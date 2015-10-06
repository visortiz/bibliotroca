<div id="menu_inner">
	<?php echo form_open('login'); ?>
		<input type="text" id="username" name="username" class="textField" placeholder="E-mail" />
		<input type="password" id="password" name="password" class="textField" placeholder="Senha" />
		<button type="submit" id="login_button">ENVIAR</button>
	</form>

	<a id="linkCadastrar" <?php if($this->uri->segment(1)=='cadastro') echo "class='linkMenuActive'"?>" href="<?php echo site_url('cadastro') ?>">CADASTRAR</a>
</div>
