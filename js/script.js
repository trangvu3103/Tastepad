document.getElementById('form-btn').onclick = function () {
  var form = document.getElementById('login-sec');
  form.classList.remove("form-deactive");
  form.classList.remove("form-fadeOut");
  form.classList.add("form-active");

  var closer = document.getElementById('closer');
  closer.onclick = function () {
    form.classList.remove("form-active");
    form.classList.add("form-fadeOut");
    setTimeout (function () { form.classList.add("form-deactive"); },500);
  }

  var login = document.getElementById('login-flip');
  var signup = document.getElementById('signup-flip');
  var signupForm = document.getElementById('signup-form');
  var loginForm = document.getElementById('login-form');
  var logTxt = document.getElementById('login-txt');

  login.onclick = function () {
    logTxt.innerHTML = "<div>Login to begin your journey!</div>";
    signupForm.classList.add("form-deactive");
    loginForm.classList.remove("form-deactive");
    loginForm.classList.add("form-active");
    login.classList.add("flipper-active");
    signup.classList.remove("flipper-active");
    logTxt.classList.add("form-active");
    setTimeout (function () { logTxt.classList.remove("form-active"); },500);
  }

  signup.onclick = function () {
    logTxt.innerHTML = "<div>Don't have an account? Let's sign you up!</div>";
    signupForm.classList.remove("form-deactive");
    signupForm.classList.add("form-active");
    loginForm.classList.add("form-deactive");
    login.classList.remove("flipper-active");
    signup.classList.add("flipper-active");
    logTxt.classList.add("form-active");
    setTimeout (function () { logTxt.classList.remove("form-active"); },500);
  }
};
