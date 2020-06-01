<?php

namespace App\Http\Requests\Tank;

use Illuminate\Foundation\Http\FormRequest;

class transferRequest extends FormRequest
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
            'sender_tank_code'=>'required',
            'receiver_tank_code'=>'required',
            'sender_location_id'=>'required',
            'receiver_location_id'=>'required'
        ];
    }
}
