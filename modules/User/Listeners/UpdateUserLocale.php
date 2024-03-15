<?php

declare(strict_types=1);

namespace Modules\User\Listeners;

use Illuminate\Auth\Events\Authenticated;

class UpdateUserLocale
{
    /**
     * Handle the event.
     */
    public function handle(Authenticated $event): void
    {
        $user = $event->user;
        $userLocale = $user->lang;

        $locale = session()->get('locale') ??
            request()->get('locale') ??
            request()->cookie('filament_language_switch_locale') ??
            config('app.locale', 'en');

        if ($userLocale !== $locale) {
            userService()->update($user->id, ['lang' => $locale]);
            userService()->updateSessionLocale($locale);
        }
    }
}
