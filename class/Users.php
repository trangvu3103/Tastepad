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
  // public $user_name;
  // public $user_password;
  // public $user_hash;
  // public $user_email;
  // public $user_role;
  public $user_info; // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
  }

  public function register(){

  }

  public function login($email = null, $password = null){
    $verifyLogin = $this->verifyLogin($email, $password);
    if($verifyLogin==1){
      Sessions::set('user_name',$this->user_name);
      Sessions::set('isLoggin',true);
      Sessions::set('role',$this->user_role = $this->user_info['user_role']);
      Sessions::set('Launguage', 'en']);
      header('Location: gallery.php');
      return 0;
    }
    return $verifyLogin
  }

  public function search()
  {
    
  }

  public function verifyLogin(){
    if ($email == null) {
      $this->err[] = "Xin vui lòng nhập email";
      return 0;
    }
    
    if ($password == null) {
      $this->err[] = "Xin vui lòng nhập password";
      return 0;
    }
    if(!$this->findEmail($email)){
      return 0;
    }
    $this->
  }

  public function verifyCreateAccount(){

  }

  function findEmail($email=null)
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