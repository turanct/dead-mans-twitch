<?php

namespace spec\Twitch\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Follower\ScreenName;

class FindDeadFollowersForScreenNameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new ScreenName('@foobar'));
        $this->shouldHaveType('Twitch\Command\FindDeadFollowersForScreenName');
    }

    function it_does_nothing_only_returns_screen_name()
    {
        $screenName = new ScreenName('@foobar');
        $this->beConstructedWith($screenName);
        $this->getScreenName()->shouldReturn($screenName);
    }
}
