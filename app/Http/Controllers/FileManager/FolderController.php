<?php

namespace App\Http\Controllers\FileManager;

use App\Models\Media_files;
use App\Models\Media_folders;
use Illuminate\Support\Facades\DB;

class FolderController extends FileManagerController
{
    public function getFolders()
    {
        $childrens = [];
        $folders = Media_folders::whereNull('folder_id')
            ->where('type', '=', $this->getType())
            ->get(['id', 'name']);
        $storage = Media_files::sum('size');
        $total = disk_total_space(storage_path());

        foreach ($folders as $folder) {
            $childrens[] = (object) [
                'name' => $folder->name,
                'url' => $folder->id,
                'children' => [],
                'has_next' => false,
            ];
        }

        return view('filemanager/tree')
            ->with(
                [
                    'storage' => $storage,
                    'total' => $total,
                    'root_folders' => [
                        (object) [
                            'name' => 'Root',
                            'url' => '',
                            'children' => $childrens,
                            'has_next' => $childrens ? true : false,
                        ],
                    ],
                ]
            );
    }

    public function addfolder()
    {
        $folder_name = request()->input('name');
        $parent_id = request()->input('working_dir');

        if ($folder_name === null || $folder_name == '') {
            return $this->error('folder-name');
        }

        if (Media_folders::folderExists($folder_name, $parent_id)) {
            return $this->error('folder-exist');
        }

        if (preg_match('/[^\w-]/i', $folder_name)) {
            return $this->error('folder-alnum');
        }

        DB::beginTransaction();
        try {
            $model = new Media_folders();
            $model->name = $folder_name;
            $model->type = $this->getType();
            $model->folder_id = $parent_id;
            $model->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        return $this->_success_response;
    }
}
