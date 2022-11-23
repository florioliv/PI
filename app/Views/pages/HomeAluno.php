<div class="container">
	<?php if($session->get('logged_in')): ?>
		<p>Bem vindo(a) <?=$session->get('user') ?>! <a href="/Usuario/logout"> Sair</a></p>
	<?php endif; ?>

	<?php if(!empty($conteudo)):?>
		<?php foreach($conteudo as $conteudo_item):?>
			<div class="card my-5">
				<div class="card-body">
					<h3><?php echo $conteudo_item['Titulo'];?></h3>
					<p><?php echo $conteudo_item['Texto_curto'];?></p>
				</div>
				<div class="card-footer">
					<a href="<?= $conteudo_item['ID_Conteudo']?>" class="btn btn-success">Saiba mais</a>					
				</div>
			</div>
		<?php endforeach;?>
	<?php else: ?>
		<h3>Sem Conteúdo</h3>
		<p>Não existe conteúdo cadastrado.</p>
	<?php endif ?>
</div>
