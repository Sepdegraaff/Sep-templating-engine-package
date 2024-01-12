<?php

namespace Sep\TemplatingEngine\Builders;

use Sep\TemplatingEngine\Detectors\SyntaxDetectorBrackets;
use Sep\TemplatingEngine\Interfaces\BuilderInterface;

class RenderFileBuilder implements BuilderInterface
{
    public string $file;

    public function __construct($file)
    {
        $this->file = $file;
    }
    public function build(array $arguments = []): array|false|string
    {
        $renderFile = $this->file;

        $detector = new SyntaxDetectorBrackets($renderFile);
        $detectedArguments = $detector->detector();

        $htmlContent = file_get_contents($renderFile);

        foreach ($detectedArguments as $detectedArg) {
            $detectedContent = trim($detectedArg[1]);

            if (array_key_exists($detectedContent, $arguments)) {
                $replacement = $arguments[$detectedContent];

                if (is_array($replacement)) {
                    $replacement = implode(' ', $replacement);
                }

                $htmlContent = str_replace($detectedArg[0], $replacement, $htmlContent);
            } else {
                throw new \RuntimeException("No replacement found for $detectedContent");
            }
        }

        return $htmlContent;
    }
}