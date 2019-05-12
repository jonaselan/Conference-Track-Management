<?php

namespace Src;

use Src\IO\Reader;
use Src\IO\Writer;

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

        (new Writer())->formatAndWrite($tracks);

        return true;
    }

}