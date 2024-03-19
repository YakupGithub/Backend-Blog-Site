<?php

namespace App\Listeners;

use App\Events\CommentAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(CommentAdded $event)
    {
        $comment = $event->comment;
        $adminEmail = $event->adminEmail;

        Mail::to($adminEmail)->send(new CommentNotification($comment));
    }
}
