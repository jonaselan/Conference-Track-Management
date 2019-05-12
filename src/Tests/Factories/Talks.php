<?php

namespace Src\Tests\Factories;

class Talks
{
    public function allTalks()
    {
        return [
            '60' => [
                'Writing Fast Tests Against Enterprise Rails',
                'Communicating Over Distance',
                'Rails Magic',
                'Ruby on Rails: Why We Should Move On',
                'Ruby on Rails Legacy App Maintenance',
            ],
            '45' => [
                'Overdoing it in Python',
                'Ruby Errors from Mismatched Gem Versions',
                'Common Ruby Errors',
                'Accounting-Driven Development',
                'Clojure Ate Scala (on my project)',
            ],
            '30' => [
                'Sit Down and Write',
                'Programming in the Boondocks of Seattle',
                'Ruby vs. Clojure for Back-End Development',
                'A World Without HackerNews',
                'User Interface CSS in Rails Apps',
            ],
            '5' => [
                'Rails for Python Developers'
            ]
        ];
    }

    public function allTalksEmpty()
    {
        return [
            '60' => [],
            '45' => [],
            '30' => [],
            '5' => []
        ];
    }

    public function withLightningTalk()
    {
        return [];
    }

}