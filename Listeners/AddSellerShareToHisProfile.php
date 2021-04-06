<?php

namespace Mohsen\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mohsen\Course\Models\Course;
use Mohsen\Course\Repositories\CourseRepo;

class AddSellerShareToHisProfile
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->payment->paymentable_type == Course::class) {
            $teacher = $event->payment->paymentable->teacher;
            $teacher->update([
                'balance'=>$teacher->balance += $event->payment->seller_share
            ]);
        }
    }
}
