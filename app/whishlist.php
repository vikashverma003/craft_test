<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class whishlist extends Model
{
    use SoftDeletes;
    protected $table ='whishlists';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'wishlist_name',
    ];

    public function user()
		{
		    return $this->belongsTo('App\User', 'user_id', 'id');
		}

}
