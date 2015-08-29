<?php

namespace spec\Twitch\Follower;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Follower\ScreenName;
use Twitch\Follower\UserId;
use DateTime;

class UserWasUnfollowedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(
            new ScreenName('@foobar'),
            new UserId('1234'),
            new DateTime('now')
        );

        $this->shouldHaveType('Twitch\Follower\UserWasUnfollowed');
        $this->shouldImplement('Twitch\Event\Event');
    }

    function it_has_properties_we_can_get_but_not_mutate()
    {
        $screenName = new ScreenName('@foobar');
        $followerId = new UserId('1234');
        $date = new DateTime('now');

        $this->beConstructedWith($screenName, $followerId, $date);

        // All properties should be transparantly returned
        $this->getScreenName()->shouldReturn($screenName);
        $this->getFollowerId()->shouldReturn($followerId);
        $this->getDate()->shouldBeLike($date);

        // The stored date should not be modified, only the local copy
        $this->getDate()->modify('+1 day');
        $this->getDate()->shouldBeLike($date);
    }
}
