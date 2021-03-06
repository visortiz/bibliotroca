$(function(){

    var books = $('.bookshelf li *');

    var imgs_modais =  imgs_modais || $('#sol_0 img, #sol_act_1 img');
    var v_sol_act_0 = v_sol_act_0 || $('#sol_act_0');
    var v_sol_act_2 = v_sol_act_2 || $('#sol_act_2');
    var v_sol_1 = v_sol_1 || $('#sol_1');
    var v_sol_2 = v_sol_2 || $('#sol_2');

    var v_sol_env_1 = v_sol_env_1 || $('#sol_env_1');
    var v_sol_env_2 = v_sol_env_2 || $('#sol_env_2');
    var v_sol_env_img = v_sol_env_img || $('#sol_env_0 img');

    //////////////////////////////////////

    //1: Solicitação Recebida; 2: Solicitação Enviada
    books.click(function(){
		var type = parseInt($(this).parent().attr('data-type'));
		var id = $(this).parent().attr('id');

        if(type == 1) {
			$.ajax({
			    assyn: false,
		        type: 'POST',
		        url: 'solicitacoes/abrir_recebida',
		        dataType: 'json',
		        data: 'id=' + id,
		        success: function(data){
		            data = data[0];

                    var ranking = rank(data.trocas_realizadas, data.reputacoes_pos, data.reputacoes_neg);
                    var votos = ranking[0];
                    var reputacao = ranking[1];

                    $('#sol_rec').val(data.id_solicitacao);
                    imgs_modais.attr('src', 'assets/imgs/book_covers/' + data.foto);
                    $(v_sol_act_0).html('<li>Nome:<p>'+data.nome+'</p></li><li>CEP:<p>'+data.cep+'</p></li><li>Endereço:<p>'+data.endereco+', '+data.numero+'</p></li><li>Cidade:<p>'+data.cidade+' - '+data.estado+'</p></li>');
                    $(v_sol_act_2).html('<li>Título:<p>'+data.titulo+'</p></li><li>Autor:<p>'+data.autor+'</p></li>');
		        	$(v_sol_1).html('<li>Título:<p>'+data.titulo+'</p></li><li>Autor:<p>'+data.autor+'</p></li><li>Editora:<p>'+data.editora+'</p></li><li>Ano de Publicação:<p>'+data.ano_pub+'</p></li><li>Descrição:<p>'+data.descricao+'</p></li>');
		        	$(v_sol_2).html('<li>Solicitante:<p>'+data.nome+'</p></li><li>Localidade:<p>'+data.cidade+'</p></li><li>Trocas Efetuadas:<p>'+data.trocas_realizadas+'</p></li><li>Reputação:<p>'+reputacao+'% ('+votos+' votos)</p></li>');

					$('#solicita').modal({fadeDuration: 300});
		        },
                error: function(message) {
                	//Catch Error
                }
		    });
        }

		if(type == 2) {
			$.ajax({
				assyn: false,
		        type: 'POST',
		        url: 'solicitacoes/abrir_enviada',
		        dataType: 'json',
		        data: 'id=' + id,
		        success: function(data){
                    data = data[0];

                    var ranking = rank(data.trocas_realizadas, data.reputacoes_pos, data.reputacoes_neg);
                    var votos = ranking[0];
                    var reputacao = ranking[1];

                    $('#sol_env').val(data.id_solicitacao);
                    $(v_sol_env_img).attr('src', 'assets/imgs/book_covers/' + data.foto);
		            $(v_sol_env_1).html('<li>Título:<p>'+data.titulo+'</p></li><li>Autor:<p>'+data.autor+'</p></li><li>Editora:<p>'+data.editora+'</p></li><li>Ano de Publicação:<p>'+data.ano_pub+'</p></li><li>Descrição:<p>'+data.descricao+'</p></li>');
		            $(v_sol_env_2).html('<li>Dono deste livro:<p>'+data.nome+'</p></li><li>Localidade:<p>'+data.cidade+'</p></li><li>Trocas Efetuadas:<p>'+data.trocas_realizadas+'</p></li><li>Reputação:<p>'+reputacao+'% ('+votos+' votos)</p></li>');

					$('#solicitacao_enviada').modal({fadeDuration: 300});
		        },
                error: function(message) {
                	//Catch Error
                }
		    });
		}
	});

    //TODO Refector deste bloco
    $('#aceitar_sol').click(function(){
        $.ajax({
            assyn: false,
            type: 'POST',
            url: 'solicitacoes/aceitar_solicitacao',
            dataType: 'json',
            data: 'ids=' + $("#sol_rec").val(),
            success: function(data){
                $('#solicitacao_aceita').modal({fadeDuration: 300});
            },
            error: function(message) {
                //Catch Error
            }
        });
	});

    //TODO Refector deste bloco
	$('#recusar_sol').click(function(){
        $.ajax({
            assyn: false,
            type: 'POST',
            url: 'solicitacoes/recusar_solicitacao',
            dataType: 'json',
            data: 'ids=' + $("#sol_rec").val(),
            success: function(data){
                $.modal.close();
            },
            error: function(message) {
                //Catch Error
            }
        });
	});

    //TODO Refector deste bloco
    $('.cancela_sol').click(function(){
        $.ajax({
            assyn: false,
            type: 'POST',
            url: 'solicitacoes/cancela_solicitacao',
            dataType: 'json',
            data: 'ids=' + $("#sol_env").val(),
            success: function(data){
                $.modal.close();
            },
            error: function(message) {
                //Catch Error
            }
        });
	});

    //AÇÃO PARA FECHAR MODAIS USANDO CLASSE '.fechar_modal'
	$('.fechar_modal').click(function(){
		$.modal.close();
	});

    function rank(trocas_realizadas, reputacoes_pos, reputacoes_neg) {
        var votos, reputacao;
        if (trocas_realizadas == 0 || reputacoes_pos + reputacoes_neg == 0) {
            votos, reputacao = 0;
        } else {
            votos = parseInt(reputacoes_pos) + parseInt(reputacoes_neg);
            reputacao = parseInt((parseInt(reputacoes_pos) / (votos) * 100));
        }
        return [votos, reputacao];
    }

});
