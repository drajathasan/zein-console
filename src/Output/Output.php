<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:51:19
 * @modify date 2022-03-21 21:37:04
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output;

class Output
{
    use Utils, Colors;
    
    public static function info()
    {
        $Output = new Static;
        $Ouput->stop();
    }

    public static function success()
    {
        $Output = new Static;
        $Ouput->stop();
    }

    public static function warning()
    {
        $Output = new Static;
        $Ouput->stop();
    }

    public static function danger(string $message)
    {
        $Output = new Static;

        $message = 
            $Output->setNewLine() . 
            $Output->dangerColor('Error:') .
            $Output->setNewLine(2) .
            $Output->normal($message) .
            $Output->setNewLine(2);

        $Output->stop($message);
    }

    private function stop(string $formatedOutput){
        echo $formatedOutput;
        echo $this->setNewLine();
        exit;
    }
}