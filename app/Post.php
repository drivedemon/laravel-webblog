<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
  protected $fillable = ['title', 'description', 'content', 'image', 'category_id', 'user_id'];

  public function deleteImage() {
    Storage::delete($this->image);
  }

  public function hasTag($tagId) {
    return in_array($tagId, $this->tag->pluck('id')->toArray());
  }

  public function tag() {
    return $this->belongsToMany(Tag::class)->withTimestamps();
  }

  public function category() {
    return $this->belongsTo(Category::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }
}
