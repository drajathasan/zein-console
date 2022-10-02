<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:38:20
 * @modify date 2022-10-02 21:48:49
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console;

abstract class Console implements Contract
{
    protected array $commandClass = [];

    use Output\Utils;

    /**
     * Register command
     *
     * @return void
     */
    public function register(array $commands)
    {
        foreach ($commands as $signature => $class) {
            $this->commandClass[$signature] = $class;
        }
    }

    /**
     * Retrive data from command class
     *
     * @param string $name
     * @return void
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->commandClass))
        {
            return $this->commandClass[$name];
        }
    }

    /**
     * Running command here
     *
     * @return value
     */
    public function run(){}
}