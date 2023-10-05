<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.signin');
    }
    public function create_user(): View
    {
        return view('Dashboard.User.auth.signin');
    }
    public function create_admin(): View
    {
        return view('Dashboard.Admin.auth.signin');
    }
    public function create_doctor(): View
    {
        return view('Dashboard.Doctor.auth.signin');
    }
    public function create_ray_employee(): View
    {
        return view('Dashboard.RayEmployee.auth.signin');
    }
    public function create_laboratory_employee(): View
    {
        return view('Dashboard.Laboratory.auth.signin');
    }
    public function create_patient(): View
    {
        return view('Dashboard.Patients.auth.signin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
