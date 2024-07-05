@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <!-- Content -->
        <div class="col-md-9">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a id="goingTab" class="nav-link active" aria-current="page"
                        onclick="fetchEvents('going', 'goingTab')">Going</a>
                </li>
                <li class="nav-item">
                    <a id="interestedTab" class="nav-link"
                        onclick="fetchEvents('interested', 'interestedTab')">Interested</a>
                </li>
                <li class="nav-item">
                    <a id="notgoingTab" class="nav-link" onclick="fetchEvents('not_going', 'notgoingTab')">Not Going</a>
                </li>
            </ul>
            <div class="row row-cols-1 row-cols-md-3 g-4" id="eventsContainer">
                <!-- Events will be loaded dynamically here -->
            </div>
        </div>
    </div>
</div>

<script>
    function fetchEvents(status, tabId) {
        // Aktív tab beállítása
        document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');

        // API hívás az események lekérdezéséhez
        fetch(`/api/yourevents?status=${status}`)
            .then(response => response.json())
            .then(events => {
                const eventsContainer = document.getElementById('eventsContainer');
                eventsContainer.innerHTML = '';

                events.forEach(event => {
                    const creatorName = event.creator ? event.creator.name : 'Unknown';
                    const eventCard = `
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
                                <p><strong>Created by:</strong> ${creatorName}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted mb-0"><i class="fas fa-calendar-alt me-1"></i>${event.date}</small>
                                    <small class="text-muted mb-0"><i class="fas fa-eye me-1"></i>${event.visibility}</small>
                                    <small class="text-muted ms-2"><i class="fas fa-tag me-1"></i>${event.type}</small>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around mt-3">
                                    <button type="button" class="btn ${event.participants[0] && event.participants[0].status === 'going' ? 'btn-success' : 'btn-outline-success'} btn-status" data-event-id="${event.event_id}" data-status="going"><i class="fas fa-check me-1"></i>Going</button>
                                    <button type="button" class="btn ${event.participants[0] && event.participants[0].status === 'interested' ? 'btn-warning' : 'btn-outline-warning'} btn-status" data-event-id="${event.event_id}" data-status="interested"><i class="fas fa-star me-1"></i>Interested</button>
                                    <button type="button" class="btn ${event.participants[0] && event.participants[0].status === 'not_going' ? 'btn-danger' : 'btn-outline-danger'} btn-status" data-event-id="${event.event_id}" data-status="not_going"><i class="fas fa-times me-1"></i>Not going</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    eventsContainer.innerHTML += eventCard;
                });

                attachEventHandlers();
            })
            .catch(error => console.error('Error fetching events:', error));
    }

    function attachEventHandlers() {
        document.querySelectorAll('.btn-status').forEach(button => {
            button.addEventListener('click', function () {
                const eventId = this.getAttribute('data-event-id');
                const status = this.getAttribute('data-status');

                fetch(`/api/change-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ event_id: eventId, status: status })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Az új státusz betöltése
                            fetchEvents(status, status + 'Tab');
                        } else {
                            console.error('Error updating status:', data.message);
                        }
                    })
                    .catch(error => console.error('Error updating status:', error));
            });
        });
    }

    // Betöltéskor alapértelmezett státusz
    document.addEventListener('DOMContentLoaded', function () {
        fetchEvents('going', 'goingTab');
    });
</script>
@endsection