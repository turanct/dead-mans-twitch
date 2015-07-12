<?php

namespace Twitch\Follower;

use Twitch\Follower\ScreenName;

interface Repository
{
    /**
     * Get a list of follower ids of a certain profile
     *
     * @param ScreenName $screenName The name of the profile
     *
     * @return UserId[]
     */
    public function getFollowersOf(ScreenName $screenName);

    /**
     * Store a list of follower ids of a certain profile
     *
     * @param ScreenName $screenName The name of the profile to store followers of
     * @param UserId[]   $ids        A list of UserId's
     */
    public function storeFollowersOf(ScreenName $screenName, array $ids);
}
