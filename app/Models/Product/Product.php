<?php

namespace App\Models\Product;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use Sluggable;

    protected $fillable = [
        'title',
        'price',
        'price_new',
        'image',
        'images',
        'image_landing',
        'active',
        'landing_page',
        'lp_product_id',
        'slug',

        'title_upsale',
        'image_upsale',
        'price_upsale',
        'price_upsale_new',
        'lp_product_id_upsale',
    ];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
