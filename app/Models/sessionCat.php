<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class sessionCat extends Model
{
    public $items = [];
    

    public function __Construct($sessionCat = null)
    {
        if($sessionCat)
        {
            $this->items = $sessionCat->items;
        }
        else
        {
            $this->items = [];
        }
    }


    // function add products to cart

    public function add($cat)
    {
       
            $items = [
            'id' => $cat->id,
            'title' => app()->getLocale() == 'ar' ? $cat->name_ar : $cat->name_en,
              ]; 
             
      
        if(!array_key_exists($cat->id , $this->items))
        {   
            $this->items[$cat->id] = $items;         
        } 
        

    }

    // function delete product from cart

    public function remove($id)
    {
        if(array_key_exists($id , $this->items))
        { 
           unset($this->items[$id]);

        }
    }
}
