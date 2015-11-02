$('#modal-voter').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var voter = button.data('voter'); // Extract info from data-* attributes

    var modal = $(this);
    modal.find('.modal-title').text(voter.doc + ', ' + voter.name);
    modal.find('#modal-place-address').text(voter.address + ', ' + voter.location.name);
    modal.find('#modal-telephone').text(voter.telephone);
    modal.find('#modal-email').text(voter.email);
    modal.find('#modal-birhtday').text(voter.date_of_birth);
    modal.find('#modal-description').text(voter.description);
    modal.find('#modal-refers').text(voter.voters.length);
    modal.find('#modal-diaries').text('Organizadas: ' + voter.organized_diaries.length + ', Delegado: ' + voter.delegated_diaries.length + ', Asistencias: ' + voter.diaries.length);
    
    var sum_diaries = voter.delegated_diaries.length + voter.organized_diaries.length + voter.diaries.length;

    if( sum_diaries > 0 )
    {
        $("#modal-diaries").attr("href", "/database/voters/diaries/"+voter.doc);  
    }

    if(voter.occupations)
    {
        modal.find('#modal-occupation').text(voter.occupations.name);
    }

    if(voter.superior_voter)
    {
        modal.find('#modal-superior').text(voter.superior_voter.name + ', cel: ' + voter.superior_voter.telephone);
    }

    if(voter.polling_station)
    {
        modal.find('#modal-polling-station').text(voter.polling_station.description + ' - Mesa: ' + voter.table_number);
    }

    console.log(voter);

    if(voter.polling_station_day)
    {
        modal.find('#modal-polling-station-day-d').text(voter.polling_station_day.description);
    }

    
    var communities = [];
    $.each( voter.communities, function( key, community ) {
        communities.push(community.name);
    });
     
    modal.find('#modal-communities').text(communities.join(', '));

    var roles = [];
    $.each( voter.roles, function( key, community ) {
        roles.push(community.name);
    });

    if(voter.colaborator == 1 && voter.delegate == 1)
    {
        modal.find('#modal-roles').text('Delegado, ' + roles.join(', '));
    }
    else if(voter.colaborator == 1)
    {
        modal.find('#modal-roles').text(roles.join(', '));
    }
    else
    {
        modal.find('#modal-roles').text('Votante');
    }

    var diary_id = $('#diary').data('diary');

    if(diary_id)
    {
        $("#modal-edit").attr("href", "/database/voters/"+voter.doc+"/"+diary_id);
        $("#modal-in").attr("href", "/database/voters/"+voter.id+"/add-to-team/"+diary_id);
        $("#modal-out").attr("href", "/database/team/"+voter.doc+"/remove/"+diary_id);
    }
    else
    {
        $("#modal-edit").attr("href", "/database/voters/"+voter.doc);
        $("#modal-in").attr("href", "/database/voters/"+voter.id+"/add-to-team");
        $("#modal-out").attr("href", "/database/team/"+voter.doc+"/remove");
    }

    if(voter.colaborator == 1)
    {
        $("#modal-in").addClass('disabled');
        $("#modal-out").removeClass('disabled');
    }
    else
    {
        $("#modal-out").addClass('disabled');
        $("#modal-in").removeClass('disabled');
    }

    var buttonDelete = $('#modal-delete');
    if(buttonDelete.length)
    {
        buttonDelete.bind("click", function() {
            deleteModel('voter-' + voter.id);
        });
    }

    var buttonDiaryRemove = $('#modal-diary-remove');
    if(buttonDiaryRemove.length)
    {
        buttonDiaryRemove.bind("click", function() {
            deleteModel('voter-' + voter.id, 'form-diary-remove');
        });
    }

});