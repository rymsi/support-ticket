<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['priority', 'title', 'ticket_id', 'category_id', 'user_id', 'message', 'status'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }
}
