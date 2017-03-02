<?php
namespace Education\Http\Controllers;

use Education\Resolvers\EntityResolver;
use Laracasts\Flash\Flash;

abstract class BaseResourceController extends Controller
{
    protected $formWithFiles = false;

    abstract protected function getResourceEntity();

    protected function getFormData($route = 'store', $method = 'POST', $files = false, $entity = null)
    {
        $formRoute = [$this->resourceRoute($route), $entity];

        if(is_null($entity)) {
            $formRoute = $this->resourceRoute($route);
        }
        else if(is_array($entity)) {
            $formRoute = array_merge([$this->resourceRoute($route)], $entity);
        }

        return [
            'route' => $formRoute,
            'method' => $method,
            'files' => $files
        ];
    }

    protected function getFormView($entity, array $formData, $viewName = 'form', array $additionalData = [])
    {
        $data = array_merge([
            'form_data' => $formData,
            $this->getEntityName() => $entity
        ], $additionalData);

        return $this->resourceView($viewName)->with($data);
    }

    protected function getEntityName()
    {
        return strtolower(class_basename($this->getResourceEntity()));
    }

    protected function getModelNameTrans()
    {
        return trans("entities.names.{$this->getResourceEntity()}");
    }

    protected function getResourceTrans($entityName, $method = 'store')
    {
        return trans("entities.resources.{$method}", [
            'entity' => $this->getModelNameTrans(),
            'entity_name' => $entityName
        ]);
    }

    protected function resourceView($viewName)
    {
        $viewBase = EntityResolver::getConfigKey($this->getResourceEntity(), 'view');

        return view("{$viewBase}.$viewName");
    }

    protected function resourceRoute($routeName)
    {
        $routeBase = EntityResolver::getConfigKey($this->getResourceEntity(), 'route');

        return "{$routeBase}.$routeName";
    }

    protected function resourceRedirect($routeName, ...$entities)
    {
        return redirect()->route($this->resourceRoute($routeName), $entities);
    }

    protected function resourceFlash($entityName, $method = 'store')
    {
        Flash::info($this->getResourceTrans($entityName, $method));
    }

    protected function resourceDeleteJson($entityName, $success = false)
    {
        $method = $success ? 'delete' : 'error-delete';

        return response()->json([
            'success' => $success,
            'message' => $this->getResourceTrans($entityName, $method)
        ]);
    }
}