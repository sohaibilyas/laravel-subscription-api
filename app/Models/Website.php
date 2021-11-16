<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
