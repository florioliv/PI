<div class="container">
	<!--Caixa de diálogo-->
	<div class="alert-primary my-3">
		<?= //O sinal = substitui o echo
		\Config\Services::validation()->listErrors();?>
	</div>
	<form action="<?= '/gravar'?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="Titulo">Título</label>
			<input type="text" class="form-control" name="Titulo" value="<?= isset($conteudo['Titulo']) ? $conteudo['Titulo'] : set_value('Titulo') ?>"/>
		</div>
		<div class="form-group">
			<label for="Texto_curto">Resumo</label>
			<input type="text" class="form-control" name="Texto_curto" value="<?= isset($conteudo['Texto_curto']) ? $conteudo['Texto_curto'] : set_value('Texto_curto') ?>"/>
		</div>
		<div class="form-group">
			<label for="Texto_completo">Conteúdo Completo</label>
			<textarea name="Texto_completo" class="form-control" rows="8"><?= isset($conteudo['Texto_completo']) ? $conteudo['Texto_completo'] : set_value('Texto_completo') ?></textarea>
		</div>
		<div class="form-group">
			<label for="imagem">Imagem</label><br/>
			<input type="file" name="imagem"/>
		</div>
		<!--hidden variável oculta para salvar id-->
		<input type="hidden" name="ID_Conteudo" value="<?= isset($conteudo['ID_Conteudo']) ? $conteudo['ID_Conteudo'] : set_value('ID_Conteudo') ?>"/>
		<div class="card my-3">
			<div class="card-footer">
				<input type="submit" name="submit" class="btn btn-primary" value="Salvar"/>
				<a href="javascript:history.back()" class="btn btn-primary">Voltar</a>
			</div>
		</div>
	</form>
</div>