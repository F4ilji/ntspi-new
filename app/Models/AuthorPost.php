<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorPost extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'authors_posts';
}
