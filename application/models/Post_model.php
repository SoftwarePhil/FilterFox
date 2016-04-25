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

public function get_all($id){
  $this->db->order_by('user_id desc, post_id desc');
  $query = $this->db->get_where('post', array('user_id' => $id));

  $posts = array();
  foreach ($query->result_array() as $row) {
    $posts[] = array(
              'post'=>$row,
              'comments'=>$this->get_comments($row['post_id']),
              'user'=>$this->user_model->get_user($id));
  }
  return $posts;
}

public function get($post_id){
  $query = $this->db->get_where('post', array('post_id' => $post_id));

  $post = array();
  $row = $query->result_array();

  $post[] = array(
              'post'=>$row[0],
              'comments'=>$this->get_comments($row[0]['post_id']),
              'user'=>$this->user_model->get_user($row[0]['user_id'])
            );

  return $post;
}

private function get_comments($id){
  $query = $this->db->get_where('post_comment', array('post_id' => $id));

  $comments = array();
  foreach ($query->result_array() as $row) {
    $comments[] = array(
              'post'=>$row,
              'user'=>$this->user_model->get_user($row['user_id']));
  }
  return $comments;

}

public function make_comment($id, $post_id, $comment){
  $post_time = date('Y-m-d H:i:s');
  $post_data = array(
          'post_id'=>$post_id,
          'comment_content'=>$comment,
          'user_id'=>$id,
          'date'=> $post_time,
  );

  $this->db->insert('post_comment', $post_data);
  $last_id = $this->db->insert_id();

  return $last_id;
}

public function like($id, $post_id){
  $like = array(
      'user_id'=>$id,
      'post_id'=>$post_id
  );

  $this->db->where($like);

  $query = $this->db->get('post_like');
  $data = $query->result_array();

  if(empty($data)){
    $this->db->insert('post_like', $like);

    $this->db->where('post_id', $post_id);
    $this->db->set('likes', 'likes+1', FALSE);
    $this->db->update('post');
}

return $data;
}

public function view($id, $post_id){
  $like = array(
      'user_id'=>$id,
      'post_id'=>$post_id
  );

  $this->db->where($like);

  $query = $this->db->get('post_view');
  $data = $query->result_array();

  if(empty($data)){
    $this->db->insert('post_like', $like);

    $this->db->where('post_id', $post_id);
    $this->db->set('likes', 'likes+1', FALSE);
    $this->db->update('post');
}

public function next_post($id){
  
}
}

public function get_last_five_posts($id){
  $this->db->limit(5);
  $this->db->order_by('user_id desc, post_id desc');
  $query = $this->db->get_where('post', array('user_id' => $id));

  $posts = array();
  foreach($query->result_array() as $row){
    $posts[] = array(
                    'post_content' =>$row['post_content'],
                    'likes' =>$row['likes'],
                    'post_id' => $row['post_id']
                    );
  }
  return $posts;
}
}
