<?php

namespace spec\Twitch\Follower;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Follower\ScreenName;

class ScreenNameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('@foobar');
        $this->shouldHaveType('Twitch\Follower\ScreenName');
    }

    function it_should_begin_with_an_at_sign()
    {
        $this
            ->shouldThrow('Twitch\\Follower\\ScreenNameShouldBeginWithAt')
            ->during__construct('foobar');
    }

    function it_can_be_compared_for_equality()
    {
        $this->beConstructedWith('@foobar');

        $this->equals(new ScreenName('@bazqux'))->shouldReturn(false);
        $this->equals(new ScreenName('@foobar'))->shouldReturn(true);
    }
}
