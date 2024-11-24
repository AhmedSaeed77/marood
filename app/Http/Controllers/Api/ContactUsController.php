<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiTrait;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use ApiTrait , HelperTrait;

    public function store(Request $request){
        if ($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = $this->upload($file , 'contacts/');
        }

        
    }
}
