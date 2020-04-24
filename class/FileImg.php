<?php
/**
 *
 */
class FileImages
{
  public $file;//save file for whole the class's sake :D
  public $filename;//name of the file.
  public $newname;//create new name in order to not overwrite each other

  public $location;//file loaction (old)
  public $dest;//set new location for moving file
  public $ext;//check for extention if it is allowed or not
  public $allowed=['png','jpg','jpeg','gif'];

  public $size;//seft-explain

  public $errfile;//when file have their own error when upload file
  public $err;//check for other error and printing error

  //function:
  public function __construct()
  {
    $this->err='';
  }

  //set file and check for error when upload
  public function setFile($file)
  {
    $this->file=$file;
    $this->filename=$this->file['name'];
    $this->location=$this->file['tmp_name'];//set location with tmp_name
    $this->size=$this->file['size'];
    foreach ($this->filename as $v) {
      $ext = explode(".",$v);
      $this->ext[]=strtolower(end($ext));
      
    }
    $this->dest = [];
    $this->errfile=$this->file['error'];
    $this->err='';
  }

  //seft-explain
  public function checksize()
  {
    foreach ($this->size as $v) {
      if ($v>=100000000){
        return false;
      }

    }
    return true;
  }

  //check if the extention of said file is allowed or not
  public function extentionAllowed()
  {
    foreach ($this->ext as $v) {
      var_dump($v);
      var_dump($this->allowed);
      var_dump(in_array($v,$this->allowed));
      if (!in_array($v,$this->allowed)){
        return false;
      }

    }
    return true;
  }

  //move file to new location (in this case our folder)
  public function move($dest)
  {
    $this->err='';
    if($this->errfile){
      if($this->extentionAllowed()){
        if($this->checksize()){
          foreach ($this->filename as $key => $v) {
            $v=uniqid() . '.' . $this->ext[$key];
            $dest1 = str_replace("\\","/", $dest) . '/' . $v;
            move_uploaded_file($this->location[$key],$dest1);
            $this->dest[] = $dest1;
          }
        } else{
          $this->err='Image is too large';
        }
      }else{
        $this->err= 'Please use file .png, .jpg, .jpeg, .gif';
      }
    }else{
      $this->err= 'There is an error loading your file';
    }
    return $this->err;

  }

  //get location to save for the DB
  public function getFileDestination()
  {
    return $this->dest;
  }

}

 ?>
