<?php

namespace Twitch\Service;

use Twitch\Client\Twitter as TwitterClient;
use Twitch\Follower\Follower;
use Twitch\Follower\UserId;
use Twitch\Follower\ScreenName;
use Twitch\Follower\RealName;

final class ZendTwitter implements Twitter
{
    private $twitter;

    public function __construct(TwitterClient $twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Get a list of follower ids of a certain profile
     *
     * @param ScreenName $screenName The name of the profile
     *
     * @return UserId[]
     */
    public function getFollowersOf(ScreenName $screenName)
    {
        $followerIds = array();
        $cursor = null;

        do {
            $result = $this->twitter->followersIds(
                (string) $screenName,
                $cursor
            )->toValue();

            $followerIds = array_merge($followerIds, $result->ids);

            $cursor = $result->next_cursor_str;
        } while ($cursor != '0');

        return array_map(
            function($id) {
                return new UserId($id);
            },
            $followerIds
        );
    }

    /**
     * Get a Follower's profile by id
     *
     * @param UserId $id The id of the follower
     *
     * @return Follower
     */
    public function getFollowerById(UserId $id)
    {
        $result = $this->twitter->usersShow((string) $id)->toValue();

        return new Follower(
            $id,
            new ScreenName('@' . $result->screen_name),
            new RealName($result->name)
        );
    }
}
