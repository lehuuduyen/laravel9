<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatLink extends Model
{
    use HasFactory;
    protected $table = 'format_links';
    protected $fillable = [
        'title',
        'link',
        'code',
    ];
}
