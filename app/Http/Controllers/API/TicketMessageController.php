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
    public function index($ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);

            // Check if user has access to this ticket
            if (Auth::user()->type === 'user' && $ticket->user_id !== Auth::id()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access to ticket'
                ], 403);
            }

            // For officers, check if they are assigned to this ticket
            if (Auth::user()->type === 'officer' && $ticket->officer_id !== Auth::id()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access to ticket'
                ], 403);
            }

            $messages = $ticket->messages()
                ->with('user:id,name,email,type') // Only get necessary user fields
                ->orderBy('created_at', 'asc')
                ->get()
                ->map(function ($message) {
                    return [
                        'id' => $message->id,
                        'message' => $message->message,
                        'created_at' => $message->created_at,
                        'user' => [
                            'id' => $message->user->id,
                            'name' => $message->user->name,
                            'type' => $message->user->type
                        ]
                    ];
                });

            return response()->json([
                'status' => true,
                'message' => 'Messages retrieved successfully',
                'data' => [
                    'ticket_id' => $ticket->id,
                    'ticket_status' => $ticket->status,
                    'messages' => $messages
                ]
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ticket not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve messages',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);

            // Check if user has access to this ticket
            if (Auth::user()->type === 'user' && $ticket->user_id !== Auth::id()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access to ticket'
                ], 403);
            }

            // For officers, check if they are assigned to this ticket
            if (Auth::user()->type === 'officer' && $ticket->officer_id !== Auth::id()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access to ticket'
                ], 403);
            }

            if ($ticket->status === 'closed') {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot send message to closed ticket'
                ], 403);
            }

            $validated = $request->validate([
                'message' => 'required|string|max:1000',
            ]);

            $message = TicketMessage::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'message' => $validated['message'],
            ]);

            // Load the user relationship for the response
            $message->load('user:id,name,email,type');

            // Format the response data
            $messageData = [
                'id' => $message->id,
                'message' => $message->message,
                'created_at' => $message->created_at,
                'user' => [
                    'id' => $message->user->id,
                    'name' => $message->user->name,
                    'type' => $message->user->type
                ]
            ];

            // Broadcast the message if you're using real-time updates
            broadcast(new MessageSent($ticket, $message))->toOthers();

            return response()->json([
                'status' => true,
                'message' => 'Message sent successfully',
                'data' => $messageData
            ], 201);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ticket not found'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
