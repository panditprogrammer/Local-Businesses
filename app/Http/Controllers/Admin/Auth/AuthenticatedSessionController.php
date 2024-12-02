<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
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
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();


        // Retrieve the authenticated admin user with the "adminGuard" guard
        $admin = auth('adminGuard')->user();
        // Check if the admin is active or banned
        if ($admin->status === false || $admin->status === 0) {
            auth('adminGuard')->logout();
            return back()->with('error', 'Your account is either inactive or suspended. Please contact admin support.');
        }


        return redirect()->intended(route('admin.dashboard.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('adminGuard')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("admin.login");
    }
}
