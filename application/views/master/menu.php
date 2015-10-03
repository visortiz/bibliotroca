<nav id="menu_inner">
	<a class="linkMenu <?php if($this->uri->segment(1)=='home') echo "linkMenuActive"?>" href="<?php echo site_url('home') ?>">Home</a>
	<a class="linkMenu <?php if($this->uri->segment(1)=='estante') echo "linkMenuActive"?>" href="<?php echo site_url('estante') ?>">Minha Estante</a>
	<a class="linkMenu <?php if($this->uri->segment(1)=='desejos') echo "linkMenuActive"?>" href="<?php echo site_url('desejos') ?>">Lista de Desejos</a>
	<a class="linkMenu <?php if($this->uri->segment(1)=='solicitacoes') echo "linkMenuActive"?>" href="<?php echo site_url('solicitacoes') ?>">Solicitações</a>
	<a class="linkMenu <?php if($this->uri->segment(1)=='como_funciona') echo "linkMenuActive"?>" href="<?php echo site_url('como_funciona') ?>">Como Funciona</a>
</nav>