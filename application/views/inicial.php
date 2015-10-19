<div id="body" class="inicial_container">
	<div id="body_inner">
		<?php echo img(array('src'=>'assets/imgs/inicial_img.png','id'=>'inicial_img'))?>
		<p>Livro novo é aquele que você nunca leu.<br/><br/>Passe um livro adiante e adquira outro, de sua escolha, de qualquer pessoa.<br/><br/>Sem dinheiro envolvido, apenas livros!</p>
		<div class="estante"><span>Livros mais recentes:</span></div>
		<div class="slideshow">
			<?php
			foreach($books as $book) {
			        echo img(array('src'=>'assets/imgs/book_covers/'.$book->foto));
		    }
			?>
		</div>
	</div>
</div>
