<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
          // Подключаем ядро wordpress 
          require_once( dirname(__FILE__) . '/wp-load.php' );
          require_once( dirname(__FILE__) . '/wp-admin/includes/admin.php');

  // Создаём XML-документ версии 1.0 с кодировкой utf-8
  $dom = new domDocument("1.0", "utf-8"); 
  $dom->formatOutput = true;


    // Создаём корневой элемент yml_catalog
    $yml_catalog = $dom->createElement('yml_catalog'); 
    // получаем дату и время генерации
    $dateNow = date("Y-m-d H:i:s"); 
    // Устанавливаем в yml_catalog атрибут даты и передаем в него значение 
    $yml_catalog->setAttribute("date", $dateNow); 
    // Вставка в документ yml_catalog
    $dom->appendChild($yml_catalog);


      // Создаем елемент shop
      $shop = $dom->createElement('shop'); 
      // Вставка shop в yml_catalog
      $yml_catalog->appendChild($shop); 

        // Создаём элемент name
        $yml_name = $dom->createElement('name','ЕЦОП'); 
        // Вставка name в shop
        $shop->appendChild($yml_name); 

        // Создаём элемент company
        $yml_company = $dom->createElement('company','ООО Единый центр обучения и переподготовки'); 
        // Вставка company в shop
        $shop->appendChild($yml_company); 

        // Создаём элемент url
        $yml_url = $dom->createElement('url','https://ecoprf.ru/'); 
        // Вставка url в shop
        $shop->appendChild($yml_url); 

        // Создаём элемент email
        $yml_email = $dom->createElement('email','info@ecoprf.ru'); 
        // Вставка email в shop
        $shop->appendChild($yml_email); 

        // Создаём элемент picture
        $yml_picture = $dom->createElement('picture','https://ecoprf.ru/wp-content/uploads/2022/11/logo.png'); 
        // Вставка picture в shop
        $shop->appendChild($yml_picture); 

        // Создаём элемент description
        $yml_description = $dom->createElement('description','Единый центр обучения и переподготовки - учебный центр в Санкт-Петербурге по проведению повышения квалификации, профессиональной переподготовки и обучения рабочим профессиям.'); 
        // Вставка description в shop
        $shop->appendChild($yml_description); 

        // Создаём элемент currencies
        $yml_currencies = $dom->createElement('currencies'); 
        // Вставка currencies в shop
        $shop->appendChild($yml_currencies); 

          // Создаём элемент currency
          $yml_currency = $dom->createElement('currency'); 
          // Устанавливаем в currency атрибут id и передаем в него значение 
          $yml_currency->setAttribute('id','RUR');
          // Устанавливаем в currency атрибут rate и передаем в него значение 
          $yml_currency->setAttribute('rate','1');
          // Вставка currency в currencies
          $yml_currencies->appendChild($yml_currency); 

        // Создаём элемент categories
        // $yml_categories = $dom->createElement('categories'); 
        // Вставка categories в shop
        // $shop->appendChild($yml_categories); 
          // Вставляем категории
        //   include ("xmlcreator/categories.php");
        // Создаем елемент sets
        $sets = $dom->createElement('sets'); 
          // Всталяем sets в shop
          $shop ->appendChild($sets);
          // Вставляем sets
          include ("xmlcreator/sets.php");

        // Создаем елемент offers
        $offers = $dom->createElement('offers'); 
        // вставляем offers в shop
        $shop->appendChild($offers); 




          // Получаем курсы
          $myCourses = get_posts( array(
            'post_type' => 'post',
            'numberposts' => -1,
            'order'       => 'ASC',
            'meta_key'    => 'dobavit_v_xml',
            'meta_value'  =>'1',
            // 'include' => 125,
          ) );

          // Цикл создающий offer`ы из курсов
          for ($i = 0; $i < count($myCourses); $i++) {
            // Получит id поста
            $post_id = $myCourses[$i]->ID;
            //  получить заголовок курса
            $post_title = get_the_title( $myCourses[$i] );
            // получить slug курса
            $post_slug = $myCourses[$i]->post_name;
            // Получить ссылку на курс
            $post_url = get_permalink($myCourses[$i]);
            // Получаем стоимость курса из курса
            $post_price = get_post_meta( $post_id, 'stoimost_kursa', true );


            // Получаем продолжительность курса из курса
            // $post_duration = get_post_meta( $post_id, 'prodolzhitelnost', true );
            // Оставляем только число
            // $post_duration_filtred = filter_var($post_duration, FILTER_SANITIZE_NUMBER_INT);
            // получаем повторитель с планом
            // $post_duration = get_post_meta( $post_id, 'plan_kursa', true );

              $post_duration = 0;
            // проверяем есть ли в повторителе данные
$post_duration = 0;

if( have_rows('plan_kursa', $post_id) ):

    while ( have_rows('plan_kursa', $post_id) ) : the_row();

        $hoursVariable = get_sub_field('chasy');
        $hoursVariableFilterd = (int) filter_var($hoursVariable, FILTER_SANITIZE_NUMBER_INT);
        $post_duration += $hoursVariableFilterd;

    endwhile;

endif;

              $post_duration_filtred = $post_duration;



            $post_education_type = get_post_meta( $post_id, 'tip_obucheniya', true );
            // Получаем сложность из курса
            $post_difficults = get_post_meta( $post_id, 'slozhnost', true );
            // Получаем результат из курса
            $post_result = get_post_meta( $post_id, 'rezultat_obucheniya', true );
            // Получаем фото из курса
            $post_kartinka_kursa_id = get_post_meta( $post_id, 'kartinka_kursa', true );
            $post_kartinka_kursa = wp_get_attachment_image_src($post_kartinka_kursa_id);
            //  Получаем описание из yoast
            $post_description1 = get_post_meta( $post_id, '_yoast_wpseo_metadesc', true );
              // создать description и передать текст
              $course_description1 = $dom->createElement('description', $post_description1); 
            // Создать offer
            $course_offer = $dom->createElement("offer"); 
            // Добавить атрибут id офферу и передать в него значение
            $short_id = mb_substr($post_slug, 0, 80);
            $course_offer->setAttribute('id', $short_id);

              //  Создать name 
              $course_name = $dom->createElement("name", $post_title); 
              // создать url
              $course_url = $dom->createElement("url", $post_url); 
              
              // создать price
              $course_price = $dom->createElement("price", ($post_price+($post_price*0.3)));

              // создаем параметр Цена по скидке 
              $course_price_param_discount = $dom->createElement('param', $post_price);
              // Добавляем ия в параметр
              $course_price_param_discount -> setAttribute('name','Цена по скидке');
              // создать currencyId
              $course_currencyId = $dom->createElement('currencyId','RUR');
              // создать param продолжительность 
              $course_duration = $dom->createElement('param', $post_duration_filtred);
              // добавить параметру атрибуты name и unit
              $course_duration -> setAttribute('name','Продолжительность');
              $course_duration -> setAttribute('unit','час');                 
              // создать param Есть текстовые уроки
              $course_have_a_text_lessons = $dom->createElement('param', 'true');
              // Добавляем параметру атрибут name 
              $course_have_a_text_lessons ->setAttribute('name','Есть текстовые уроки');
              // создать param Тип обучения
              $course_education_type = $dom->createElement('param', $post_education_type);   
              // Добавить атрибут name
              $course_education_type ->setAttribute('name','Тип обучения');
              // создать param Сложность
              $course_difficults = $dom->createElement('param', $post_difficults);   
              // Добавить атрибут name
              $course_difficults ->setAttribute('name','Сложность');
              // создать param Результат обучения
              $course_result = $dom->createElement('param', $post_result);   
              // Добавить атрибут name
              $course_result ->setAttribute('name','Результат обучения');
              // создать picture и передать картинку
              $course_kartinka = $dom->createElement('picture', $post_kartinka_kursa[0]);  

              //  Добавить в оффер имя
              $course_offer->appendChild($course_name); 
              // Добавить в offer url
              $course_offer->appendChild($course_url); 

 




                // Цикл создающий categoryId
                if( have_rows('kategorii_dlya_xml', $post_id ) ):
                  while ( have_rows('kategorii_dlya_xml', $post_id ) ) : the_row();
                      $kategoriya_dlya_xml = get_sub_field('kategoriya_dlya_xml');
                      $course_category_id = $dom->createElement('categoryId', $kategoriya_dlya_xml);  
                      $course_offer->appendChild($course_category_id);
                  endwhile;
                else :
                  // no rows found
                endif;

                // Цикл создающий set-ids
                if( have_rows('sety', $post_id ) ):
                  while ( have_rows('sety', $post_id ) ) : the_row();
                      $id_seta = get_sub_field('id_seta');
                      $course_set_id = $dom->createElement('set-ids', $id_seta);  
                      $course_offer->appendChild($course_set_id);
                  endwhile;
                else :
                  // no rows found
                endif;

              // Добавить в offer price
              $course_offer->appendChild($course_price); 
              $course_offer->appendChild($course_price_param_discount); 

              // Добавить в offer currencyId
              $course_offer->appendChild($course_currencyId);
              // Добавить в offer параметр продолжительность
              $course_offer->appendChild($course_duration);
              // Добавить в offer параметр есть текстовые уроки
              $course_offer->appendChild($course_have_a_text_lessons);
              // Добавить в offer параметр тип обучения
              $course_offer->appendChild($course_education_type);
              // Добавить в offer параметр сложность
              $course_offer->appendChild($course_difficults);
              // Добавить в offer параметр Результат обучения
              $course_offer->appendChild($course_result);
              // Добавить в offer picture
              $course_offer->appendChild($course_kartinka);
              // Добавить в offer course_description
              $course_offer->appendChild($course_description1); 

                // Цикл создающий планы
              if( have_rows('plan_kursa', $post_id ) ):
                $plans_counter = 0;
                while ( have_rows('plan_kursa', $post_id ) ) : the_row();
                    $plan_order= get_row_index();
                    $plan_name = get_sub_field('nazvanie');
                    $plan_hours = get_sub_field('chasy');
                    $plan_description = get_sub_field('opisanie');
                    // Do something...
                    $plan_content_start = '';
                    $plan_content_end = ''.'';
                    $plan_content = $plan_content_start.$plan_description.$plan_content_end;
                    
                    $course_plan = $dom->createElement('param', $plan_content);  
                    $course_plan ->setAttribute('name','План');
                    $course_plan ->setAttribute('order', $plan_order);
                    $course_plan ->setAttribute('unit', $plan_name);
                    $course_plan ->setAttribute('hours', $plan_hours);

                    $course_offer->appendChild($course_plan);

                endwhile;
              else :
                // no rows found
                
              endif;


            //  добавить сгенерированный offer в offers
            $offers->appendChild($course_offer); 
            // сбрасываем переменную $post
            wp_reset_postdata(); 
          }

  // Сохраняем полученный XML-документ в файл
  $dom->save("users.xml"); 
  
?>

</body>
</html>

