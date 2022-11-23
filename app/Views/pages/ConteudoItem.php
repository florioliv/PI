<div class="container">
	<div class="card my-3">
		<div class="card-body">
			<img src="/imagem/conteudo/<?= $conteudo['Imagem']?>" class="img-fluid col-md-6 offset-md-3">
			<div class="py-4">
				<h3><?php echo $conteudo['Titulo']; ?></h3>
			</div>
			<div class="text-justify">
				<p><?php echo $conteudo['Texto_completo']; ?></p>
			</div>
		</div>
		<div class="card-footer">
			<a href="javascript:history.back()" class="btn btn-primary">Voltar</a>
		</div>
	</div>
</div>