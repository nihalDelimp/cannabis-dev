<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponser;

class SaveServiceRequest extends FormRequest
{
    use ApiResponser;
    
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
            'category_id'   => 'nullable|numeric',
            'name' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $data = $this->setResponseFormat('validation_failed', $validator->errors()->toArray(), array(), 0);
        $response = response()->json($data, 422);

        throw new ValidationException($validator, $response);
    }
}
