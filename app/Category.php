<?php
/*

=========================================================
* Argon Dashboard PRO - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro-laravel
* Copyright 2018 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)

* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
namespace App;

use App\Specific;
use App\Type;
use App\Deal;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'truck_mounted', 'type_id', 'title_structure', 'user_id'];
    
    /**
     * Get the category of the item
     *
     * @return \App\Type
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the tags of the item
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function specifics()
    {
        return $this->belongsToMany(Specific::class);
    }
    
    /**
     * Get the tags of the item
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
