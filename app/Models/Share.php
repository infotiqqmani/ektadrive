<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;
    protected $fillable = [
        'share_to', 'share_from', 'file_id', 'folder_id',
    ];

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'share_from');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'share_to');
    }
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
