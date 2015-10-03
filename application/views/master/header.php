<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<base href="<?php echo base_url();?>">
	<title>Bibliotroca <?php echo isset($title) ? '- '.$title : '';?></title>
	<link rel="icon" href="<?=base_url()?>assets/imgs/favicon.gif" type="image/gif">

	<?php
		echo link_tag('http://fonts.googleapis.com/css?family=Roboto:400,700,900');
		echo put_headers();
	?>

</head>
<body>

<div id="container">
	
	<div id="header">
		<div id="header_inner">
			<?php 
				if(isset($nome)) {
				echo "<div id=\"login_info\">
					  <p>Olá, você está logado como " . $nome . "! <a href=\"home/logout\">sair</a></p>
					  <p>Você possui " . $creditos . " créditos</p>
					  </div>";
				}
			?>
			<a href=<?php echo site_url('inicial')?>><?php echo img('assets/imgs/logo.png')?></a>
			<?php echo form_open('busca'); ?>
			<input type="text" id="search" name="search" class="textField" placeholder="Busque por Título, Autor ou Editora" />
			<a href="<?php echo site_url('busca') ?>" ><?php echo img(array('src'=>'assets/imgs/search.png','id'=>'search_icon'))?></a>
		</form>
		</div>
	</div>

	<div id="menu">
		<?php
			if(isset($nome)) {
				$this->load->view('master/menu.php');
			}
			else {
				$this->load->view('master/form_login.php');
			}
		?>
	</div>