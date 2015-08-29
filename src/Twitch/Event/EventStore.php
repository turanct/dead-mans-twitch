<?php

namespace Twitch\Event;

interface EventStore
{
    /**
     * Push an event to the event store
     *
     * @param mixed $event The event
     */
    public function push($event);

    /**
     * Get all events from the store
     *
     * @return mixed[] An array of events
     */
    public function getAll();
}
