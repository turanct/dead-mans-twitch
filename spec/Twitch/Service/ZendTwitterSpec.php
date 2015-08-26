<?php

namespace spec\Twitch\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twitch\Follower\UserId;
use Twitch\Follower\ScreenName;
use Twitch\Follower\RealName;
use Twitch\Follower\Follower;
use Twitch\Client\Twitter;
use ZendService\Twitter\Response;

class ZendTwitterSpec extends ObjectBehavior
{
    function it_is_initializable(Twitter $client)
    {
        $this->beConstructedWith($client);
        $this->shouldHaveType('Twitch\Service\ZendTwitter');
    }

    function it_gets_an_empty_list_of_followers(Twitter $client, Response $response)
    {
        $response->toValue()->willReturn((object) array(
            'ids' => array(),
            'next_cursor_str' => '0',
        ));
        $client->followersIds('@example', null)->willReturn($response);
        $this->beConstructedWith($client);

        $screenName = new ScreenName('@example');

        $this->getFollowersOf($screenName)->shouldReturn(array());
    }

    function it_gets_a_one_page_list_of_followers(
        Twitter $client,
        Response $response
    ) {
        $response->toValue()->willReturn((object) array(
            'ids' => array(1, 2, 3, 4, 5),
            'next_cursor_str' => '0',
        ));
        $client->followersIds('@example', null)->willReturn($response);
        $this->beConstructedWith($client);

        $screenName = new ScreenName('@example');

        $this->getFollowersOf($screenName)->shouldBeLike(array(
            new UserId(1),
            new UserId(2),
            new UserId(3),
            new UserId(4),
            new UserId(5),
        ));
    }

    function it_gets_a_multipage_list_of_followers(
        Twitter $client,
        Response $response1,
        Response $response2
    ) {
        $response1->toValue()->willReturn((object) array(
            'ids' => array(1, 2, 3),
            'next_cursor_str' => 'foo',
        ));
        $response2->toValue()->willReturn((object) array(
            'ids' => array(4, 5),
            'next_cursor_str' => '0',
        ));
        $client->followersIds('@example', null)->willReturn($response1);
        $client->followersIds('@example', 'foo')->willReturn($response2);
        $this->beConstructedWith($client);

        $screenName = new ScreenName('@example');

        $this->getFollowersOf($screenName)->shouldBeLike(array(
            new UserId(1),
            new UserId(2),
            new UserId(3),
            new UserId(4),
            new UserId(5),
        ));
    }

    function it_gets_a_follower_by_id(
        Twitter $client,
        Response $response
    ) {
        $id = new UserId('1234');

        $response->toValue()->willReturn((object) array(
            'screen_name' => 'example',
            'name' => 'FooBar',
        ));
        $client->usersShow($id)->willReturn($response);
        $this->beConstructedWith($client);

        $this->getFollowerById($id)->shouldBeLike(
            new Follower(
                $id,
                new ScreenName('@example'),
                new RealName('FooBar')
            )
        );
    }
}
