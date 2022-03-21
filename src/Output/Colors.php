<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 21:19:42
 * @modify date 2022-03-21 21:36:30
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output;

trait Colors
{
    public function successColor()
    {
        
    }

    public function infoColor()
    {
        
    }

    public function warningColor()
    {
        
    }

    public function dangerColor(string $message)
    {
        return "\e[31m{$message}";
    }

    public function normal(string $message)
    {
        return "\033[0m{$message}";
    }
}