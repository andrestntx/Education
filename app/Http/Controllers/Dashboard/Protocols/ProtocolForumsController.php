<?php
namespace Education\Http\Controllers\Dashboard\Protocols;

use Education\Entities\Forum;
use Education\Entities\Protocol;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;


class ProtocolForumsController extends Controller
{
    private $protocol;


    public function __construct()
    {
        $this->beforeFilter('@findProtocol', ['only' => ['store']]);
    }

    public function findProtocol(Route $route)
    {
        $this->protocol = Protocol::findOrFail($route->getParameter('protocols'));
    }

    public function store(Request $request)
    {
        $forum = new Forum($request->all());
        $forum->user()->associate(auth()->user());
        $this->protocol->forums()->save($forum);

        return redirect()->route('study', $this->protocol);
    }
}
