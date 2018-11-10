
<?
use helper\Site;
Site::app()->title = 'Signin';
?>
 
<div class="row">  
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <h1 class="text-right">Signin</h1>
    <form action="?site/signin" method="post">
      <div class="form-group">
        <label for="signin_username_email">Username or Email:</label>
        <input type="text" class="form-control" name="signin_username_email" id="signin_username_email">

      </div><div class="form-group">
        <label for="signin_password">Password:</label>
        <input type="password" class="form-control" name="signin_password" id="signin_password" placeholder="">
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="signin_remember" id="signin_member" value="true"> Remember Me
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Signin</button>
    </form>
  </div>

  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    <h1 class="text-center">Or</h1>
  </div>

  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <h1>Signup</h1>
      <form action="?site/signup" method="post">
        <div class="form-group">
          <label for="signup_username">Username:</label>
          <input type="text" class="form-control" name="signup_username" id="signup_username" aria-describedby="signup_username_help" placeholder="">
          <small id="signup_username_help" class="form-text text-muted">Display name outside your network.</small>        
        </div>
        <div class="form-group">
          <label for="signup_email">Email:</label>
          <input type="email" class="form-control" name="signup_email" id="signup_email" aria-describedby="signup_email_help" placeholder="">
          <small id="signup_email_help" class="form-text text-muted">Your active email address</small>
        </div>
        <div class="form-group">
          <label for="signup_first_name">First Name:</label>
          <input type="text" class="form-control" name="signup_first_name" id="signup_first_name" aria-describedby="signup_first_name_help" placeholder="">
          <small id="signup_first_name_help" class="form-text text-muted">Should be your real name.</small>
        </div>
        <div class="form-group">
          <label for="signup_surename">Surename:</label>
          <input type="text" class="form-control" name="signup_surename" id="signup_surename" aria-describedby="signup_surename" placeholder="">
          <small id="signup_surename" class="form-text text-muted">Should be your real surename</small>
        </div>
        <div class="form-group">
          <label for="signup_password">Password:</label>
          <input type="password" class="form-control" name="signup_password" id="signup_password" placeholder="">
        </div>
        <div class="form-group">
          <label for="signup_reenter_password">Re-enter Password:</label>
          <input type="password" class="form-control" name="signup_reenter_password" id="signup_reenter_password" placeholder="">
        </div>
        <button type="submit" class="btn btn-primary">Signup</button>
    </form>
  </div>
</div>

