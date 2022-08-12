<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id', 'status'];
    protected $withCount = ['students', 'reviews'];

    use HasFactory;

    const BORRADOR = 1;
    const REVISION = 2;
    const PUBLICADO = 3;

    public function getRatingAttribute()
    {
        if($this->reviews_count)
        {
            return round($this->reviews->avg('rating'), 1);
        }
        else
        {
            return 5;
        }
    }

    //QUERY SCOPES
    public function scopeCategory($query, $category_id)
    {
        if($category_id)
        {
            return $query->where('category_id', $category_id);
        }
    }


    public function getRouteKeyName()
    {
        return "slug";
    }

    //Relacion uno a muchos
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function requirements()
    {
        return $this->hasMany('App\Models\Requirement');
    }

    public function goals()
    {
        return $this->hasMany('App\Models\Goal');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }


    //Relacion uno a muchos inversa
    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }


    //Relacion muchos a muchos
    public function students()
    {
        return $this->belongsToMany('App\Models\User');
    }


    //Realcion uno a uno polimorfica
    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function lessons()
    {
        return $this->hasManyThrough('App\Models\Lesson', 'App\Models\Section');
    }
}
