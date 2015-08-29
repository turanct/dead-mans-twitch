<?php

namespace Twitch\Event;

interface Event
{
    /**
     * Get the date for this event
     *
     * @return DateTime
     */
    public function getDate();

    /**
     * Serialize the event to a json representation
     *
     * E.g.:
     * {
     *   "event": "FooWasBarred",
     *   "date": 1440867474,
     *   "otherProperty": "foo"
     * }
     *
     * @return string
     */
    public function toJson();
}
