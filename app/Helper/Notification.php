<?php
/**
 * [triggerPusher description]
 * @param  [string] $room_channel [The Channel That The Data Will Send In]
 * @param  [string] $event        [The Event Name That WIll Happend]
 * @param  [Object] $data         [The Data Object NOTE => [The Message]]
 */
function triggerPusher($room_channel, $event, $data)
{
    $pusher = new \Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), ['cluster' => env('PUSHER_APP_CLUSTER')]);
    $pusher->trigger( $room_channel, $event, [$data] );
}
