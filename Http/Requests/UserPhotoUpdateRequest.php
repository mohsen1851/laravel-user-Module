<?php


namespace Mohsen\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mohsen\Course\Models\Course;
use Mohsen\Course\Rules\ValidTeacher;
use Mohsen\User\Models\User;
use Mohsen\User\Rules\ValidMobile;

class UserPhotoUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        return [
            'userPhoto' => ['required','image'],
        ];
    }

}
