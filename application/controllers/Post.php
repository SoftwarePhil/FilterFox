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
      redirect("post/show_all/$my_id");
    }
  }

  else{
    echo "login to post";
  }
}

public function show_all($id){
  $data['post'] = $this->post_model->get_all($id);

  if (empty($data['post'])){
          echo "you have no posts to show! say something";
  }

  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->_draw_header('Posts');
  $this->load->view('post/view', $data);
}

public function show($post_id){
  $data['post'] = $this->post_model->get($post_id);

  if (empty($data['post'])){
          echo "this post is not there";
  }

  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->_draw_header('Posts');
  $this->load->view('post/single_post', $data);
}


public function comment($post_id, $other_user_id){
  //add error condtion for not being logged in
if(array_key_exists('id', $this->session->userdata)){
  $POST = $this->input->post();
  $my_id = $this->session->userdata('id');

  $this->load->helper('form');

  if(array_key_exists('like', $POST)){
        $new_post = $this->input->post('post');
        $this->post_model->make_comment($my_id, $post_id, $new_post);
    }

  if(array_key_exists('like2', $POST)){
    $this->post_model->like($my_id, $post_id);
  }

    redirect("/post/show_all/$other_user_id");
    $this->load->view('templates/footer');
    print_r($this->input->post());
}
}

public function _draw_header($info = FALSE){
  if(array_key_exists('id', $this->session->userdata)){
    $my_id = $this->session->userdata('id');
    $data['user'] = $this->user_model->get_user($my_id);
    $name = $info;

    if($info == FALSE){
      $data['title'] = "Hello, welcome $name";
    }
    else{
      $data['title'] = $info;
    }

    $this->load->helper('form'); //so logout works

    $this->load->view('templates/header_in', $data);
  }
  else{
    $data['title'] = "Hello, please log in!";
    $this->load->view('templates/header', $data);
  }
}
}
