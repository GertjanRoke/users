<?php

namespace App\Http\Requests;

use App\User;
use App\Http\Requests\Request;

/**
 * Update user request
 * @package users
 * @author Gertjan Roke
 */
class UserRequest extends Request
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
                        'name'      => 'max:255',
                        'email'     => 'required|email|max:255|unique:users,email',
                        'role'      => 'required',
                        'password'  => 'required|min:5|max:255|confirmed',
                    ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $id = $this->route()->users;
                $user = User::findOrFail($id);
                if(!$this->get('password'))
                {
                    return [
                        'name'      => 'max:255',
                        'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
                        'role'      => 'required',
                        'password'  => 'min:5|max:255|confirmed',
                    ];
                }
                else
                {
                    return [
                        'name'      => 'max:255',
                        'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
                        'role'      => 'required',
                        'password'  => 'required|min:5|max:255|confirmed',
                    ];
                }
            }
            default:break;
        }
    }
}
