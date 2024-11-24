<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\followCat;

class MenueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
      
            if(auth('api')->check()){

            $follow_cat = followCat::query()
                ->where('user_id','=',auth('api')->id())
                ->where('cat_id','=',$this->cat->id)
                ->exists();
        }

        return [
            'id' => $this->cat->id,
             'follow_cat' => auth('api')->check() ? ($follow_cat ? 1 : 0) : null,
            'name' => $this->name,
            'icon' => $this->cat->icon,
             'photo'=>$this->photo != null ? $this->photo : asset('public/cap/capimage.png'),
            'sort'=>$this->sort,
            'is_year'=>$this->cat->is_year,
            'type'=>$this->cat->type,
            'has_child'=>$this->has_child(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
