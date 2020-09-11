<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('app.settings.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::User();

        if (!Auth::validate(['email' => $user->email, 'password' => $request->current_password])) {
            return redirect()->back()->withErrors([
                'current_password' => 'Current password does not match'
            ]);
        }

        $rules = [
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ];
        $this->validate($request, $rules);

        $user->update([
            'password' => bcrypt($request->password),
            'change_password' => false
        ]);

        Alert::success('Success', 'Password updated successfully');

        if (!$user->isDirty('change_password')) {
            return redirect(route('applications.index'));
        }

        return redirect(route('settings.edit'));
    }
}
