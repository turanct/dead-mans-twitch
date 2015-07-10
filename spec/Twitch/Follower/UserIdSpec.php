<?php

namespace spec\Twitch\Follower;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Follower\UserId;

class UserIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('999999');
        $this->shouldHaveType('Twitch\Follower\UserId');
    }

    function it_can_be_compared_for_equality()
    {
        $this->beConstructedWith('1');

        $this->equals(new UserId(2))->shouldReturn(false);
        $this->equals(new UserId(1))->shouldReturn(true);
    }
}
