@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-md-9 mb-4 d-flex justify-content-center">
            <button type="button" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i>Create new event</button>
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
            .catch(error => console.error('Error fetching events:', error));
    }

    // Initial load
    fetchEvents('all', 'allTab');

</script>

@endsection