<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable=[
        'blog_category_id','title','slug','description','thumbnail_image','feature_image','status','show_homepage','seo_title','seo_description','admin_id','view'
    ];

    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }


    public function comments(){
        return $this->hasMany(BlogComment::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

}
