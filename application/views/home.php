<div id="body" class="home_container">
	<div id="body_inner">
		<h1>Livros recentemente desejados</h1>

		<?php
			foreach($livros_desejados as $book) {
				echo "<div class='span3 flip-card flip-card-hover'>
						  <div class='supertrunfo'>
						      <div class='supertrunfo-front supertrunfo-face'>"
						  	      .img(array('src'=>'assets/imgs/book_covers/'.$book->foto))
						    ."</div>
						      <div class='supertrunfo-back supertrunfo-face'>
						          <h3>".$book->titulo."</h3>
							      <p>".$book->autor."</p>
							  </div>
						  </div>
					  </div>";
			}
		?>

		<h1 style="margin-top: 50px;">Livros recentemente cadastrados</h1>

		<?php
			foreach($livros_cadastrados as $book) {
				echo "<div class='span3 flip-card flip-card-hover'>
						  <div class='supertrunfo'>
						      <div class='supertrunfo-front supertrunfo-face'>"
						  	      .img(array('src'=>'assets/imgs/book_covers/'.$book->foto))
						    ."</div>
						      <div class='supertrunfo-back supertrunfo-face'>
						          <h3>".$book->titulo."</h3>
							      <p>".$book->autor."</p>
							  </div>
						  </div>
					  </div>";
			}
		?>

		<h1 style="margin-top: 50px;">Livros trocados recentemente</h1>

		<?php
			foreach($livros_trocados as $book) {
				echo "<div class='span3 flip-card flip-card-hover'>
						  <div class='supertrunfo'>
						      <div class='supertrunfo-front supertrunfo-face'>"
						  	      .img(array('src'=>'assets/imgs/book_covers/'.$book->foto))
						    ."</div>
						      <div class='supertrunfo-back supertrunfo-face'>
						          <h3>".$book->titulo."</h3>
							      <p>".$book->autor."</p>
							  </div>
						  </div>
					  </div>";
			}
		?>

	</div>
</div>
