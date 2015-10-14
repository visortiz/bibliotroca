$(function() {

    var books = $('.bookshelf li *');

    var sol_1 = sol_1 || $('#sol_1');
    var sol_2 = sol_2 || $('#sol_2');
    var sol_imgs = sol_imgs || $('#sol_0 img, #cover_book_preview, #sol_act_1 img');

    var ender_anunciante = ender_anunciante || $('#conf_end_1 .anunciante');
    var ender_titulo = ender_titulo || $('#conf_end_1 .titulo');
    var ender_autor = ender_autor || $('#conf_end_1 .autor');

    var idl = idl || $('#idl');
    var iduo = iduo || $('#iduo');

    var num_creditos = num_creditos || $('#num_creditos');
    var cep = cep || $('#cep');
    var endereco = endereco || $('#endereco');
    var numero = numero || $('#numero');
    var cidade = cidade || $('#cidade');
    var estado = estado || $('#estado');

    var credito_info = credito_info || $('#solicita_final .credito_info')

    /////////////////////////////////////

    books.click(function(){
		var id = $(this).parent().attr('id');
		$.ajax({
		    assyn: false,
            type: 'POST',
            url: 'busca/abrir',
            dataType: 'json',
            data: 'id=' + id,
            success: function(data){
                data = data[0];

                var ranking = rank(data.trocas_realizadas, data.reputacoes_pos, data.reputacoes_neg);
                var votos = ranking[0];
                var reputacao = ranking[1];

                $(sol_imgs).attr('src', 'assets/imgs/book_covers/' + data.foto);
            	$(sol_1).html('<li>Título:<p>'+data.titulo+'</p></li><li>Autor:<p>'+data.autor+'</p></li><li>Editora:<p>'+data.editora+'</p></li><li>Ano de Publicação:<p>'+data.ano_pub+'</p></li><li>Descrição:<p>'+data.descricao+'</p></li>');
            	$(sol_2).html('<li>Anunciante: <p>'+data.nome+'</p></li><li>Localidade:<p>'+data.cidade+'</p></li><li>Trocas Efetuadas:<p>'+data.trocas_realizadas+'</p></li><li>Reputação:<p>'+reputacao+'% ('+votos+' votos)</p></li>');

                $(ender_anunciante).html(data.nome);
                $(ender_titulo).html(data.titulo);
                $(ender_autor).html(data.autor);

            	$(idl).val(data.id_livro);
            	$(iduo).val(data.id_usuario);

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

            	$(num_creditos).text(data.creditos);
            	$(cep).val(data.cep);
            	$(endereco).val(data.endereco);
            	$(numero).val(data.numero);
            	$(cidade).val(data.cidade);
            	$(estado).val(data.estado);

            	var creditos_atualizados = parseInt(data.creditos) - 1;
            	    creditos_atualizados = (creditos_atualizados == 0) ? 'Você não possui mais créditos.' : 'Você ainda possui ' + creditos_atualizados + ' crédito(s) para continuar realizando trocas.';

                $(credito_info).text(creditos_atualizados);

            	$('#confirma_ender').modal({fadeDuration: 300});
            },
            error: function(message) {
            	//Catch Error
            }
        });
	});

	$('#finaliza_sol').click(function(){
		var id_l = $(idl).val();
		var id_uo = $(iduo).val();
		var idus = $('#idus').val();
		var end = $('#form_endereco').serialize();
		var data = 'idl=' + id_l + '&iduo=' + id_uo + '&idus=' + idus + '&' + end;
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

})
