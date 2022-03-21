<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:48:46
 * @modify date 2022-03-21 22:04:02
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console;

final class Argument
{
    private array $arguments;

    public function fetch()
    {
        try {
            if (count($_SERVER['argv']) < 2) throw new Exception('Tidak ada perintah untuk dilakukan!');

            $this->arguments = array_slice($_SERVER['argv'], 1);
            
        } catch (Exception $e) {
            Output\Output::danger($e->getMessage());
        }
    }

    public function get()
    {
        return $this->arguments;
    }

    public function getParameter()
    {
        return array_values(array_filter($this->arguments, function($argument){
            if (!preg_match('/-/i', $argument)) return true;
        }));
    }

    public function getOption()
    {
        return array_values(array_filter($this->arguments, function($argument){
            if (preg_match('/-/i', $argument)) return true;
        }));
    }
}