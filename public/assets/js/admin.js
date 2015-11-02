function deleteModel(button_id, form_id)
{
   form_id = form_id || 'form-delete';

   console.log('button ' + button_id + ' -> form_id' + form_id);
   
   var button = $('#'+button_id);
   var id = button.data('id');
   button.parents('tr').fadeOut(1000);
   var form = $('#' + form_id);
   var action = form.attr('action').replace('ID', id);
   var row =  button.parents('tr');
   
   row.fadeOut(1000);
   
   $.post(action, form.serialize(), function(result) {
      console.log('hecho');
      if (result.success) 
      {
         console.log('borró correctamente');
         setTimeout (function () {
            row.delay(1000).remove();
            var result_html = '<div class="col-md-12"> <div class="alert alert-info alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+result.msg+'</div></div>';
            $('#title_page').append(result_html);
         }, 1000);                
      } else 
      {
         row.show();
         var result_html = '<div class="col-md-12"> <div class="alert alert-danger alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> El registro no pudo ser eliminado. '+result.msg+'</div> </div>';
         $('#title_page').append(result_html);
      }
   }, 'json');
}

function deleteAnswer(button_id) 
{
   console.log('está borrando');
   var button = $('#'+button_id);
   var id = button.data('id');
   button.parents('tr').fadeOut(1000);
   var form = $('#form-delete');
   var action = form.attr('action').replace('ID', id);
   var row =  button.parents('.form-group');
   
   row.fadeOut(1000);
   
   $.post(action, form.serialize(), function(result) {
      console.log('hecho');
      if (result.success) 
      {
         console.log('borró correctamente');
         setTimeout (function () {
            row.delay(1000).remove();
            var result_html = '<div class="col-md-12"> <div class="alert alert-info alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+result.msg+'</div></div>';
            $('#title_page').append(result_html);
         }, 1000);                
      } else 
      {
         row.show();
         var result_html = '<div class="col-md-12"> <div class="alert alert-danger alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> El registro no pudo ser eliminado. '+result.msg+'</div> </div>';
         $('#title_page').append(result_html);
      }
   }, 'json');
}

function deleteQuestion(button_id) 
{
   console.log('está borrando');
   var button = $('#'+button_id);
   var id = button.data('id');
   button.parents('tr').fadeOut(1000);
   var form = $('#form-delete');
   var action = form.attr('action').replace('ID', id);
   var row =  button.parents('.widget-question');
   
   row.fadeOut(1000);
   
   $.post(action, form.serialize(), function(result) {
      if (result.success) 
      {
         console.log('borró correctamente');
         setTimeout (function () {
            row.delay(1000).remove();
            var result_html = '<div class="col-md-12"> <div class="alert alert-info alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+result.msg+'</div></div>';
            $('#show-poll').append(result_html);
         }, 1000);                
      } else 
      {
         row.show();
         var result_html = '<div class="col-md-12"> <div class="alert alert-danger alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> El registro no pudo ser eliminado. '+result.msg+'</div> </div>';
         $('#show-poll').append(result_html);
      }
   }, 'json');
}