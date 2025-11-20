<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function genshin() {
        return view ('Services.genshin');
    }
        public function hsr() {
        return view ('Services.hsr');
    }
        public function zzz() {
        return view ('Services.zzz');
    }
}
