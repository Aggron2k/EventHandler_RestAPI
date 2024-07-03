@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <!-- Search Bar -->
        <div class="col-md-4 mb-4">
            <form class="d-flex" method="GET" action="{{ url('home') }}">
                <div class="input-group shadow-sm">
                    <input class="form-control" type="search" placeholder="Keresés" aria-label="Search" name="query"
                        value="{{ request('query') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                @error('query')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </form>
        </div>
        <!-- Content -->
        <div class="col-md-9">
            @if(request('query'))
                <h2>Search Results for "{{ request('query') }}"</h2>
            @else
                <h2>All Events</h2>
            @endif

            @if($events->isEmpty())
                <p>No events found.</p>
            @else
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($events as $event)
                                    <div class="col mb-4">
                                        <div class="card">
                                            <img src="{{ $event->image_url }}" class="card-img-top" height="300" alt="...">
                                            <div class="card-body">
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
                                                    <small class="text-muted mb-0"><i class="fas fa-eye me-1"></i>{{ $event->visibility }}</small>
                                                    <small class="text-muted ms-2"><i class="fas fa-tag me-1"></i>{{ $event->type }}</small>
                                                </div>
                                                <hr>
                                                @php
                                                    $response = $event->participants->first();
                                                @endphp
                                                <div class="d-flex justify-content-around mt-3">
                                                    <button type="button"
                                                        class="btn {{ $response && $response->status == 'going' ? 'btn-success' : 'btn-outline-success' }} btn-status"
                                                        data-event-id="{{ $event->event_id }}" data-status="going"><i
                                                            class="fas fa-check me-1"></i>Going</button>
                                                    <button type="button"
                                                        class="btn {{ $response && $response->status == 'interested' ? 'btn-warning' : 'btn-outline-warning' }} btn-status"
                                                        data-event-id="{{ $event->event_id }}" data-status="interested"><i
                                                            class="fas fa-star me-1"></i>Interested</button>
                                                    <button type="button"
                                                        class="btn {{ $response && $response->status == 'not_going' ? 'btn-danger' : 'btn-outline-danger' }} btn-status"
                                                        data-event-id="{{ $event->event_id }}" data-status="not_going"><i
                                                            class="fas fa-times me-1"></i>Not going</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-status').on('click', function () {
            let eventId = $(this).data('event-id');
            let status = $(this).data('status');
            let button = $(this);

            $.ajax({
                url: "/api/update-status",
                method: "POST",
                data: {
                    event_id: eventId,
                    status: status
                },
                success: function (response) {
                    if (response.success) {
                        button.removeClass('btn-outline-success btn-outline-warning btn-outline-danger')
                            .addClass(status === 'going' ? 'btn-success' : (status === 'interested' ? 'btn-warning' : 'btn-danger'));

                        button.siblings().each(function () {
                            var siblingStatus = $(this).data('status');
                            $(this).removeClass('btn-success btn-warning btn-danger')
                                .addClass(siblingStatus === 'going' ? 'btn-outline-success' : (siblingStatus === 'interested' ? 'btn-outline-warning' : 'btn-outline-danger'));
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function (response) {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
@endsection