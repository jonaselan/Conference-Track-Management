<?php

namespace Src;

use Src\IO\Reader;

class Main
{
    /**
     * Run app
     *
     * @return bool
     * @throws \Exception
     */
    public function run()
    {
        $talks = (new Reader())->readAndFormat('input.txt');

        $tracks = (new Conference($talks))->buildTracks();

        print_r($tracks);

        // (new Writer())->formatAndWrite($tracks);

        return true;
    }

}