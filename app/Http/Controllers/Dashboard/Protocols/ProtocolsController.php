<?php
namespace Education\Http\Controllers\Dashboard\Protocols;

use Education\Http\Controllers\SimpleResourceController;
use Education\Repositories\ForumRepository;
use Education\Repositories\ProtocolRepository;
use Education\Http\Requests\Protocols\CreateRequest;
use Education\Http\Requests\Protocols\EditRequest;
use Education\Entities\Protocol;
use Education\Repositories\UserRepository;

class ProtocolsController extends SimpleResourceController
{
    protected $formWithFiles = true;
    private $forumRepository;
    private $protocolRepository;
    private $userRepository;

    public function __construct(ForumRepository $forumRepository, ProtocolRepository $protocolRepository,
                                UserRepository $userRepository)
    {
        $this->forumRepository = $forumRepository;
        $this->protocolRepository = $protocolRepository;
        $this->userRepository = $userRepository;
    }

    public function store(CreateRequest $request)
    {
        $protocol = $this->protocolRepository->createForUser(auth()->user(),
            $request->all(), $request->file('file_doc'));

        $this->resourceFlash($protocol->name);

        return $this->resourceRedirect('show', $protocol);
    }

    public function show(Protocol $protocol)
    {
        $forums = $this->forumRepository->paginateOfProtocol($protocol);
        $protocol->load('Links', 'questions');

        return $this->resourceView('show-admin')->with([
            'protocol' => $protocol,
            'forums' => $forums
        ]);
    }
    
    public function edit(Protocol $protocol)
    {
        $formData = $this->getFormData('update', 'PUT', true, $protocol);

        return $this->getFormView($protocol, $formData);
    }
    
    public function update(EditRequest $request, Protocol $protocol)
    {
        $protocol = $this->protocolRepository->update($protocol, $request->all(), $request->file('file_doc'));
        $this->resourceFlash($protocol->name, 'update');

        return $this->resourceRedirect('show', $protocol);
    }
    
    public function destroy(Protocol $protocol)
    {
        $success = $this->protocolRepository->deleteEntity($protocol);

        return $this->resourceDeleteJson($protocol->name, $success);
    }

    public function stats(Protocol $protocol)
    {
        $users = $this->userRepository->usersWithProtocolExams($protocol);

        return view()->make('dashboard.pages.protocol.exams', compact('protocol', 'users'));
    }

    protected function getResourceEntity()
    {
        return Protocol::class;
    }
}
