<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        return view('yourevents');
    }

    public function fetchEvents(Request $request)
    {
        $status = $request->query('status');

        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $userId = Auth::id();

        $events = Event::with([
            'creator',
            'participants' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }
        ])
            ->whereHas('participants', function ($query) use ($userId, $status) {
                $query->where('user_id', $userId)->where('status', $status);
            })
            ->get();

        return response()->json($events);
    }

    public function changeStatus(Request $request)
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