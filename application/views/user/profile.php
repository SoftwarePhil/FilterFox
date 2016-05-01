
<div align="center" class="pure-g">
    <div class=" pure-u-1"><p><h1><big><?php echo $user['name'] ?></big></p></h1></div>
  <div class="pure-u-1-3"><p>
      <table class="pure-table">
      <thead>
      <tr>
        <th>bio</th>
      </tr>
      </thread>

      <tbody>
      <tr>
        <td><?php echo $user['bio'] ?></td>
      </tr>
      </tbody>
      </table>
    </div>

  <div class align="center"><p>
<?php
print <<<pic
<img src = "$user[photo]" style = 'width:500px'>
pic;
?>
  </div>
<div class ="pure-u-1 pure-u-md-1 pure-u-lg-1-3"><p>
  <table class="pure-table">
    <h3>posts</h3>
    <thead>
        <tr>
            <th>recent posts</th>
            <th>likes</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($last_five_posts as $post){
echo '<tr><td>'.anchor("post/show/$post[post_id]", "$post[post_content]", 'class="link-class"').'</td>';
print <<<posts
    <td><b>$post[likes]</b></td></tr>
posts;
#echo '<td>'.anchor("post/show/$post[post_id]", "$post[post_content]", 'class="link-class"').'</td>';
}
?>
    </tbody>
  </table>
  </p></div>
</p></div>
