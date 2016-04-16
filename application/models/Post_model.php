<?php
class Post_Model extends CI_Model {

public function __construct(){
        $this->load->database();
        $this->load->model('user_model');
}

public function make($id, $post){
  $post_time = date('Y-m-d H:i:s');
  $post_data = array(
          'post_date'=> $post_time,
          'post_content'=>$post,
          'user_id'=>$id
  );

  $this->db->insert('post', $post_data);
  $last_id = $this->db->insert_id();

  return $last_id;
}

public function get($id){
  $query = $this->db->get_where('post', array('user_id' => $id));

  $posts = array();
  foreach ($query->result_array() as $row) {
    $posts[] = array(
              'post'=>$row,
              'user'=>$this->user_model->get_user($id));
  }
  return $posts;
}

public function make_commnet($id, $post_id, $comment){
  $post_time = date('Y-m-d H:i:s');
  $post_data = array(
          'post_id'=>$post_id,
          'comment_content'=>$comment,
          'user_id'=>$id,
          'date'=> $post_time,
  );

  $this->db->insert('post', $post_data);
  $last_id = $this->db->insert_id();

  return $last_id;
}

}
