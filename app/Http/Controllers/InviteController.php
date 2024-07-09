<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Participant;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{

    public function getUsers()
    {
        $users = User::all();
        return response()->json(['success' => true, 'users' => $users]);
    }

    public function sendInvite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
        }

        $invitingUser = $request->user();
        $eventId = $request->input('event_id');
        $userId = $request->input('user_id');

        if (Participant::where('event_id', $eventId)->where('user_id', $userId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This user has already reacted to this event'
            ], 400);
        }

        $participant = Participant::create([
            'event_id' => $eventId,
            'user_id' => $userId,
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
