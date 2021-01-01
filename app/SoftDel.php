<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDel extends Model
{
    //
    use SoftDeletes;
    protected $table ='soft_dels';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        's_name',
    ];

}
