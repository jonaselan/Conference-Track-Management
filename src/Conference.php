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
        while($this->hasTalksRemaining())
        {
            $this->tracks[++$this->track_count] =
            $this->setDailyTrack(
                $this->fillMorningTrack(),
                $this->fillAfternoonTrack()
            );
        }

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
        $count_by_minutes = $this->getCountsByMinutes();

        // 60 + (2 × 45) + 30
        if (($count_by_minutes['45'] >= $count_by_minutes['60'])
            && ($count_by_minutes['45']) >= $count_by_minutes['30'])
        {
            $morningTrack = [
                $this->popTitle($this->talks[60]) => 60,
                $this->popTitle($this->talks[45]) => 45,
                $this->popTitle($this->talks[45]) => 45,
                $this->popTitle($this->talks[30]) => 30,
            ];
        }
        // (2 × 60) + (2 × 30)
        else if(($count_by_minutes['45'] < $count_by_minutes['60'])
                || ($count_by_minutes['45'] < $count_by_minutes['30']))
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
        $afternoonTrack = [];
        $afternoonMinutes = 0;
        $count_by_minutes = $this->getCountsByMinutes();

        do {
            // verificar qual o que tem mais (por grupo de minuto) para manter o equilibrio
            $max_qtd_minutes = array_search(max($count_by_minutes), $count_by_minutes);

            // keep tracking how much minutes was put on afternoon
            $afternoonMinutes += $max_qtd_minutes;

            $afternoonTrack = array_merge(
                $afternoonTrack,
                [ $this->popTitle($this->talks[$max_qtd_minutes]) => $max_qtd_minutes ]
            );
            $count_by_minutes[$max_qtd_minutes]--;
        }
        while (!(($afternoonMinutes + $max_qtd_minutes) > 240));

        if ($count_by_minutes['5'] > 0)
        {
            $afternoonTrack = array_merge(
                $afternoonTrack,
                [ $this->popTitle($this->talks['5']) => 5 ]
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

    private function popTitle(&$array)
    {
        return array_pop($array);
    }

    private function getCountsByMinutes()
    {
        $counts = [];
        foreach ($this->talks as $minutes => $talks)
        {
            $counts[$minutes] = count($talks);
        }

        return $counts;
    }

}