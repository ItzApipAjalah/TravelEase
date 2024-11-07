@extends(Auth::user()->role === 'officer' ? 'layouts.officer.sidebar' : 'layouts.admin.sidebar')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Accept Ticket</div>

                <div class="card-body">
                    <h5>Ticket Details:</h5>
                    <p><strong>Title:</strong> {{ $ticket->title }}</p>
                    <p><strong>Description:</strong> {{ $ticket->description }}</p>
                    <p><strong>Priority:</strong> {{ $ticket->priority }}</p>

                    <form action="{{ route('officer.accept', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Confirm Accept</button>
                            <a href="{{ route('ticket') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection