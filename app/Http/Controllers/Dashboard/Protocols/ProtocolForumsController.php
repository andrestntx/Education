<?php
namespace Education\Http\Controllers\Dashboard\Protocols;

use Education\Entities\Forum;
use Education\Entities\Protocol;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;

class ProtocolForumsController extends Controller
{
    public function store(Request $request, Protocol $protocol)
    {
        $forum = new Forum($request->all());
        $forum->user()->associate(auth()->user());
        $protocol->forums()->save($forum);

        return redirect()->route('study', $protocol);
    }
}
