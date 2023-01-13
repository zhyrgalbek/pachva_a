<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "image",
        "title",
        "link",
        "description",
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
            1 => __('Top slider'),
            2 => __('Main slider'),
            3 => __('Advantages'),
            4 => __('Financial literacy'),
            5 => __('Banks and partners')
        ];
    }

    public function notPublished()
    {
        return !$this->published;
    }
}
