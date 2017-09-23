<h1>Caixa de Mensagens</h1>
<p>Novas mensagens</p>
<?php foreach ($mensagens as $mensagem): ?>
<!--MENSAGEM-->
<hr>

<p><b>De:</b> <?php echo $mensagem['de']; ?></p>
<p><b>Para:</b> <?php echo $mensagem['para']; ?></p>
<p><b>Mensagem:</b></p>
<p><?php echo $mensagem['mensagem']; ?></p>

<?php endforeach; ?>
<hr>
<!-- END MENSAGEM -->
<a href="/home">Voltar a home.</a>