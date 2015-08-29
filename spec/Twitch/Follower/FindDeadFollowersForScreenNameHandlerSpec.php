<?php

namespace spec\Twitch\Follower;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Service\Twitter;
use Twitch\Follower\UserId;
use Twitch\Follower\ScreenName;
use Twitch\Follower\Repository;
use Twitch\Follower\FollowerListComparison;
use Twitch\Follower\UserWasUnfollowed;
use Twitch\Follower\FindDeadFollowersForScreenName;
use Twitch\Event\EventStore;

class FindDeadFollowersForScreenNameHandlerSpec extends ObjectBehavior
{
    function it_is_initializable(
        Twitter $twitter,
        Repository $repository,
        EventStore $eventstore
    ) {
        $comparison = new FollowerListComparison;
        $this->beConstructedWith($twitter, $repository, $comparison, $eventstore);
        $this->shouldHaveType('Twitch\Follower\FindDeadFollowersForScreenNameHandler');
    }

    function it_should_publish_events_when_new_unfollowers(
        Twitter $twitter,
        Repository $repository,
        EventStore $eventstore
    ) {
        $comparison = new FollowerListComparison;
        $this->beConstructedWith($twitter, $repository, $comparison, $eventstore);

        $screenName = new ScreenName('@example');

        $removedFollower = new UserId(1);
        $oldFollowerList = array($removedFollower);
        $newFollowerList = array();

        $repository->getFollowersOf($screenName)->willReturn($oldFollowerList);
        $twitter->getFollowersOf($screenName)->willReturn($newFollowerList);
        $eventstore
            ->push(new UserWasUnfollowed($screenName, $removedFollower))
            ->shouldBeCalled();
        $repository
            ->storeFollowersOf($screenName, $newFollowerList)
            ->shouldBeCalled();

        $this->handle(new FindDeadFollowersForScreenName($screenName));
    }

    function it_should_not_publish_events_when_no_new_unfollowers(
        Twitter $twitter,
        Repository $repository,
        EventStore $eventstore
    ) {
        $comparison = new FollowerListComparison;
        $this->beConstructedWith($twitter, $repository, $comparison, $eventstore);

        $screenName = new ScreenName('@example');
        $followerList = array();
        $repository->getFollowersOf($screenName)->willReturn($followerList);
        $twitter->getFollowersOf($screenName)->willReturn($followerList);
        $eventstore->push()->shouldNotBeCalled();
        $repository
            ->storeFollowersOf($screenName, $followerList)
            ->shouldBeCalled();

        $this->handle(new FindDeadFollowersForScreenName($screenName));
    }
}
