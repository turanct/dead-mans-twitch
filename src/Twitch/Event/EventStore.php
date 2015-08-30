<?php

namespace Twitch\Event;

interface EventStore
{
    /**
     * Push an event to the event store
     *
     * @param Event $event The event
     */
    public function push(Event $event);

    /**
     * Get all events from the store
     *
     * @return Event[] An array of events
     */
    public function getAll();
}
