<?php

namespace Twitch\Follower;

interface EventStore
{
    public function push($event);
}
