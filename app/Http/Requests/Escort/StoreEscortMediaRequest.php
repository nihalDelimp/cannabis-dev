<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;

class StoreEscortMediaRequest extends FormRequest
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
     //,jpeg,image/jpeg,image/png,jpg,gif,svg|max:256000|dimensions:min_width=130,min_height=200,max_width=1000,max_height=1024
    public function rules()
    {
        return [
            'files' => 'required|array',
            'files.*' => 'required|mimetypes:mp4,video/mp4,video/avi,video/mpeg,video/webm,video/quicktime,jpeg,image/jpeg,image/png,jpg,gif,svg',
        ];

    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach($this->file('files') as $file) {
                //dd($file);
                if(in_array($file->getClientMimeType(),['jpeg','image/jpeg','image/png','jpg','gif','svg']))
                {

                    $data = getimagesize($file);
                    //dd($data);
                    $width = $data[0];
                    $height = $data[1];
                    //
                    if($width >= 130 && $width <= 1000 && $height >= 200 && $height <= 1024)
                    {
                        
                    } else {
                        $validator->errors()->add('dimension_error', 'Image dimensions should be 130x200 to 1000x1024');
                    }
                   
                    // $validator->validate($this, [

                    //     'files.*' => 'max:256000|dimensions:min_width=130,min_height=200,max_width=1000,max_height=1024'
                    
                    // ]);
                   

                }
            }
            
        });
    }
    
    protected function failedValidation(Validator $validator)
    {
        $data = $this->setResponseFormat($validator->errors()->first(), $validator->errors()->toArray(), array(), 0);
        $response = response()->json($data, 422);

        throw new ValidationException($validator, $response);
    }
}
