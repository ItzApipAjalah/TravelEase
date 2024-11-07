<?php
namespace App\Policies;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class TicketPolicy
{
    use HandlesAuthorization;
    public function viewChat(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id || $user->type === 'admin' || $user->type === 'officer';
    }
    // Other policy methods...
}