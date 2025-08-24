<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Property::with('user')->approved();

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by rooms
        if ($request->filled('rooms')) {
            $query->where('rooms', $request->rooms);
        }

        $properties = $query->latest()->paginate(12);

        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->isLandlord()) {
            abort(403, 'Only landlords can create properties.');
        }
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('properties', 'public');
        }

        $property = Property::create($validated);

        return redirect()->route('properties.show', $property)
                        ->with('success', 'Property created successfully and is pending approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->load('user');
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        if (!Auth::user()->isLandlord() || Auth::user()->id !== $property->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($property->image_path) {
                Storage::disk('public')->delete($property->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('properties', 'public');
        }

        $property->update($validated);

        return redirect()->route('properties.show', $property)
                        ->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        if (!Auth::user()->isLandlord() || Auth::user()->id !== $property->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image
        if ($property->image_path) {
            Storage::disk('public')->delete($property->image_path);
        }

        $property->delete();

        return redirect()->route('properties.index')
                        ->with('success', 'Property deleted successfully.');
    }

    /**
     * Display landlord's properties dashboard.
     */
    public function dashboard()
    {
        if (!Auth::user()->isLandlord()) {
            abort(403, 'Only landlords can access this dashboard.');
        }
        
        $properties = Auth::user()->properties()->latest()->paginate(10);
        
        return view('properties.dashboard', compact('properties'));
    }
}
