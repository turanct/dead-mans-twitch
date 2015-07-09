<?php

namespace Twitch;

final class ZendTwitter
{
    private $twitter;

    public function __construct(Client\Twitter $twitter)
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