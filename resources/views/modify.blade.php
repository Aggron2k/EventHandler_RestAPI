<div class="modal-header">
    <h5 class="modal-title" id="updateEventModalLabel">Modify Event</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form id="updateEventForm">
        @csrf
        <input type="hidden" id="eventIdInput" name="event_id">

        <div class="mb-3">
            <label for="eventNameUpdate" class="form-label">Name</label>
            <input type="text" class="form-control" id="eventNameUpdate" name="name" required>
        </div>

        <div class="mb-3">
            <label for="eventDateUpdate" class="form-label">Date</label>
            <input type="text" class="form-control" id="eventDateUpdate" name="date" required>
        </div>

        <div class="mb-3">
            <label for="eventLocationUpdate" class="form-label">Location</label>
            <input type="text" class="form-control" id="eventLocationUpdate" name="location" required>
        </div>

        <div class="mb-3">
            <label for="eventImageUrlUpdate" class="form-label">Image URL</label>
            <input type="url" class="form-control" id="eventImageUrlUpdate" name="image_url" required>
        </div>

        <div class="mb-3">
            <label for="eventTypeUpdate" class="form-label">Type</label>
            <input type="text" class="form-control" id="eventTypeUpdate" name="type" required>
        </div>

        <div class="mb-3">
            <label for="eventVisibilityUpdate" class="form-label">Visibility</label>
            <select class="form-select" id="eventVisibilityUpdate" name="visibility" required>
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="eventDescriptionUpdate" class="form-label">Description</label>
            <textarea class="form-control" id="eventDescriptionUpdate" name="description" rows="3" required></textarea>
        </div>

        <input type="hidden" id="eventCreatorIdUpdate" name="creator_id">
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitUpdateEventForm()">Update Event</button>
</div>
