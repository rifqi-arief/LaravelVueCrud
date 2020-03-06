<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactModel extends Model
{
    use SoftDeletes;

    protected $table = 'contact';    
    protected $fillable = ['name', 'phone','gender','address'];
}
