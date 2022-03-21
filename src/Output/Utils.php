<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 21:16:59
 * @modify date 2022-03-21 22:07:44
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output;

trait Utils
{
    public $newLine = PHP_EOL;

    public function setNewLine(int $howManyLine = 1)
    {
        if ($howManyLine === 1) return $this->newLine;

        return str_repeat($this->newLine, $howManyLine);
    }
}