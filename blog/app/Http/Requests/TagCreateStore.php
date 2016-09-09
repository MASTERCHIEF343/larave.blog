<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TagCreateStore extends Request
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
            'tag' => 'bail|required',
            'title' => 'bail|required',
            'subtitle' => 'bail|required',
            'layout' => 'bail|required',
        ];
    }
    public function messages(){
        return [
            'tag.required' => '缺少标签名',
            'title.required' => '缺少标题',
            'subtitle.required' => '缺少副标题',
            'layout.required' => '缺少模板',
        ];
    }
}
