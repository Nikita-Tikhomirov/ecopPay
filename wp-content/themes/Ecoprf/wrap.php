<?php

$sizeNow = $_POST['sizeNow'];
$output = (int)$sizeNow;

// echo $otput;
if($output > 600){
  if (have_rows('razdel_kursa')):
    $i = 0;
    while (have_rows('razdel_kursa')):
      the_row();
     echo the_sub_field('nazvanie_razdela');
  
    endwhile; 

  endif; 

  
}else{
  echo '3';

}


?>