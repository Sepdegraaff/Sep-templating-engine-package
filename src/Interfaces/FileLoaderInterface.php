<?php

namespace Sep\TemplatingEngine\Interfaces;

interface FileLoaderInterface
{
    public function render(string $file, array $arguments = []);
}