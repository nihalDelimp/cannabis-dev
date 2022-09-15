<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgentBankDetailRequest extends FormRequest
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
            //'account_number' => 'required|unique:agent_bank_details',
            // 'email' => 'required|unique:users',
            // 'password' => 'required',
            // 'type' => 'required|in:5',
        ];
    }
}
