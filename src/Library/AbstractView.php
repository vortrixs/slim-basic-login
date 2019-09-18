<?php

namespace SBL\Library;

abstract class AbstractView
{
    protected $path = __DIR__ . '/../../templates/';

    protected $data;

    public function render(string $template, array $data = []) : string
    {
        $this->path .= $template . '.php';
        $this->data = $data;

        $output = '';

        ob_start();

        include $this->path;

        $output .= ob_get_contents();

        ob_end_clean();

        return $output;
    }
}
