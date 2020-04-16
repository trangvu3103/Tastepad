<?php
/**
 * Class: User
 * This is for all user functions
 */

class User
{
  //user for connection
  protected $conn; 

  //User's Variable:

  public $user_info; // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
  }

  public function register($email = null, $fullName = null, $pw = null, $pw1 = null){
    $verifyCreateAccount = $this->verifyCreateAccount($email, $password);
    if($verifyCreateAccount==0){
      $_SESSION['user_name'] = $this->user_info['userName']);
      $_SESSION['isLoggin'] = true;
      $_SESSION['role'] = $this->user_info['userRole']);

      header('Location: gallery.php');
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
      $_SESSION['user_name'] = $this->user_info['userName']);
      $_SESSION['isLoggin'] = true;
      $_SESSION['role'] = $this->user_info['userRole']);

      header('Location: gallery.php');
      return 0;
    }
    //when error occur delete connection?
    if(!empty($this->err)){
      unset($this->conn);
    }

    return $verifyLogin;
  }

  public function verifyLogin($email = null, $password = null){
    if ($email == null) {
      $this->err[] = "Xin vui lòng nhập email";
      return 1;
    }
    
    if ($password == null) {
      $this->err[] = "Xin vui lòng nhập password";
      return 1;
    }

    if(!$this->findEmail($email)){
      $this->err[] = "Không tìm thấy Email. Xin nhập lại Email";
      return 1;
    }

    if(!password_verify($password, $this->user_info['userPassword'])){
      $this->err[] = "Sai mật khẩu. Xin nhập lại mật khẩu";
      return 1;
    }

    if($this->user_info['lockStatus']){
      $this->err[] = "Đăng nhập không thành công, tài khoản đã bị khóa";
      return 1;
    }

    return 0;
  }

  public function verifyCreateAccount($email = null, $fullName = null, $pw = null, $pw1 = null){
    if ($email == null) {
      $this->err[] = "Xin vui lòng nhập email";
      return 1;
    }
    
    if ($fullName == null|| strlen($fullName)>0) {
      $this->err[] = "Xin vui lòng nhập Full name";
      return 1;
    }
    
    if ($pw == null) {
      $this->err[] = "Xin vui lòng nhập Password";
      return 1;
    }
    
    if ($pw1 == null) {
      $this->err[] = "Xin vui lòng nhập Re-enter password";
      return 1;
    }

    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $this->err[]="Email không hợp lệ. Xin nhập lại Email";
      return 1;
    }

    if($this->findEmail($email)){
      $this->err[] = "Email bị trùng khớp. Xin nhập lại Email";
      return 1;
    }

    if($pw != $pw1){
      $this->err[] = "Password và re-enter password ko trùng khớp. Xin nhập lại Re-enter password";
      return 1;
    }

    return 0;

  }

  public function findEmail($email=null)
  {
    if ($email==null) {
      return null;
    }
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $this->conn->query($sql);
    $this->user_info = $result->fetch_assoc();
    return $result->num_rows;
  }

  // get user info for user class
  public function getUserInfo (){
    return $this->user_info;
  }

//   // get and set name for user class
//   public function gsetName ($name=null){
//     if($name!=null){
//       $user_name = $name;
//     }
//     return $user_name;
//   }

//   // get and set email for user class
//   public function gsetEmail ($email=null){
//     if($email!=null){
//       $user_email = $email;
//     }
//     return $user_email;
//   }

// // get and set role for user class
//   public function gsetRole ($role=null){
//     if($role!=null){
//       $user_role = $role;
//     }
//     return $user_role;
//   }

}
 ?>