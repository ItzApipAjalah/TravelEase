<?php

namespace App\Http\Controllers\API;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketMessageController extends Controller
{
    public function index(Ticket $ticket)
    {
        try {
            $this->authorize('viewChat', $ticket);

            $messages = $ticket->messages()
                ->with('user')
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Messages retrieved successfully',
                'data' => $messages
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve messages',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, Ticket $ticket)
    {
        try {
            $this->authorize('viewChat', $ticket);

            if ($ticket->status == 'closed') {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot send message to closed ticket'
                ], 403);
            }

            $validated = $request->validate([
                'message' => 'required|string',
            ]);

            $message = TicketMessage::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'message' => $validated['message'],
            ]);

            broadcast(new MessageSent($ticket, $message))->toOthers();

            return response()->json([
                'status' => true,
                'message' => 'Message sent successfully',
                'data' => $message
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
