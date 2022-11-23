<?php
namespace App\Models;
use CodeIgniter\Model;

class ConteudoModel extends Model{
	protected $table = 'conteudo';
	protected $primaryKey = 'ID_Conteudo';
	protected $allowedFields = ['Titulo','Texto_curto','Texto_completo','Imagem'];

	public function getConteudo(){
		return $this->findAll();
	}
	//Devolve um conteúdo específico
	public function getConteudoItem($id){
		return $this->asArray()->where(['ID_Conteudo'=>$id])->first();
	}
}
?>