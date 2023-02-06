<?php

namespace application\core;

use RuntimeException;

class View
{
    /**
     * @var string
     */
	public string $path;

    /**
     * @var string
     */
	public string $layout = 'default';

	public function __construct ($controller, $method)
    {
		$this->path = $controller.'/'.$method;
	}

    /**
     * If necessary to provide custom view, that method will allow you to do it.
     *
     * @param string $path
     * @return $this
     */
    public function setView (string $path): static
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Render the view.
     *
     * @param string $title
     * @param array $vars
     * @return void
     */
    public function render (string $title, array $vars = []): void
    {
        extract($vars);

        $pathToView = 'application/views/'.$this->path.'.php';

        if (!file_exists($pathToView)) {
            throw new RuntimeException("View file not found at { $pathToView }");
        }

        ob_start();
        require $pathToView;
        $content = ob_get_clean();
        require 'application/views/layouts/'.$this->layout.'.php';
    }
}	
