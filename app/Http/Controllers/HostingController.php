<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HostingController extends Controller
{
    public function index()
    {
        $events = Event::with('creator')
            ->where('creator_id', Auth::id())
            ->orderBy('date', 'asc')
            ->get();

        return view('hosting', compact('events'));
    }

    public function APIindex()
    {
        $events = Event::with('creator')
            ->where('creator_id', Auth::id())
            ->orderBy('date', 'asc')
            ->get();

        return response()->json(['events' => $events]);
    }

    public function APIfilterByVisibility($visibility)
    {
        $validator = Validator::make(['visibility' => $visibility], [
            'visibility' => 'required|string|in:public,private',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
        }

        $events = Event::where('visibility', $visibility)
            ->where('creator_id', Auth::id())
            ->with('creator')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json(['events' => $events]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'date' => 'required|date',
            'location' => 'required|string|max:50',
            'image_url' => 'required|url',
            'type' => 'required|string|max:50',
            'visibility' => 'required|string|in:public,private',
            'description' => 'required|string|max:255',
            'creator_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
        }

        $event = Event::create($request->all());

        return response()->json(['success' => true, 'event' => $event]);
    }

    public function destroy($id)
    {
        $event = Event::where('event_id', $id)->where('creator_id', Auth::id())->first();

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found or unauthorized'], 404);
        }

        $event->delete();

        return response()->json(['success' => true, 'message' => 'Event deleted successfully']);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'date' => 'required|date',
            'location' => 'required|string|max:50',
            'image_url' => 'required|url',
            'type' => 'required|string|max:50',
            'visibility' => 'required|string|in:public,private',
            'description' => 'required|string|max:255',
            'creator_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
        }

        $event = Event::where('event_id', $id)
            ->where('creator_id', Auth::id())
            ->first();

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found or unauthorized'], 404);
        }

        try {
            $event->update($request->all());
            return response()->json(['success' => true, 'event' => $event]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating event'], 500);
        }
    }
    public function edit($eventId)
    {
        $event = Event::findOrFail($eventId);

        return view('edit', compact('event'));
    }


}
