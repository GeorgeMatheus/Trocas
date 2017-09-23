<h2>Criar objeto</h2>

<?php echo validation_errors(); ?>

<?php echo form_open("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]); ?>

<?php if(!(isset($sucesso) && $sucesso)): ?>
<h5>Nome</h5>
<input type="text" name="nome" value="<?php echo set_value('nome'); ?>" size="50" />

<h5>Descriçao</h5>
<input type="text" name="descricao" value="<?php echo set_value('descricao'); ?>" size="50" />

<h5>Interesse</h5>
<input type="text" name="interesse" value="<?php echo set_value('interesse'); ?>" size="50" />

<h5>Categoria</h5>
<input type="text" name="categoria" value="<?php echo set_value('categoria'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>
<?php else: ?>
<p style="color: green">Objeto adicionado com sucesso</p>
<a href="/home/newobj">Adicionar outro objeto</a><br>
<a href="/home">Voltar a Home</a><br>
<?php endif; ?>