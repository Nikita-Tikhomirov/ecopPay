<?php


// проверяем есть ли в повторителе данные
if( have_rows('kategoriya','option') ):

  // перебираем данные
   while ( have_rows('kategoriya','option') ) : the_row();

       // отображаем вложенные поля
       $nazvanie_kategorii = get_sub_field('nazvanie_kategorii');
       $id_kategorii = get_sub_field('id_kategorii');
       $id_roditelskoj_kategorii = get_sub_field('id_roditelskoj_kategorii');

        // Создаём элемент category
        $yml_category = $dom->createElement('category', $nazvanie_kategorii); 
        // Устанавливаем в category атрибут id и передаем в него значение 
        $yml_category->setAttribute('id',$id_kategorii);




       if($id_roditelskoj_kategorii){
        // Устанавливаем в category атрибут parentId и передаем в него значение 
        $yml_category->setAttribute('parentId',$id_roditelskoj_kategorii);
       }

        // Вставка category в categories
        $yml_categories->appendChild($yml_category); 

   endwhile;

else :

   // вложенных полей не найдено

endif;
?>