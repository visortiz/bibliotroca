$(function() {

	var btn_add_book = $('#add_book');
	var message = $('#message');

	var form_add_book = $('#cadastro_livros');
	var btn_form_add_book_cover = $('#cover_book');
	var img_form_add_book_cover = $('#cover_book_preview');
	var btn_cancel_add_book = $('#btnCancelAddBook');

	var books = $('.bookshelf li *');

	var edit_book_modal = $('#book_modal');
	var form_edit_book = $('#edit_book');
	var form_edit_book_fields = $('#edit_book input, #edit_book textarea');
	var btn_form_edit_book_cover = $('#edit_cover_book');
	var btn_form_edit_book_cover_hidden = $('#edit_cover_book_2');
	var img_form_edit_book_cover = $('#edit_cover_book_preview');
	var btn_edit_book = $('#btnEditBook');
	var btn_cancel_edit_book = $('#btnCancelEditBook');

	////////////////////////////////////////////////

	//FORMULARIO ADICIONAR NOVO LIVRO
	btn_add_book.click(function(){
		if (message)
			message.hide();

		btn_add_book.hide();
		form_add_book.fadeIn();
	});

	form_add_book.submit(function(){
		var view = view || $('#data-view').val();
        var url = url || (view == 1) ? 'estante/inserir' : 'desejos/inserir';
        var dataString = new FormData(this);
        $.ajax({
            type: 'POST',
            url: url,
            contentType: false,
            processData: false,
            data: dataString,
            success: function(message){
                $(message).fadeIn();
				var img = form_add_book.find('img');
				form_add_book.hide();
				form_add_book[0].reset();
				img.attr('src','./assets/imgs/book_covers/book_cover.jpg');
				btn_add_book.fadeIn();
            },
            error: function(message){
				//Catch error
            }
        });
        return false;
    });

	btn_cancel_add_book.click(function(){
		var form = $(this).parent().parent();
		var img = form.find('img');
		form.hide();
		form[0].reset();
		img.attr('src','./assets/imgs/book_covers/book_cover.jpg');
		btn_add_book.fadeIn();
	});

	btn_form_add_book_cover.change(function(){
		previewImg(this, img_form_add_book_cover);
	});

	//MODAL LIVRO
	books.click(function(){
		var id = $(this).parent().attr('id');
		var view =  view || $(this).parent().attr('data-view');
		var url = url || (view == 1) ? 'estante/abrir' : 'desejos/abrir';
		$.ajax({
		    assyn: false,
            type: 'POST',
            url: url,
            dataType: 'json',
            data: 'id=' + id,
            success: function(data){
            	data = data[0];
            	_dados = {'id': data.id_livro, 'titulo': data.titulo, 'autor': data.autor, 'editora': data.editora, 'ano_pub': data.ano_pub, 'descricao': data.descricao, 'foto': 'assets/imgs/book_covers/' + data.foto};
            	populate(form_edit_book, _dados);
				edit_book_modal.modal({fadeDuration: 300});
            },
            error: function(message) {
            	//Catch Error
            }
        });
	});

	//MODAL LIVRO - EDITAR
	btn_edit_book.click(function(){
		form_edit_book_fields.removeAttr('disabled');
		btn_form_edit_book_cover.css('visibility','visible');
		$(this).hide().parent().prev().show();
	});

	btn_form_edit_book_cover_hidden.change(function(){
		previewImg(this, img_form_edit_book_cover);
	});

	form_edit_book.submit(function(){
		var view = view || $('#data-view').val();
        var url = url || (view == 1) ? 'estante/editar' : 'desejos/editar';
		var dataString = new FormData(this);
        $.ajax({
            type: 'POST',
            url: url,
            contentType: false,
            processData: false,
            data: dataString,
            success: function(message){
            	console.log(message);
            	form_edit_book_fields.attr('disabled','disabled');
				btn_form_edit_book_cover.css('visibility','hidden');
				btn_form_edit_book_cover_hidden.hide();
				$(btnEditBook).show().parent().prev().hide();
            },
            error: function(message) {
            	//Catch Error
            }
        });
        return false;
	});

	btn_cancel_edit_book.click(function(){
		var form = $(this).parent().parent();
		var img = form.find('img');

		form[0].reset();
		populate(form, _dados);
		img.attr('src',_dados.foto);

		form_edit_book_fields.attr('disabled','disabled');
		btn_form_edit_book_cover.css('visibility','hidden');
		$(btnEditBook).show().parent().prev().hide();
	});

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
		img_form_edit_book_cover.attr('src',data.foto)
	}

})
