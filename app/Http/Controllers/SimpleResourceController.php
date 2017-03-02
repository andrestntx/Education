<?php
namespace Education\Http\Controllers;

abstract class SimpleResourceController extends BaseResourceController
{
    public function index()
    {
        return $this->resourceView('list');
    }

    public function create()
    {
        $entity = new $this->getResourceEntity();
        $formData = $this->getFormData('store', 'POST', true);

        return $this->getFormView($entity, $formData);
    }
}