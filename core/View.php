<?php

namespace Core;

/**
 * Class View.
 */
class View
{
    /**
     * Display a template.
     * @param string $view
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function render($view, $data = [])
    {
        extract($data, EXTR_SKIP);

        $file = DIR_VIEWS_ABS . '/' . $view . '.php';

        if (!is_readable($file)) {
            throw new \Exception(sprintf('View %s not found', $file));
        }

        ob_start();
        require $file;
        return ob_get_flush();
    }
}
