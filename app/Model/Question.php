<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public static function boot()
    {
        parent::boot();
        static::creating(static function($question) {
            $question->slug = str_slug($question->title);
        });
    }

    // protected $guarded = [];
    protected $fillable = ['title', 'slug','body', 'user_id', 'category_id'];

    // override the id routing
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPathAttribute()
    {
        return "/question/$this->slug";
    }
}
