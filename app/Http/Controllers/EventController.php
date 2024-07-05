<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $events = Event::whereHas('participants', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('yourevents', compact('events'));
    }
}