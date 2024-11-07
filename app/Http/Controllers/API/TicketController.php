<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $filter = $request->query('filter', 'all');

            $query = Ticket::with('user', 'category')->where('user_id', $userId);

            if ($filter === 'officer_empty') {
                $query->whereNull('officer_id');
            }

            $tickets = $query->get();

            return response()->json([
                'status' => true,
                'message' => 'Tickets retrieved successfully',
                'data' => $tickets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'priority' => 'required|in:low,medium,high',
                'category_id' => 'required|exists:categories,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $ticket = Ticket::create([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
                'status' => 'pending'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Ticket created successfully',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Ticket $ticket)
    {
        try {
            if (in_array($ticket->status, ['accepted', 'closed', 'canceled'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot update ticket that is already accepted, closed, or canceled'
                ], 403);
            }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'priority' => 'required|in:low,medium,high',
                'category_id' => 'required|exists:categories,id',
            ]);

            $ticket->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'priority' => $validated['priority'],
                'category_id' => $validated['category_id'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Ticket updated successfully',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function acceptTicket($id)
    {
        try {
            $ticket = Ticket::where('id', $id)->where('officer_id', null)->first();

            if (!$ticket) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ticket not found or already accepted'
                ], 404);
            }

            $ticket->update([
                'officer_id' => Auth::id(),
                'status' => 'accepted',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Ticket accepted successfully',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to accept ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function closeTicket($id)
    {
        try {
            $ticket = Ticket::where('id', $id)->where('status', 'accepted')->first();

            if (!$ticket) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ticket not found or not in accepted status'
                ], 404);
            }

            $ticket->update([
                'status' => 'closed',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Ticket closed successfully',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to close ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
