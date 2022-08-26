<?php

namespace App\Http\Controllers\FileManager;

use Illuminate\Http\Request;

use App\Models\Media_files;
use App\Models\Media_folders;

class DeleteController extends FileManagerController
{
    public function delete(Request $request)
    {
        $itemNames = $request->post('items');
        $errors = [];

        foreach ($itemNames as $file) {
            if (is_null($file)) {
                array_push($errors, parent::error('folder-name'));
                continue;
            }

            $is_directory = $this->isDirectory($file);
            if ($is_directory) {
                Media_folders::find($file)->deleteFolder();
            } else {
                $file_path = $this->getPath($file);
                Media_files::where('path', '=', $file_path)
                    ->first()
                    ->delete();
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return $this->_success_response;
    }
}
