<?php

namespace Helpers;

use Exception;

class Validator
{
    const MIN_MINUTES_PER_DAY = 180;

    /**
     * Validate entries
     *
     * @param string $title
     *
     * @throws Exception
     */
    public function validateTitle($title)
    {
        if (preg_match('/\d/', $title))
            throw new Exception('Invalid input: talk title can not have numbers');
    }

    /**
     * Validate minutes length
     *
     * @param $minutes
     * @throws Exception
     */
    public function validateMinutesLength($minutes)
    {
        if ($minutes < self::MIN_MINUTES_PER_DAY)
            throw new Exception('Invalid input: A minimum amount of hours was not entered to fill a track');
    }

    /**
     * Validate input path
     *
     * @param string $path
     *
     * @throws Exception
     */
    public function validateFile($path)
    {
        if (file_exists($path))
            throw new Exception('Invalid input: The file you are trying to open don\'t exist');
    }


}