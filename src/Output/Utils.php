<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 21:16:59
 * @modify date 2022-03-23 08:30:22
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output;

trait Utils
{
    // Define default new line
    public $newLine = PHP_EOL;

    /**
     * Set a new line
     *
     * @param integer $howManyLine
     * @return void
     */
    public function setNewLine(int $howManyLine = 1)
    {
        if ($howManyLine === 1) return $this->newLine;

        return str_repeat($this->newLine, $howManyLine);
    }

    /**
     * Set whitespace betwen charater
     *
     * @param string $character
     * @param string $position
     * @param integer $howManySpace
     * @return void
     */
    public function withSpace(string $character, string $position = 'left',int $howManySpace = 1)
    {
        $result = '';
        // Prefix
        if ($position === 'left' || $position === 'both') $result .= str_repeat("\x20", $howManySpace);

        // Content
        $result .= trim($character);

        // Suffix
        if ($position === 'right' || $position === 'both') $result .= str_repeat("\x20", $howManySpace);

        return $result;
    }

    /**
     * Seperate command and signature
     *
     * @param string $command
     * @param integer $index
     * @return void
     */
    public function seperateCommand(string $command, int $index = 0)
    {
        $seperateCommand = explode(':', $command);

        return $seperateCommand[$index]??null;
    }

    /**
     * Retrive option value
     *
     * @param string $option
     * @return void
     */
    public function getOptionValue(string $option)
    {
        $options = explode('=', $option);

        return $options[1]??null;
    }
}