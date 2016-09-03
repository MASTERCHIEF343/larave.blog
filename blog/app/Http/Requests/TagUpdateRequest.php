<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TagUpdateRequest extends Request
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
            'title' => 'required',
            'subtitle' => 'required',
            'layout' => 'required',
        ];
    }
    public function messages(){
        return [
            'title.required' => '缺少标题',
            'subtitle.required' => '缺少副标题',
            'layout.required' => '缺少模板',
        ];
    }
}
