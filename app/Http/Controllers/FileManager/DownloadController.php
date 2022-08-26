<?php

namespace App\Http\Controllers\FileManager;

use Illuminate\Support\Facades\Storage;
use App\Models\Media_files;

class DownloadController extends FileManagerController
{
    public function getDownload()
    {
        $file = $this->getPath(request()->get('file'));
        $data = Media_files::where('path', '=', $file)->first(['name']);

        $path = Storage::disk(config('configFile.filemanager.disk'))->path($file);
        if ($data) {
            return response()->download($path, $data->name);
        }

        return response()->download($path);
    }
}
