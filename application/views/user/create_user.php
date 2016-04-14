
<?php echo validation_errors(); ?>

<?php echo form_open('user/create'); ?>

    <label for="email">Email</label>
    <input type="input" name="email" /><br />

    <label for="name">Name</label>
    <input type="input" name="name"></input><br />

    <label for="password">Password</label>
    <input type="password" name = "password"></input><br />

    <input type="submit" name="submit" value="Create my account!" />

</form>
