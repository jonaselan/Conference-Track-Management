<?php

namespace Src\IO;

class Writer
{
    public function formatAndWrite($tracks)
    {
        foreach ($tracks as $track => $talks)
        {
            $conferenceDuration = $this->startANewDay();
            echo "Track $track:\n\n";

            foreach ($talks as $talk => $length) {
                echo $conferenceDuration ." $talk \n\n";

                $this->nextTalk($conferenceDuration, $length);
            }
        }
    }

    private function startANewDay()
    {
        return date('h:i A', strtotime('09:00'));
    }

    private function nextTalk(&$duration, $length)
    {
        $duration = date('h:i A', strtotime("+".$length." minutes", strtotime($duration)));
    }
}
