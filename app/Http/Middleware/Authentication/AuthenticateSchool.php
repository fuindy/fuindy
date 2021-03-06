<?php

namespace App\Http\Middleware\Authentication;

use App\Traits\v1\Account\LoginAttemptCase;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateSchool
{
    use LoginAttemptCase;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->back();
            }
        }

        $this->logicCase($guard);

        $logicPassed = $this->school || $this->teacher;

        if ($this->noAccess || !$logicPassed) {

            if ($request->ajax() || $request->wantsJson()) {

                return response('Unauthorized.', 401);

            } else {

                if (!$this->guest) {
                    $request->session()->flash('alert-danger-bar-top', 'You don\'t have permission to access this page');
                }

                return redirect()->back();
            }
        }

        // Admin access is granted
        return $next($request);
    }
}
