<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:38:20
 * @modify date 2022-03-21 20:45:01
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console;

abstract class Console implements Contract
{
    protected array $commandClass;

    /**
     * Register command
     *
     * @return void
     */
    public function register(string $commandSignature, string $commandClass)
    {
        $this->commandClass[$commandSignature] = $commandClass;
    }

    /**
     * Running command here
     *
     * @return value
     */
    public function run(string $commandSignature)
    {
    }
}