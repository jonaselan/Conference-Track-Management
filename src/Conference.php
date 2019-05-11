<?php

namespace Src;

class Conference
{
    /**
     * @var array
     */
    private $talks = [];

    /**
     * @var array
     */
    public $tracks = [];

    /**
     * @var int
     */
    public $track_count = 0;

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
//        print_r($this->fillMorningTrack());
//        print_r($this->talks);

//        while($this->hasTalksRemaining())
//        {
            //$this->tracks[$this->track_count++][] =
//            $this->setDailyTrack(
//                $this->fillMorningTrack(),
//                $this->fillAfternoonTrack()
//            );
//        }

        return $this->tracks;
    }

    private function hasTalksRemaining()
    {
        $has = false;
        foreach ($this->talks as $minutes => $talks)
        {
            // if has unless one taks, continue
            if (!empty($talks)) {
                $has = true;
                break;
            }
        }

        return $has;
    }

    /**
     * Return values for fill morning track
     *
     * @return array
     */
    private function fillMorningTrack()
    {
        $morningTrack = [];
        $counts = $this->setCounts();

        // 60 + (2 × 45) + 30
        if (($counts['45'] >= $counts['60']) && ($counts['45']) >= $counts['30'])
        {
            $morningTrack = [
                $this->popTitle($this->talks[60]) => 60,
                $this->popTitle($this->talks[45]) => 45,
                $this->popTitle($this->talks[45]) => 45,
                $this->popTitle($this->talks[30]) => 30,
            ];
        }
        // (2 × 60) + (2 × 30)
        else if(($counts['45'] < $counts['60']) || ($counts['45'] < $counts['30']))
        {
            $morningTrack = [
                $this->popTitle($this->talks[60]) => 60,
                $this->popTitle($this->talks[30]) => 30,
                $this->popTitle($this->talks[30]) => 30,
                $this->popTitle($this->talks[60]) => 60,
            ];
        }

        return $morningTrack;
    }

    /**
     * Return values for fill afternoon track
     *
     * @return array
     */
    public function fillAfternoonTrack()
    {
        $morningTrack = [];
        $counts = $this->setCounts();

        // if has more 45 -> 60 + 2 × 45 + 30
        if (($counts['45'] >= $counts['60']) && ($counts['45']) >= $counts['30'])
        {
            $morningTrack = [
                $this->popTitle($this->talks[60]) => 60,
                $this->popTitle($this->talks[45]) => 45,
                $this->popTitle($this->talks[45]) => 45,
                $this->popTitle($this->talks[30]) => 30,
            ];
        }
        // 2 × 60 + 2 × 30
        else if(($counts['45'] < $counts['60']) || ($counts['45'] < $counts['30']))
        {
            $morningTrack = [
                $this->popTitle($this->talks[60]) => 60,
                $this->popTitle($this->talks[30]) => 30,
                $this->popTitle($this->talks[30]) => 30,
                $this->popTitle($this->talks[60]) => 60,
            ];
        }

        return $morningTrack;
    }

    private function setDailyTrack($morningTrack, $afternoonTrack)
    {
        $morning = array_merge($morningTrack, ['Lunch' => 0]);
        $afternoon = array_merge($afternoonTrack, ['Networking Event' => 0]);

        return array_merge($morning, $afternoon);
    }

    private function popTitle(&$array)
    {
        return array_pop($array);
    }

    private function setCounts()
    {
        $counts = [];
        foreach ($this->talks as $minutes => $talks_title)
        {
            $counts[$minutes] = count($talks_title);
        }

        return $counts;
    }

}