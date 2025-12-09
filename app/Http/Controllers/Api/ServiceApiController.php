<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceApiController extends Controller
{
    /**
     * Display a listing of services.
     * GET /api/v1/services
     */
    public function index(Request $request)
    {
        $query = Service::query();

        // Filter by game if provided
        if ($request->has('game')) {
            $query->where('game', $request->game);
        }

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category_name', $request->category);
        }

        // Filter by active status
        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $services = $query->orderBy('game')->orderBy('category_name')->get();

        return response()->json([
            'success' => true,
            'message' => 'Services retrieved successfully',
            'data' => $services
        ], 200);
    }

    /**
     * Store a newly created service.
     * POST /api/v1/services
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'game' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'is_active' => 'boolean',
            ]);

            // Auto-generate category_name and slugs
            $categoryName = $validated['category'];
            $categorySlug = Str::slug($validated['category']);
            $nameSlug = Str::slug($validated['name']);

            $service = Service::create([
                'game' => $validated['game'],
                'category_name' => $categoryName,
                'category' => $categorySlug,
                'name' => $validated['name'],
                'slug' => $nameSlug,
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => $service
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified service.
     * GET /api/v1/services/{id}
     */
    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Service retrieved successfully',
            'data' => $service
        ], 200);
    }

    /**
     * Update the specified service.
     * PUT/PATCH /api/v1/services/{id}
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'game' => 'sometimes|string|max:255',
                'category' => 'sometimes|string|max:255',
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'price' => 'sometimes|numeric|min:0',
                'is_active' => 'sometimes|boolean',
            ]);

            // Update slugs if category or name changed
            if (isset($validated['category'])) {
                $validated['category_name'] = $validated['category'];
                $validated['category'] = Str::slug($validated['category']);
            }

            if (isset($validated['name'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $service->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully',
                'data' => $service->fresh()
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified service.
     * DELETE /api/v1/services/{id}
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ], 200);
    }
}