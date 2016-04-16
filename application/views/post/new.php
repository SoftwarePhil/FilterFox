<?php echo validation_errors(); ?>

<?php echo form_open('post/create'); ?>

    <label for="post"></label>
    <textarea name="post"></textarea><br />

    <input type="submit" name="submit" value="post" />
</form>
