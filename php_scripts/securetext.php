<?php
  
function secure($string){
  return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}
?>
