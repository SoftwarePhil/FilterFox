<div align="center" class="pure-g">
    <div class="pure-u-1 pure-u-md-1 pure-u-lg-1"><p><h1><big><?php echo $user['name'] ?></big></p></h1></div>
  <div class="pure-u-1 pure-u-md-1-3 pure-u-lg-1-3"><p>
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
    <h3>favorite posts</h3>
    <thead>
        <tr>
            <th>user</th>
            <th>post</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>bob</td>
            <td>I ate a green cat</td>
        </tr>

        <tr>
            <td>hood struct h310</td>
            <td>trees, fees, and flees, #hoodlife</td>
        </tr>

        <tr>
            <td>robot robit</td>
            <td>proccessing request bitch</td>
        </tr>
    </tbody>
  </table>
  </p></div>
</p></div>
