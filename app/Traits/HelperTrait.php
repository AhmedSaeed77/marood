<?php

namespace App\Traits;

Trait HelperTrait
{
    public function upload($file , $path){
        $name = time() . md5(rand()) . $file->getClientOriginalName();
        $file->move(base_path() . '/public/storage/' . $path , $name);
        return $name;
    }
    public function getUrlWithoutParameters()
    {
        $url = url()->current();
        $urlWithoutParameters = strtok($url, '?');

        return $urlWithoutParameters;
    }


}
