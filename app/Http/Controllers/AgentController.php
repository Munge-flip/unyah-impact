<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AgentController extends Controller
{
    public function index()
    {
        $agent = Auth::user();

        $ordersHandling = $agent->tasks()->where('status', '!=', 'completed')->count();

        $completedCount = $agent->tasks()->where('status', 'completed')->count();

        $totalAssigned = $agent->tasks()->count();

        $completionRate = $totalAssigned > 0
            ? round(($completedCount / $totalAssigned) * 100) . '%'
            : '0%';

        return view("agent.dashboard.index", compact(
            'agent',
            'ordersHandling',
            'completedCount',
            'completionRate'
        ));
    }
    public function order()
    {
        return view("agent.orders.index");
    }
    public function edit()
    {
        return view('agent.dashboard.edit-info');
    }
    public function update()
    {
        return view('agent.dashboard.edit-password');
    }
    public function chat()
    {
        return view("agent.chat");
    }
    public function show($id)
    {
        return view('agent.orders.show', ['id' => $id]);
    }
}
