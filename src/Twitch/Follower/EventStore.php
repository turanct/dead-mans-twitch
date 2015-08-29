<?php

namespace Twitch\Follower;

interface EventStore
{
    /**
     * Push an event to the event store
     *
     * @param mixed $event The event
     */
    public function push($event);
}
