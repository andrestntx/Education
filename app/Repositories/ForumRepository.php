<?php
namespace Education\Repositories;

use Education\Entities\Protocol;

class ForumRepository extends BaseRepository
{
    protected $defaultPaginate = 5;

    public function paginateOfProtocol(Protocol $protocol)
    {
        return $protocol->forums()
            ->with(['user'])
            ->paginate($this->defaultPaginate);
    }
}