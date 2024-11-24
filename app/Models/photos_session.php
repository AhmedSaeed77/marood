<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class photos_session extends Model
{
    public $items = [];
    

    public function __Construct($sessionphotos = null)
    {
        if($sessionphotos)
        {
            $this->items = $sessionphotos->items;
        }
        else
        {
            $this->items = [];
        }
    }


    // function add products to cart

    public function add($photo)
    { 
            $items = [
            // 'img' => $photo['img'],
            'type' => $photo['type'],
            'sort'=>$photo['sort'],
            'name'=>$photo['name']
              ]; 
             
      
        if(!array_key_exists($photo['name'] , $this->items))
        {   
            $this->items[$photo['name']] = $items;         
        } 
        

    }

    // function delete product from cart

    public function remove($name)
    {
        if(array_key_exists($name , $this->items))
        { 
           unset($this->items[$name]);

        }
    }
}
