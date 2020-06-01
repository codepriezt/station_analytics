<?php

namespace App\Http\Requests\Water;

use Illuminate\Foundation\Http\FormRequest;

class waterSupplyRequest extends FormRequest
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
            'supplied_width'=>'required',
            'supplied_lenght'=>'required',
            'supplied_depth'=>'required',
            'tank_type'=> 'required',
            'location_id'=>'required'

            
        ];
    }
}
