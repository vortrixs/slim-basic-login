<?php

namespace SBL\Library;

abstract class AbstractView
{
    /**
     * @var string
     */
    protected $path = __DIR__ . '/../../templates/';

    /**
     * @var array
     */
    protected $data;

    /**
     * Returns a HTML string based on the template supplied
     *
     * @param string $template  Name of the template file to render
     * @param array  $data      Data passed to the template
     *
     * @return string
     */
    public function render(string $template, array $data = []) : string
    {
        $this->path .= $template . '.php';
        $this->data  = $data;

        $output = '';

        ob_start();

        include $this->path;

        $output .= ob_get_contents();

        ob_end_clean();

        return $output;
    }
}
