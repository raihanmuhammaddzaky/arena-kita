<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter by role
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        $users = $query->latest()->paginate(10)->appends($request->query());

        return view('admin.users.index', compact('users'));
    }

    /**
     * Approve a pending user.
     */
    public function approve(User $user)
    {
        $user->update(['status' => 'approved']);

        return redirect()->back()
            ->with('success', "User {$user->name} berhasil disetujui.");
    }

    /**
     * Reject a pending user.
     */
    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);

        return redirect()->back()
            ->with('success', "User {$user->name} berhasil ditolak.");
    }
}
