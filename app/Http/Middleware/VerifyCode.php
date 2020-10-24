<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $adm_setting = allsetting();
        if (isset($adm_setting['is_authenticated']) && ($adm_setting['is_authenticated'] == LICENSE_VERIFIED)) {
            return $next($request);
        } else {
            return redirect()->route('generalSetting')->with('dismiss', __('Please verify envato purchase code'));
        }
    }
}
