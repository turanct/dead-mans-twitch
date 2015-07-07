<?php

namespace spec\Twitch;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Follower;
use Twitch\ScreenName;
use Twitch\RealName;

class FollowerListComparisonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Twitch\FollowerListComparison');
    }

    function it_returns_empty_list_when_nothing_to_compare()
    {
        $emptyList = $this->getEmptyList();

        $this->diff($emptyList, $emptyList)->shouldReturn($emptyList);
    }

    function it_returns_empty_list_when_nothing_was_removed()
    {
        $emptyList = $this->getEmptyList();
        $fooBarList = $this->getFooBarList();
        $fooBarBazList = $this->getFooBarBazList();

        $this->diff($fooBarList, $fooBarList)->shouldReturn($emptyList);
        $this->diff($fooBarList, $fooBarBazList)->shouldReturn($emptyList);
    }

    function it_returns_a_list_of_removed_items()
    {
        $fooBarList = $this->getFooBarList();
        $fooList = $this->getFooList();
        $barList = $this->getBarList();

        $this->diff($fooBarList, $fooList)->shouldBeLike($barList);
    }

    function it_returns_a_list_of_removed_items_even_when_others_were_added()
    {
        $fooBarBazList = $this->getFooBarBazList();
        $bazQuxList = $this->getBazQuxList();
        $fooBarList = $this->getFooBarList();

        $this->diff($fooBarBazList, $bazQuxList)->shouldBeLike($fooBarList);
    }

    private function getEmptyList()
    {
        return array();
    }
    private function getFooList()
    {
        return array(
            new Follower(new ScreenName('@foo'), new RealName('Foo')),
        );
    }
    private function getBarList()
    {
        return array(
            new Follower(new ScreenName('@bar'), new RealName('Bar')),
        );
    }
    private function getFooBarList()
    {
        return array(
            new Follower(new ScreenName('@foo'), new RealName('Foo')),
            new Follower(new ScreenName('@bar'), new RealName('Bar')),
        );
    }
    private function getFooBarBazList()
    {
        return array(
            new Follower(new ScreenName('@foo'), new RealName('Foo')),
            new Follower(new ScreenName('@bar'), new RealName('Bar')),
            new Follower(new ScreenName('@baz'), new RealName('Baz')),
        );
    }
    private function getBazQuxList()
    {
        return array(
            new Follower(new ScreenName('@baz'), new RealName('Baz')),
            new Follower(new ScreenName('@qux'), new RealName('Qux')),
        );
    }
}
