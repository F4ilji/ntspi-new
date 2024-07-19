<?php

namespace App\Observers;

use App\Models\Post;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Redirect;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function saved(Post $post): void
    {
        $recipient = auth()->user();

        Notification::make()
            ->title('Saved successfully')
            ->sendToDatabase($recipient);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
