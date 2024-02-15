<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'upload',
        'category_id',
        'slug'
    ];

    public function category()

    {
        return $this->belongsTo(Category::class);
    }
  /*   public function tags()
    {
        return $this->belongsToMany(Tag::class)->limit(4);
    }

    public function downloadHistory()
    {
        return $this->hasMany(DownloadHistory::class);
    } */
    public function getRouteKeyName()
    {
        return 'slug';
    }
   /*  public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    } */
}
