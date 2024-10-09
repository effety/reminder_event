@extends('layouts.app')

@section('content')
    <style>
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #f8f9fa;
        }

        .card-footer {
            background-color: #f8f9fa;
        }

        .countdown-card {
            margin-bottom: 10px;
        }

        .countdown-card {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            width: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
    </style>
    <div class="container">
        <div class="header">
            <h1 class="text-warning">Reminder of your Events</h1>
        </div>
        <div class="d-flex">
            <button class="btn btn-danger mt-4 me-2" data-toggle="modal" data-target="#createEventModal">
                Create New Event
            </button>
            <div class="mx-2"></div> <!-- Spacer -->
            <button class="btn btn-info mt-4" data-toggle="modal" data-target="#importDataModal">
                Import Data
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Event List -->
        <div class="container mt-4">
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header align-items-center  bg-info text-white">

                                <h5 class="card-title mb-0"><i class="fas fa-clock fa-2x me-4"></i> {{ $event->name }}</h5>
                                <p>
                                <p class="card-text"><strong>ID:</strong> {{ $event->reminder_id  }}</p>
                                </p>
                            </div>
                            <div class="card-body text-start" style="color: #333;">
                                <p class="card-text"><strong>Email:</strong> {{ $event->email }}</p>
                                <p class="card-text"><strong>Date:</strong> {{ $event->event_date }}</p>
                                <p class="card-text"><strong>Time:</strong>
                                    {{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('g:i A') : 'Not Set' }}</p>
                                <p class="card-text">
                                    <strong>Status:</strong>
                                    <span class="{{ $event->is_completed ? 'text-success' : 'text-danger' }}">
                                        {{ $event->is_completed ? 'Completed' : 'Upcoming' }}
                                    </span>
                                </p>
                            </div>
                            <div class="card-footer text-center">

                                <p class="card-text d-flex align-items-center justify-content-center">
                                    <i class="fas fa-hourglass-half me-2"></i>
                                    <span id="countdown-{{ $event->id }}"></span>
                                </p>

                                <button class="btn btn-success btn-sm edit-btn text-white"
                                    data-id="{{ $event->id }}">Update</button>
                                <button class="btn btn-danger btn-sm delete-btn"
                                    data-id="{{ $event->id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Create Event Modal -->
        <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEventModalLabel">Create New Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="create-event-form">
                            <div class="mb-3">
                                <label for="name" class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="event_date" class="form-label">Event Date</label>
                                <input type="date" class="form-control" id="event_date" name="event_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="event_time" class="form-label">Event Time</label>
                                <input type="time" class="form-control" id="event_time" name="event_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Event Modal -->
        <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-event-form">
                            <input type="hidden" id="edit_event_id">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_event_date" class="form-label">Event Date</label>
                                <input type="date" class="form-control" id="edit_event_date" name="event_date"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="event_time" class="form-label">Event Time</label>
                                <input type="time" class="form-control" id="edit_event_time" name="event_time"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- import data --}}
        <div class="modal fade" id="importDataModal" tabindex="-1" role="dialog"
            aria-labelledby="importDataModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importDataModalLabel">Import Events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="importForm" enctype="multipart/form-data" action="{{ route('events.import') }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="csv_file">Upload CSV File</label>
                                <input type="file" name="csv_file" class="form-control" id="csv_file" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
@endsection

@section('scripts')
    <script>
        // CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Create Event
        $('#create-event-form').on('submit', function(e) {
            e.preventDefault();

            let data = $(this).serialize();
            $.post("{{ route('events.store') }}", data, function(response) {
                alert(response.success);
                location.reload();
            });
        });

        // Edit Event
        $('.edit-btn').on('click', function() {
            let eventId = $(this).data('id');

            $.get('/events/' + eventId + '/edit', function(data) {
                $('#edit_event_id').val(data.id);
                $('#edit_name').val(data.name);
                $('#edit_email').val(data.email);
                $('#edit_event_date').val(data.event_date);
                $('#edit_event_time').val(data.event_time);

                $('#editEventModal').modal('show');
            });
        });

        // Update Event
        $('#edit-event-form').on('submit', function(e) {
            e.preventDefault();

            const eventId = $('#edit_event_id').val();
            const data = $(this).serialize();

            $.ajax({
                url: '/events/' + eventId,
                type: 'PUT',
                data: data,
                success: function(response) {
                    alert(response.success);
                    location.reload();
                },
                error: function(jqXHR) {
                    alert('Error: ' + jqXHR.responseJSON.message ||
                        'An error occurred. Please try again.');
                }
            });
        });

        // Delete Event
        $('.delete-btn').on('click', function() {
            let eventId = $(this).data('id');
            if (confirm('Are you sure you want to delete this event?')) {
                $.ajax({
                    url: '/events/' + eventId,
                    type: 'DELETE',
                    success: function(response) {
                        alert(response.success);
                        location.reload();
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function startCountdown(eventId, eventDateTime) {
                const countdownElement = document.getElementById('countdown-' + eventId);
                const countdownDate = new Date(eventDateTime).getTime();

                if (countdownDate < Date.now()) {
                    countdownElement.innerHTML = "<span style='color: green;'>Event has already started!</span>";
                    return;
                }

                const interval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countdownDate - now;
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownElement.innerHTML =
                        `<span style='color: red;'>${days}d ${hours}h ${minutes}m ${seconds}s</span>`;
                    if (distance < 0) {
                        clearInterval(interval);
                        countdownElement.innerHTML =
                            "<span style='color: yellow;'>Event has started!</span>";

                        setTimeout(function() {
                            location.reload();
                        }, 10000);

                    }
                }, 1000);
            }

            @foreach ($events as $event)
                (function() {
                    const eventId = {{ $event->id }};
                    const eventDateTime =
                        '{{ $event->event_date }}T{{ $event->event_time }}';
                    startCountdown(eventId, eventDateTime);
                })();
            @endforeach
        });
    </script>
@endsection
