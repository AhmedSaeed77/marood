<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\menues;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    use ApiTrait;
    public function index() {
        $menus = menues::with('items')->get(['id' , 'name'  ,'is' , 'h_v' , 'show']);
        return $this->sendResponse('success' , $menus);
    }
}
