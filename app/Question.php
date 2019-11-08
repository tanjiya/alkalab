<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'question_type',
        'title',
        'question',
        'asked_date',
        'description',
        'is_required',
    ];

    protected $hidden = [
        'answer',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
