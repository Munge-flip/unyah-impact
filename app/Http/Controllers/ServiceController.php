<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function genshin()
    {
        // Fetch services grouped by their category name (for display) and slug (for logic)
        $services = Service::where('game', 'Genshin Impact')
            ->where('is_active', true)
            ->get()
            ->groupBy('category_name');

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

    public function hsr()
    {
        $services = Service::where('game', 'Honkai Star Rail')
            ->where('is_active', true)
            ->get()
            ->groupBy('category_name');

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

    public function zzz()
    {
        $services = Service::where('game', 'Zenless Zone Zero')
            ->where('is_active', true)
            ->get()
            ->groupBy('category_name');

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }
}
