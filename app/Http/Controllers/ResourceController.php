<?php
namespace Education\Http\Controllers;

use Education\Resolvers\EntityResolver;
use Laracasts\Flash\Flash;

abstract class ResourceController extends Controller
{
    protected $formWithFiles = false;

    abstract protected function getResourceEntity();

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

    protected function getFormData($route = 'store', $method = 'POST', $files = false, $entity = null)
    {
        $formRoute = is_null($entity) ? $this->resourceRoute($route) : [$this->resourceRoute($route), $entity];

        return [
            'route' => $formRoute,
            'method' => $method,
            'files' => $files
        ];
    }

    protected function getFormView($entity, array $formData, $viewName = 'form')
    {
        return $this->resourceView($viewName)->with([
            'form_data' => $formData,
            $this->getEntityName() => $entity
        ]);
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

    protected function resourceRedirect($routeName, $model)
    {
        return redirect()->route($this->resourceRoute($routeName), $model);
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