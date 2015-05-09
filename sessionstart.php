<?php
    session_start();
                   $_SESSION['position']='boss';
                   $_SESSION['person']='bilal';


      if ($_SESSION['position']='boss')
      {
             echo $_SESSION['position'];
      }
      if ($_SESSION['position']='processor')
      {
             echo $_SESSION['position'];
      }
      if ($_SESSION['position']='accounting')
      {
             echo $_SESSION['position'];
      }
      if ($_SESSION['position']='buyer')
      {
             echo $_SESSION['position'];
      }
      
      echo $_SESSION['person'];
?>