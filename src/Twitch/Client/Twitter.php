<?php

namespace Twitch\Client;

use ZendService\Twitter\Response;

class Twitter extends \ZendService\Twitter\Twitter
{
    public function followersIds(
        $screenname,
        $cursor = null,
        $count = 5000
    ) {
        $this->init();
        $data = array(
            'screen_name' => (string) $screenname,
        );

        if ($cursor !== null) {
            $data['cursor'] = (string) $cursor;
        }

        $data['count'] = (int) $count;
        $data['stringify_ids'] = true;

        return new Response($this->get('followers/ids', $data));
    }
}
