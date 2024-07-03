<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function filterByVisibility($visibility)
    {
        $events = Event::where('visibility', $visibility)
            ->where('creator_id', Auth::id())
            ->with('creator')
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
        $events = Event::where('visibility', $visibility)
            ->where('creator_id', Auth::id())
            ->with('creator')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json(['events' => $events]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'date' => 'required|date',
            'location' => 'required|string|max:50',
            'image_url' => 'required|url',
            'type' => 'required|string|max:50',
            'visibility' => 'required|string|in:public,private',
            'description' => 'required|string|max:255',
            'creator_id' => 'required|exists:users,id',
        ]);

        $event = Event::create($request->all());

        return response()->json(['success' => true, 'event' => $event]);
    }
}
