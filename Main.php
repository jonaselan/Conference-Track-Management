<?php

//use Helper;

class Main
{
    public $total_minutes = 0;

    /**
     * Run app
     *
     * @return bool
     * @throws Exception
     */
    public function run()
    {
        if (!($fh = fopen('io/input.txt', 'r')))
            throw new Exception('Invalid input: The file you are trying to open don\'t exist');

        $talks = [];

        while ($line = fgets($fh)) {
            if (strlen($line) == 1) continue;

            list($minutes, $description) = $this->formatEntry($line);

            $this->validateEntry($description);

            $talks[$minutes][] = $description;
        }

        fclose($fh);

        if ($this->total_minutes < 180)
            throw new Exception('Invalid input: A minimum amount of hours was not entered to fill a track');

        
        return true;
    }

    /**
     * Format input coming from file
     *
     * @param $description
     * @return array
     */
    public function formatEntry($description)
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
    public function formatMinutes($dirty_minutes)
    {
        $minutes = '5';
        if ($dirty_minutes != 'lightning') {
            $minutes = strstr($dirty_minutes, 'min', true);
        }

        $this->total_minutes += $minutes;

        return $minutes;
    }

    /**
     * Validate entries
     *
     * @param $description
     *
     * @throws Exception
     */
    public function validateEntry($description)
    {
        if (preg_match('/\d/', $description))
            throw new Exception('Invalid input: talk title can not have numbers');
    }

}

try {
    (new Main())->run();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>