<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-22 11:26:39
 * @modify date 2022-03-23 07:28:24
 * @license GPLv3
 * @desc [description]
 */

namespace App;
use Zein\Console\{Console,Argument,Output\Output};

class Pinko extends Console
{
    private object $argument;

    public function __construct()
    {
        $this->argument = new Argument;
        $this->argument->strict = false;
        $this->argument->fetch();    
    }

    public function run()
    {
        if (!$this->argument->get())
        {
            Output::help($this->commandClass);
        }

        $Parameter = $this->argument->getParameter();
        $Option = $this->argument->getOption();

        // Run command
        $Command = $this->{$this->seperateCommand($Parameter[0])};
        $CommandInstance = new $Command($Option, $Parameter);

        $CommandInstance->handle();
    }
}