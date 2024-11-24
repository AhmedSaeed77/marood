<?php

namespace App\Http\Resources;

use App\Models\followCat;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(auth('api')->check()) {

            $follow_cat = followCat::query()
                ->where('user_id', '=', auth('api')->id())
                ->where('cat_id', '=', $this->id)
                ->exists();

        }
        return [
            'id' => $this->id,
            'follow_cat' => auth('api')->check() ? ($follow_cat ? 1 : 0) : null,
            'parent_id' => $this->parent->id,
            'name' => $this->name,
            'icon' => $this->icon,
           'photo'=> $this->photo != null ? asset('public/storage/'.$this->photo) : asset('public/cap/capimage.png'),
            'sort'=>$this->sort,
            'is_year'=>$this->is_year,
            'type'=>$this->type,
            'has_child'=>$this->has_child(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
