@extends('layouts.admin.sidebar')

@section('title', 'Trash Tickets')

@section('contents')
<div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-header text-white" style="background-color: #366389;">
            <h4 class="mb-0">Trash Bin</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($deletedTickets->isEmpty())
                <p>No tickets found in trash.</p>
            @else
                <table class="table table-bordered table-hover">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Ticket No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deletedTickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->ticket_no }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ $ticket->description }}</td>
                                <td>{{ $ticket->priority }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->deleted_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <!-- Restore ticket -->
                                    <form action="{{ route('trash.restore', $ticket->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success btn-sm">Restore</button>
                                    </form>

                                    <!-- Permanently delete ticket -->
                                    <form action="{{ route('trash.forceDelete', $ticket->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection