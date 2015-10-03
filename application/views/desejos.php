<div id="body" class="livros_container">
	<div id="body_inner">

		<div id="livros">
			<h1>Meus livros desejados</h1>

			<ul class="bookshelf">
				<?php
					foreach($books as $book) {
				        echo "<li id=\"".$book->id_livro."\" data-type='1' data-view='2'>"
									 // .img(array('src'=>'assets/imgs/book_cover.jpg'))
									 .img(array('src'=>'assets/imgs/book_covers/'.$book->foto))
									 ."<p class='booktag'>SAIBA MAIS</p>"
								     ."<p class='booktitle'>Título:</p>"
								     ."<p>".$book->titulo."</p><br/>"
								     ."<p class='bookauthor'>Autor:</p>"
								     ."<p>".$book->autor."</p>"
							."</li>";
				    }
				?>
			</ul>

		</div>

		<div id="livros_cadastro">
			<h1>Adicionar livro desejado</h1>

			<div id="message" style="display: none;">
				<?php echo img(array('src'=>'assets/imgs/success_ico.png','id'=>'success_ico'))?>
				<p id="message_inner">
					Cadastro realizado com sucesso!
				</p>
			</div>

			<?php echo img(array('src'=>'assets/imgs/add_book.png','id'=>'add_book')) ?>
			
			<?php echo form_open_multipart('desejos/inserir', 'id="cadastro_livros"'); ?>
				<input type="hidden" id="data-view" value="2" />
				<input type="hidden" id="idu" name="idu" value=<?php echo "\"" . $id . "\"" ?> />
				<fieldset>
					<?php echo img(array('src'=>'assets/imgs/book_covers/book_cover.jpg','id'=>'cover_book_preview')) ?>
					<input type='file' id="cover_book" name="foto" />
				</fieldset>
				
				<fieldset>
					<label>Título:</label>
					<input type="text" class="textField" name="titulo" id="titluo" style="width: 265px;" />
				</fieldset>

				<fieldset>
					<label>Autor:</label>
					<input type="text" class="textField" name="autor" id="autor" style="width: 265px;" />
				</fieldset>

				<fieldset style="float: left;">
					<label>Editora:</label>
					<input type="text" class="textField" name="editora" id="editora" style="width: 120px;" />
				</fieldset>

				<fieldset style="padding-left: 0;">
					<label>Ano de Publicação:</label>
					<input type="text" class="textField" name="ano_pub" id="ano_pub" style="width: 120px;" />
				</fieldset>

				<fieldset>
					<label>Descrição:</label>
					<textarea class="textField" name="descricao" id="descricao" style="width: 265px;"></textarea>
				</fieldset>

				<div>
					<button id="btnAddBook" type="submit">Adicionar</button>
					<button id="btnCancelAddBook" type="button">Cancelar</button>
				</div>
			</form>
		 </div>

	</div>

	<div id="book_modal" style="display:none;">
    	<?php echo form_open_multipart('estante/editar', 'id="edit_book"'); ?>
    		<input type="hidden" name="id" />
			<fieldset style="float: left;">
				<?php echo img(array('src'=>'assets/imgs/book_covers/book_cover.jpg','id'=>'edit_cover_book_preview')) ?>
				
				<input type="file" id="edit_cover_book_2" name="foto_edited" style="display: none;" />
				<input type="button" id="edit_cover_book" value="Procurar..." onclick="document.getElementById('edit_cover_book_2').click();" style="width: 100px; display: block; visibility: hidden;" />
			</fieldset>
			
			<fieldset style="margin-top: 5px;">
				<label>Título:</label>
				<input type="text" class="textField" name="titulo" style="width: 265px;" disabled />
			</fieldset>

			<fieldset>
				<label>Autor:</label>
				<input type="text" class="textField" name="autor" style="width: 265px;" disabled />
			</fieldset>

			<fieldset style="float: left;">
				<label>Editora:</label>
				<input type="text" class="textField" name="editora" style="width: 120px;" disabled />
			</fieldset>

			<fieldset style="padding-left: 0;">
				<label>Ano de Publicação:</label>
				<input type="text" class="textField" name="ano_pub" style="width: 120px;" disabled />
			</fieldset>

			<fieldset>
				<label>Descrição:</label>
				<textarea class="textField" name="descricao" style="width: 265px;" disabled></textarea>
			</fieldset>

			<div style="text-align: right; padding-right: 17px; margin-bottom: 10px; display: none;">
				<!-- <button id="btnSaveEditedBook" type="button">Salvar</button> -->
				<button id="btnSaveEditedBook" type="submit">Salvar</button>
				<button id="btnCancelEditBook" type="button">Cancelar</button>
			</div>

			<div style="text-align: right; padding-right: 17px; margin-bottom: 10px;">
				<button id="btnEditBook" type="button">Editar Livro</button>
			</div>
		</form>
  	</div>
</div>