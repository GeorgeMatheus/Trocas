<html lang="en">
<head>
<title>Trocas1.1</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Trocas 1.1</h1>
		<p>Seja simples, troque.</p>
		<div style="width: 50%;">
			<?php if(isset($erro)): ?>
			<div class="alert alert-danger">
				<p><?php echo $erro; ?></p>
			</div>
			<?php endif; ?>
			<?php echo validation_errors('<div class="alert alert-warning"><p>','</p></div>'); ?>
			<?php echo form_open("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"], array('class'=>"form-inline")); ?>
				<div class="form-group">
					<label for="usuario">Usuario</label>
					<input class="form-control" type="text" name="usuario" value="<?php echo set_value('usuario'); ?>"/>
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input class="form-control" type="password" name="senha" value="<?php echo set_value('senha'); ?>"/>
				</div>
				<input class="btn btn-default" type="submit" value="Logar" />
			</form>

			<a href="/new_user">Criar conta</a>
		</div>
	</div>
</body>