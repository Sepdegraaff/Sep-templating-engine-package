<?php

namespace Sep\TemplatingEngine\Detectors;

use Sep\TemplatingEngine\Interfaces\DetectorInterface;

class SyntaxDetectorBrackets implements DetectorInterface
{
    public string $file;

    public function __construct($file)
    {
        $this->file = $file;
    }
    public function detector(): array
    {
        $re = '/\[\[ (.*?) ]]/mix';

        $detectFile = file_get_contents($this->file);

        preg_match_all($re, $detectFile, $matches, PREG_SET_ORDER, 0);

        return array_map(static function ($match) {
            return array_values(array_filter($match));
        }, $matches);
    }
}