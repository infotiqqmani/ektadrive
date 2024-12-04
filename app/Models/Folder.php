<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['folder_name', 'user_id','parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_folder');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function file()
    {
        return $this->hasMany(File::class);
    }


    public function shares()
    {
        return $this->hasMany(Share::class, 'id');
    }
    public function sharedUsers()
    {
        return $this->belongsToMany(User::class,  'folder_id', 'user_id'); // Adjust table names and keys as necessary
    }
}