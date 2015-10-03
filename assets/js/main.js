$(function(){

	// BUSCA
	$("#search_icon").click(function(){
		$(this).parent().submit();
	});

	//SLIDESHOW (PAGINA INICIAL)
	if($('.slideshow').length) {
		$('.slideshow').cycle({
			fx: 'carousel',
			speed: 1000,
			timeout: 1000,
			width: 1000
		});
	}

	//CADASTRO
	$("#enviar_cadastro").click(function(){
		$("#form_cadastro").submit();
	});

	//FORMULARIO DE CADASTRO DE LIVROS (PAGINA ESTANTE/DESEJOS)
	$("#cadastro_livros").submit(function(){
         //dataString = $("#cadastro_livros").serialize();
         dataString = new FormData(this);
         var form = $(this);
         var view = $("#data-view").val();
         view = (view == 1) ? "estante/inserir" : "desejos/inserir";
         $.ajax({
           type: "POST",
           url: view,
           contentType: false,
           processData: false,
           data: dataString,
           success: function(message){
            	$("#livros_cadastro #message").fadeIn();
				var img = $(form).find("img");
				clearBookForm(form,img);
           }
         });
        return false;
      });

	$('#add_book').click(function(){
		if ($("#message")) $("#message").hide();
		$(this).hide();
		$("#cadastro_livros").fadeIn();
	});

	$("#btnCancelAddBook").click(function(){
		var form = $(this).parent().parent();
		var img = $(form).find("img");
		clearBookForm(form, img);
	});

	$("#cover_book").change(function(){
		previewImg(this, $("#cover_book_preview"));
	});

	//Abertura de Modal => 1: Estante/Desejos; 2: Solicitação Recebida/Busca; 3: Solicitação Enviada
	$(".bookshelf li *").click(function(){
		var type = parseInt($(this).parent().attr("data-type"));
		var id = $(this).parent().attr("id");
		switch(type) {
			case 1:
				var view = $(this).parent().attr("data-view");
				view = (view == 1) ? "estante/abrir" : "desejos/abrir";
				$.ajax({
					assyn: false,
		           	type: "POST",
		           	url: view,
		           	dataType: "json",
		           	data: "id=" + id,
		           	success: function(data){
		           		data = data[0];
		            	dados = {'id': data.id_livro, 'titulo': data.titulo, 'autor': data.autor, 'editora': data.editora, 'ano_pub': data.ano_pub, 'descricao': data.descricao, 'foto': 'assets/imgs/book_covers/' + data.foto};
		            	populate("#edit_book", dados);
						$("#book_modal").modal({fadeDuration: 300});
		            }
		        });
				break;
			case 2:
				var view = $(this).parent().attr("data-view");
				view = (view == 1) ? "busca/abrir" : "solicitacoes/abrir_recebida";
				$.ajax({
					assyn: false,
		           	type: "POST",
		           	url: view,
		           	dataType: "json",
		           	data: "id=" + id,
		           	success: function(data){
		           		data = data[0];
		           		if (data.trocas_realizadas == 0 || data.reputacoes_pos + data.reputacoes_neg == 0) {
		           			var votos = 0;
		           			var reputacao = 0;
		           		} else {
		           			var votos = parseInt(data.reputacoes_pos) + parseInt(data.reputacoes_neg);
		           			var reputacao = parseInt((parseInt(data.reputacoes_pos) / (votos) * 100));
		           		}
		           		var ator = (view == 1) ? "Anunciante:" : "Solicitante:";
		            	var sol_1 = "<li>Título:<p>"+data.titulo+"</p></li><li>Autor:<p>"+data.autor+"</p></li><li>Editora:<p>"+data.editora+"</p></li><li>Ano de Publicação:<p>"+data.ano_pub+"</p></li><li>Descrição:<p>"+data.descricao+"</p></li>";
		            	var sol_2 = "<li>"+ator+"<p>"+data.nome+"</p></li><li>Localidade:<p>"+data.cidade+"</p></li><li>Trocas Efetuadas:<p>"+data.trocas_realizadas+"</p></li><li>Reputação:<p>"+reputacao+"% ("+votos+" votos)</p></li>";
		            	$("#sol_0 img, #cover_book_preview, #sol_act_1 img").attr("src", "assets/imgs/book_covers/" + data.foto);
		            	if (view == "solicitacoes/abrir_recebida") {
		            		var sol_act_0 = "<li>Nome:<p>"+data.nome+"</p></li><li>CEP:<p>"+data.cep+"</p></li><li>Endereço:<p>"+data.endereco+", "+data.numero+"</p></li><li>Cidade:<p>"+data.cidade+" - "+data.estado+"</p></li>";
					    	var sol_act_2 = "<li>Título:<p>"+data.titulo+"</p></li><li>Autor:<p>"+data.autor+"</p></li>";
					    	$("#sol_act_0").html(sol_act_0);
					    	$("#sol_act_2").html(sol_act_2);
					    	$("#sol_act_1 img").attr("src", "assets/imgs/book_covers/" + data.foto);
		            	}
		            	$("#sol_1").html(sol_1);
		            	$("#sol_2").html(sol_2);
		            	$("#conf_end_1 .anunciante").html(data.nome);
		            	$("#conf_end_1 .titulo").html(data.titulo);
		            	$("#conf_end_1 .autor").html(data.autor);
		            	$("#idl").val(data.id_livro);
		            	$("#iduo").val(data.id_usuario);
						$("#solicita").modal({fadeDuration: 300});
		            }
		        });
				break;
			case 3:
				var view = $(this).parent().attr("data-view");
				$.ajax({
					assyn: false,
		           	type: "POST",
		           	url: "solicitacoes/abrir_enviada",
		           	dataType: "json",
		           	data: "id=" + id,
		           	success: function(data){
		           		data = data[0];
		           		if (data.trocas_realizadas == 0 || data.reputacoes_pos + data.reputacoes_neg == 0) {
		           			var votos = 0;
		           			var reputacao = 0;
		           		} else {
		           			var votos = parseInt(data.reputacoes_pos) + parseInt(data.reputacoes_neg);
		           			var reputacao = parseInt((parseInt(data.reputacoes_pos) / (votos) * 100));
		           		}
		            	var sol_1 = "<li>Título:<p>"+data.titulo+"</p></li><li>Autor:<p>"+data.autor+"</p></li><li>Editora:<p>"+data.editora+"</p></li><li>Ano de Publicação:<p>"+data.ano_pub+"</p></li><li>Descrição:<p>"+data.descricao+"</p></li>";
		            	var sol_2 = "<li>Dono deste livro:<p>"+data.nome+"</p></li><li>Localidade:<p>"+data.cidade+"</p></li><li>Trocas Efetuadas:<p>"+data.trocas_realizadas+"</p></li><li>Reputação:<p>"+reputacao+"% ("+votos+" votos)</p></li>";
		            	$("#sol_env_0 img, #cover_book_preview").attr("src", "assets/imgs/book_covers/" + data.foto);
		            	$("#sol_env_1").html(sol_1);
		            	$("#sol_env_2").html(sol_2);
		            	//$("#idl").val(data.id_livro);
		            	//$("#iduo").val(data.id_usuario);

						$("#solicitacao_enviada").modal({fadeDuration: 300});
		            }
		        });
				break;
		}
	});

	//Botão Editar Livro para destravar campos da modal para edição
	$("#btnEditBook").click(function(){
		$("#edit_book input, #edit_book textarea").removeAttr("disabled");
		$("#edit_cover_book").css("visibility","visible");
		$(this).hide().parent().prev().show();
	});

	$("#edit_cover_book_2").change(function(){
		previewImg(this, $('#edit_cover_book_preview'));
	});

	// Salvar edição de livro em modal
	$("#btnSaveEditedBook").click(function(){
		dataString = $("#edit_book").serialize();
		var view = $("#data-view").val();
        view = (view == 1) ? "estante/editar" : "desejos/editar";
        $.ajax({
            type: "POST",
            url: view,
            data: dataString,
            success: function(message){
            	$("#edit_book input, #edit_book textarea").attr("disabled","disabled");
				$("#edit_cover_book").css("visibility","hidden");
				$("#edit_cover_book_2").hide();
				$("#btnEditBook").show().parent().prev().hide();
            }
        });
        return false;
	});

	$("#btnCancelEditBook").click(function(){
		var form = $(this).parent().parent();
		var img = $(form).find("img");
		clearBookForm(form, img, true);
	});

	//Limpa formulário de edição de livros
	function clearBookForm(form, img, modal) {
		if(modal) {
			form[0].reset();
			populate(form, dados);
			
			var base_url = window.location.origin;
			console.log(dados);

			img.attr("src","assets/imgs/book_covers/book_cover.jpg");
			$(form).find("input, textarea").attr("disabled","disabled");
			$("#edit_cover_book").css("visibility","hidden");
			$("#btnEditBook").show().parent().prev().hide();
		} else {
			form.hide();
			form[0].reset();
			img.attr("src","./assets/imgs/book_covers/book_cover.jpg");
			$("#add_book").fadeIn();
		}
	}

	//Função para exibir imagem ao selecionar arquivo (input arquivo, el img preview)
	function previewImg(input, el) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $(el).attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	//função para popular formulario(frm) com dados Json(data)
	function populate(frm, data) {
		$.each(data, function(key, value){
	    	$('[name='+key+']', frm).val(value);
		});
		$("#edit_cover_book_preview").attr("src",data.foto)
	}

	$("#aceitar_sol").click(function(){
		//FUNÇÃO DE ACEITA SOLICITAÇÃO
		$("#solicitacao_aceita").modal({fadeDuration: 300});
	});

	$("#recusar_sol").click(function(){
		//FUNÇÃO DE RECUSA SOLICITAÇÃO
		$.modal.close();
	});

	$(".fechar_modal").click(function(){
		$.modal.close();
	});

	$("#solicita_livro").click(function(){
		var idus = $("#idus").val();
		$.ajax({
			assyn: false,
           	type: "POST",
           	url: 'busca/busca_endereco',
           	dataType: "json",
           	data: "id=" + idus,
           	success: function(data){
           		data = data[0];
           		$("#num_creditos").text(data.creditos);
           		$("#cep").val(data.cep);
           		$("#endereco").val(data.endereco);
           		$("#numero").val(data.numero);
           		$("#cidade").val(data.cidade);
           		$("#estado").val(data.estado);

           		var creditos_atualizados = parseInt(data.creditos) - 1;
           		creditos_atualizados = (creditos_atualizados == 0) ? "Você não possui mais créditos." : "Você ainda possui " + creditos_atualizados + " crédito(s) para continuar realizando trocas.";
           		$("#solicita_final .credito_info").text(creditos_atualizados);

           		$("#confirma_ender").modal({fadeDuration: 300});
            }
        });
	});

	$("#finaliza_sol").click(function(){
		var idl = $("#idl").val();
		var iduo = $("#iduo").val();
		var idus = $("#idus").val();
		var end = $("#form_endereco").serialize();
		var data = "idl=" + idl + "&iduo=" + iduo + "&idus=" + idus + "&" + end;
		$.ajax({
			assyn: false,
           	type: "POST",
           	url: 'busca/solicita',
           	dataType: "json",
           	data: data,
           	success: function(data){
           		data = data[0];           		
           		$("#solicita_final").modal({fadeDuration: 300});	
            }, error: function(err) { console.log(err);}
        });
	})

});