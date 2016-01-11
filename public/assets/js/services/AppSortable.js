/*
 *  Document   : AppSorteable.js
 *  Author     : andrestntx
 *  Description: Custom javascript code used in Sorteable Ajax 
 */

var AppSortable = function() {
	
	var token = function () {
		return $('#token').data('token');
	}

	return {
		
		initChecklists: function(){
			$('#sortable').sortable({
				axis: 'y',
			  	cursor: 'pointer',
			  	cursorAt: { top: 1 },
			  	delay: 150,
			  	opacity: 0.8,
			  	revert: true,
			  	update: function( event, ui ) {
			  		var questions = $('#sortable').sortable('toArray');
			  		var formatId  = $('#sortable').data('format-id');

			  		$.ajax({
				        url: '/formats/checklists/' + formatId + '/order',
				        data: {_token: token, questions: questions},
				        method:'POST',
				        success:function(data){
				            console.log(data);
				        },
				        error:function(){
				            $('#sortable').sortable('cancel');
				        }
				    });

			  	}
			}).disableSelection();
		},

		initObservations: function(){
			$('#sortable').sortable({
				axis: 'y',
			  	cursor: 'pointer',
			  	cursorAt: { top: 1 },
			  	delay: 150,
			  	opacity: 0.8,
			  	revert: true,
			  	update: function( event, ui ) {
			  		var questions = $('#sortable').sortable('toArray');
			  		var formatId  = $('#sortable').data('format-id');

			  		$.ajax({
				        url: '/formats/observations/' + formatId + '/order',
				        data: {_token: token, questions: questions},
				        method:'POST',
				        success:function(data){
				            console.log(data);
				        },
				        error:function(){
				            $('#sortable').sortable('cancel');
				        }
				    });

			  	}
			}).disableSelection();
		}

	}
}();