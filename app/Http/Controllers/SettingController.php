<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index(): View
    {
        $user = Auth::user();
        
        return view('pages.settings.index', compact('user'));
    }

    /**
     * Update profile information.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->bio = $request->bio; // assuming you have bio column in users table
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Update account settings.
     */
    public function updateAccount(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'timezone' => 'nullable|string|max:50',
            'language' => 'nullable|in:en,id,es',
        ]);

        $user = Auth::user();
        $user->username = $request->username; // assuming you have username column in users table
        $user->timezone = $request->timezone;
        $user->language = $request->language;
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Account settings updated successfully.');
    }

    /**
     * Update security settings.
     */
    public function updateSecurity(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('settings.index')->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Password updated successfully.');
    }

    /**
     * Update notification settings.
     */
    public function updateNotifications(Request $request): RedirectResponse
    {
        $request->validate([
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
        ]);

        $user = Auth::user();
        $user->email_notifications = $request->email_notifications ?? false;
        $user->push_notifications = $request->push_notifications ?? false;
        $user->sms_notifications = $request->sms_notifications ?? false;
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Notification settings updated successfully.');
    }

    /**
     * Update appearance settings.
     */
    public function updateAppearance(Request $request): RedirectResponse
    {
        $request->validate([
            'theme' => 'nullable|in:auto,light,dark',
            'layout' => 'nullable|in:sidebar,topbar',
            'font_size' => 'nullable|in:small,normal,large',
        ]);

        $user = Auth::user();
        $user->theme = $request->theme;
        $user->layout = $request->layout;
        $user->font_size = $request->font_size;
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Appearance settings updated successfully.');
    }
}
