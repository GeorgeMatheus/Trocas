<html>
<head>
<title>My Form</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]); ?>

<h5>Nome</h5>
<input type="text" name="nome" value="<?php echo set_value('nome'); ?>" size="50" />

<h5>Data de Nascimento</h5>
<input type="text" name="data_nascimento" value="<?php echo set_value('data_nascimento'); ?>" size="50" />

<h5>Email</h5>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<h5>Username</h5>
<input type="text" name="usuario" value="<?php echo set_value('usuario'); ?>" size="50" />

<h5>Password</h5>
<input type="text" name="senha" value="<?php echo set_value('senha'); ?>" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="confirm_senha" value="<?php echo set_value('confirm_senha'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>