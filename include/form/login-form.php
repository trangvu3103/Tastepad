<section class="form-deactive" id="login-sec">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-6">
        <div class="login-txt" id="login-txt">
          <div>
            Login to begin your journey!
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="login-form">
          <div class="flipper">
            <div class="flip-wrap">
              <span id="login-flip" class="flipper-active">Log in</span>
              <span>/</span>
              <span id="signup-flip">Sign up</span>
            </div>
            <div class="closer" id="closer">
              <img src="img/icon/closer.png" alt="">
            </div>
          </div>
          <!-- Do not remove form id -->
          <form id="login-form" class="">
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="text" class="form-control" id="email" placeholder="My email is...">
            </div>
            <div class="form-group">
              <label for="Password">Password</label>
              <input name="password" type="text" class="form-control" id="pass" placeholder="Password is...">
            </div>
            <button type="submit" name="login" id="log-in-btn">Login</button>
          </form>
          <!-- Do not remove form id -->
          <form id="signup-form" class="form-deactive">
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="text" class="form-control" placeholder="My email is...">
            </div>
            <div class="form-group">
              <label for="full-name">Full name</label>
              <input name="full-name" type="text" class="form-control" placeholder="My full name is...">
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input name="pass" type="text" class="form-control" placeholder="Password is...">
            </div>
            <div class="form-group">
              <label for="re=pass">Re-enter password</label>
              <input name="re-pass" type="text" class="form-control" placeholder="Re-enter password...">
            </div>
            <button type="submit" name="signup" id="sign-up-btn">Sign up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
