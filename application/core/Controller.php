<?php

namespace application\core;

use stdClass;

abstract class Controller
{
    /**
     * @var View
     */
	public View $view;

    /**
     * @var stdClass
     */
    public stdClass $request;

    /**
     * @var mixed|void
     */
    public Model $model;

    public function __construct (string $controller, string $method, array $payload = [])
    {
		$this->view = new View($controller, $method);
		$model      = $this->loadModel($controller);

        $this->setRequestParams($payload);

        if (!is_null($model)) {
            $this->model = $model;
        }
	}

    /**
     * Loading model.
     *
     * @param $name
     * @return mixed|void
     */
	public function loadModel ($name)
    {
        $classInstance = 'application\models\\'.ucfirst($name);

		if (class_exists($classInstance)) {
			return new $classInstance;
		}

        return null;
	}

    /**
     * All provided params in request will be save in array $this->request.
     *
     * Example of request: /post/{id}/section/{main}
     * Example of $this->request: $this->request-id, $this->request->main
     *
     * @param array $payload
     * @return void
     */
    private function setRequestParams (array $payload = []): void
    {
        if (!empty($payload)) {
            $this->request = new stdClass();

            foreach ($payload as $propertyName => $propertyValue)
            {
                $this->request->{$propertyName} = $propertyValue;
            }
        }
    }
}
