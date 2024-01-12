<?php

namespace Sep\TemplatingEngine\Loader;

use Sep\TemplatingEngine\Builders\RenderFileBuilder;
use Sep\TemplatingEngine\Detectors\SyntaxDetectorBrackets;
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

        if (!file_exists($renderFile) || !is_readable($renderFile)) {
            throw new \RuntimeException("File not found or not readable: $renderFile");
        }

        try {
            $builder = new RenderFileBuilder($renderFile);
            echo $builder->build($arguments);
        } catch (\Throwable $exception) {
            echo "Loading error: " . $exception->getMessage();
        }
    }
}