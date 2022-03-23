<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-22 11:51:20
 * @modify date 2022-03-23 08:29:21
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output\Template;

use Zein\Console\Exception;
use Zein\Console\Output\{Output,Colors,Utils};

/**
 * Basic template
 */

class Help
{
    use Colors,Utils;
    
    public static function render($lists)
    {
        $Help = new static;

        ob_start();

        echo $Help->setNewLine();

        // Usage
        echo $Help->warningColor('Usage') . $Help->normal() . $Help->setNewLine();
        echo $Help->normal($Help->withSpace('command [options] [arguments]')) . $Help->setNewLine(2);

        // Options
        echo $Help->warningColor('Available Commands') . $Help->normal() . $Help->setNewLine(2);
        
        foreach ($lists as $Command => $class) {
            // Set command
            $commandLabel = $Help->warningColor($Command) . $Help->normal() . $Help->setNewLine();
            echo $Help->normal("{$Help->withSpace($commandLabel, 'both')}") . $Help->setNewLine();

            try {

                if (!class_exists($class)) throw new Exception("Class {$class} not found!");

                // Get signature
                $CommandInstance = new $class;

                foreach ($CommandInstance->getSignature() as $signature => $attribute) {
                    echo $Help->withSpace($Help->successColor($signature), 'both', 3) 
                            . $Help->normal($Help->withSpace($attribute['description'], 3)) . $Help->setNewLine();
                }
                
            } catch (Exception $e) {
                Output::danger($e->getMessage());
            }
        }

        return ob_get_clean();
    }
}