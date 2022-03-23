<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:40:50
 * @modify date 2022-03-22 11:46:50
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console;

interface Contract
{
    public function register(array $commands);
    public function run();
}