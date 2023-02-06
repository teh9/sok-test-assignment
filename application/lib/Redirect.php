<?php

namespace application\lib;

class Redirect {

    /**
     * @var mixed
     */
    protected mixed $path;

    public function __construct ($path = null)
    {
        $this->path = $path;
    }

    /**
     * Setting errors.
     *
     * @param $errors
     * @return $this
     */
    public function withErrors ($errors): self
    {
        $_SESSION['errors'] = $errors;
        return $this;
    }

    /**
     * Execute redirect.
     *
     * @return void
     */
    public function go (): void
    {
        if (is_null($this->path)) {
            $this->path = $_SERVER['HTTP_REFERER'];
        }

        header('Location: ' . $this->path);
        exit;
    }

    /**
     * Set path to redirect back.
     *
     * @return $this
     */
    public function back (): self
    {
        $this->path = $_SERVER['HTTP_REFERER'];
        return $this;
    }
}
