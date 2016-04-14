
<?php echo validation_errors(); ?>

<?php echo form_open('user/start'); ?>

    <label for="email">Email</label>
    <input type="input" name="email" /><br />

    <label for="password">password</label>
    <input type="password" name="password" /><br />

    <input type="submit" name="submit" value="log in" />
    <input type="submit" name="create" value="create new user" />

</form>
