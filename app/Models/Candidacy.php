<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidacy extends Model
{
    protected $table = 'candidacy';

    protected $fillable = [
        'name',
        'email',
        'desired_role',
        'education_level',
        'observations',
        'sender_ip',
        'cv_file'
    ];
}
