<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    protected $table = 'details';

    protected $fillable = ['member_id', 'first_name', 'middle_name','last_name'];
}
