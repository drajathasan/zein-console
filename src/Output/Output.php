<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:51:19
 * @modify date 2022-04-04 22:04:26
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output;

class Output
{
    use Utils, Colors;
    
    /**
     * Output as help structure
     *
     * @param [type] $list
     * @param string $template
     * @return void
     */
    public static function help($list, string $template = 'Zein\Console\Output\Template\Help')
    {
        $Output = new Static;

        $Output->stop($template::render($list));
    }

    /**
     * Print all message as information
     *
     * @param string $message
     * @param string $header
     * @return void
     */
    public static function info(string $message, string $header = 'Info')
    {
        $Output = new Static;

        $message = 
            $Output->setNewLine() . 
            $Output->infoColor($header) .
            $Output->setNewLine(2) .
            $Output->normal($message) .
            $Output->setNewLine(2);

        $Output->stop($message);
    }

    /**
     * Print all message as success format
     *
     * @param string $message
     * @param string $header
     * @return void
     */
    public static function success(string $message)
    {
        $Output = new Static;

        $Output->stop($Output->successColor($message) . $Output->normal());
    }

    /**
     * Print warning message
     *
     * @param string $message
     * @return void
     */
    public static function warning(string $message)
    {
        $Output = new Static;
        $Output->stop($Output->successColor($message) . $Output->normal());
    }

    /**
     * Print danger message
     *
     * @param string $message
     * @return void
     */
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

    /**
     * Stop process with print message
     *
     * @param string $formatedOutput
     * @return void
     */
    private function stop(string $formatedOutput){
        echo $formatedOutput;
        echo $this->setNewLine();
        exit;
    }
}