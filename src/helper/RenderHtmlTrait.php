<?php

namespace Sicredi\Credeasy\Helper;

trait RenderHtmlTrait 
{
    public function renderHtml(string $viewDir, array $options)
    {
        extract($options);

        ob_start();
        require __DIR__ . "/../../view/$viewDir";

        return ob_get_clean();
    }
}