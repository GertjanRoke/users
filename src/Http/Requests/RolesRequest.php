<?php

namespace App\Http\Requests;

use App\Role;
use App\User;
use App\Http\Requests\Request;

class RolesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::findOrFail(\Auth()->user()->id);
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|min:3|max:255|unique:roles,name',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $id = $this->route()->roles;
                $role = Role::findOrFail($id);
                return [
                    'name' => 'required|min:3|max:255|unique:roles,name,'.$role->id,
                ];
            }
            default:break;
        }
    }
}
