<?php

declare(strict_types=1);

namespace Modules\User\Listeners;

use Illuminate\Auth\Events\Login;

class SetUserLocale
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $locale = $user->lang;

        if ($locale) {
            userService()->updateSessionLocale($locale);
        }
    }
}
