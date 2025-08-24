<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                abort(403, 'Access denied.');
            }
            return $next($request);
        });
    }

    /**
     * Display admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_properties' => Property::count(),
            'pending_properties' => Property::pending()->count(),
            'approved_properties' => Property::approved()->count(),
            'rejected_properties' => Property::where('status', 'rejected')->count(),
            'total_landlords' => User::where('role', 'landlord')->count(),
            'total_tenants' => User::where('role', 'tenant')->count(),
        ];

        $recent_properties = Property::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_properties'));
    }

    /**
     * Display all properties for admin review.
     */
    public function properties(Request $request)
    {
        $query = Property::with('user');

        // Search properties
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $properties = $query->latest()->paginate(15);

        return view('admin.properties', compact('properties'));
    }

    /**
     * Update property status.
     */
    public function updatePropertyStatus(Request $request, Property $property)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $property->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Property status updated successfully.');
    }

    /**
     * Display all users.
     */
    public function users(Request $request)
    {
        $query = User::withCount('properties');

        // Search users
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNull('email_verified_at');
            } elseif ($request->status === 'verified') {
                $query->whereNotNull('email_verified_at');
            }
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * Show user details.
     */
    public function showUser(User $user)
    {
        $user->load(['properties' => function($query) {
            $query->latest();
        }]);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Update user role.
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:tenant,landlord,admin',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    /**
     * Delete user account.
     */
    public function deleteUser(User $user)
    {
        // Don't allow deletion of current admin
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        // Delete user's properties first
        $user->properties()->delete();
        
        // Delete user
        $user->delete();

        return redirect()->back()->with('success', 'User and their properties deleted successfully.');
    }

    /**
     * Show property details for admin.
     */
    public function showProperty(Property $property)
    {
        $property->load('user');
        
        return view('admin.properties.show', compact('property'));
    }

    /**
     * Delete property.
     */
    public function deleteProperty(Property $property)
    {
        // Delete property images
        if ($property->image) {
            $imagePath = public_path('storage/' . $property->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $property->delete();

        return redirect()->route('admin.properties')->with('success', 'Property deleted successfully.');
    }
}
