<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class UpdateRequestAboutAll extends FormRequest
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
            //
        ];
    }

    public function messages()
    {
        return [
            'banner_image.image' => 'The banner image must be an image (jpeg, png, jpg, gif, svg).',
            'banner_image.mimes' => 'The banner image must be an image (jpeg, png, jpg, gif, svg).',
            'banner_image.max' => 'The banner image may not be greater than 2048 kilobytes.',
            'banner_video.mimetypes' => 'The banner video must be an video (mp4, webm, ogg).',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = true;
        $message = $validator->errors()->first();

        $response = response()->json(compact('message','error'), 422);

        throw new ValidationException($validator, $response);
    }
}
