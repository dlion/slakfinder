<?php session_start(); 
echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Package Finder - developing</title>
  </head>
  <style type="text/css">
  <!--
    a:link    {text-decoration: none; color: blue;}
    a:visited {text-decoration: none; color: blue;}
    a:hover   {text-decoration: underline; color: red;}
    input {border:1px solid #000000;}
  .repository {border:1px solid #000000;}
  .repository td { border-top:1px solid #000000; border-right:1px dotted; }
  .repository th { border-right:1px dotted; }
  .results {border:1px solid #000000;}
  .results td { border-top:1px solid #000000; border-right:1px dotted; }
  .results th { border-right:1px dotted; }
  .gb {border:none; border-bottom:1px dotted #000000; }
  .gb td { border-top:1px dotted #000000; padding:2px; }

  -->
  </style>
<body>
<?php
  include 'inc/includes.inc.php';

  $maxresult=30;
  $start=0;
  $db=new database();
  if(!isset($_SESSION['last_search2']))$_SESSION['last_search2']="";
  if(!isset($_SESSION['searcher2_visitor'])){
    $db->counter_inc('visits');
    $_SESSION['searcher2_visitor']=$db->counter_get('visits');
  }
  #echo "You are the ".$_SESSION['searcher_visitor']."st visitor<br />";
  $distro=$wo=$q=$ver=$search=$name=$desc=$file=$repo=$order=null;
  foreach($_GET as $key => $value)$$key=$value;
  if ($name or $desc or $file) {
    if(($start==0)and($_SESSION['last_search']!="name=$name&desc=$desc&file=$file")){
      $_SESSION['last_search2']="name=$name&desc=$desc&file=$file";
      $db->counter_inc('searches');
    }
  }
  #echo "Searched ".$db->counter_get('searches')." packages from 6 March 2010<br /><br />";
  $hrepos="";
  if ($name or $desc or $file){
    $hrepos.="<div style='color:red' id='wait1'>Wait a moment...";
    if($file)$hrepos.=" (up 2 minutes)";
    $hrepos.="</div>";
  }
  $hrepos.="

<form action='index.php?#results'>
  <input type='hidden' name='act' value='search'>
  <input type='hidden' name='start' value='0'>
  <input type='hidden' name='order' value=''>
  <input type='hidden' name='maxresult' value='$maxresult'>
  ";

  $frm=new form();

  $hrepos.=$frm->show();
  if ($name or $desc or $file){
    $hrepos.="<div style='color:red' id='wait2'>Wait a moment...";
    if($file)$hrepos.=" (up 2 minutes)";
    $hrepos.="</div>";
  }
  $hrepos.="</form> <a name='results'></a> ";
  $ord="";

  echo $hrepos;
  if ($search){
    echo "Search Engine is in Re-Developing status";
    //echo search();
  }
?>
</body></html>