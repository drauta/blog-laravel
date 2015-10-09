<?php

namespace Drauta\BlogLaravel\Http\Requests;

use App\Http\Requests\Request;

class PostFormRequest extends Request
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
            'titulo' => 'required',
            'descripcion' => 'required',
            'contenido' => 'required',
            'categoria' => 'required'
        ];
    }
}
