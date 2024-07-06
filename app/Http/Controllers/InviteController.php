<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Participant;

class InviteController extends Controller
{

    public function getUsers()
    {
        $users = User::all();
        return response()->json(['success' => true, 'users' => $users]);
    }

    public function invite(Request $request)
    {
        // Get input from the request
        $event_id = $request->input('event_id');
        $email = $request->input('email');

        // Find the event by ID
        $event = Event::find($event_id);
        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found'], 404);
        }

        // Find the user by email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // Check if the user is already invited
        $participant = Participant::where('event_id', $event_id)->where('user_id', $user->id)->first();
        if ($participant) {
            return response()->json(['success' => false, 'message' => 'User already invited'], 400);
        }

        // Create the participant entry
        Participant::create([
            'event_id' => $event_id,
            'user_id' => $user->id,
            'status' => 'invited',
        ]);

        return response()->json(['success' => true, 'message' => 'Invitation sent successfully']);
    }
}
