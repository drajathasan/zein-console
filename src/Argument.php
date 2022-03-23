<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-21 20:48:46
 * @modify date 2022-03-23 07:10:53
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console;

final class Argument
{
    /**
     * Output mode
     *
     * @var array
     */
    public bool $strict = true;

    /**
     * Property of argument
     *
     * @var array
     */
    private array $arguments;

    /**
     * Available scope
     *
     * @var array
     */
    private array $scope = [
        'Parameter' => '/^[a-z]\w+/i',
        'Option' => '/\-\-+[a-z]\w+/i'
    ];

    /**
     * Fetch all argument
     *
     * get all argument from Cli environment
     * 
     * @return void
     */
    public function fetch()
    {
        try {
            if (count($_SERVER['argv']) < 2 && $this->strict) throw new Exception('Tidak ada perintah untuk dilakukan!');

            $this->arguments = array_slice($_SERVER['argv'], 1);
            
        } catch (Exception $e) {
            Output\Output::danger($e->getMessage());
        }
    }

    /**
     * Retrive all argument
     *
     * @return array
     */
    public function get()
    {
        return $this->arguments;
    }

    /**
     * Call scope function
     *
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public function __call($name, $arguments)
    {
        if (preg_match('/get/i', $name))
        {
            $inputScope = ucfirst(str_replace('get', '', $name));

            if (array_key_exists($inputScope, $this->scope)) 
                return $this->search($this->scope[$inputScope], $arguments);
        }

        Output\Output::danger("Method {$name} not found!");
    }

    /**
     * Search argument based on regex
     *
     * @param string $regex
     * @return void
     */
    private function search()
    {
        $searchArguments = func_get_args();

        $process = array_values(array_filter($this->arguments, function($argument) use($searchArguments) {
            if (preg_match($searchArguments[0], $argument)) return true;
        }));

        return count($searchArguments[1]) > 0 ? $this->searchByInput($process, $searchArguments[1][0]) : $process;
    }

    /**
     * Search option or argument based on user input
     *
     * @param array $arguments
     * @param string $inputArgument
     * @return void
     */
    private function searchByInput(array $arguments, string $inputArgument)
    {
        return array_values(array_filter($arguments, function($argument) use($inputArgument) {
            if ($argument === $inputArgument) return true;
        }))[0]??null;
    }
}