<?php

namespace Src;

class Conference
{
    /**
     * @var array
     */
    private $talks = [];

    /**
     * Conference constructor.
     * @param $talks
     */
    public function __construct($talks)
    {
        $this->talks = $talks;
    }

    /**
     * @return array
     */
    public function buildTracks()
    {
        $trackCount = 0;
        $tracks = [];

        while($this->hasTalksRemaining())
        {
            $tracks[++$trackCount] =
            $this->setDailyTrack(
                $this->fillMorningTrack(),
                $this->fillAfternoonTrack()
            );
        }

        return $tracks;
    }

    public function hasTalksRemaining()
    {
        $has = false;
        foreach ($this->talks as $minutes => $talks)
        {
            // if has unless one talk, continue
            if (!empty($talks)) {
                $has = true;
                break;
            }
        }

        return $has;
    }

    public function getCountsByMinutes()
    {
        $counts = [];
        foreach ($this->talks as $minutes => $talks)
        {
            $counts[$minutes] = count($talks);
        }

        return $counts;
    }

    /**
     * Return values for fill morning track
     *
     * @return array
     */
    private function fillMorningTrack()
    {
        $morningTrack = [];
        $countByMinutes = $this->getCountsByMinutes();

        // 60 + (2 × 45) + 30
        if (($countByMinutes['45'] >= $countByMinutes['60'])
            && ($countByMinutes['45']) >= $countByMinutes['30'])
        {
            $morningTrack = [
                $this->popTalk($this->talks[60]) => 60,
                $this->popTalk($this->talks[45]) => 45,
                $this->popTalk($this->talks[45]) => 45,
                $this->popTalk($this->talks[30]) => 30,
            ];
        }
        // (2 × 60) + (2 × 30)
        else if(($countByMinutes['45'] < $countByMinutes['60'])
            || ($countByMinutes['45'] < $countByMinutes['30']))
        {
            $morningTrack = [
                $this->popTalk($this->talks[60]) => 60,
                $this->popTalk($this->talks[30]) => 30,
                $this->popTalk($this->talks[30]) => 30,
                $this->popTalk($this->talks[60]) => 60,
            ];
        }

        return $morningTrack;
    }

    /**
     * Return values for fill afternoon track
     *
     * @return array
     */
    private function fillAfternoonTrack()
    {
        $afternoonTrack = [];
        $afternoonMinutes = 0;
        $countByMinutes = $this->getCountsByMinutes();

        do {
            // check which has the most occurrences per time
            $maxQtdMinutes = array_search(max($countByMinutes), $countByMinutes);

            // keep tracking how much minutes was put on afternoon
            $afternoonMinutes += $maxQtdMinutes;

            $afternoonTrack = array_merge(
                $afternoonTrack,
                [ $this->popTalk($this->talks[$maxQtdMinutes]) => $maxQtdMinutes ]
            );
            $countByMinutes[$maxQtdMinutes]--;
        }
        while (!(($afternoonMinutes + $maxQtdMinutes) > 240)); // > 5pm

        // handle lightning talks
        if ($countByMinutes['5'] > 0)
        {
            $afternoonTrack = array_merge(
                $afternoonTrack,
                [ $this->popTalk($this->talks['5']) => 5 ]
            );
        }

        return $afternoonTrack;
    }

    private function setDailyTrack($morningTrack, $afternoonTrack)
    {
        $morning = array_merge($morningTrack, ['Lunch' => 60]);
        $afternoon = array_merge($afternoonTrack, ['Networking Event' => 0]);

        return array_merge($morning, $afternoon);
    }

    private function popTalk(&$array)
    {
        return array_pop($array);
    }

}