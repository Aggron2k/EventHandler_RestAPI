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

    public function sendInvite(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $invitingUser = $request->user();

        $participant = Participant::create([
            'event_id' => $validatedData['event_id'],
            'user_id' => $validatedData['user_id'],
            'invited_by_user_id' => $invitingUser->id,
            'status' => 'invited',
        ]);

        if ($participant) {
            return response()->json([
                'success' => true,
                'message' => 'Invitation sent successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error sending invitation'
            ], 500);
        }
    }
}
