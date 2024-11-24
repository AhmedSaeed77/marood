<?php

namespace App\Http\Requests;

use App\Traits\ApiTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayCommisionRequest extends FormRequest
{
    use ApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'username' => 'required',
            'phone' => 'required',
            'price' => 'required',
            'back_id' => Rule::exists('haraj_banks' , 'id'),
            'timeOfTransfer' => Rule::exists('transfer_dates' , 'id'),
            'money_sender' => 'required',
            'receipt_photo' => 'mimes:jpeg,jpg,png,gif',
            'type' => ['required' , Rule::in(0,1)]
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $er = [];
        $errors = $this->validator->errors();
        foreach($errors->all() as $error){
            array_push($er, $error);
        }
        return $er;
    }
}
