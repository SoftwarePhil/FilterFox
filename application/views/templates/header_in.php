
<html>
        <head>
                <title>filterfox</title>
               <link rel="stylesheet" href="//cdn.rawgit.com/yahoo/pure-release/v0.6.0/pure-nr-min.css">
                <link rel="stylesheet" href="//cdn.rawgit.com/yahoo/pure-release/v0.6.0/pure-min.css">
                <link rel="stylesheet" href="/my_sheet.css">
        </head>
        <nav>
              <div class="pure-g">
                  <div class="pure-u-1-3"><p><h1>FilterFox</h1></p></div>
                  <div class="pure-u-1-3"><p><h3><?php echo $title; ?></h3></p></div>
                  <div class="pure-u-1-3"><p>
                    <?php echo form_open('user/log_out'); ?>
                            <input type="submit" name="logout" value="logout"/>
                            <input type="submit" name="profile" value="profile"/>
                            <input type="submit" name="posts" value="posts"/>
                            <input type="submit" name="new_post" value="new post"/>
                        </form>
                  </p></div>
              </div>
            </nav>
            <body>
