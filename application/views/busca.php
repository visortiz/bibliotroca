<div id="body" class="busca_container">
	<div id="body_inner">

		<div id="resultado_busca">
			<h1>Resultado da busca por "<?php echo $busca ?>"</h1>

			<ul class="bookshelf">
				<?php

					foreach($books as $book) {
				        echo "<li id=\"".$book->id_livro."\" data-type='2' data-view='1'>"
									 .img(array('src'=>'assets/imgs/book_covers/' . $book->foto));
									 if(isset($id)) {
									 	echo "<p class='booktag'>SOLICITAR</p>";
									 }
								     echo "<p class='booktitle'>Título:</p>"
								     ."<p>".$book->titulo."</p><br/>"
								     ."<p class='bookauthor'>Autor:</p>"
								     ."<p>".$book->autor."</p>"
							."</li>";
					}
				?>
			</ul>
		</div>

	</div>

	<? if (isset($id)): ?>

	<div id="solicita" style="display:none;">
    	<div id="sol_0">
    		<?php echo img(array('src'=>'assets/imgs/book_covers/book_cover.jpg')) ?>
    	</div>
		<ul id="sol_1">
			<li>Título:<p>Livro X</p></li>
			<li>Autor:<p>Autor X</p></li>
			<li>Editora:<p>Editora X</p></li>
			<li>Ano de Publicação:<p>01/01/2001</p></li>
			<li>Descrição:<p>descricao descricao descricao</p></li>
		</ul>
		<ul id="sol_2">
			<li>Anunciante:<p>Anunciante X X</p></li>
			<li>Localidade:<p>Cidade X</p></li>
			<li>Trocas Efetuadas:<p>7</p></li>
			<li>Reputação:<p>100% (6 votos)</p></li>
		</ul>
		<div class="modal_concluir">
			<input type="hidden" id="idl" value="" />
			<input type="hidden" id="iduo" value="" />
			<input type="hidden" id="idus" value="<?php echo $id ?>" />
			<button id="solicita_livro">Solicitar Livro</button>
			<button class="fechar_modal">Fechar</button>
		</div>
  	</div>

  	<div id="confirma_ender" style="display:none;">
  		<h1>Confirme seu endereço:</h1>
  		<div id="conf_end_0">
  			<p>Você possui <span id="num_creditos"></span> créditos</p>
  			<form id="form_endereco">
  				<fieldset>
					<label>CEP:</label>
					<input type="text" class="textField" label="cep" id="cep" name="cep" style="width: 130px;" />
				</fieldset>

				<fieldset style="float: left;">
					<label>Endereço:</label>
					<input type="text" class="textField" label="endereco" id="endereco" name="endereco" style="width: 240px;" />
				</fieldset>

				<fieldset>
					<label>Número:</label>
					<input type="text" class="textField" label="numero" id="numero" name="numero" style="width: 65px;" />
				</fieldset>

				<fieldset style="float: left;">
					<label>Cidade:</label>
					<input type="text" class="textField" label="cidade" id="cidade" name="cidade" style="width: 240px;" />
				</fieldset>

				<fieldset>
					<label>Estado:</label>
					<input type="text" class="textField" label="estado" id="estado" name="estado" style="width: 65px;" />
				</fieldset>
  			</form>
  		</div>

  		<div id="conf_end_1">
  			<?php echo img(array('src'=>'assets/imgs/book_covers/book_cover.jpg','id'=>'cover_book_preview')) ?>

			<p class="title">Anunciante:</p>
			<p class="anunciante"></p>
			<p class="title">Título:</p>
			<p class="titulo"></p>
			<p class="title">Autor:</p>
			<p class="autor"></p>
  		</div>

  		<div class="modal_concluir">
			<button id="finaliza_sol">Finalizar Solicitação</button>
			<button class="fechar_modal">Cancelar</button>
		</div>
  	</div>

  	<div id="solicita_final" style="display: none;">
  		<div id='message'>
  			<?php echo img(array('src'=>'assets/imgs/success_ico.png','id'=>'success_ico')) ?>
		   	<p id='message_inner'>Solicitação realizada com sucesso!</p>
		</div>
		<p> - Você será notificado quando esta solicitação for respondida.<p>
		<p> - O crédito usado nesta solicitação ficará suspenso até que a solicitação seja respondida.</p>
		<p class="credito_info"></p>
		<div class="modal_concluir">
			<button class="fechar_modal">Concluir</button>
		</div>
  	</div>

	<? endif; ?>

</div>
