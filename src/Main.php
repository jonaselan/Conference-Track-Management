<?php

namespace Src;

use Src\IO\Reader;

class Main
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
     * Run app
     *
     * @return bool
     * @throws \Exception
     */
    public function run()
    {
        $this->talks = (new Reader())->readAndFormat('input.txt');

        while($this->hasTalksRemaining())
        {
            //$this->tracks[$this->track_count++][] =
            $this->setDailyTrack(
                $this->fillMorningTrack(),
                $this->fillAfternoonTrack()
            );
        }

        // (new Writer())->formatAndWrite($this->tracks);

        return true;
    }

    public function hasTalksRemaining()
    {
        $has = false;
        foreach ($this->talks as $minutes => $talks_title)
        {
            if (!empty($talks_title)) {
                $has = true;
                break;
            }
        }

        return $has;
    }

    /**
     * Return values for fill morning track
     */
    public function fillMorningTrack()
    {
        $morningTrak = [];
        $talks = $this->talks;
        if ((count($talks['45']) > count($talks['60']))
            && (count($talks['45']) > count($talks['30'])))
        {
            // return 45
        }
        else if((count($talks['45']) > count($talks['60']))
            && (count($talks['45']) > count($talks['30'])))
        {
            //
        }

    }

    public function setDailyTrack($morningTrak, $afternoonTrak)
    {
        // merge arrays...
    }

}

//try {
//    (new Main())->run();
//} catch (\Exception $e) {
//    echo $e->getMessage();
//}