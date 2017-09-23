<h1>Meu perfil</h1>
<form action="<?php echo "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post">
	Nome: <?php echo $perfil['nome']; ?><br>
	Endereço<br>
	  Estado: <input type="type" name="estado" value="<?php echo $perfil['endereco']['estado']; ?>"><br>
	  Cidade: <input type="type" name="cidade" value="<?php echo $perfil['endereco']['cidade']; ?>"><br>
	  Bairro: <input type="type" name="bairro" value="<?php echo $perfil['endereco']['bairro']; ?>"><br>
	  Rua: <input type="type" name="rua" value="<?php echo $perfil['endereco']['rua']; ?>"><br>
	  Complemento: <input type="type" name="complemento" value="<?php echo $perfil['endereco']['complemento']; ?>"><br>
	Contatos<br>
	  Email: <input type="type" name="email" value="<?php echo $perfil['contatos']['email']; ?>"><br>
	  Telefone: <input type="type" name="telefone1" value="<?php echo $perfil['contatos']['telefone1']; ?>"><br>
	  Redes Sociais:<br>
	    Facebook: <input type="type" name="facebook" value="<?php echo $perfil['contatos']['redes_sociais']['facebook']; ?>"><br>
	    Instagram: <input type="type" name="instagram" value="<?php echo $perfil['contatos']['redes_sociais']['instagram']; ?>"><br>
	    Outra: <input type="type" name="rs_outra" value="<?php echo $perfil['contatos']['redes_sociais']['outras1']; ?>"><br>
	<input type="submit" name="alterar" value="Salvar alterações">
</form>
<form action="<?php echo $_SERVER["REQUEST_URI"];?>" method="post">
	<input type="submit" name="delete_user" value="Deletar usuario">
</form>
<a href="/home">Voltar a Home</a>