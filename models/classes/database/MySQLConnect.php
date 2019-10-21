<?php
//database setup - singleton design pattern
define('DB_NAME',"sample");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"");
define('DB_ADDRESS',"localhost");

class MySQLConnect{
  private static $result;
  private function __construct(){}
  public static function get_instance(){
    if(empty(self::$result)){
      @self::$result=new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
      @self::$result->set_charset("utf8");
      if(mysqli_connect_errno()){
        echo 'Error: Veritabanina baglanti saglanamadi. ';
		exit;
      }
      @self::$result->autocommit(TRUE);
    }
    return self::$result;
  }
  protected static function reset_mysqli(){
    @self::$result->close();
      @self::$result=new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
      @self::$result->set_charset("utf8");
    if(mysqli_connect_errno()){
      echo 'Error: Veritabanina baglanti saglanamadi.';
      exit;
    }
    @self::$result->autocommit(TRUE);
  }
  protected static function set_mysqli_connection($web_address, $username, $password, $db_name){
    @self::$result->close();
    @self::$result=new mysqli($web_address, $username, $password, $db_name);
    @self::$result->set_charset("utf8");
    if(mysqli_connect_errno()){
      echo 'Error: Veritabanina baglanti saglanamadi.';
      exit;
    }
    @self::$result->autocommit(TRUE);
}

  private function __destruct(){
    self::$result->close();
    unset(self::$result);
  }
}

?>
