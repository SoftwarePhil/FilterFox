<p>
<table align="center" class ="pure-table-striped" width="80%">
  <thread>

<?php
$name = $post['user']['name'];
$other_user_id = $post['user']['user_id'];
$photo = $post['user']['photo'];
$date = $post['post']['post_date'];
$content = $post['post']['post_content'];
$post_id = $post['post']['post_id'];
$post_comments = $post['comments'];
$likes = $post['post']['likes'];
echo '<tr><td><h2>'.anchor("user/profile/$other_user_id", "$name", 'class="link-class"').'</h2></td>';
print <<<post
<td><div class="pure-g">
  <div class="pure-u-sm-1 pure-u-lg-1-2"><img src =$photo width="150"></div>
  <div class="pure-u-sm-1 pure-u-lg-1-2">$content<div>
</div>
</td>
<td><h2>$likes</h2></td>
<td>

<div class="pure-menu pure-menu-horizontal">
  <ul class="pure-menu-list">
  <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
       <a href="#" id="menuLink1" class="pure-menu-link">Comment</a>
       <ul class="pure-menu-children">
           <li class="pure-menu-item"><a href="#" class="pure-menu-link">post date: $date</a></li>
            <li>
post;

echo validation_errors();

echo form_open("post/comment_create/$post_id/$other_user_id");

print <<<make_comment
    <label for="comment"></label>
    <textarea name="post"></textarea><br />

    <input type="submit" name="like" value="comment" />
    <input type="submit" name="like2" value="like"/>
</form>
  </li>
  </li></ul>
</td>
</tr>
make_comment;

foreach ($post_comments as $comment) {
$content = $comment['post']['comment_content'];
$date = $comment['post']['date'];
$name = $comment['user']['name'];
$picture = $comment['user']['photo'];
$users_id = $comment['user']['user_id'];
//echo '<div class ="pure-u-1-8">'.anchor("user/profile/$users_id", "$name", 'class="link-class"').'</div>';
print <<<start_table
<tr><td></td>
  <td><div class="pure-g">
start_table;
  echo '<div class ="pure-u-1-8">'.anchor("user/profile/$users_id", "$name", 'class="link-class"').'</div>';
print <<<p_comments
    <div class="pure-u-1 pure-u-lg-3-8"><img src =$picture width="100"></div>
    <div class="pure-u-1 pure-u-lg-3-8">$content</div>
    </div></td>
<td>
  <div class="pure-menu pure-menu-horizontal">
    <ul class="pure-menu-list">
    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
         <a href="#" id="menuLink1" class="pure-menu-link">More</a>
         <ul class="pure-menu-children">
             <li class="pure-menu-item"><a href="#" class="pure-menu-link">post date: $date</a></li>
  </td>
</tr>
p_comments;
}
?>
</p>
<tr>
<td></td><td></td>
<?php
  echo form_open("post/show_with_post/$post_id");
?>
  <td>
  <div <div class="pure-g">
  <div class="pure-u-1-2"><input type="submit" name="like" value="like"/></div>
  <div class="pure-u-1-2"><input type="submit" name="next" value="next"/></div>
</div>
</form>
</td>
</tr>
