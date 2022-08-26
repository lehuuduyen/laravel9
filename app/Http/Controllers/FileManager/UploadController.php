<?php

namespace App\Http\Controllers\FileManager;

use App\Models\Media_files;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Juzaweb\CMS\Support\FileManager;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadController extends FileManagerController
{
    protected  $errors = [];

    public function upload(Request $request): JsonResponse
    {
        $folderId = $request->input('working_dir');

        if (empty($folderId)) {
            $folderId = null;
        }

        try {
            
            if ($request->hasFile('upload')) {
                $file = $request->upload;
                
                
                $fileName = time() . "_" . $file->getClientOriginalName();
                $path = $this->makeFolderUpload();
                
                Storage::putFileAs($path, $file, $fileName);
                $fullPath = $path.'/'.$fileName;
                $this->addFile($file, $this->getType(),$fullPath, $folderId);
                return $this->response($this->errors);

                // $file->move('app/public/', $file->getClientOriginalName());
                // //Lấy Tên files $file->getClientOriginalName()
                // //Lấy Đuôi File $file->getClientOriginalExtension()
                // //Lấy đường dẫn tạm thời của file $file->getRealPath()
                // //Lấy kích cỡ của file đơn vị tính theo bytes $file->getSize()
                // //Lấy kiểu file $file->getMimeType()

            }
            return $this->returnJson('');
        } catch (\Exception $e) {
            Log::error($e);
            $this->errors[] = $e->getMessage();
            return $this->response($this->errors);
        }
    }
    protected function makeFolderUpload(): string
    {
        $folderPath = date('Y/m/d');

        $checkFolderPath = Storage::disk(config('configFile.filemanager.disk'))->getDriver()->getAdapter()->getPathPrefix().$folderPath;
        $folderPath = config('configFile.filemanager.disk').'/'.$folderPath;
        
        
        
        // Make Directory if not exists
        if (! file_exists($checkFolderPath)) {
            File::makeDirectory($checkFolderPath, 0775, true);
        }

        return $folderPath;
    }
    protected function addFile(
        $file,
        string $type = 'image',
        $path ,
        $folderId = null
    )
    {
        $fileName = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $userId = \Auth::id();
        return Media_files::create(
            [
                'name'=>$fileName,
                'type'=>$type,
                'mime_type'=>$mimeType,
                'path'=>$path,
                'extension'=>$extension,
                'size'=>$size,
                'folder_id'=>$folderId,
                'user_id'=>$userId,
            ]
        );
        
    }
    protected function response($error_bag): JsonResponse
    {
        $response = count($error_bag) > 0 ? $error_bag : $this->_success_response;

        return response()->json($response);
    }
}
