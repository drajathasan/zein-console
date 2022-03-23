<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 21:19:42
 * @modify date 2022-03-23 08:27:00
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output;

trait Colors
{
    /**
     * Define color scope
     *
     * @var array
     */
    public array $colorScope = [
        'successColor' => "\e[32m<message>",
        'infoColor' => "\e[36m<message>",
        'warningColor' => "\e[93m<message>",
        'dangerColor' => "\e[31m<message>"
    ];

    /**
     * Print output ass normal text
     *
     * @param string $message
     * @return void
     */
    public function normal(string $message = '')
    {
        return "\033[0m{$message}";
    }

    /**
     * Call method based on scope
     *
     * @param [type] $name
     * @param [type] $argumemts
     * @return void
     */
    public function __call($name, $argumemts)
    {
        if (array_key_exists($name, $this->colorScope))
        {
            return  str_replace('<message>', $argumemts[0], $this->colorScope[$name]);
        }

        Output::danger("Method {$name} not found");
    }
}