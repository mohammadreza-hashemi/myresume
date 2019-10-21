<?php

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

Broadcast::channel('articles.{type}', function ($user, $type) {
if($user->name == "hesam"){
  return true;
}
  return false;
    // return (int) $user->id === (int) $id;
});
