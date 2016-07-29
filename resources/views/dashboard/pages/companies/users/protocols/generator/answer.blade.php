<div class="answer">
	<h2> <span class="order">{{ $order }}.</span> {{ $question->text }}</h2>
	<p>{!! $question->pivot->answer !!}</p>
	@foreach($generatedProtocol->questions->where('superior_id', $question->id) as $child)
		@include('dashboard.pages.companies.users.protocols.generator.answer', ['question' => $child, 'generatedProtocol' => $generatedProtocol, 'order' => $order . '.' . $child->order])
	@endforeach
</div>