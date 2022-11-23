<?php 
namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model{
	/*Atributos de Configuração*/
	protected $table = 'Usuario';
	protected $primaryKey = 'ID_Usuario';
	protected $allowedFields = ['Nome', 'User', 'Senha','Perfil'];

	public function getUsuario($user, $senha){
		return $this->asArray()->where(['User'=>$user, 'Senha'=>md5($senha)])->first();
	}
}
?>