<?php
class User_Model extends CI_Model {

public function __construct(){
        $this->load->database();
}

public function validate_user($email, $password){
    $query = $this->db->get_where('user_access', array('email' => $email));
      $test1 = $query->row_array();

    if($test1 != FALSE && $test1['password'] == $password && $test1['email'] == $email){
        return $test1['user_id'];
    }

    else{
      return -1;
    }
}

public function set_user(){
  $this->load->helper('url');

  $data = array(
      'name' => $this->input->post('name')
  );

  $this->db->insert('user', $data);

  $last_id = $this->db->insert_id();

  $more_data = array(
      'user_id' => $last_id,
      'email' => $this->input->post('email'),
      'password' => $this->input->post('password')
  );

    $this->db->insert('user_access', $more_data);

    return $last_id;
}

public function get_user($id){
  $query = $this->db->get_where('user', array('user_id' => $id));
  return $query->row_array();
}

public function edit_bio($id, $bio){
    $edit_bio = array('bio'=>$bio);
    $this->db->update('user', $edit_bio, "user_id = $id");
}

public function edit_photo($id, $path){
    $edit_photo = array('photo'=>$path);
    $this->db->update('user', $edit_photo, "user_id = $id");
}
}
