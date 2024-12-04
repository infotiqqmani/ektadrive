<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['file_name', 'folder_id', 'user_id'];
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function shares()
    // {
    //     return $this->hasMany(Share::class);
    // }

    public function shares()
    {
        return $this->hasMany(Share::class, 'id');
    }

    // public function folder()
    // {
    //     return $this->belongsTo(Folder::class);
    // }
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
