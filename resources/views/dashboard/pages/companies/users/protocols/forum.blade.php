<div class="block">
    <div class="block-title">
        <h2>Foro</h2>
    </div>
    <div class="block-section">
    	<div class="protocol-forums">
	    	<table class="table table-striped">
	    		<tbody>
			        @foreach($forums as $forum)
		                <tr>
		                    <td class="text-center"><a href="page_ready_profile.html"><strong>{{ $forum->user->username}}</strong></a></td>
		                    <td><em>{{ $forum->created_at->format('M d, Y - h:s A') }}</em></td>
		                </tr>
		                <tr>
		                    <td class="text-center" style="width: 10%;">
		                        <div class="push-bit">
		                            <a href="page_ready_profile.html">
		                                <img src="{{ $forum->user->image }}" alt="avatar" class="img-circle forum-user-image">
		                            </a>
		                        </div>
		                    </td>
		                    <td>
		                        <p>{{ $forum->comment }}</p>
		                        <em>{{ $forum->user->name }}</em>
		                    </td>
		                </tr>
		            @endforeach
	            </tbody>
	        </table>
        </div>

        <table class="table table-striped forum-form">
    		<tbody>
	            <tr>
	                <td class="text-center"><a href="page_ready_profile.html"><strong>Tú</strong></a></td>
	                <td><em>Ahora</em></td>
	            </tr>
	            <tr>
	                <td class="text-center" style="width: 15%;">
	                    <a href="page_ready_profile.html"><img src="{{ Auth()->user()->image }}" class="img-circle forum-user-image" alt="avatar"></a>
	                </td>
	                <td>
	                	{!! Form::open(['route' => ['protocols.forum.store', $protocol->id], 'method' => 'POST', 
	                		'class' => 'form-horizontal']) !!}

	                		<div class="form-group">
	                			<div class="col-md-12">
									{!! Form::textarea('comment', null, ['placeholder' => 'Pregunta o responde...', 'rows' => 4, 
										'class' => 'form-control']) !!}
								</div>
							</div>

							<div class="form-group">
	                            <div class="col-md-12">
	                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Enviar comentario</button>
	                            </div>
	                        </div>
						{!! Form::close() !!}
	                </td>
	            </tr>
	        </tbody>
	    </table>
		
		<div class="text-center">
	    	{!! $forums->render() !!}
	    </div>
    </div>
</div>