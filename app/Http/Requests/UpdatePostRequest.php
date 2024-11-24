<?php

namespace App\Http\Requests;

use App\Traits\ApiTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    use ApiTrait;
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
        return [
            'cat_id' => [Rule::exists('cats' , 'id')],
            'area_id' => [Rule::exists('areas' , 'id')],
//            'mobile' => 'regex:/(01)[0-9]{9}/',
            'bank_id' => [Rule::exists('haraj_banks' , 'id')] ,
            'use_status' => [Rule::in([1,2,3])],
            'post_type' => [Rule::in([1,2])],
            'gear_type' => [Rule::in([0,1])],
            'price_type' => [Rule::in([0,1])],
            'fuel_type' => [Rule::in([0,1,2])],
            'double' => [Rule::in([0,1])],
            'contact' => [Rule::in([1,2])],
            'images.*' =>'mimes:jpeg,jpg,png,gif',
            'videos.*' => 'mimes:mp4,mov,ogg,qt'


        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $er = [];
        $errors = $this->validator->errors();
        foreach($errors->all() as $error){
            array_push($er, $error);
        }
        throw new HttpResponseException(
            $this->responseValidationJsonFailed($er)
        );
    }
}
