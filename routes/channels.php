<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{ticketId}', function ($user, $ticketId) {
    return $user->id === Ticket::find($ticketId)->user_id || in_array($user->type, ['admin', 'officer']);
});
