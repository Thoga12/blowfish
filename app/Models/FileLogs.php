<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileLogs extends Model
{
    //
    protected $fillable = ['file_name', 'type', 'size'];
}
