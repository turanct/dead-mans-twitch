<?php

namespace Twitch;

interface Twitter
{
    /**
     * Get a list of follower ids of a certain profile
     *
     * @param ScreenName $screenName The name of the profile
     *
     * @return UserId[]
     */
    public function getFollowersOf(ScreenName $screenName);
}
