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
}
