<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuestionTime extends Model
{
    protected $fillable = ['user_id', 'question_id', 'expire_time'];
}
