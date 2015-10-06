$(function() {

    $('.bookshelf li *').click(function(){
		var id = $(this).parent().attr('id');
		$.ajax({
		    assyn: false,
            type: 'POST',
            url: 'busca/abrir',
            dataType: 'json',
            data: 'id=' + id,
            success: function(data){
                data = data[0];
                if (data.trocas_realizadas == 0 || data.reputacoes_pos + data.reputacoes_neg == 0) {
                    var votos = 0;
                    var reputacao = 0;
                } else {
                    var votos = parseInt(data.reputacoes_pos) + parseInt(data.reputacoes_neg);
                    var reputacao = parseInt((parseInt(data.reputacoes_pos) / (votos) * 100));
                }
                var ator = (view == 1) ? 'Anunciante:' : 'Solicitante:';
            	var sol_1 = '<li>Título:<p>'+data.titulo+'</p></li><li>Autor:<p>'+data.autor+'</p></li><li>Editora:<p>'+data.editora+'</p></li><li>Ano de Publicação:<p>'+data.ano_pub+'</p></li><li>Descrição:<p>'+data.descricao+'</p></li>';
            	var sol_2 = '<li>'+ator+'<p>'+data.nome+'</p></li><li>Localidade:<p>'+data.cidade+'</p></li><li>Trocas Efetuadas:<p>'+data.trocas_realizadas+'</p></li><li>Reputação:<p>'+reputacao+'% ('+votos+' votos)</p></li>';
            	$('#sol_0 img, #cover_book_preview, #sol_act_1 img').attr('src', 'assets/imgs/book_covers/' + data.foto);
            	if (view == 'solicitacoes/abrir_recebida') {
            		var sol_act_0 = '<li>Nome:<p>'+data.nome+'</p></li><li>CEP:<p>'+data.cep+'</p></li><li>Endereço:<p>'+data.endereco+', '+data.numero+'</p></li><li>Cidade:<p>'+data.cidade+' - '+data.estado+'</p></li>';
			    	var sol_act_2 = '<li>Título:<p>'+data.titulo+'</p></li><li>Autor:<p>'+data.autor+'</p></li>';
			    	$('#sol_act_0').html(sol_act_0);
			    	$('#sol_act_2').html(sol_act_2);
			    	$('#sol_act_1 img').attr('src', 'assets/imgs/book_covers/' + data.foto);
            	}
            	$('#sol_1').html(sol_1);
            	$('#sol_2').html(sol_2);
            	$('#conf_end_1 .anunciante').html(data.nome);
            	$('#conf_end_1 .titulo').html(data.titulo);
            	$('#conf_end_1 .autor').html(data.autor);
            	$('#idl').val(data.id_livro);
            	$('#iduo').val(data.id_usuario);
				$('#solicita').modal({fadeDuration: 300});
            }
        });
    });

    $('#solicita_livro').click(function(){
		var idus = $('#idus').val();
		$.ajax({
		    assyn: false,
            type: 'POST',
            url: 'busca/busca_endereco',
            dataType: 'json',
            data: 'id=' + idus,
            success: function(data){
            	data = data[0];
            	$('#num_creditos').text(data.creditos);
            	$('#cep').val(data.cep);
            	$('#endereco').val(data.endereco);
            	$('#numero').val(data.numero);
            	$('#cidade').val(data.cidade);
            	$('#estado').val(data.estado);

            	var creditos_atualizados = parseInt(data.creditos) - 1;
            	creditos_atualizados = (creditos_atualizados == 0) ? 'Você não possui mais créditos.' : 'Você ainda possui ' + creditos_atualizados + ' crédito(s) para continuar realizando trocas.';
            	$('#solicita_final .credito_info').text(creditos_atualizados);

            	$('#confirma_ender').modal({fadeDuration: 300});
            },
            error: function(message) {
            	//Catch Error
            }
        });
	});

	$('#finaliza_sol').click(function(){
		var idl = $('#idl').val();
		var iduo = $('#iduo').val();
		var idus = $('#idus').val();
		var end = $('#form_endereco').serialize();
		var data = 'idl=' + idl + '&iduo=' + iduo + '&idus=' + idus + '&' + end;
		$.ajax({
		    assyn: false,
            type: 'POST',
            url: 'busca/solicita',
            dataType: 'json',
            data: data,
            success: function(data){
                data = data[0];
                $('#solicita_final').modal({fadeDuration: 300});
            },
            error: function(message) {
            	//Catch Error
            }
        });
	});

    $('.fechar_modal').click(function(){
		$.modal.close();
	});

})
