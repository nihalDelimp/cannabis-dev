<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
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
            'phone' => 'required',//|unique:users',
            'age' => 'required|numeric',
            'name' => 'required',
            //'pincode' => 'required|numeric',
            'city_id' => 'required|integer',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            //'social_links' => 'required|array',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = true;
        $message = $validator->errors()->first();
        $errors = $validator->errors()->toArray();

        $response = response()->json(compact('error', 'message', 'errors'), 422);

        throw new ValidationException($validator, $response);
    }
}
