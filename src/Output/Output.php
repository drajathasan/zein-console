<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:51:19
 * @modify date 2022-04-07 07:47:43
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

        $formatedMessage = 
            $Output->setNewLine() . 
            $Output->infoColor($header) .
            $Output->setNewLine(2) .
            $Output->normal($Output->isCliOrWeb($message, true)) .
            $Output->setNewLine(2);

        $Output->stop($formatedMessage);
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

        $Output->stop($Output->successColor($Output->isCliOrWeb($message, true)) . $Output->normal());
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
        $Output->stop($Output->successColor($Output->isCliOrWeb($message, false)) . $Output->normal());
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

        $formatedMessage = 
            $Output->setNewLine() . 
            $Output->dangerColor('Error:') .
            $Output->setNewLine(2) .
            $Output->normal($Output->isCliOrWeb($message, false)) .
            $Output->setNewLine(2);

        $Output->stop($formatedMessage);
    }

    /**
     * Check environment first for difference 
     * result
     *
     * @param string $message
     * @param boolean $status
     * @return string
     */
    private function isCliOrWeb(string $message, bool $status)
    {
        if (php_sapi_name() !== 'cli')
        {
            $this->stopAsJson(['status' => $status, 'message' => $message]);
        }

        return $message;
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

    /**
     * Stop process in web environment
     * with json as default format
     */
    private function stopAsJson(array $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}