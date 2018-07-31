<?php

namespace App\Http\Middleware\Authentication;

use App\Traits\v1\Account\LoginAttemptCase;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateStudent
{
    use LoginAttemptCase;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->json()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->back();
            }
        }

        $this->logicCase($guard);

        $logicPassed = $this->school || $this->student;

        if ($this->noAccess || $logicPassed) {

            if ($request->ajax() || request()->wantsJson()) {

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
