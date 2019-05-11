<?php

namespace Src\IO;

class Writer
{
    public function formatAndWrite($tracks)
    {

        // 10:00AM Overdoing it in Python 45min
        foreach ($tracks as $track => $talks)
        {
            $conferenceDuration = date('h:i A', strtotime('09:00'));
            echo "Track $track:\n\n";

            foreach ($talks as $talk => $length) {
                echo $conferenceDuration ." $talk \n\n";

                $conferenceDuration = date('h:i A', strtotime("+".$length." minutes", strtotime($conferenceDuration)));
            }
        }
    }
}
