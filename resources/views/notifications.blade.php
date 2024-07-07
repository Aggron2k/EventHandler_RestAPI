@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        <!-- Content -->
        <div class="col-md-9">

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Check if there are any events -->
            @if($events->isEmpty())
                <div class="alert alert-info">
                    You have no new notifications.
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($events as $event)
                        <div class="col mb-4">
                            <div class="card">
                                <img src="{{ $event->image_url }}" class="card-img-top" height="300" alt="...">
                                <div class="card-body">
                                    <p class="alert alert-primary"><i
                                            class="fas fa-paper-plane me-1"></i><strong>{{ $event->creator->name }} </strong>
                                        meghívott erre az eseményre:
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">{{ $event->name }}</h5>
                                        <small class="text-muted ms-2"><i
                                                class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</small>
                                    </div>
                                    <hr>
                                    <p class="card-text">{{ $event->description }}</p>
                                    <p><strong>Created by:</strong> {{ $event->creator->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted mb-0"><i
                                                class="fas fa-calendar-alt me-1"></i>{{ $event->date }}</small>
                                        <small class="text-muted mb-0"><i
                                                class="fas fa-eye me-1"></i>{{ $event->visibility }}</small>
                                        <small class="text-muted ms-2"><i class="fas fa-tag me-1"></i>{{ $event->type }}</small>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-around mt-3">
                                        <form method="POST"
                                            action="{{ route('api.events.respond', ['event' => $event->event_id]) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="going">
                                            <button type="submit" class="btn btn-outline-success"><i
                                                    class="fas fa-check me-1"></i>Going</button>
                                        </form>
                                        <form method="POST"
                                            action="{{ route('api.events.respond', ['event' => $event->event_id]) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="interested">
                                            <button type="submit" class="btn btn-outline-warning"><i
                                                    class="fas fa-star me-1"></i>Interested</button>
                                        </form>
                                        <form method="POST"
                                            action="{{ route('api.events.respond', ['event' => $event->event_id]) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="not_going">
                                            <button type="submit" class="btn btn-outline-danger"><i
                                                    class="fas fa-times me-1"></i>Not Going</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
@endsection