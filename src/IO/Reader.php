<?php

namespace Src\IO;

use Src\Helpers\Validator;

class Reader
{
    /**
     * @var int
     */
    private $totalMinutes = 0;

    /**
     * @var Validator
     */
    public $validator = null;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * @param $path
     * @return array
     * @throws \Exception
     */
    public function readAndFormat($path): array
    {
        if($this->validator->validateFile($path)){
            $fh = fopen($path, 'r', true);
            $talks = [];
        }

        while ($line = fgets($fh)) {
            if (strlen($line) == 1) continue; // ignore empty lines

            list($length, $title) = $this->formatEntry($line);

            $this->validator->validateTitle($title);

            $talks[$length][] = $title;
        }

        fclose($fh);

        $this->validator->validateMinutesLength($this->totalMinutes);

        arsort($talks);

        return $talks;
    }

    /**
     * Format input coming from file
     *
     * @param $description
     * @return array
     */
    private function formatEntry($description)
    {
        // position of last occurring space in the string
        $pos = strrpos($description, ' ');

        // get the last word in the string
        $lastWord = substr($description, $pos);

        return [
            $this->formatMinutes(trim($lastWord)),
            strstr($description, $lastWord, true),
        ];
    }

    /**
     * Format dirty minutes
     *
     * @param $dirtyMinutes
     * @return string
     */
    private function formatMinutes($dirtyMinutes)
    {
        $minutes = '5';
        if ($dirtyMinutes != 'lightning') {
            // get only number of minutes
            $minutes = strstr($dirtyMinutes, 'min', true);
        }

        $this->totalMinutes += $minutes;

        return $minutes;
    }

}
