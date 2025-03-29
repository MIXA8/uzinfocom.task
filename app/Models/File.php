<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'path', 'hash', 'user_id'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'file_user', 'file_id', 'user_id');
    }
}
