<!DOCTYPE html>
<html lang="en">
    <head>
        <title id="pageTitle">Administration Login</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <script src="libs/jquery/jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="themes/default/Login/style.css" type="text/css" media="screen"/>
    </head>
    <body>
        <div id="container">        
            <div id="errorMessage">
            </div>

            <?php $this->showLanguageChooser(); ?>
            <form name="login" method="post" action="" id="loginform">
            <div id="login">
                <div id="branding">
                    <img id="imgLogo" alt="MongoUI Logo" src="themes/default/images/logo-mongoui.png" border="0" height="75"/>
                </div>
                <div id="panelLogin">
                    <div>
                        <label><?php echo $this->translate("Login.Username"); ?></label>
                        <input type="text" class="textbox340" name="txtLogin" id="txtLogin" value=""/>
                    </div>
                    <div>
                        <label><?php echo $this->translate("Login.Password"); ?></label>
                        <input type="password" class="textbox340" name="txtPassword" id="txtPassword" value=""/>
                    </div>
                    <div class="submit clearfix">
                        <input type="submit" name="btnLogin" id="btnLogin" value="<?php echo $this->translate("Login.Login"); ?>" />
                    </div>
                    <p class="info">
                        <a href="#" class="selectdb"><?php echo $this->translate("Login.SelectDatabase"); ?></a>
                        <?php echo $this->translate("Login.Or"); ?>
                        <a href="http://mongoui.org/docs/" target="_blank"><?php echo $this->translate("Login.NeedHelp"); ?>?</a>
                    </p>
                </div>
            </div>
            <!-- END #login -->
        </form>
        </div>
        <script language="javascript" type="text/javascript">
            if (document.getElementById('txtLogin'))
                document.getElementById('txtLogin').focus();
        </script>
    </body>
</html>