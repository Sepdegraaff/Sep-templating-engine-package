<?php

namespace Sep\TemplatingEngine\Loader;

use Sep\TemplatingEngine\Interfaces\FileLoaderInterface;

class FileLoader implements FileLoaderInterface
{
    public string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = rtrim($filePath . DIRECTORY_SEPARATOR);
    }

    public function render(string $file, array $arguments = []): void
    {
        $renderFile = $this->filePath . $file;

        $detector = new SyntaxDetector($renderFile);
        $detector->detector();

        if (!file_exists($renderFile) || !is_readable($renderFile)) {
            throw new \RuntimeException("File not found or not readable: $renderFile");
        }

        try {
            include $renderFile;
        } catch (\Exception $exception) {
            echo "Loading error: " . $exception->getMessage();
        }
    }
}