<?php

namespace App\Http\Controllers\FileManager;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\BaseController;
class FileManagerController extends BaseController
{
    public  $_success_response = 'OK';

    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $type = $this->getType();
        
        
        $mimeTypes =['image/jpeg','image/pjpeg','image/png','image/gif','image/svg+xml'];
        $maxSize = 5;
        $multiChoose = $request->get('multichoose', 0);
        
        if (empty($mimeTypes)) {
            return abort(404);
        }

        return view(
            'filemanager/index',
            compact(
                'mimeTypes',
                'maxSize',
                'multiChoose'
            )
        );
    }

    public function getErrors(): array
    {
        $errors = [];

        if (! extension_loaded('gd') && ! extension_loaded('imagick')) {
            $errors[] = trans('filemanager.message_extension_not_found', ['name' => 'gd']);
        }

        if (! extension_loaded('exif')) {
            $errors[] = trans('filemanager.message_extension_not_found', ['name' => 'exif']);
        }

        if (! extension_loaded('fileinfo')) {
            $errors[] = trans('filemanager.message_extension_not_found', ['name' => 'fileinfo']);
        }

        return $errors;
    }

    public function error($error_type, $variables = [])
    {
        throw new \Exception(trans('filemanager.error-' . $error_type, $variables));
    }

    protected function getType(): string
    {
        $type = strtolower(request()->get('type'));

        return Str::singular($type);
    }

    protected function getPath($url): string
    {
        $explode = explode('uploads/', $url);
        if (isset($explode[1])) {
            return $explode[1];
        }

        return $url;
    }

    protected function isDirectory($file): bool
    {
        if (is_numeric($file)) {
            return true;
        }

        return false;
    }
}
