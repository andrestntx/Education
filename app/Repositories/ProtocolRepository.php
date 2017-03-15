<?php
namespace Education\Repositories;

use Education\Entities\Protocol;
use Education\Entities\User;
use Illuminate\Database\QueryException;

class ProtocolRepository extends BaseRepository
{
    public function createForUser(User $user, array $data, $file)
    {
        $protocol = new Protocol();
        $protocol->fillAndClear($data);
        $user->protocolsCreated()->save($protocol);
        $protocol->syncRelations($data);
        $protocol->uploadDoc($file);
        $protocol->save();

        return $protocol;
    }

    public function update(Protocol $protocol, array $data, $file)
    {
        $protocol->uploadDoc($file);
        $protocol->fillAndClear($data);
        $protocol->save();
        $protocol->syncRelations($data);

        return $protocol;
    }

    public function delete(Protocol $protocol)
    {
        $protocol->detachAndDelete();
    }
}