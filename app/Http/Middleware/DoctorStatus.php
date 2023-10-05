<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DoctorStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق مما إذا كان الدكتور مفعلًا أم لا
        if (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->status == 1) {
            return $next($request);
        }

        // إذا لم يتم تنفيذ الشرط أعلاه (الدكتور غير مفعل)، يمكنك توجيهه إلى صفحة أخرى أو إظهار رسالة خطأ
        return redirect()->route('doctor.inactive');
    }
}
