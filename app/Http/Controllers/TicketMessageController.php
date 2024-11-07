<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketMessageController extends Controller
{
    public function index(Ticket $ticket)
    {
        $layout = 'layouts.user.sidebar'; // Default layout

        if (auth()->check()) {
            if (auth()->user()->type == 'admin') {
                $layout = 'layouts.admin.sidebar';
            } elseif (auth()->user()->type == 'officer') {
                $layout = 'layouts.officer.sidebar';
            }
        }

        $this->authorize('viewChat', $ticket);

        $messages = $ticket->messages()->with('user')->orderBy('created_at', 'asc')->get();

        return view('tickets.chat', compact('ticket', 'messages', 'layout'));
    }

    public function store(Request $request, Ticket $ticket)
    {
        $this->authorize('viewChat', $ticket);

        if ($ticket->status == 'closed') {
            return redirect()
                ->back()
                ->with('error', 'You cannot send a message because the ticket is closed.');
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $message = TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($ticket, $message))->toOthers(); // Broadcast the event

        return redirect()->route('tickets.chat', $ticket)->with('success', 'Message sent successfully.');
    }
}
