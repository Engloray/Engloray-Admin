<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\ContactData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = User::where('email', $request->email)->first();

        if (!$admin || ! Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        Auth::login($admin);

        session(['admin_logged_in' => true]);

        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $contacts = ContactData::latest()->paginate(10); // 10 items per page
        return view('admin.dashboard', compact('contacts'));
    }

    public function searchContacts(Request $request)
    {
        $query = $request->input('query');

        $contacts = ContactData::when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phone_no', 'like', '%' . $query . '%')
                ->orWhere('message', 'like', '%' . $query . '%');
        })
            ->latest()
            ->paginate(10)
            ->appends(['query' => $query]); // 🔥 this keeps query on each page

        if ($request->ajax()) {
            return view('admin.contact_table', compact('contacts'))->render();
        }

        return view('admin.dashboard', compact('contacts'));
    }




    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}
