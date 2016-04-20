<p>
<div class ="pure-g" align='center'>
  <div class="pure-u-1"
<?php echo validation_errors(); ?>

<?php echo form_open('post/create'); ?>

    <label for="post"></label>
    <textarea name="post" rows="4" cols="24"></textarea><br />

    <input type="submit" name="submit" value="post" />
</form>
</p>
