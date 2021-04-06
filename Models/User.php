<?php

namespace Mohsen\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Mohsen\Course\Models\Course;
use Mohsen\Media\Models\Media;
use Mohsen\Payment\Models\Payment;
use Mohsen\Payment\Models\Settlement;
use Mohsen\User\Notifications\resetPasswordRequestNotification;
use Mohsen\User\Notifications\VerifyEmailNotification;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use HasFactory;

    const STATUS__ACTIVE = "active";
    const STATUS__INACTIVE = "inactive";
    const STATUS__BAN = "ban";

    public static $statuses = [
        self::STATUS__ACTIVE,
        self::STATUS__INACTIVE,
        self::STATUS__BAN
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function resetPasswordRequestNotification()
    {
        $this->notify(new resetPasswordRequestNotification());
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function HasAccessToCourse($course)
    {
        if (
            $this->can('view', $course) or
            $this->id == $course->teacher_id or
            $this->purchases->contains($course->id) or
            $course->type == Course::TYPE_FREE)
            return true;

        return false;
    }

    public function students()
    {
        return \DB::table('courses')->select("courses.id")->where('teacher_id', $this->id)->
        join('course_user', 'course_user.course_id', '=', 'courses.id')->select('course_user.user_id')->
        get()->collect()->unique('user_id');
    }

    public function purchases()
    {
        return $this->belongsToMany(Course::class, 'course_user');
    }

    public function getAvatarAttribute()
    {
        return $this->image ? $this->image->thumb : "/img/profile.jpg";
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'buyer_id');
    }

    public function settlement()
    {
        return $this->hasMany(Settlement::class);
    }
}
