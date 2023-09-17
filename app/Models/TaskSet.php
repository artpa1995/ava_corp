<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSet extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function taskRelation(){
        return $this->hasMany(TaskSetRelation::class, 'task_set_id', 'id')->with('user:id,last_name,first_name')->orderBy('positions', 'ASC');
    }
}
