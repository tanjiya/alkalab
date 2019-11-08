<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Answer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                {
                    return [
                        'question_id' => 'required',
                        'answer' => 'required | min:5 | max:255',
                    ];
                }
                break;

            case 'PUT':
                {
                    return [
                        'question_id' => 'sometimes | required',
                        'answer' => 'sometimes | required | min:5 | max:255',
                    ];
                }
                break;

            default:
                break;
        }
    }

    /**
     * Custom Validation Message
     */
    public function messages()
    {
        return [
            'answer.required' => 'Answer is Required!',
            'question_id.required' => 'Question Id is Required!',
        ];
    }

    /**
     * Return Validation Error in Response
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
