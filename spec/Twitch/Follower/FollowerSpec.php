<?php

namespace spec\Twitch\Follower;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Follower\Follower;
use Twitch\Follower\UserId;
use Twitch\Follower\ScreenName;
use Twitch\Follower\RealName;

class FollowerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(
            new UserId('999999'),
            new ScreenName('@foobar'),
            new RealName('Foo Bar')
        );
        $this->shouldHaveType('Twitch\Follower\Follower');
    }

    function it_is_equal_to_another_follower_if_ids_are_equal()
    {
        $this->beConstructedWith(
            new UserId(1),
            new ScreenName('@foobar'),
            new RealName('Foo Bar')
        );

        $sameIdSameCredentials = new Follower(
            new UserId(1),
            new ScreenName('@foobar'),
            new RealName('Foo Bar')
        );
        $this->equals($sameIdSameCredentials)->shouldReturn(true);

        $sameIdDifferentCredentials = new Follower(
            new UserId(1),
            new ScreenName('@bazqux'),
            new RealName('Baz Qux')
        );
        $this->equals($sameIdDifferentCredentials)->shouldReturn(true);

        $differentIdSameCredentials = new Follower(
            new UserId(2),
            new ScreenName('@foobar'),
            new RealName('Foo Bar')
        );
        $this->equals($differentIdSameCredentials)->shouldReturn(false);

        $differentIdDifferentCredentials = new Follower(
            new UserId(2),
            new ScreenName('@bazqux'),
            new RealName('Baz Qux')
        );
        $this->equals($differentIdDifferentCredentials)->shouldReturn(false);
    }
}
