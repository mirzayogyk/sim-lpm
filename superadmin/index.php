<!DOCTYPE html>
<html lang="en">
    <?php
session_start(); 
?>
<head>
        <title>SINORMAS ADMIN</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="../css/maruti-login.css" />
    </head>
    <body>
        <div id="logo">
            <img src="../img/login-logo.png" alt="" />
        </div>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" method="post" action="../?page=Login-Validasi">
				 <div class="control-group normal_text"><h3>Admin Login</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="txtUser" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="txtPassword"  placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
				
                    <div class="controls"> 
                        <div class="main_input_box"> <label   for="input01"> <?php
//meng-generate angka random integer antara 20 - 50
$jx = rand(30,70);
//meregisterkan angka tersebut ke session
$_SESSION['captchakuis'] = $jx;
$kx = rand(1,29);
$yx = $jx - $kx;
//mencetak ke halaman
echo "<b> ".$yx." + ".$kx." = ? </b>";;
?> </label>
                            <span class="add-on"><i class="icon-eye-close"></i></span> <input type="text" name="jawaban" id="jawaban" maxlength="5">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-success" name="btnLogin" value="Login" /></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions <br/><font color="#FF6633">how to recover a password.</font></p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-info" value="Recover" /></span>
                </div>
            </form>
        </div>
        
        <script src="../js/jquery.min.js"></script>  
        <script src="../js/maruti.login.js"></script> 
    </body>

</html>
