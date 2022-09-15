<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponser;

class StoreRateRequest extends FormRequest
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
            // 'price*' => 'required|array',
            // 'price.*' => 'integer',
            // 'service_id*' => 'required|array',
            // 'service_id.*' => 'integer',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $data = $this->setResponseFormat($validator->errors()->first(), $validator->errors()->toArray(), array(), 0);
        $response = response()->json($data, 422);

        throw new ValidationException($validator, $response);
    }
}
