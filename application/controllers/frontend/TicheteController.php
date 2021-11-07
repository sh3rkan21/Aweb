<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicheteController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('TichetModel');
		$this->load->library('session');
	}

	public function homepage()
	{
		$this->load->view('templates/header');

		$tichete = new TichetModel;
		$data['tichete'] = $tichete->getTichete();
		$this->load->view('tichete/homepage', $data);

		$this->load->view('templates/footer');
	}

	public function create()
	{
		$this->load->view('templates/header');
		$tichete = new TichetModel;
		$data['tichete'] = $tichete->getTichete();
		$this->load->view('tichete/create', $data);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('denumire', 'Denumire', 'required');
		$this->form_validation->set_rules('descriere', 'Descriere', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');

		if ($this->form_validation->run()) {
			$org_filename = $_FILES['upload_poza']['name'];
			$new_name = time() . "-" . str_replace(' ', '-', $org_filename);
			$config = [
				'upload_path' => './images/',
				'allowed_types' => 'jpg|png|gif',
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('upload_poza')) {
				$imageError = array('imageError' => $this->upload->display_errors());
				$this->load->view('templates/header');
				$this->load->view('tichete/create', $imageError);
				$this->load->view('templates/footer');
			} else {
				$nume_poza = $this->upload->data('file_name');
				$data = array(
					'denumire' => $this->input->post('denumire'),
					'descriere' => $this->input->post('descriere'),
					'data' => $this->input->post('data'),
					'parent_id'=> $this->input->post('parent_id'),
					'poza' => $nume_poza
				);
				$tichet = new TichetModel;
				$res = $tichet->insertTichet($data);
				$this->session->set_flashdata('status', 'Tichetul a fost adaugat cu succes!');
				redirect(base_url('index.php/tichete/add'));

			}
		} else {
			$this->create();
		}
	}

	public function edit($id)
	{
		$this->load->view('templates/header');
		$tichet = new TichetModel;
		$data ['tichet'] = $tichet->editTichet($id);
		$data ['tichete'] = $tichet->getTichete();
		$this->load->view('tichete/edit', $data);
		$this->load->view('templates/footer');
	}

	public function update($id)
	{
		$this->form_validation->set_rules('denumire', 'Denumire', 'required');
		$this->form_validation->set_rules('descriere', 'Descriere', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');

		if ($this->form_validation->run()) {
			$old_filename = $this->input->post('old_image');
			$new_filename = $_FILES['upload_poza']['name'];
			if ($new_filename == TRUE) {
				$update_filename = time() . "-" . str_replace(' ', '-', $_FILES['upload_poza']['name']);
				$config = [
					'upload_path' => './images/',
					'allowed_types' => 'jpg|png|gif',
					'file_name' => $update_filename,
				];
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('upload_poza')) {
					if (file_exists("./images/" . $old_filename)) {
						unlink("./images/" . $old_filename);
					}
				}
			} else {
				$update_filename = $old_filename;
			}

			$data = [
				'denumire' => $this->input->post('denumire'),
				'descriere' => $this->input->post('descriere'),
				'data' => $this->input->post('data'),
				'parent_id'=> $this->input->post('parent_id'),
				'poza' => $update_filename,
			];
			$tichet = new TichetModel;
			$res = $tichet->updateTichet($data, $id);
			$this->session->set_flashdata('status', 'Tichet modificat cu succes!');
			redirect(base_url('index.php/tichete/edit/' . $id));

		} else {
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		$tichet = new TichetModel;
		if ($tichet->checkTichetImage($id)) {
			$data = $tichet->checkTichetImage($id);

			if (file_exists('./images/' . $data->poza)) {
				unlink('./images/' . $data->poza);
			}
			$tichet->deleteTichet($id);
		}

		$tichet->deleteTichet($id);
		$this->session->set_flashdata('status', 'Tichetul a fost sters cu succes!');
		redirect(base_url('index.php/tichete/home'));
	}


	public function categories()
	{
		$this->load->model('CategoryModel');
		$data['categories'] = $this->CategoryModel->get_categories();

		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}
?>
