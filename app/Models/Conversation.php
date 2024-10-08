<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title'];

    public function messages() {
        return $this->hasMany(Message::class);
    }
}
