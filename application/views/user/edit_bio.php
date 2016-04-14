<?php echo validation_errors(); ?>

<?php echo form_open('user/edit_bio'); ?>

    <label for="bio">Text</label>
    <textarea name="bio"></textarea><br />

    <input type="submit" name="submit" value="update bio" />
</form>
