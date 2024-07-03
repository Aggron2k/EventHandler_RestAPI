@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
    <div class="col-md-9 mb-4 d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEventModal">
                <i class="fa-solid fa-plus me-1"></i>Create new event
            </button>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a id="allTab" class="nav-link active" aria-current="page"
                        onclick="fetchEvents('all', 'allTab')">All</a>
                </li>
                <li class="nav-item">
                    <a id="publicTab" class="nav-link" onclick="fetchEvents('public', 'publicTab')">Public</a>
                </li>
                <li class="nav-item">
                    <a id="privateTab" class="nav-link" onclick="fetchEvents('private', 'privateTab')">Private</a>
                </li>
            </ul>
            <div class="row row-cols-1 row-cols-md-3 g-4" id="eventsContainer">
                <!-- Events will be loaded dynamically here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Create New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createEventForm">
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="eventName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date</label>
                        <input type="datetime-local" class="form-control" id="eventDate" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="eventLocation" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventImageUrl" class="form-label">Image URL</label>
                        <input type="url" class="form-control" id="eventImageUrl" name="image_url" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Type</label>
                        <input type="text" class="form-control" id="eventType" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventVisibility" class="form-label">Visibility</label>
                        <select class="form-select" id="eventVisibility" name="visibility" required>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="3"
                            required></textarea>
                    </div>
                    <input type="hidden" name="creator_id" value="{{ Auth::user()->id }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitEventForm()">Save Event</button>
            </div>
        </div>
    </div>
</div>

<script>
    function fetchEvents(visibility, tabId) {
        let url = '/api/hosting';
        if (visibility !== 'all') {
            url = `/api/hosting/${visibility}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const eventsContainer = document.getElementById('eventsContainer');
                eventsContainer.innerHTML = '';

                data.events.forEach(event => {
                    const card = `
                    <div class="col mb-4">
                        <div class="card">
                            <img src="${event.image_url}" class="card-img-top" height="300" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">${event.name}</h5>
                                    <small class="text-muted ms-2"><i class="fas fa-map-marker-alt me-1"></i>${event.location}</small>
                                </div>
                                <hr>
                                <p class="card-text">${event.description}</p>
                                <p><strong>Created by:</strong> ${event.creator.name}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted mb-0"><i class="fas fa-calendar-alt me-1"></i>${event.date}</small>
                                    <small class="text-muted mb-0"><i class="fas fa-eye me-1"></i>${event.visibility}</small>
                                    <small class="text-muted ms-2"><i class="fas fa-tag me-1"></i>${event.type}</small>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around mt-3">
                                    <button type="button" class="btn btn-secondary"><i
                                            class="fas fa-pencil me-1"></i>Modify</button>
                                    <button type="button" class="btn btn-secondary"><i
                                            class="fas fa-door-open me-1"></i>Invite</button>

                                    <button type="button" class="btn btn-danger"><i
                                            class="fas fa-trash me-1"></i>Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    eventsContainer.insertAdjacentHTML('beforeend', card);
                });

                // Update active tab
                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                document.getElementById(tabId).classList.add('active');
            })
            .catch(error => alert(error));
    }

    // Initial load
    fetchEvents('all', 'allTab');

    function submitEventForm() {
        const form = document.getElementById('createEventForm');
        const formData = new FormData(form);

        fetch('/api/hosting/store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const createEventModal = new bootstrap.Modal(document.getElementById('createEventModal'));
                    createEventModal.hide();

                    fetchEvents('all', 'allTab');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => alert(error));
    }

</script>

@endsection