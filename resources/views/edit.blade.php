@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Event</h1>
    <form id="editEventForm" action="{{ url('/api/events/edit/' . $event->event_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="datetime-local" class="form-control" id="date" name="date" value="{{ $event->date }}" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}"
                required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ $event->image_url }}"
                required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $event->type }}" required>
        </div>
        <div class="mb-3">
            <label for="visibility" class="form-label">Visibility</label>
            <select class="form-select" id="visibility" name="visibility" required>
                <option value="public" {{ $event->visibility == 'public' ? 'selected' : '' }}>Public</option>
                <option value="private" {{ $event->visibility == 'private' ? 'selected' : '' }}>Private</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                required>{{ $event->description }}</textarea>
        </div>
        <button type="button" class="btn btn-primary" onclick="updateEvent()">Save Changes</button>
    </form>
</div>

<script>
    function updateEvent() {
        let eventId = '{{ $event->event_id }}';
        let creatorId = '{{ $event->creator_id }}';

        let formData = new FormData(document.getElementById('editEventForm'));
        formData.append('creator_id', creatorId);

        
        let formDataObject = {};

        
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });

        

        fetch('{{ url("/api/events/edit") }}/' + eventId, {
            method: 'PUT',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                if (data.success) {
                    alert('Event updated successfully');
                } else {
                    alert('Error updating event: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error updating event');
            });
    }


</script>
@endsection