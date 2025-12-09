<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function genshin() {
        // Fetch services grouped by their category name (for display) and slug (for logic)
        $services = Service::where('game', 'Genshin Impact')
            ->where('is_active', true)
            ->get()
            ->groupBy('category_name');

        return view('services.genshin', compact('services'));
    }

    public function hsr() {
        // You can do the same for HSR later
        return view('services.hsr');
    }

    public function zzz() {
        // You can do the same for ZZZ later
        return view('services.zzz');
    }
}