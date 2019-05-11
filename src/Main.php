<?php

namespace Src;

use Src\IO\Reader;
use Src\Helpers\Validator;

class Main
{
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
        list($talks, $total_minutes) = (new Reader())->readAndFormat('/input.txt');

        print_r([$talks, $total_minutes]);

        (new Validator())->validateMinutesLength($total_minutes);

//        while($this->hasTalksRemaining($talks))
//        {
//            //$tracks =
//            $this->setDailyTrack(
//                $this->fillMorningTrack(),
//                $this->fillAfternoonTrack()
//            );
//        }

        // (new Writer())->formatAndWrite($tracks);

        return true;
    }

    public function hasTalksRemaining($talks)
    {
        $has = false;
        foreach ($talks as $minutes => $talks_title)
        {
            if (!empty($talks_title)) {
                $has = true;
                break;
            }
        }

        return $has;
    }

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