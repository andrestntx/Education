<?php
namespace Education\Http\Controllers;

use Laracasts\Flash\Flash;

abstract class ResourceController extends Controller
{
    public function index()
    {
        return $this->resourceView('list');
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

    protected function getFormView($model, array $formData, $viewName = 'form')
    {
        return $this->resourceView($viewName)->with([
            'form_data' => $formData,
            $this->getModelName() => $model
        ]);
    }

    protected function getModelNameTrans()
    {
        return trans("entities.names.{$this->getModelName()}");
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
        return view("{$this->getPrefixView()}.$viewName");
    }

    protected function resourceRoute($routeName)
    {
        return "{$this->getPrefixRoute()}.$routeName";
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

    abstract protected function getPrefixRoute();
    abstract protected function getPrefixView();
    abstract protected function getModelName();
}