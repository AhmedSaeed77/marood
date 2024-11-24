<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberShipDetailsResource;
use App\Http\Resources\MemberShipResource;
use App\Models\MemberShip;
use App\Traits\ApiTrait;

class MemberShipsController extends Controller
{
    use ApiTrait;
    public function index() {
        $memberShips = MemberShip::get();
        return $this->sendResponse('success' , MemberShipResource::collection($memberShips));
    }

    public function show(MemberShip $membership) {
        return $this->sendResponse('success' , MemberShipDetailsResource::make($membership));
    }
}
