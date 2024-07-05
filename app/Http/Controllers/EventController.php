<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return view('yourevents');
    }

    public function fetchEvents(Request $request)
    {
        $userId = Auth::id();
        $status = $request->query('status');

        $events = Event::whereHas('participants', function ($query) use ($userId, $status) {
            $query->where('user_id', $userId)
                ->where('status', $status);
        })->with(['creator', 'participants'])->get();

        return response()->json($events);
    }
}