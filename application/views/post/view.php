<table class ="pure-table">
  <thread>

<?php
print_r($post);
foreach($post as $p){
  $name = $p['user']['name'];
  $photo = $p['user']['photo'];
  $date = $p['post']['post_date'];
  $content = $p['post']['post_content'];
print <<<post
<tr><td>$name</td>
<td><img src =$photo width="100"></td>
<td>$content</td>
</tr>
post;
}
?>
