<?php

namespace blogCms\Http\Requests\Page;

use blogCms\Http\Requests\Request;

class StorePageRequest extends Request
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
            'name' => ['unique:pages'],
            'title'   => ['required'],
            'uri'    => ['required', 'unique:pages'],
            'content' => ['required']

        ];
    }
}
