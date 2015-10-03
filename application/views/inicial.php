<div id="body" class="inicial_container">
	<div id="body_inner">
		<?php echo img(array('src'=>'assets/imgs/inicial_img.png','id'=>'inicial_img'))?>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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