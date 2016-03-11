<?php

namespace App\Http\Requests;

use App\User;
use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Auth()->user()->id;
        $user = User::findOrFail($id);
        if(in_array('admin', $user->roles->lists('name')->toArray()) OR in_array('source', $user->roles->lists('name')->toArray())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'role'      => 'required',
            'password'  => 'required|confirmed|min:10|max:255',
        ];
    }
}
