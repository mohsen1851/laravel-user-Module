<?php


namespace Mohsen\User\Http\Controllers;


use App\Http\Controllers\Controller;
use Mohsen\Common\Responses\AjaxResponses;
use Mohsen\Media\Services\MediaFileService;
use Mohsen\RolePermissions\Models\Role;
use Mohsen\RolePermissions\Repositories\RoleRepo;
use Mohsen\User\Http\Requests\ProfileUpdateRequest;
use Mohsen\User\Http\Requests\UserPhotoUpdateRequest;
use Mohsen\User\Http\Requests\UserRequest;
use Mohsen\User\Models\User;
use Mohsen\User\Repositories\UserRepo;

class UserController extends Controller
{
    /**
     * @var UserRepo
     */
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {

        $this->userRepo = $userRepo;
    }

    public function index(RoleRepo $roleRepo)
    {
        $this->authorize('index', User::class);
        $roles = $roleRepo->all();
        $users = $this->userRepo->paginate();
        return view('User::Admin.index', compact('users', 'roles'));
    }


    public function edit($user_id, RoleRepo $roleRepo)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($user_id);
        $roles = $roleRepo->all();
        return view('User::Admin.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, $user_id)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($user_id);
        if ($request->hasFile('image')) {
            $request->request->add([
                'image_id' =>
                    MediaFileService::publicUpload($request->image)->id
            ]);
            if ($user->image) {
                $user->image->delete();
            }
        } else {
            $request->request->add([
                'image_id' =>
                    $user->image_id
            ]);
        }
        $this->userRepo->update($user_id, $request);
        newFeedback();
        return back();
    }

    public function destroy($user_id)
    {
        $this->authorize('destroy', User::class);
        $this->userRepo->findById($user_id)->delete();
        return AjaxResponses::successResponse('با موفقیت حذف شد');
    }

    public function manualVerify($userId)
    {
        $this->authorize('manualVerify', User::class);
        $user = $this->userRepo->findById($userId);
        $user->markEmailAsVerified();
        return AjaxResponses::successResponse('کاربر تائید شد');
    }

    public function updatePhoto(UserPhotoUpdateRequest $request)
    {
        $media = MediaFileService::publicUpload($request->userPhoto);
        $user = auth()->user();
        if ($user->image_id) $user->image->delete();

        $user->update(['image_id' => $media->id]);
        return back();
    }

    public function profile()
    {
        $user = auth()->user();
        return view('User::admin.profile', compact('user'));
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $this->userRepo->updateProfile($request);
        newFeedback();
        return back();
    }
}
