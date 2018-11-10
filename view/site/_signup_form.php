<?
use helper\Site;
Site::app()->title = 'Signup';
?>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <h1>Signup</h1>
      <form action="?site/signup" method="post">
        <div class="form-group">
          <input type="text" class="form-control" name="signup_username" id="signup_username" aria-describedby="signup_username_help" placeholder="Username">
        </div>
        <div class="form-group">
          <input type="email" class="form-control" name="signup_email" id="signup_email" aria-describedby="signup_email_help" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="signup_first_name" id="signup_first_name" aria-describedby="signup_first_name_help" placeholder="First Name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="signup_surename" id="signup_surename" aria-describedby="signup_surename" placeholder="Surename">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="signup_password" id="signup_password" placeholder="Password">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="signup_reenter_password" id="signup_reenter_password" placeholder="Re-enter Password">
        </div>
        <button type="submit" class="btn btn-primary">Signup</button>
    </form>
  </div>
</div>