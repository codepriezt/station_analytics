<?php

namespace App\Http\Requests\Tank;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
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
            'code'=>'required',
            'tank_type'=>'required',
            'tank_dimension'=>'required',
            'location_id'=>'required',
            'height'=>'required',
            'length'=>'required',
            'width'=>'required',
            'depth'=>'required'
        ];
    }
}
