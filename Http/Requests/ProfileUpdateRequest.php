<?php


namespace Mohsen\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mohsen\Course\Models\Course;
use Mohsen\Course\Rules\ValidTeacher;
use Mohsen\User\Models\User;
use Mohsen\User\Rules\ValidMobile;
use Mohsen\User\Rules\ValidPassword;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        return [
            'name' => ['required','min:3','max:190'],
            'email' => ['required','email','min:3','max:190','unique:users,email,'.auth()->id()],
            'username' => ['nullable','min:3','max:190','unique:users,username,'.auth()->id()],
            'mobile' => ['required','unique:users,mobile,'.auth()->id(),new ValidMobile()],
            'password'=>['nullable',new ValidPassword()]
        ];
    }

    public function attributes()
    {
        return [
            'name'=>trans('User::validation.attributes.name'),
            'email' => trans('User::validation.attributes.email'),
            'username' => trans('User::validation.attributes.username'),
            'password'=>trans('User::validation.attributes.password'),
        ];
    }

}
