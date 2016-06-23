<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\User;
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
        $user = \Auth::user();
        if($user->hasRoles(['admin', 'super admin'])) {
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
