<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bankName'=>$this->bankName,
            'accountnumber'=>$this->accountnumber,
            'userNameBank'=>$this->userNameBank,
            'Iban'=>$this->Iban,
            'bank_photo'=>url('public/storage').'/'.$this->bank_photo,
            'qr'=>url('public/storage').'/'.$this->qr,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
