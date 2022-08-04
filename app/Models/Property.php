<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use HasFactory,SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'password',
        'city',
        'country',
        'address',
        'price',
        'sqm',
        'bedrooms',
        'bathrooms',
        'garages',
        'slider',
        'visible'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('sliderbild')
            ->performOnCollections('slider')
            ->crop('crop-center', 1920, 960)
            ->nonQueued();
        $this->addMediaConversion('thumb-slider')
            ->performOnCollections('slider')
            ->crop('crop-center', 192, 96)
            ->nonQueued();
        $this->addMediaConversion('hauptbild')
            ->performOnCollections('hauptbilder')
            ->crop('crop-center', 600, 800)
            ->nonQueued();
        $this->addMediaConversion('thumb-hauptbild')
            ->performOnCollections('hauptbilder')
            ->crop('crop-center', 120, 160)
            ->nonQueued();
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value,0,'',','),
            set: fn ($value) => preg_replace('/[^0-9]/','',$value),
        );
    }

}
