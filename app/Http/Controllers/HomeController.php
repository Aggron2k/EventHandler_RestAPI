<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Participant;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->validate([
            'query' => 'nullable|string|max:255'
        ]);

        $query = $request->input('query');

        if ($query) {
            $events = Event::where('visibility', 'public')
                ->where(function ($subQuery) use ($query) {
                    $subQuery->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('type', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->orWhere('location', 'LIKE', "%{$query}%")
                        ->orWhere('date', 'LIKE', "%{$query}%");
                })
                ->with([
                    'participants' => function ($query) {
                        $query->where('user_id', Auth::id());
                    }
                ])
                ->orderBy('date', 'asc')
                ->get();
        } else {
            $events = Event::where('visibility', 'public')
                ->with([
                    'participants' => function ($query) {
                        $query->where('user_id', Auth::id());
                    }

                ])
                ->orderBy('date', 'asc')
                ->get();
        }

        return view('home', compact('events', 'query'));
    }

    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,event_id',
            'status' => 'required|in:going,interested,not_going',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
        }


        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }


        try {
            $eventId = $request->input('event_id');
            $status = $request->input('status');
            $userId = Auth::id();

            Participant::updateOrCreate(
                ['event_id' => $eventId, 'user_id' => $userId],
                ['status' => $status]
            );

            return response()->json(['success' => true, 'message' => 'Status updated successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating status'], 500);
        }
    }


}
