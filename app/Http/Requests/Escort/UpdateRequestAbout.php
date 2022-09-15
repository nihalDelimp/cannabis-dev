<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestAbout extends FormRequest
{
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
        return [
            //'about'=>'required',
        ];
    }
}
