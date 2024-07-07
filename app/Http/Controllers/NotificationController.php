<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\Participant;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        $events = Event::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id())
                ->where('status', 'invited');
        })->get();

        return view('notifications', compact('events'));
    }
    public function respond(Request $request, Event $event)
    {
        $participant = Participant::where('event_id', $event->event_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($participant) {
            $participant->status = $request->input('status');
            $participant->save();

            return redirect()->route('notifications.index')->with('success', 'Status updated successfully!');
        }

        return redirect()->route('notifications.index')->with('error', 'Failed to update status!');
    }
}
