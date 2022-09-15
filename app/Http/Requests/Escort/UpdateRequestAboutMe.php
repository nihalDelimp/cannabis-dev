<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class UpdateRequestAboutMe extends FormRequest
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
            //'gender'=>'required',
            //'nationality_id'=>'required',
            // 'statistics'=>'required',
            // 'height'=>'required',
            // 'eyes'=>'required',
            // 'orientation'=>'required',
            'age'=>'required',
            // 'hair_color'=>'required',
            // 'skin_tone'=>'required',
            // 'breast'=>'required',
            // 'contact'=>'required',
            // 'ethnicity'=>'required',
            // 'body_type'=>'required',
            // 'hair_style'=>'required',
            // 'weight'=>'required',
            // 'dress_size'=>'required',
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi,video/webm,video/ogg',
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
