<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class Usuario extends Controller{
	public function index(){
		echo view('Templates/Header');
		echo view('Login');
		echo view('Templates/Footer');
	}
	public function login(){
		$model = new UsuarioModel();
		//Pegar os dados do formulário.
		$user = $this->request->getVar('user');
		$senha = $this->request->getVar('senha');
		$data['usuario'] = $model->getUsuario($user, $senha);
		//Instanciar uma sessão
		$data['session'] = \Config\Services::session();

		if(empty($data['usuario'])){
			return redirect('login');
		}else{
			$sessionData = [
				'user' => $user,
				'logged_in' => TRUE,
			];
			//Início da sessão
			$data['session']->set($sessionData);
			if($data['usuario']['Perfil'] == 1)
				return redirect('principal');
			else
				return redirect('aluno');
		}
	}
	public function logout(){
		$data['session'] = \Config\Services::session();
		$data['session']->destroy();
		return redirect('login');
	}
}

?>