<?php

  $login_pass = true;
  if(isset($errors['empty_login'])){
    $login_pass = false;
  }

  $password_pass = true;
  if(isset($errors['empty_password'])){
    $password_pass = false;
  }

  $this -> view('head');
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?=base_url('admin/login')?>">
                        <fieldset>
                            <div class="form-group <?php if(!$login_pass) echo 'has-error'; ?>">
                                <?php if(!$login_pass){ ?>
                                  <label class="control-label" for="inputError">Puste pole login</label>
                                <?php } ?>
                                <input class="form-control" placeholder="Login" name="login" type="text" autofocus>
                            </div>
                            <div class="form-group <?php if(!$password_pass) echo 'has-error'; ?>">
                                <?php if(!$password_pass){ ?>
                                  <label class="control-label" for="inputError">Puste pole hasło</label>
                                <?php } ?>
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

  $this -> view('footer');

  ?>
