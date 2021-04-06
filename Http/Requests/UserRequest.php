<?php


namespace Mohsen\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mohsen\Course\Models\Course;
use Mohsen\Course\Rules\ValidTeacher;
use Mohsen\User\Models\User;
use Mohsen\User\Rules\ValidMobile;
use Mohsen\User\Rules\ValidPassword;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        return [
            'name' => ['required','min:3','max:190'],
            'email' => ['required','email','min:3','max:190','unique:users,email,'.request()->route('user')],
            'username' => ['nullable','min:3','max:190','unique:users,username,'.request()->route('user')],
            'status' => ['required',Rule::in(User::$statuses)],
            'role' => ['nullable','exists:roles,name'],
            'mobile' => ['nullable','unique:users,mobile,'.request()->route('user'),new ValidMobile()],
            'image'=>['nullable','mimes:jpeg,jpg,png'],
            'password'=>['nullable',new ValidPassword()]
        ];
    }

    public function attributes()
    {
        return [
            'name'=>trans('User::validation.attributes.name'),
            'email' => trans('User::validation.attributes.email'),
            'username' => trans('User::validation.attributes.username'),
            'status' => trans('User::validation.attributes.status'),
            'mobile' => trans('User::validation.attributes.mobile'),
            'image'=>trans('User::validation.attributes.image'),
            'password'=>trans('User::validation.attributes.password'),
        ];
    }
}
