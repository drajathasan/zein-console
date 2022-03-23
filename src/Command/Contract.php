<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-03-22 12:24:27
 * @modify date 2022-03-23 10:43:38
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Command;

use Zein\Console\Exception;

abstract class Contract
{
    /**
     * Signature list
     *
     * @var array
     */
    protected array $signatures = [];

    /**
     * Option list
     *
     * @var array
     */
    protected array $options = [];

    /**
     * Argument list
     *
     * @var array
     */
    protected array $arguments = [];

    use \Zein\Console\Output\Utils;

    /**
     * Constructor
     *
     * @param array $options
     * @param array $arguments
     */
    public function __construct(array $options = [], array $arguments = [])
    {
        $this->options = $options;
        $this->arguments = $arguments;
    }

    /**
     * Retrieve all available signature
     *
     * @param string $key
     * @return void
     */
    public function getSignature(string $key = '')
    {
        return $this->signatures;
    }

    /**
     * Get option
     *
     * @param string $key
     * @return array|string
     */
    public function option(string $key = '')
    {
        if (empty($key)) return $this->options;

        $key = '--' . trim($key, '-');

        return $this->getOptionValue(array_values(array_filter($this->options, function($option) use($key) {
            if (preg_match('/' . $key . '/i', $option)) return true;
        }))[0]??null);
    }

    /**
     * Get argument
     *
     * @param string $key
     * @return array|string
     */
    public function argument(string $key = '')
    {
        if (empty($key)) return $this->arguments;

        try {
            $signature = $this->arguments[0]??null;
            unset($this->arguments[0]);
            $arguments = array_values($this->arguments);

            if (!isset($this->signatures[$signature])) throw new Exception("Signature not avalialble");

            $input = str_replace(['{','}'], '', $this->signatures[$signature]['input']);

            foreach (explode(' ', $input) as $index => $value) {
                if ($key === $value)
                {                    
                    return $arguments[$index]??null;
                }
            }
            
            throw new Exception("No argument available");

        } catch (Exception $e) {
            \Zein\Console\Output\Output::danger($e->getMessage());
        }
    }
}