<?php

namespace Src\Helpers;

use Exception;

class Validator
{
    const MIN_MINUTES_PER_DAY = 180;

    private $msg;

    public function __construct()
    {
        $this->msg = include 'messages.php';
        $this->msg = $this->msg[$GLOBALS['lang']];
    }

    /**
     * Validate entries
     *
     * @param string $title
     *
     * @return bool
     * @throws Exception
     */
    public function validateTitle($title)
    {
        if (preg_match('/\d/', $title))
            throw new Exception($this->msg['title_has_integer']);

        return true;
    }

    /**
     * Validate minutes length
     *
     * @param $minutes
     * @return bool
     * @throws Exception
     */
    public function validateMinutesLength($minutes)
    {
        if ($minutes < self::MIN_MINUTES_PER_DAY)
            throw new Exception($this->msg['invalid_time_length']);

        return true;
    }

    /**
     * Validate input path
     *
     * @param string $path
     *
     * @return bool
     * @throws Exception
     */
    public function validateFile($path)
    {
        if (file_exists($path) && is_readable($path))
            throw new Exception('Invalid input: The file you are trying to open don\'t exist or can\'t be read');

        return true;
    }


}