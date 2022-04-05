<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-04-05 13:03:54
 * @modify date 2022-04-05 13:29:38
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Console\Output;

trait Interactive
{
    public array $interactiveOptions;

    public function setQuestion(array $question)
    {
        unset($question['--interactive']);
        $this->interactiveOptions = $question;
    }

    public function getAnswer($callback = '')
    {
        if (is_callable($callback))
        {
            $callback($this);
            return;
        }

        foreach ($this->interactiveOptions as $option => $question) {
            echo "\e[1m$question?\033[0m [tuliskan] ";
            $this->interactiveResponse[$option] = trim(fgets(STDIN));
        }
    }
}