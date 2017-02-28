<?php
namespace Education\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class BaseRepository
{
    protected $defaultPaginate = 10;

    protected function logQueryException(QueryException $e)
    {
        Log::info("Query Exeption: {$e->getCode()} - {$e->getMessage()}");
    }

}