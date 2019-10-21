<?php
class Kategori{
  protected $kategori_adi;
  protected $kategori_id;
  protected $connector;

  function __construct(){
    $this->connector=new MySQLQueries();
  }

  function get_kategoriler() {
   $m_query = "select kategori_id, kategori_adi from kategoriler";
   @$result=$this->connector->c_exec($m_query);
   //initialize variables
   //...
   return $result;
 }

  function get_kategori_adi($catid) {

   // query database for the name for a category id
   $m_query = "select kategori_adi from kategoriler
             where kategori_id=?";
   $param_strs="i";
   $params=array(&$catid);
   print_r("AQER");
   $res=$this->connector->_execQ($m_query, $param_strs, $params);
   //Some initializations if necessary
   //...
   print_r("AQER2");
   return $res;
 }

 function add_kategori($catname){
   $m_query="insert into kategoriler values(?, ?)";
   $param_strs="ss";
   $params=array(&$this->kategori_id, &$catname);
   @$res=$this->connector->insert_execQ($m_query, $param_strs, $params);
   //Some preprocesses if necessary
   //...
   return $res;
 }
 function delete_kategori($catid){

 }
}
?>
