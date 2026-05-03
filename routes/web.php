<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::prefix('dev')->group(function (): void {
    Route::get('/about', function () {
        return view('dev-about::about');
    });

    if (! app()->environment('local')) {
        return;
    }

    Route::get('/logout', function () {
        Auth::logout();

        return redirect('/');
    });

    Route::get('/{identifier}', function ($identifier) {
        $userQuery = User::query();
        $hasLookupCondition = false;

        if (is_numeric($identifier)) {
            $userQuery->where('id', $identifier);
            $hasLookupCondition = true;
        }

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $hasLookupCondition
                ? $userQuery->orWhere('email', $identifier)
                : $userQuery->where('email', $identifier);

            $hasLookupCondition = true;
        }

        if (Schema::hasColumn('users', 'nokp')) {
            $hasLookupCondition
                ? $userQuery->orWhere('nokp', $identifier)
                : $userQuery->where('nokp', $identifier);

            $hasLookupCondition = true;
        }

        abort_if(! $hasLookupCondition, 404, 'User not found');

        $user = $userQuery->first();

        abort_if(! $user, 404, 'User not found');

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        Auth::login($user);
        session()->regenerate();

        return redirect('/');
    });
});
