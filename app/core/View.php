<?php

namespace app\core;

use ViewNotFoundException;

class View
{
    public function __construct(
        protected string $view,
        protected array $params = []
    ) {
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }


    /**
     * Loads a view file, checks if it exists, extracts parameters, captures the output of the view file using
     * output buffering, and returns the rendered view as a string. If the view is not found,
     * it throws a ViewNotFoundException.
     *
     * @return string
     * @throws ViewNotFoundException
     */
    public function render(): string
    {
        $viewPath = VIEWS_PATH . '/' . $this->view . '.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        foreach($this->params as $key => $value) {
            $$key = $value;// uses the double dollar sign ($$) to dynamically create variables based on the array keys and assigns them the corresponding values
        }

        ob_start();//start the output buffering so we can return the view as a string

        include $viewPath;

        return (string) ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }

}