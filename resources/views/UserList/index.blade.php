@extends('layouts.admin.sidebar')

@section('title', 'Ticketing')


@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #366389;">
                        <h4 class="mb-0">User List </h4>
                        <div class="float-end">
                            <a href="{{ route('user.list', ['filter' => 'all']) }}" class="btn btn-success btn-sm">All Users</a>
                            <a href="{{ route('user.list', ['filter' => 'admin']) }}" class="btn btn-danger btn-sm">Admin Only</a>
                            <a href="{{ route('user.list', ['filter' => 'officer']) }}" class="btn btn-warning btn-sm">Officer Only</a>
                            <a href="{{ route('user.list', ['filter' => 'user']) }}" class="btn btn-primary btn-sm">User Only</a>
                        </div>
                    </div>

                    <div class="card-body">
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

                        <table class="table table-hover table-bordered">
                            <thead class="text-white" style="background-color: #366389;">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($UserList as $userlist)
                                    <tr>
                                        <td>{{ $userlist->id }}</td>
                                        <td>{{ $userlist->name }}</td>
                                        <td>{{ $userlist->email }}</td>
                                        <td>{{ $userlist->type }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $userlist->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    {{-- <!-- Modal for Ticket Details -->
                                    <div class="modal fade" id="ticketDetailModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketDetailModalLabel{{ $ticket->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white" id="ticketDetailModalLabel{{ $ticket->id }}">Ticket Details</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                                    <p><strong>Description:</strong> {{ $ticket->description }}</p>
                                                    <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
                                                    <p><strong>Status:</strong> {{ $ticket->status }}</p>
                                                    <p><strong>Category:</strong> {{ $ticket->category ? $ticket->category->name_category : 'Category Not Available' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $userlist->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $userlist->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white" id="deleteModalLabel{{ $userlist->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this ticket?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('user.destroy', $userlist->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap and jQuery for Modal functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
