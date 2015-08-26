<?php

namespace Twitch\Follower;

final class FollowerListComparison
{
    /**
     * Get removed followers between an old and a new list of followers
     *
     * @param Follower[] $old An old list of followers
     * @param Follower[] $new A new list of followers
     *
     * @return Follower[] The removed followers
     */
    public function diff(array $old, array $new)
    {
        $diff = array();

        foreach ($old as $oldFollower) {
            foreach ($new as $newFollower) {
                if ($newFollower->equals($oldFollower)) {
                    continue 2;
                }
            }

            $diff[] = $oldFollower;
        }

        return $diff;
    }
}
