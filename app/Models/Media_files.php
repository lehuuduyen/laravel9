<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media_files extends Model
{
    use HasFactory;
    protected $table = 'media_files';
    protected $fillable = [
        'name',
        'path',
        'extension',
        'mime_type',
        'user_id',
        'folder_id',
        'type',
        'size',
    ];

    public function delete()
    {
        Storage::disk(config('configFile.filemanager.disk'))->delete($this->path);

        return parent::delete();
    }

    public function isImage()
    {
        return in_array(
            $this->mime_type,
            config('configFile.filemanager.types.image.valid_mime')
        );
    }
}
