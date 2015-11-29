/*
 *  Document   : AppServices.js
 *  Author     : andrestntx
 *  Description: Custom javascript code used in all Ajax Services
 */

var AppServices = function() {

	var postDelete = function (entityElement, entityId, url) {
		var token = $(entityElement).data('token');

		$.ajax({
	        url: url,
	        data: {'_token': token},
	        dataType:'json',
	        method:'DELETE',
	        success:function(data){
	            if(data['success']){
	                deleteEntity(entityId);
	                notification('info', data['message']);
	            }
	            else{
	            	notification('danger', data['message']);
	            }
	        },
	        error:function(){
	            alert('fallo la conexion');
	        }
	    });
	};

	var deleteEntity = function (entityId, entityName) {
		$("#" + entityId).fadeOut(700, function() {
	        $("#" + entityId).remove();
	    });
	};

	var notification = function (type, message) {
		$.bootstrapGrowl("<h4><strong>Atención</strong></h4> <p style='font-size:16px;'>" + message + "</p>", {
	        type: type,
	        delay: 7000,
	        allow_dismiss: true,
	        offset: {from: 'top', amount: 20}
	    });
	};

    return {

		postDeleteRole: function (entityElement) {
			var entityId 	= $(entityElement).data('entity-id');
			var url 		= '/roles/' +  entityId;

			postDelete(entityElement, entityId, url);
		},
		postDeleteArea: function (entityElement) {
			var entityId 	= $(entityElement).data('entity-id');
			var url 		= '/areas/' +  entityId;

			postDelete(entityElement, entityId, url);
		},
		postDeleteCategory: function (entityElement) {
			var entityId 	= $(entityElement).data('entity-id');
			var url 		= '/categories/' +  entityId;

			postDelete(entityElement, entityId, url);
		},
		postDeleteProtocol: function (entityElement) {
			var entityId 	= $(entityElement).data('entity-id');
			var url 		= '/protocols/' +  entityId;

			postDelete(entityElement, entityId, url);
		},
		postDeleteUser: function (entityElement) {
			var entityId 	= $(entityElement).data('entity-id');
			var url 		= '/users/' +  entityId;

			postDelete(entityElement, entityId, url);
		}

	};
}();