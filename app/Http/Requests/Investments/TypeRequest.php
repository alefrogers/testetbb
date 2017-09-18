<?php

namespace App\Http\Requests\Investments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Response;

class TypeRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = array(
            'name' => 'required',
            'profitability' => 'required|numeric',
            'rate' => 'required|numeric',
            'application_days' => 'required|numeric'            
        );        

        return $rules;
    }

}