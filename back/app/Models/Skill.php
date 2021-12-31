<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable=['skill_name','skill_detail'];
    public function user_skill()
    {
        return $this->belongsTo(User_Skill::class);
    }
}
