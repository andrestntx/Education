<?php
namespace Education\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class BaseRepository
{
    protected $defaultPaginate = 10;

    public function simpleUpdate(Model $entity, array $data)
    {
        $entity->fill($data);
        $entity->save();

        return $entity;
    }

    protected function delete(Model $entity)
    {
        $entity->delete();
    }

    public function deleteEntity(Model $entity)
    {
        $success = true;

        try {
            $this->delete($entity);
        } catch (QueryException $e) {
            $success = false;
            $this->logQueryException($e);
        }

        return $success;
    }

    protected function logQueryException(QueryException $e)
    {
        Log::info("Query Exeption: {$e->getCode()} - {$e->getMessage()}");
    }

}