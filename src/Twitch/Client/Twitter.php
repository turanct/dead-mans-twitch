<?php

namespace Twitch\Client;

use ZendService\Twitter\Response;

class Twitter extends \ZendService\Twitter\Twitter
{
    /**
     * Get a list of follower ids for a screenname
     *
     * @param string $screenname The screenname for which we want the followers
     * @param string $cursor     The page cursor
     * @param int    $count      The max number of ids per page
     *
     * @return Response The api response
     */
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
