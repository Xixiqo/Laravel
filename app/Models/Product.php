<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
 protected $fillable = [
 'category_id',
 'name',
 'slug',
 'price',
 'stock',
 'description',
 ];
 public function category()
 {
 return $this->belongsTo(Category::class);
 }

	public function images()
	{
		return $this->hasMany(Image::class);
	}

	public function getFirstImageUrlAttribute()
	{
		$image = $this->images()->orderByDesc('is_primary')->first();
		if (! $image) {
			return null;
		}
		return '/storage/' . $image->path;
	}
}