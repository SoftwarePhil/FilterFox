<?php
class User extends CI_Controller {

public function __construct(){
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('post_model');
    $this->load->helper('url_helper');
    $this->load->library('session');
}

public function start(){

  $this->load->helper('form');
  $this->load->library('form_validation');
  $data['title'] = 'Log in!';

  $this->form_validation->set_rules('email', 'Email', 'required');
  $this->form_validation->set_rules('password', 'Name', 'required');


  if(array_key_exists('create', $_POST)){
    $this->create();
  }

  elseif ($this->form_validation->run() === FALSE)
  {
      $this->load->view('templates/header', $data);
      $this->load->view('user/log_in');
      $this->load->view('templates/footer');

  }
  else{
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $valid = $this->user_model->validate_user($email, $password);

      if($valid >= 0){
        echo "you have logged in! welcome";

        $temp = array(
                'logged_in'=>TRUE,
                'id'=>$valid
        );

        $this->session->set_userdata($temp);

        $this->profile($valid);
      }

      else{
          $data['title'] = 'Log in failed!';
          $this->load->view('templates/header', $data);
          $this->load->view('user/log_in');
          $this->load->view('templates/footer');
      }
  }
}

public function create(){

    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title'] = 'Create a new user!';

    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('user/create_user');
        $this->load->view('templates/footer');

    }
    else
    {
        $this->user_model->set_user();
        $this->start();
    }
}

public function profile($id){
  $data['last_five_posts'] = $this->post_model->get_last_five_posts($id);

  $my_id = $this->session->userdata('id');
  if($my_id == FALSE || $my_id != $id){
    $data['user'] = $this->user_model->get_user($id);

    if (empty($data['user'])){
            show_404();
    }

    $data['title'] = 'A Profile';

    $this->load->view('templates/header', $data);
    $this->load->view('user/profile', $data);
    $this->load->view('templates/footer');
  }
  else{
    $data['user'] = $this->user_model->get_user($id);
    $name = $data['user']['name'];
    $data['title'] = "Hello, welcome $name";

    $this->_draw_header();
    $this->load->view('user/profile', $data);
    $this->load->view('user/edit');
    $this->load->view('templates/footer');
  }
}

public function click_edit(){
    $edits = $this->input->post();

    if(array_key_exists('edit_bio', $edits)){
      $this->edit_bio();
    }
    if(array_key_exists('edit_photo', $edits)){
      $this->edit_photo();
    }
}

public function edit_bio(){
  $my_id = $this->session->userdata('id');
  $current_bio = $this->user_model->get_user($my_id)['bio'];

  $data['title'] = "Your current bio is .. $current_bio";

  $this->load->helper('form');
  $this->load->library('form_validation');

  $this->form_validation->set_rules('bio', 'Bio', 'required');

  if ($this->form_validation->run() === FALSE)
  {
      $this->_draw_header();
      $this->load->view('user/edit_bio');
      $this->load->view('templates/footer');

  }
  else{
      $edits = $this->input->post('bio');

      $this->user_model->edit_bio($my_id, $edits);
      $this->profile($my_id);
  }
}

function edit_photo(){
    $this->load->helper(array('form', 'url'));

    $my_id = $this->session->userdata('id');

		$config['upload_path'] = './profile_photos/';
		$config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $my_id;
    $config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
    $config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

      $data['title'] = "Photo upload!";

      $this->_draw_header();
			$this->load->view('user/edit_photo', $error);
		}
		else
		{
      $file_name = $this->upload->data()['file_name'];
      #this path will have to be changed if change where site is..
      $path = "http://localhost/filterfox/profile_photos/$file_name";

      $this->user_model->edit_photo($my_id, $path);
      $this->profile($my_id);
		}
	}

public function log_out(){
  $edits = $this->input->post();
  $my_id = $this->session->userdata('id');

  if(array_key_exists('logout', $edits)){
    $this->session->sess_destroy();
    $this->start();
  }

  if(array_key_exists('profile', $edits)){
    redirect("user/profile/$my_id");
  }

  if(array_key_exists('posts', $edits)){
    redirect("post/show_all/$my_id");
  }

  if(array_key_exists('new_post', $edits)){
    redirect("post/create/$my_id");
  }
}

public function _draw_header(){
  if(array_key_exists('id', $this->session->userdata)){
    $my_id = $this->session->userdata('id');

    $data['user'] = $this->user_model->get_user($my_id);
    $name = $data['user']['name'];
    $data['title'] = "Hello, welcome $name";

    $this->load->helper('form'); //so logout works

    $this->load->view('templates/header_in', $data);
  }
  else{
    $data['title'] = "Hello, please log in!";
    $this->load->view('templates/header', $data);
  }
}

}
