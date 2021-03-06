<?php
	if (isset($success_message)) {
		echo '<div id="message">
				<p id="message_inner">'
					.img(array('src'=>'assets/imgs/success_ico.png','id'=>'success_ico'))
					.$success_message
				.'<p>
			</div>';
	}
?>

<div id="body" class="cadastro_container">

	<div id="body_inner">

		<?php echo form_open('cadastro/inserir', 'id="form_cadastro"'); ?>
		<!-- <form id="form_cadastro"> -->
			<fieldset>
				<label>Nome Completo</label>
				<input type="text" class="textField" name="nome" id="nome" style="width: 450px;"
					   data-validation="required" />
			</fieldset>

			<fieldset>
				<label>E-mail</label>
				<input type="text" class="textField" name="email" id="email" style="width: 450px;"
					   data-validation="email" />
			</fieldset>

			<fieldset>
				<label>Senha</label>
				<input type="password" class="textField" name="senha" id="password" style="width: 250px;"
					   data-validation="required" />
			</fieldset>

			<fieldset>
				<label>Data de Nascimento</label>
				<input type="text" class="textField" name="dt_nasc" id="dataNascimento" style="width: 170px;"
					   data-validation="date" data-validation-format="dd/mm/yyyy" />
			</fieldset>

			<fieldset>
				<label>Cep</label>
				<input type="text" class="textField" name="cep" id="cep" style="width: 100px;"
					   data-validation="required" data-validation-length="9-9" />
			</fieldset>

			<fieldset>
				<label>Endereço</label>
				<input type="text" class="textField" name="endereco" id="endereco" style="width: 320px;"
					   data-validation="required" />
			</fieldset>

			<fieldset>
				<label>Número</label>
				<input type="text" class="textField" name="numero" id="numero" style="width: 100px;"
					   data-validation="required" />
			</fieldset>

			<fieldset>
				<label>Bairro</label>
				<input type="text" class="textField" name="bairro" id="bairro" style="width: 320px;"
					   data-validation="required" />
			</fieldset>

			<fieldset>
				<label>Cidade</label>
				<input type="text" class="textField" name="cidade" id="cidade" style="width: 350px;"
					   data-validation="required" />
			</fieldset>

			<fieldset>
				<label>Estado</label>
				<input type="text" class="textField" name="estado" id="estado" style="width: 70px;"
					   data-validation="required" data-validation-length="2-2"/>
			</fieldset>
		<?php echo form_close(); ?>
		<!-- </form> -->

		<?php echo img(array('src'=>'assets/imgs/cadastro_img.png','id'=>'cadastro_img'))?>
		<button id="enviar_cadastro">Enviar Cadastro</button>
		<button id="limpar_cadastro">Limpar Cadastro</button>
	</div>
</div>
