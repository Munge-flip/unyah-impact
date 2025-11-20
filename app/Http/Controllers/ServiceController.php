<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function genshin() {
        return view ('services.genshin');
    }
        public function hsr() {
        return view ('services.hsr');
    }
        public function zzz() {
        return view ('services.zzz');
    }
}
