<?php

namespace Sep\TemplatingEngine\Loader;

class SyntaxDetector
{
    public string $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function detector(): void
    {
        $detectFile = unpack('C*', $this->file);

        $bytes = $detectFile;

        $byteIndex = 1;

        foreach ($bytes as $byte => $currentByte) {
            if ($byte[$currentByte] === 60 && $byte === 60)
            {
                echo "<pre>";var_dump($byte[]);exit();
            }
        }
    }
}