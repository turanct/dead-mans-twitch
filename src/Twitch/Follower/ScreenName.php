<?php

namespace Twitch\Follower;

final class ScreenName
{
    private $name;

    public function __construct($name)
    {
        $this->assertBeginsWithAtSign($name);

        $this->name = (string) $name;
    }

    private function assertBeginsWithAtSign($name)
    {
        if (strpos($name, '@') !== 0) {
            throw new ScreenNameShouldBeginWithAt($name);
        }
    }

    public function equals(ScreenName $otherName)
    {
        return mb_strtolower($this->name) == mb_strtolower($otherName->name);
    }

    public function __toString()
    {
        return $this->name;
    }
}
