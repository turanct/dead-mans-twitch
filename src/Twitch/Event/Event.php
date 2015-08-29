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
}
