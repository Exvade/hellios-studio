<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StudioAccessController extends Controller
{
    public function create(): View
    {
        return view('studio.login', ['configured' => filled(config('hellios.studio_password'))]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['password' => ['required', 'string']]);

        $configuredPassword = config('hellios.studio_password');

        if (! is_string($configuredPassword) || blank($configuredPassword) || ! Hash::check($request->string('password')->toString(), $configuredPassword)) {
            return back()->withErrors(['password' => 'The studio password is not correct.'])->onlyInput('password');
        }

        $request->session()->regenerate();
        $request->session()->put('hellios_studio_access', true);

        return to_route('studio.products.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('hellios_studio_access');
        $request->session()->regenerateToken();

        return to_route('home');
    }
}
