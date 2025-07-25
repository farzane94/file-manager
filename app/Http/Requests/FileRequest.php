<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends BaseRequest
{
    public function postRules()
    {
       return [
           'file' => 'required|file|mimes:pdf,jpg,png,docx|max:5120'
       ];
    }
}
