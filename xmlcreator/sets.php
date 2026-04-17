<?php 


  // проверяем есть ли в повторителе данные
if( have_rows('set','option') ):

  // перебираем данные
   while ( have_rows('set','option') ) : the_row();

       // отображаем вложенные поля
       $nazvanie_seta = get_sub_field('nazvanie_seta');
       $id_seta = get_sub_field('id_seta');
       $ssylka_na_set = get_sub_field('ssylka_na_set');

        // Создаем елемент set
        $set = $dom->createElement('set'); 
        // Добавляем атрибут id и передает в него значение
        $set-> setAttribute('id',$id_seta);

        // Создаем елемент name
        $setName = $dom->createElement('name',$nazvanie_seta); 
        //  Вставляем в set елемент name 
        $set -> appendChild($setName);
        // // Создаем елемент url
        $setUrl = $dom->createElement('url', $ssylka_na_set );
        // //  Вставляем в set елемент url
        $set -> appendChild($setUrl);

        // Всталяем set в  sets
        $sets->appendChild($set);

   endwhile;

else :

   // вложенных полей не найдено

endif;

  
?>