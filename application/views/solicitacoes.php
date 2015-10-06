<div id="body" class="solicitacoes_container">
	<div id="body_inner">

		<div id="solicitacoes_recebidas">
			<h1>Solicitações Recebidas</h1>

			<ul class="bookshelf">
				<?php
					foreach($sol_rec as $book) {
				        echo "<li id=\"".$book->id_livro."\" data-type='1'>"
									 .img(array('src'=>'assets/imgs/book_covers/'.$book->foto))
									 ."<p class='booktag'>RESPONDER</p>"
								     ."<p class='booktitle'>Título:</p>"
								     ."<p>".$book->titulo."</p><br/>"
								     ."<p class='bookauthor'>Autor:</p>"
								     ."<p>".$book->autor."</p>"
								     ."<p class='status'>Status</p>"
							     	 ."<p>Pendente</p>"
							."</li>";
				    }
				?>
			</ul>
		</div>

		<div id="solicitacoes_enviadas">
			<h1>Solicitações Enviadas</h1>

			<ul class="bookshelf">
				<?php
					foreach ($sol_env as $book) {
						echo "<li id=\"".$book->id_livro."\" data-type='2'>"
								 .img(array('src'=>'assets/imgs/book_covers/'.$book->foto))
								 ."<p class='booktag'>GERENCIAR</p>"
							     ."<p class='booktitle'>Título:</p>"
							     ."<p>".$book->titulo."</p><br/>"
							     ."<p class='bookauthor'>Autor:</p>"
							     ."<p>".$book->autor."</p>"
							     ."<p class='status'>Status</p>"
							     ."<p>Pendente</p>"
							  ."</li>";
					}
				?>
			</ul>
		 </div>

	</div>

	<div id="solicita" style="display:none;">
    	<div id="sol_0">
    		<?php echo img(array('src'=>'assets/imgs/book_covers/book_cover.jpg')) ?>
    	</div>
		<ul id="sol_1"></ul>
		<ul id="sol_2"></ul>
		<div class="modal_concluir">
			<button id="aceitar_sol">Aceitar</button>
			<button id="recusar_sol">Recusar</button>
		</div>
  	</div>

  	<div id="solicitacao_aceita" style="display:none;">
		<div id="message">
			<?php echo img(array('src'=>'assets/imgs/success_ico.png','id'=>'success_ico'))?>
			<p id="message_inner">
				Solicitação aceita!<br/>Envie este livro para o endereço descrito abaixo.
			</p>
		</div>
		<ul id="sol_act_0"></ul>
		<div id="sol_act_1">
    		<?php echo img(array('src'=>'assets/imgs/book_covers/book_cover.jpg')) ?>
    	</div>
		<ul id="sol_act_2"></ul>
		<div class="modal_concluir">
			<button class="fechar_modal">Concluir</button>
		</div>
  	</div>

  	<div id="solicitacao_enviada" style="display:none;">
    	<div id="sol_env_0">
    		<?php echo img(array('src'=>'assets/imgs/book_covers/book_cover.jpg')) ?>
    	</div>
		<ul id="sol_env_1"></ul>
		<ul id="sol_env_2"></ul>
		<div class="modal_concluir">
			<button class="fechar_modal">Cancelar Solicitação</button>
			<button class="fechar_modal">Fechar</button>
		</div>
  	</div>
</div>
