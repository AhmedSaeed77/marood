<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowedCategoriesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
           'category' => $this->Cat
        ];
    }
}
