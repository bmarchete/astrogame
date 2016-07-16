<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;

class StoreReportRequest extends Request
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
            'text' => 'required|min:10|max:65535',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $messages = $validator->errors();
        return response()->json(['status' => false, 'text' => $messages->first('text')]);
    }
}
