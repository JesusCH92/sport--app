<?php

declare(strict_types=1);

namespace App\Common\Infrastructure;

abstract class WebController
{
    protected function renderTemplate(string $pathView, array $vars = []): string
    {
        $pathToPhp = __DIR__ . $pathView;

        ob_start();

        extract($vars);

        include $pathToPhp;

        $htmlContent = ob_get_clean();

        return $htmlContent;
    }

    protected function renderBaseTemplate(string $content, string $windowName): string
    {
        return $this->renderTemplate('/../../View/base.php', [
            'title' => $windowName,
            'content' => $content,
        ]);
    }
}