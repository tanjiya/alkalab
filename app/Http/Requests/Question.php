<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class Question extends FormRequest
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
                        'question_type' => 'required | min:3 | max:10',
                        'title' => 'required | min:5 | max:100',
                        'question' => 'required | min:5 | max:255',
                        'description' => 'min:10 | max:255',
                        'is_required' => 'required',
                    ];
                }
                break;

            case 'PUT':
                {
                    return [
                        'question_type' => 'sometimes | required | min:3 | max:10',
                        'title' => 'sometimes | required | min:5 | max:100',
                        'question' => 'sometimes | required | min:5 | max:255',
                        'description' => 'sometimes | min:10 | max:255',
                        'is_required' => 'sometimes | required',
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
            'question_type.required' => 'Question Type is Required!',
            'title.required' => 'Title is Required!',
            'question.required' => 'Question is Required!',
            'is_required.required' => 'Is Require Value is Required',
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
