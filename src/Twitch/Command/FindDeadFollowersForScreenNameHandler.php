<?php

namespace Twitch\Command;

use Twitch\Service\Twitter;
use Twitch\Follower\Repository;
use Twitch\Follower\FollowerListComparison;
use Twitch\Follower\EventStore;
use Twitch\Follower\UserWasUnfollowed;

final class FindDeadFollowersForScreenNameHandler
{
    private $twitter;
    private $repository;
    private $comparison;
    private $eventstore;

    public function __construct(
        Twitter $twitter,
        Repository $repository,
        FollowerListComparison $comparison,
        EventStore $eventstore
    ) {
        $this->twitter = $twitter;
        $this->repository = $repository;
        $this->comparison = $comparison;
        $this->eventstore = $eventstore;
    }

    public function handle(FindDeadFollowersForScreenName $command)
    {
        $screenName = $command->getScreenName();

        $oldFollowerList = $this->repository->getFollowersOf($screenName);
        $newFollowerList = $this->twitter->getFollowersOf($screenName);

        $diffList = $this->comparison->diff($oldFollowerList, $newFollowerList);

        foreach ($diffList as $followerId) {
            $this->eventstore->push(new UserWasUnfollowed($screenName, $followerId));
        }
    }
}
