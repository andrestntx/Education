<fieldset>
  <legend><i class="fa fa-angle-right"></i> {{ $question->text }}</legend>
  <div class="form-group">
      <div class="col-xs-12">
        {!! Form::textarea('questions['.$question->id.'][answer]', $generatedProtocol->getAnswerQuestion($question->id), 
        ['placeholder' => 'Escriba el contenido ', 'class' => 'ckeditor', 'rows' => 4]) !!}
      </div>
  </div>
  @foreach($question->questions as $child)
  	 @include('dashboard.pages.companies.users.protocols.generator.fieldset-question', ['question' => $child, 'generatedProtocol' => $generatedProtocol])
  @endforeach
</fieldset>