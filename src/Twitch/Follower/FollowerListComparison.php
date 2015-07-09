<?php

namespace Twitch\Follower;

final class FollowerListComparison
{
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
