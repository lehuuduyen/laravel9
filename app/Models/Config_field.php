<?php

namespace App\Models;

use App\Models\Config_detail_field;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config_field extends Model
{
    use HasFactory;
    protected $table = 'config_field';
    protected $fillable = ['title','key'];

    public function config_detail_field()
    {
        return $this->hasMany(Config_detail_field::class)->select("title","key","type");
    }

}
