<?php

namespace App\Http\Controllers\Backend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function dashboard()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to the login page if not authenticated
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the authenticated user has the correct role (e.g., admin roles with role_id 1, 2, or 3)
        if (!in_array($user->role_id, [1, 2, 3])) {
            return redirect()->route('login');  // Redirect non-admin users to the homepage
        }

        // Fetch all users with their roles (assuming the role relationship is defined in the User model)
        $users = User::with('role')->get();

        // Pass users to the view
        return view('backend.dashboard', compact('users'));
    }


}
