<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'superadmin') {
            return app(\App\Http\Controllers\Web\SuperadminController::class)->dashboard();
        }

        $userId = Auth::id();
        $totalEvents = Event::where('user_id', $userId)->count();
        $totalParticipants = \App\Models\Registration::whereHas('event', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
        $latestEvent = Event::where('user_id', $userId)->latest('updated_at')->first();
        $rejectedEvents = Event::where('user_id', $userId)->where('status', 'rejected')->get();

        return view('dashboard', compact('totalEvents', 'totalParticipants', 'latestEvent', 'rejectedEvents'));
    }
}