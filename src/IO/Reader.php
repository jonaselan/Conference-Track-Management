<?php

namespace Src\IO;

use Src\Helpers\Validator;

class Reader
{
    /**
     * @var int
     */
    private $total_minutes = 0;

    /**
     * @var array
     */
    private $talks = [];

    public $validator = [];

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
        }

        while ($line = fgets($fh)) {
            if (strlen($line) == 1) continue; // ignore empty lines

            list($length, $title) = $this->formatEntry($line);

            $this->validator->validateTitle($title);

            $this->talks[$length][] = $title;
        }

        fclose($fh);

        return [
            $this->talks,
            $this->total_minutes
        ];
    }

    /**
     * Format input coming from file
     *
     * @param $description
     * @return array
     */
    private function formatEntry($description)
    {
        // position of last occuring space in the string
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
     * @param $dirty_minutes
     * @return string
     */
    private function formatMinutes($dirty_minutes)
    {
        $minutes = '5';
        if ($dirty_minutes != 'lightning') {
            $minutes = strstr($dirty_minutes, 'min', true);
        }

        $this->total_minutes += $minutes;

        return $minutes;
    }

}