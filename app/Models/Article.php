<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "photo",
        "title",
        "summary",
        "body",
        "published",
        "published_at",
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }


    public function getDateAttribute()
    {
        return $this->getAttribute('created_at');
    }

    public static function getTypeOptions()
    {
        return [
            1 => __('FinMarket news'),
            2 => __('Financial Sector News'),
            3 => __('Bank news')
        ];
    }

    public function notPublished()
    {
        return !$this->published;
    }
}
