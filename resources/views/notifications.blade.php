@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($events as $event)
            <div class="col-12">
                <div class="card mb-4 flex-row" style="max-width: 900px; margin: 0 auto;">
                    <img src="{{ $event->image_url }}" class="card-img-left example-card-img-responsive" alt="..." style="width: 300px;">
                    <div class="card-body">
                        <h4 class="card-title h5 h4-sm">Horváth Krisztián Meghívott erre az eseményre:</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $event->name }}</h5>
                            <small class="text-muted ms-2"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</small>
                        </div>
                        <hr>
                        <p class="card-text">{{ $event->description }}</p>
                        <p><strong>Created by:</strong> {{ $event->creator->name }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted mb-0"><i class="fas fa-calendar-alt me-1"></i>{{ $event->date }}</small>
                            <small class="text-muted mb-0"><i class="fas fa-eye me-1"></i>{{ $event->visibility }}</small>
                            <small class="text-muted ms-2"><i class="fas fa-tag me-1"></i>{{ $event->type }}</small>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-around mt-3">
                            <button type="button" class="btn btn-outline-success"><i class="fas fa-check me-1"></i>Going</button>
                            <button type="button" class="btn btn-outline-warning"><i class="fas fa-star me-1"></i>Interested</button>
                            <button type="button" class="btn btn-outline-danger"><i class="fas fa-times me-1"></i>Not Going</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
