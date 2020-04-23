<?php
/**
 * Class: User
 * This is for all user functions
 */
require_once 'sessions.php';
require_once 'DB.php';
class user
{
  //user for connection
  protected $conn; 

  //User's Variable:
  
  protected $user_info; // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
  }

  public function setSession()
  {
      Session::set('uid', $this->user_info['userID']);
      Session::set('name', $this->user_info['userName']);
      Session::set('avartar', $this->user_info['userAvatar']);
      Session::set('isLoggin', true);
      Session::set('role', $this->user_info['userRole']);
  }

  public function register($email = null, $fullName = null, $pw = null, $pw1 = null){
    $verifyCreateAccount = $this->verifyCreateAccount($email, $fullName, $pw, $pw1);
    if($verifyCreateAccount==0){
      $this->createAccount($email, $fullName, $pw);
      $this->setSession();
      // header('Location: home-page.php');
      return 0;
    }
    //when error occur delete connection?
    if(!empty($this->err)){
      unset($this->conn);
    }

    return $verifyCreateAccount;
  }

  public function login($email = null, $password = null){
    $verifyLogin = $this->verifyLogin($email, $password);
    if($verifyLogin==0){
      $this->setSession();      // header('Location:home-page.php');
      return 0;
    }
    //when error occur delete connection?
    if(!empty($this->err)){
      unset($this->conn);
    }

    return $verifyLogin;
  }

  public function verifyLogin($email = null, $password = null){
    if (!$email) {
      $this->err = "Please enter your email";
      return 1;
    }
    
    if (!$email || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $this->err = "Invalid email. Please re-enter Email";
      return 1;
    }
    
    if(!$this->findEmail($email)){
      $this->err = "Email not found. Please re-enter Email";
      return 1;
    }
    
    if (!$password) {
      $this->err = "Please enter your password";
      return 1;
    }

    if(!password_verify($password, $this->user_info['userPassword'])){
      $this->err = (password_verify($password, $this->user_info['userPassword'])."Wrong password. Please enter your password again");
      return 1;
    }

    if($this->user_info['lockStatus']){
      $this->err = "Failed to login, the account has been locked";
      return 1;
    }

    return 0;
  }

  public function verifyCreateAccount($email = null, $fullName = null, $pw = null, $pw1 = null){
    if (!$email) {
      $this->err = "Please enter your email";
      return 1;
    }
    
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $this->err="Invalid email. Please re-enter Email";
      return 1;
    }

    if($this->findEmail($email)){
      $this->err = "This email has been registered. Please re-enter Email";
      return 1;
    }

    if (!$fullName || strlen($fullName)<1) {
      $this->err = "Please enter your full name";
      return 1;
    }
    
    if($this->findUserName($fullName)){
      $this->err = "This name has been registered. Please re-enter the name";
      return 1;
    }
    
    if (!$pw) {
      $this->err = "Please enter your password";
      return 1;
    }
    
    if (!$pw1) {
      $this->err = "Please enter the password again";
      return 1;
    }

    if($pw != $pw1){
      $this->err = "The password and re-enter password do not match. Please enter the Re-enter password again";
      return 1;
    }

    return 0;

  }

  public function createAccount($email = null, $fullName = null, $pw = null)
  {
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $sql="INSERT INTO users values(DEFAULT, '$fullName', '$email', '$pw', '', '', '', 1, DEFAULT, DEFAULT, DEFAULT)";
    $result = $this->conn->query($sql);
    return ($result && isset($result->num_rows))?$result->num_rows:false;
  }

  public function findEmail($email=null)
  {
    if ($email==null) {
      return null;
    }
    $sql = "SELECT * FROM users WHERE userEmail = '$email'";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->user_info = $result->fetch_assoc();
    }
    return ($result && $result->num_rows)?$result->num_rows:false;
  }

  public function findUserName($name=null)
  {
    if ($name==null) {
      return null;
    }
    $sql = "SELECT * FROM users WHERE userName = '$name'";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->user_info = $result->fetch_assoc();
    }
    return ($result && $result->num_rows)?$result->num_rows:false;
  }
  
  public function findUserByID($UID=null)
    {
      if ($UID==null) {
        return null;
      }
      $sql = "SELECT * FROM users WHERE userID = '$UID'";
      $result = $this->conn->query($sql);
      if ($result) {
        $this->user_info = $result->fetch_assoc();
      }
      return ($result && $result->num_rows)?$result->num_rows:false;
    }

  // get user info for user class
  public function getUserInfo (){
    return $this->user_info;
  }

  // get and set name for user class
  public function gsetName ($name=null){
    if($name!=null){
      $user_name = $name;
    }
    return $user_name;
  }

  // get and set email for user class
  public function gsetEmail ($email=null){
    if($email!=null){
      $user_email = $email;
    }
    return $user_email;
  }

// get and set role for user class
  public function gsetRole ($role=null){
    if($role!=null){
      $user_role = $role;
    }
    return $user_role;
  }

}
 ?>