
<html>
        <head>
                <title>filterfox</title>
                <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
                <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
                <style media="screen">
                nav{
                    position:relative;
                    background-color:rgb(10,145,56);
                  }
                </style>
        </head>
        <nav>
              <div class="pure-g">
                  <div class="pure-u-1-3"><p><h1>FilterFox</h1></p></div>
                  <div class="pure-u-1-3"><p><h3><?php echo $title; ?></h3></p></div>
                  <div class="pure-u-1-3"><p>
                    <?php echo form_open('user/log_out'); ?>
                            <input type="submit" name="logout" value="logout"/>
                        </form>
                  </p></div>
              </div>
            </nav>
            <body>
