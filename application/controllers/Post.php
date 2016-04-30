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
    $data['title'] = "make posts and see whats new!";

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('post', 'post', 'required');

    if ($this->form_validation->run() === FALSE){
        $this->load->helper('form'); //so logout works

        $this->load->view('templates/header_in', $data);
        $this->load->view('post/new');

        $post_id = $this->post_model->next_post($my_id);
        print_r($post_id);
        $this->show_with_post($post_id);
    }

    else{
      $new_post = $this->input->post('post');
      $this->post_model->make($my_id, $new_post);
      redirect("post/create");
    }
  }

  else{
    echo "login to post";
  }
}
/*
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
*/

public function show_all($id){
  $posts = $this->post_model->get_all($id);

  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->_draw_header('Posts');

  foreach($posts as $p){
    $data['post'] = $p;
    $this->load->view('post/single_post', $data);
  }
}

public function show($post_id){
  $data['post'] = $this->post_model->get($post_id)[0];

  if (empty($data['post'])){
          echo "this post is not there";
  }

  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->_draw_header('Posts');
  $this->load->view('post/single_post', $data);
}

public function show_with_post($post_id){
  if(array_key_exists('id', $this->session->userdata)){
    $POST = $this->input->post();
    $my_id = $this->session->userdata('id');

    if($post_id == 0){
      echo "no new posts";
    }
    else{
      $data['post'] = $this->post_model->get($post_id)[0];
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->view('post/single_post_like_next', $data);
    }

    if (array_key_exists('like', $POST)){
      $this->post_model->like($my_id, $post_id);
      $this->post_model->view($my_id, $post_id);
      redirect("post/create");
    }

    if (array_key_exists('next', $POST)){
      $this->post_model->view($my_id, $post_id);
      redirect("post/create");
    }
  }
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
      print_r($this->post_model->like($my_id, $post_id));

  }

    redirect("/post/show_all/$other_user_id");
    $this->load->view('templates/footer');
    //print_r($this->input->post());
}
  else{$this->_draw_header();}
}

public function comment_single($post_id, $other_user_id){
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
      print_r($this->post_model->like($my_id, $post_id));
  }

    redirect("/post/show/$post_id");
    $this->load->view('templates/footer');
    //print_r($this->input->post());
}
  else{$this->_draw_header();}
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
