<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'lp_product_id' => $this->lp_product_id,
            'title' => $this->title,
            'price' => $this->price,
            'price_new' => $this->price_new,
            'image_landing' => $this->image_landing,
            'active' => $this->active,
            'landing_page' => $this->landing_page,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'slug' => $this->slug,

            'title_upsale' => $this->title_upsale,
            'price_upsale' => $this->price_upsale,
            'price_upsale_new' => $this->price_upsale_new,
            'image_upsale' => $this->image_upsale,
            'lp_product_id_upsale' => $this->lp_product_id_upsale,
        ];
    }
}
