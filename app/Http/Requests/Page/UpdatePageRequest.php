<?php

namespace blogCms\Http\Requests\Page;

use blogCms\Http\Requests\Request;

class UpdatePageRequest extends Request
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
            'title' => ['required'],
            'name' => ['unique:pages,name,' . $this->route('pages')],
            'content' => ['required'],
            'uri' => ['required', 'unique:pages,uri,' . $this->route('pages')]
        ];
    }
}
