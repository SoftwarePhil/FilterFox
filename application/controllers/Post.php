<?php
class Post extends CI_Controller {

public function __construct(){
        parent::__construct();
        $this->load->model('post_model');
        $this->load->model('user_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
}


public function create(){
  if(array_key_exists('id', $this->session->userdata)){
    $my_id = $this->session->userdata('id');
    $data['title'] = "Post something cool!";

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('post', 'post', 'required');

    if ($this->form_validation->run() === FALSE){
        $this->load->helper('form'); //so logout works

        $this->load->view('templates/header_in', $data);
        $this->load->view('post/new');
        $this->load->view('templates/footer');

    }
    else{
      $new_post = $this->input->post('post');
      $this->post_model->make($my_id, $new_post);
    }
  }

  else{
    echo "login to post";
  }
}

public function show($id){
  $data['post'] = $this->post_model->get($id);

  if (empty($data['post'])){
          show_404();
  }

  $data['title'] = 'Posts';

  $this->load->view('templates/header', $data);
  $this->load->view('post/view', $data);
  $this->load->view('templates/footer');
}

}
