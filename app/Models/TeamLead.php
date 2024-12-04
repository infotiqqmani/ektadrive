<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamLead extends Model
{
    use HasFactory;
    protected $table = 'teamleads';
    protected $primaryKey = 'id';



    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
