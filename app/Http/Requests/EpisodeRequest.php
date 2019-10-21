<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
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

        if($this->method() == 'POST'){
          return [
              'title' =>'required|max:250',
              'description' =>'required',
              'videoUrl' =>'required',
              'course_id'=>'required',
              'time'=>'required',
              'number' =>'required',
              'type' =>'required',
              'tags' =>'required'

          ];
        }
          return [
            'title' =>'required|max:250',
            'description' =>'required',
            'videoUrl' =>'required',
            'course_id'=>'required',
            'time'=>'required',
            'number' =>'required',
            'type' =>'required',
            'tags' =>'required'

          ];

    }
}
