<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ConteudoModel;

class Home extends Controller{
	public function principal()	{
		//return view('welcome_message');
		$model = new ConteudoModel();
		$data = [
			'conteudo' => $model->getConteudo(),
			'session' => \Config\Services::session(),
		];
		
		//Se logged_in false
		if(!$data['session']->get('logged_in'))
			return redirect('login');

		echo view('templates/Header');
		echo view('pages/Home',$data);
		echo view('templates/Footer');
	}
	public function aluno()	{
		$model = new ConteudoModel();
		$data = [
			'conteudo' => $model->getConteudo(),
			'session' => \Config\Services::session(),
		];
		
		//Se logged_in false
		if(!$data['session']->get('logged_in'))
			return redirect('login');
		

		echo view('templates/Header');
		echo view('pages/HomeAluno',$data);
		echo view('templates/Footer');

	}
	public function item($id){
		$model = new ConteudoModel();
		$data = [
			'conteudo' => $model->getConteudoItem($id),
			'session' => \Config\Services::session(),
		];
		if(!$data['session']->get('logged_in'))
			return redirect('login');

		echo view('templates/Header');
		echo view('pages/ConteudoItem',$data);
		echo view('templates/Footer');
	}
	public function inserir(){
		$data['session'] = \Config\Services::session();
		if(!$data['session']->get('logged_in'))
			return redirect('login');

		//helper('form') para validação dos campos.
		helper('form');
		echo view('templates/Header');
		echo view('pages/ConteudoGravar');
		echo view('templates/Footer');
	}
	public function editar($id = NULL){
		$model = new ConteudoModel();
		$data = [
			'conteudo' => $model->getConteudoItem($id),
			'session' => \Config\Services::session(),
		];
		if(!$data['session']->get('logged_in'))
			return redirect('login');

		echo view('templates/Header',$data);
		echo view('pages/ConteudoGravar',$data);
		echo view('templates/Footer'); 
	}
	public function excluir($id = NULL){
		$data['session'] = \Config\Services::session();
		if(!$data['session']->get('logged_in'))
			return redirect('login');

		$model = new ConteudoModel();
		$model->delete($id);
		return redirect('principal');
	}
	public function gravar(){
		$data['session'] = \Config\Services::session();
		if(!$data['session']->get('logged_in'))
			return redirect('login');

		//Validação dos campos
		helper('form');
		$model = new ConteudoModel();

		if($this->validate([
			'Titulo'=>['label'=>'Titulo','rules'=>'required|min_length[3]|max_length[100]'],
			'Texto_curto'=>['label'=>'Resumo','rules'=>'required|min_length[10]|max_length[100]'],
			'Texto_completo'=>['label'=>'Conteudo Completo','rules'=>'required|min_length[10]']	
		])){
			//Salvar no banco de dados
			$id_Conteudo = $this->request->getVar('ID_Conteudo');
			$titulo = $this->request->getVar('Titulo');
			$texto_curto = $this->request->getVar('Texto_curto');
			$texto_completo = $this->request->getVar('Texto_completo');
			$imagem = $this->request->getFile('imagem');

			if(!$imagem->isValid()){
				$model->save([
					'ID_Conteudo'=>$id_Conteudo,
					'Titulo'=>$titulo,
					'Texto_curto'=>$texto_curto,
					'Texto_completo'=>$texto_completo,
				]);
				//Depois de salvar volta para raiz
				return redirect('principal');
			}else{
				$validaImagem = $this->validate([
					'imagem' => [
						'uploaded[imagem]',
						'mime_in[imagem,image/jpg,image/jpeg,image/gif,image/png]',
						'max_size[imagem,4096]',
					],
				]);
				if($validaImagem){
					//Criar nome para imagem
					$novoNome = $imagem->getRandomName();
					//Mover para public/imagem/conteudo
					$imagem->move('imagem/conteudo', $novoNome);

					$model->save([
						'ID_Conteudo'=>$id_Conteudo,
						'Titulo'=>$titulo,
						'Texto_curto'=>$texto_curto,
						'Texto_completo'=>$texto_completo,
						'Imagem'=>$novoNome,
					]);
					
				}else{
					echo view('templates/Header');
					echo view('pages/ConteudoGravar');
					echo view('templates/Footer');
				}
				return redirect('principal');
			}
		}else{
			echo view('templates/Header');
			echo view('pages/ConteudoGravar');
			echo view('templates/Footer');			
		}

	}
	//--------------------------------------------------------------------

}
