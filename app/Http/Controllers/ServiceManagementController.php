<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceManagementController extends Controller
{
    /**
     * Display all services
     */
    public function index(Request $request)
    {
        $query = Service::query();

        // Filter by game if provided
        if ($request->has('game') && $request->game) {
            $query->where('game', $request->game);
        }

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('category_name', $request->category);
        }

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $services = $query->orderBy('game')->orderBy('category_name')->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show form to create new service
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store new service
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Auto-generate category_name from category if not provided
        $categoryName = $validated['category'];
        
        // Auto-generate category slug (lowercase, hyphenated)
        $categorySlug = Str::slug($validated['category']);
        
        // Auto-generate name slug (lowercase, hyphenated)
        $nameSlug = Str::slug($validated['name']);

        Service::create([
            'game' => $validated['game'],
            'category_name' => $categoryName, // Display name
            'category' => $categorySlug, // Slug for JS logic
            'name' => $validated['name'], // Display name
            'slug' => $nameSlug, // Slug for JS logic
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully!');
    }

    /**
     * Show form to edit service
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update service
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'game' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Auto-generate slugs
        $categoryName = $validated['category'];
        $categorySlug = Str::slug($validated['category']);
        $nameSlug = Str::slug($validated['name']);

        $service->update([
            'game' => $validated['game'],
            'category_name' => $categoryName,
            'category' => $categorySlug,
            'name' => $validated['name'],
            'slug' => $nameSlug,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] ?? $service->is_active,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Delete service
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service deleted successfully!');
    }

    /**
     * Toggle service active status
     */
    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();

        return back()->with('success', 'Service status updated!');
    }
}