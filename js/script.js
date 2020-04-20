document.getElementById('form-btn').onclick = function () {
  var form = document.getElementById('login-sec');
  form.classList.remove("form-deactive");

  var login = document.getElementById('login-flip');
  var signup = document.getElementById('signup-flip');
  var signupForm = document.getElementById('signup-form');
  var loginForm = document.getElementById('login-form');
  var logTxt = document.getElementById('login-txt');
  login.onclick = function () {
    logTxt.innerHTML = "Login to begin your journey!";  
    signupForm.classList.add("form-deactive");
    loginForm.classList.remove("form-deactive");
  }

  signup.onclick = function () {
    logTxt.innerHTML = "Don't have an account? Let's sign you up!";
    signupForm.classList.remove("form-deactive");
    loginForm.classList.add("form-deactive");
  }

};
