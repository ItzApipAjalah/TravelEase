@extends($layout)
@section('contents')
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">

    <div class="container">
        <div class="chat-container">
           
            <div class="chat-header">
                <span class="user-name">{{ $ticket->user->name }}</span>
                Ticket : {{ $ticket->title }}
                @if (Auth::user()->type === 'admin' || Auth::user()->type === 'officer')
                    <button type="button" class="btn btn-danger ms-3" data-bs-toggle="modal"
                        data-bs-target="#closeModal{{ $ticket->id }}">close this chat</button>
                @endif

            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Chat Area -->
            <div class="chat-area">
                <div class="message-history" id="messages">
                    @foreach ($messages as $message)
                        <div class="message mb-3 @if ($message->user_id === Auth::id()) text-right @endif">
                            <div
                                class="@if ($message->user_id === Auth::id()) bg-primary text-white @else bg-light @endif d-inline-block p-2 rounded">
                                <strong>{{ $message->user->name }}:</strong>
                                <p class="mb-0">{{ $message->message }}</p>
                            </div>
                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach
                </div>

                <form action="{{ route('tickets.chat.store', $ticket) }}" method="POST" class="mt-auto">
                    @csrf
                    <div class="message-input input-group">
                        <input name="message" class="form-control" required placeholder="Type your message here..."></input>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary" aria-label="Send Message">Reply</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="closeModal{{ $ticket->id }}" tabindex="-1" role="dialog"
    aria-labelledby="closeModallLabel{{ $ticket->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #366389;">
                <h5 class="modal-title text-white" id="closeModalLabel{{ $ticket->id }}">Close this ticket</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this ticket?
            </div>
            <div class="modal-footer">
                <form action="{{ route('officer.closed', $ticket->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.iife.min.js"></script>

<script>
    const ticketId = {{ $ticket->id }};
    Pusher.logToConsole = true;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}',
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true
    });

    // Listen for incoming messages
    Echo.private(`chat.${ticketId}`)
        .listen('MessageSent', (event) => {
            const userName = event.message.user ? event.message.user.name : 'User';
            const messageHtml = `
                <div class="message mb-3 ${event.message.user_id === {{ Auth::id() }} ? 'text-right' : ''}">
                    <div class="${event.message.user_id === {{ Auth::id() }} ? 'bg-primary text-white' : 'bg-light'} d-inline-block p-2 rounded">
                        <strong>${userName}:</strong>
                        <p class="mb-0">${event.message.message}</p>
                    </div>
                    <small class="text-muted">${new Date(event.message.created_at).toLocaleTimeString()}</small>
                </div>`;

            document.querySelector('#messages').innerHTML += messageHtml;
            scrollToBottom(); // Auto-scroll when a new message is received
        });

    // Scroll to the bottom of the chat area
    function scrollToBottom() {
        const messageHistory = document.querySelector('#messages');
        messageHistory.scrollTop = messageHistory.scrollHeight;
    }

    // Initial scroll to bottom when the page loads
    document.addEventListener("DOMContentLoaded", scrollToBottom);

    // Scroll to the bottom after sending a message
    const messageForm = document.querySelector("form");
    messageForm.addEventListener("submit", function(e) {
        setTimeout(scrollToBottom, 100); // Delay to ensure new message is rendered
    });
</script>


<style>

</style>
