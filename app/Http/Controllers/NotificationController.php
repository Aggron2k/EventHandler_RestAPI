<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

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
}
