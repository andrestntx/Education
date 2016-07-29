<li class="well well-sm" data-id="{{ $question->id }}" data-name="{{ $question->text }}" id="{{ $question->id }}" style="cursor:pointer;">
    <a href="#" title="Borrar Pregunta" data-toggle="tooltip" class="pull-right question-option btn btn-xs btn-danger"><i class="gi gi-bin" onclick="AppProtocolGenerator.postDeleteQuestion(this)" data-entity-id="{{ $question->id }}"></i></a>

    @if($question->aviable)
        <a href="javascript:void(0)" title="Desactivar Pregunta" data-toggle="tooltip" class="pull-right question-option btn btn-xs btn-warning"><i class="gi gi-thumbs_down" onclick="AppProtocolGenerator.postDeactivateQuestion(this)" data-entity-id="{{ $question->id }}"></i></a>
    @else
        <a href="javascript:void(0)" title="Activar Pregunta" data-toggle="tooltip" class="pull-right question-option btn btn-xs btn-success"><i class="gi gi-thumbs_up" onclick="AppProtocolGenerator.postDeactivateQuestion(this)" data-entity-id="{{ $question->id }}"></i></a>
    @endif

    <a href="#" class="editable h4" data-url="/protocol-generator/{{ $question->id }}" data-pk="{{ $question->id }}">
        {{ $question->text }}
    </a>
    <ul>
       @foreach($question->questions->sortBy('order') as $child)
            @include('dashboard.pages.companies.users.protocols.generator.question', ['question' => $child])
       @endforeach 
    </ul>
</li>