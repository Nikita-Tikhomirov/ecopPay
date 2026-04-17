<?php
/**
 * Template Name: Price
 */ ?>

<?php get_header(); ?>




<div class="seo-text-finish-page">
  <h1>
    <?php the_title(); ?>
  </h1>
  <h2 class="tabs-titl-new faq-controls-title">Наименование</h2>
  <?php the_content(); ?>


  <div class="new_tabs_wrap">

    <div class="downloadExcel">Скачать таблицы в Excel</div>

    <div class="new_tabs_naw">



      <div class="new_tabs_naw_links-wrap" counter="0">
        <div class="new_tabs_naw_link_out_wrap">
          <div class="new_tabs_link_cross">+</div>
          <div class="new_tabs_naw_link_out">Повышение квалификации</div>
        </div>
        <div class="new_tabs_naw_link_in_wrap">


        </div>
      </div>


      <div class="new_tabs_naw_links-wrap" counter="1">
        <div class="new_tabs_naw_link_out_wrap">
          <div class="new_tabs_link_cross">+</div>
          <div class="new_tabs_naw_link_out">Профпереподготовка</div>
        </div>
        <div class="new_tabs_naw_link_in_wrap">


        </div>
      </div>



      <div class="new_tabs_naw_links-wrap" counter="2">
        <div class="new_tabs_naw_link_out_wrap">
          <div class="new_tabs_link_cross">+</div>
          <div class="new_tabs_naw_link_out active">Рабочие профессии</div>
        </div>
        <div class="new_tabs_naw_link_in_wrap">
        </div>
      </div>




    </div>




    <div class="new_tabs_content_wrap">


      <div class="new_tabs_block" tabcounter="0">
        <div class="new_tabs_content">
          <?php
          $category_id = 2;
          $categories = get_categories(
            array(
              'parent' => $category_id,
              'hide_empty' => 0
            )
          );

          foreach ($categories as $category) { ?>

            <h2>
              <?php echo $category->name; ?>
            </h2>

            <table class="tablepress tablepress-id-104 tablepress-responsive stacktable large-only">
              <thead>
                <tr class="row-1 odd">
                  <th class="column-1">Название курса</th>
                  <th class="column-2">Часы</th>
                  <th class="column-3" colspan="3">
                    <div class="column-3Title">Дистанционное обучение, руб/чел при коллективных заявках</div>
                    <div class="column-3__col">
                      <span>1+</span>
                      <span>5+</span>
                      <span>10+</span>
                    </div>

                  </th>
                </tr>
              </thead>
              <tbody class="row-hover">
                <?php
                $posts = get_posts(
                  array(
                    'category' => $category->term_id,
                    'numberposts' => -1,
                    'meta_key' => 'rtng',
                    'orderby' => 'meta_value_num',
                  )
                );

                foreach ($posts as $post) {
                  setup_postdata($post); // Устанавливаем глобальный объект $post
              
                  $price = get_field('stoimost_kursa', $post->ID);
                  $price_5 = $price * 0.95; // Цена со скидкой 5%
                  $price_10 = $price * 0.90; // Цена со скидкой 10%
              
                  // Получаем значение продолжительности и оставляем только цифры
                  $prodolzhitelnost = get_field('prodolzhitelnost', $post->ID);
                  $numeric_prodolzhitelnost = preg_replace('/[^0-9\/]/', '', $prodolzhitelnost);

                  echo '<tr class="row-19 odd">
                          <td class="column-1"><a target="_blank"  href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></td>
                          <td class="column-2">' . $numeric_prodolzhitelnost . '</td>
                          <td class="column-3">' . $price . '</td>
                          <td class="column-4">' . $price_5 . '</td>
                          <td class="column-5">' . $price_10 . '</td>
                        </tr>';
                }

                wp_reset_postdata(); // Сбрасываем данные поста
                ?>

              </tbody>
            </table>


          <?php } ?>



        </div>

      </div>


      <div class="new_tabs_block" tabcounter="1">
        <div class="new_tabs_content">
          <?php
          $category_id = 3;
          $categories = get_categories(
            array(
              'parent' => $category_id,
              'hide_empty' => 0
            )
          );

          foreach ($categories as $category) { ?>

            <h2>
              <?php echo $category->name; ?>
            </h2>

            <table class="tablepress tablepress-id-104 tablepress-responsive stacktable large-only">
              <thead>
                <tr class="row-1 odd">
                  <th class="column-1">Название курса</th>
                  <th class="column-2">Часы</th>
                  <th class="column-3" colspan="3">
                    <div class="column-3Title">«Дистанционное обучение*, руб/чел в зависимости от
                      количества слушателей или количества выбранных курсов»</div>
                    <div class="column-3__col">
                      <span>1+</span>
                      <span>5+</span>
                      <span>10+</span>
                    </div>

                  </th>
                </tr>
              </thead>
              <tbody class="row-hover">
                <?php
                $posts = get_posts(
                  array(
                    'category' => $category->term_id,
                    'numberposts' => -1,
                    "meta_key" => "rtng",
                    "orderby" => "meta_value_num",
                  )
                );
                foreach ($posts as $post) {
                  setup_postdata($post); // Устанавливаем глобальный объект $post
              
                  $price = get_field('stoimost_kursa', $post->ID);
                  $price_5 = $price * 0.95; // Цена со скидкой 5%
                  $price_10 = $price * 0.90; // Цена со скидкой 10%
              
                  // Получаем значение продолжительности и оставляем только цифры
                  $prodolzhitelnost = get_field('prodolzhitelnost', $post->ID);
                  $numeric_prodolzhitelnost = preg_replace('/\D/', '', $prodolzhitelnost); // Удаляем все нецифровые символы
              
                  echo '<tr class="row-19 odd">
                                       <td class="column-1"><a target="_blank"  href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></td>
                          <td class="column-2">' . $numeric_prodolzhitelnost . '</td>
                          <td class="column-3">' . $price . '</td>
                          <td class="column-4">' . $price_5 . '</td>
                          <td class="column-5">' . $price_10 . '</td>
                        </tr>';
                }

                wp_reset_postdata(); // Сбрасываем данные поста
                ?>
              </tbody>
            </table>


          <?php } ?>



        </div>

      </div>

      <div class="new_tabs_block" tabcounter="2">
        <div class="new_tabs_content">
          <table class="tablepress tablepress-id-104 tablepress-responsive stacktable large-only">
            <thead>
              <tr class="row-1 odd">
                <th class="column-1">Название курса</th>
                <th class="column-2">Часы</th>
                <th class="column-3" colspan="3">
                  <div class="column-3Title">«Дистанционное обучение*, руб/чел в зависимости от
                    количества слушателей или количества выбранных курсов»</div>
                  <div class="column-3__col">
                    <span>1+</span>
                    <span>5+</span>
                    <span>10+</span>
                  </div>

                </th>
              </tr>
            </thead>
            <tbody class="row-hover">




              <?php
              global $post;

              $myposts = get_posts([
                'posts_per_page' => -1,
                'category' => 24,
                'post_type' => 'post',
                'orderby' => 'title',
                'order' => 'ASC',
              ]);



              foreach ($myposts as $post) {
                setup_postdata($post); // Устанавливаем глобальный объект $post
              
                $price = get_field('stoimost_kursa', $post->ID);
                $price_5 = $price * 0.95; // Цена со скидкой 5%
                $price_10 = $price * 0.90; // Цена со скидкой 10%
              
                // Получаем значение продолжительности и оставляем только цифры
                $prodolzhitelnost = get_field('prodolzhitelnost', $post->ID);
                $numeric_prodolzhitelnost = preg_replace('/\D/', '', $prodolzhitelnost); // Удаляем все нецифровые символы
              
                echo '<tr class="row-19 odd">
                       <td class="column-1"><a target="_blank"  href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></td>
                        <td class="column-2">' . $numeric_prodolzhitelnost . '</td>
                        <td class="column-3">' . $price . '</td>
                        <td class="column-4">' . $price_5 . '</td>
                        <td class="column-5">' . $price_10 . '</td>
                      </tr>';
              }

              wp_reset_postdata(); // Сбрасываем данные поста
              ?>
            </tbody>
          </table>

        </div>

      </div>


    </div>


    <style>
      .new_tabs_naw_link_out {
        cursor: pointer
      }

      .new_tabs_naw_link_in {
        cursor: pointer
      }

      .mobile-tables {
        display: none !important;
      }

      .new_tabs_naw {
        padding-top: 60px;
        padding-right: 20px;
      }

      .tabs-titl-new.faq-controls-title {
        margin-bottom: 0;
        transform: translateY(40px)
      }

      @media (max-width: 576px) {
        .mobile-tables {
          display: block !important;
        }

        .new_tabs_wrap .new_tabs_naw {
          display: none !important;
        }

        .new_tabs_wrap .new_tabs_content_wrap {
          display: none !important;
        }

        .accordion-header::after {
          display: none !important;
        }

      }

      @media(max-width:1200px) {
        .stacktable.large-only {
          display: table !important;
        }
      }
    </style>

    <div class="mobile-tables">
      <div class="acrdn-wrap">






        <div class="accardion__title-new-cval">Повышение квалификации</div>
        <div class="cva-wrap">
          <?php
          $parent_category_id = 2; // ID родительской категории
          $child_categories = get_categories(array('parent' => $parent_category_id));

          foreach ($child_categories as $child_category) {
            $args = array(
              'category' => $child_category->cat_ID,
              'posts_per_page' => -1,
            );
            $posts = get_posts($args);

            if ($posts) {
              ?>
              <div class="subcategory-wrap">
                <div class="cat-title button-for-posts-inside">
                  <?php echo $child_category->name; ?>
                </div>
                <div class="posts-wrap posts-inside">
                  <table class="tablepress tablepress-id-104 tablepress-responsive stacktable large-only">
                    <thead>
                      <tr class="row-1 odd">
                        <th class="column-1">Название курса</th>
                        <th class="column-2">Часы</th>
                        <th class="column-3">Цена</th>
                      </tr>
                    </thead>
                    <tbody class="row-hover">
                      <?php
                      foreach ($posts as $post) {
                        ?>

                        <tr class="row-19 odd">
                          <td class="column-1">
                            <?php the_title() ?>
                          </td>
                          <td class="column-2">
                            <?php the_field('prodolzhitelnost') ?>
                          </td>
                          <td class="column-3">
                            <?php the_field('stoimost_kursa') ?> руб
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                      </body>
                  </table>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>

        <script>
          const buutonCva = document.querySelector('.accardion__title-new-cval')
          const menuCva = document.querySelector('.cva-wrap')

          buutonCva.addEventListener('click', () => {
            buutonCva.classList.toggle('active')
            menuCva.classList.toggle('active')

          })



        </script>


        <style>
          .cva-wrap {
            display: none;
          }

          .cva-wrap.active {
            display: block;
          }

          .accardion__title-new-cval {
            border: 1px solid #0D5BD9;
            padding: 6px 18px 6px 18px;
            color: black;
            border-radius: 50px;
            margin: 0;
            font-size: 18px;
            margin-bottom: 17px;

          }

          .accardion__title-new-cval.active {
            background: #0D5BD9;
            color: #fff;
          }

          .posts-inside {
            display: none;
          }

          .posts-inside.active {
            display: block;
          }

          .button-for-posts-inside {
            border: 1px solid #0D5BD9;
            padding: 6px 18px 6px 18px;
            color: black;
            border-radius: 50px;
            margin: 0;
            font-size: 18px;
            margin-bottom: 5px;
          }

          .button-for-posts-inside.active {
            background: #0D5BD9;
            color: #fff;
          }

          .subcategory-wrap {
            margin-bottom: 15px;
          }
        </style>

        <div class="accardion__title-new-cval1">Профпереподготовка</div>
        <div class="cva-wrap1">
          <?php
          $parent_category_id = 3; // ID родительской категории
          $child_categories = get_categories(array('parent' => $parent_category_id));

          foreach ($child_categories as $child_category) {
            $args = array(
              'category' => $child_category->cat_ID,
              'posts_per_page' => -1,
            );
            $posts = get_posts($args);

            if ($posts) {
              ?>
              <div class="subcategory-wrap">
                <div class="cat-title button-for-posts-inside">
                  <?php echo $child_category->name; ?>
                </div>
                <div class="posts-wrap posts-inside">
                  <table class="tablepress tablepress-id-104 tablepress-responsive stacktable large-only">
                    <thead>
                      <tr class="row-1 odd">
                        <th class="column-1">Название курса</th>
                        <th class="column-2">Часы</th>
                        <th class="column-3">Цена</th>
                      </tr>
                    </thead>
                    <tbody class="row-hover">
                      <?php
                      foreach ($posts as $post) {
                        ?>

                        <tr class="row-19 odd">
                          <td class="column-1">
                            <?php the_title() ?>
                          </td>
                          <td class="column-2">
                            <?php the_field('prodolzhitelnost') ?>
                          </td>
                          <td class="column-3">
                            <?php the_field('stoimost_kursa') ?> руб
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                      </body>
                  </table>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>


        <script>
          const buutonCva1 = document.querySelector('.accardion__title-new-cval1')
          const menuCva1 = document.querySelector('.cva-wrap1')

          buutonCva1.addEventListener('click', () => {
            buutonCva1.classList.toggle('active')
            menuCva1.classList.toggle('active')

          })

        </script>

        <script>
          const allButtonsForChildPosts = document.querySelectorAll('.button-for-posts-inside')
          allButtonsForChildPosts.forEach(function (item, i, arr) {
            item.addEventListener('click', () => {
              item.classList.toggle('active')
              item.nextElementSibling.classList.toggle('active')
            })
          })
        </script>

        <style>
          .cva-wrap1 {
            display: none;
          }

          .cva-wrap1.active {
            display: block;
          }

          .accardion__title-new-cval1 {
            border: 1px solid #0D5BD9;
            padding: 6px 18px 6px 18px;
            color: black;
            border-radius: 50px;
            margin: 0;
            font-size: 18px;
            margin-bottom: 17px;

          }

          .accardion__title-new-cval1.active {
            background: #0D5BD9;
            color: #fff;
          }
        </style>
        <div class="accardionJs">
          <div class="accardion__title">Рабочие профессии</div>
          <div class="accardionContentJs">
            <div class="accardion__content">
              <table class="tablepress tablepress-id-104 tablepress-responsive stacktable large-only">
                <thead>
                  <tr class="row-1 odd">
                    <th class="column-1">Название курса</th>
                    <th class="column-2">Часы</th>
                    <th class="column-3">Цена</th>
                  </tr>
                </thead>
                <tbody class="row-hover">


                  <?php
                  global $post;

                  $myposts = get_posts([
                    'posts_per_page' => -1,
                    'category' => 24,
                    'post_type' => 'post',
                  ]);

                  foreach ($myposts as $post) {
                    setup_postdata($post);
                    ?>
                    <tr class="row-19 odd">
                      <td class="column-1">

                        <?php echo get_the_title($post->ID) ?>
                      </td>
                      <td class="column-2">
                        <?php echo get_field('prodolzhitelnost', $post->ID) ?>
                      </td>
                      <td class="column-3">
                        <?php echo get_field('stoimost_kursa', $post->ID) ?> руб
                      </td>
                    </tr>
                    <?php
                  }
                  wp_reset_postdata();

                  ?>
                  </body>
              </table>
            </div>
          </div>
        </div>
      </div>


    </div>


  </div>


</div>

<style>
  .accordion-group {
    margin: 16px 0;
  }

  .accordion-body {
    display: none;
    padding: 14px 20px;
    background: #FFF;
    border-radius: 5px;
    margin: 8px 0;
    border: 2px solid #BFE2FF;
  }

  .accordion-body>*>.accordion-body {
    background: #FFF;
    margin: 0;
  }

  .accordion-header {
    margin: 8px 0;
    border: 1px solid #0D5BD9;
    padding: 6px 18px 6px 18px;
    color: black;
    border-radius: 50px;
    font-size: 18px;
    position: relative;

  }

  .accordion-header.open {
    background: #0D5BD9;
    color: #fff;
  }

  .accordion-header::after {
    content: "+";
    right: 16px;
    font-family: Courier;
    font-size: 28px;
    line-height: 28px;
    font-weight: bold;

  }


  .new_tabs_wrap {
    display: grid;
    grid-template-columns: 1fr 3fr;
  }

  .new_tabs_naw_link_out_wrap {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 10px;
  }

  .new_tabs_naw_link_in_wrap {
    display: none;
  }

  .new_tabs_naw_link_in_wrap.active {
    display: block;
  }

  .new_tabs_content {
    display: none;
  }

  .new_tabs_content.active {
    display: block;
  }

  .new_tabs_link_cross {
    font-size: 20px;
    cursor: pointer;
    margin-left: 20px;
    margin-right: -8px;
  }

  .new_tabs_naw_link_out_wrap {
    padding: 0px;

  }

  .new_tabs_naw_link_out_wrap.active {

    color: #0D5BD9 !important;
    background-color: #F0F0F0 !important;
  }

  .new_tabs_naw_link_out_wrap.active .new_tabs_naw_link_out {
    color: #0D5BD9 !important;

  }

  .new_tabs_naw_link_out {
    padding: 20px;
    width: 100%;
  }

  .column-3Title {
    color: var(--head-text-color);
    font-weight: 700;
    text-align: center;
    padding-bottom: 10px;
  }

  .column-3__col {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    text-align: center;

  }

  .column-3__col span {
    color: var(--head-text-color);
    font-weight: 700;
  }

  tbody .column-3,
  tbody .column-4,
  tbody .column-5 {
    text-align: center;
  }

  thead .column-3 {
    width: 30%;
  }

  .new_tabs_wrap {
    position: relative;
  }

  .downloadExcel {
    position: absolute;
    top: 0;
    right: 40px;
    background: #0d5bd9;
    color: #fff;
    padding: 13px 44px;
    border-radius: 75px;
    transition: .5s;
    text-align: center;
    cursor: pointer;
  }

  .downloadExcel:hover {
    background: #81f585;
    color: #000;
  }

  .downloadExcel.active {
    top: -70px;
  }

  @media (max-width: 576px) {
    .new_tabs_wrap {
      grid-template-columns: 1fr;
      grid-gap: 20px;
    }

    .seo-text-finish-page {
      padding: 10px;
    }

    .new_tabs_naw {
      border-right: none;
      border-bottom: 2px solid #eee;
      padding-bottom: 5px;
    }

    .new_tabs_content_wrap {
      padding: 10px;
    }


    .new_tabs_naw_link_out_wrap.active {
      background: #40d445;
      color: #ffffff;
      border-radius: 25px;
    }

    .new_tabs_naw_link_out_wrap.active .new_tabs_naw_link_out {
      color: #ffffff;

    }

    .new_tabs_naw_link_out_wrap.active .new_tabs_link_cross {
      color: white;
      margin-left: auto;
    }

    .new_tabs_naw_link_in {
      margin-top: 5px;
      margin-bottom: 5px;
    }

    .new_tabs_naw_link_in.active {
      color: white;
      background: #40d445;
      border-radius: 25px;
    }

    .new_tabs_naw_link_out_wrap {
      color: white !important;
      background: #0D5BD9;
      margin-bottom: 5px;
      border-radius: 25px;
    }

    .new_tabs_naw_link_out_wrap .new_tabs_naw_link_out {
      color: white !important;

    }

    .new_tabs_link_cross {
      color: white !important;

    }

    .st-head-row.st-head-row-main {
      margin-bottom: 4px;
      background: #20a6db72 !important;
    }



    .tablepress th {
      background: #20a6db72 !important;
    }

    .row-1 {
      margin-bottom: 4px;
    }
  }

  @media(max-width:768px) {
    .downloadExcel {
      position: relative !important;
      right: 0 !important;
    }

    .tabs-titl-new {
      display: none;
    }
  }
</style>
<script>

  // добавим всем кнопкам первого уровня атрибут counter

  const allLinksWrap = document.querySelectorAll('.new_tabs_naw_links-wrap')
  const allTabsWrap = document.querySelectorAll('.new_tabs_block')

  allLinksWrap.forEach(function (item, i, arr) {
    item.setAttribute('counter', i)
  })

  allTabsWrap.forEach(function (item, i, arr) {
    item.setAttribute('tabcounter', i)
  })



  // переменные

  const outLinksArr = document.querySelectorAll('.new_tabs_naw_link_out')
  const allTabsArr = document.querySelectorAll('.new_tabs_block')
  const allCrossArr = document.querySelectorAll('.new_tabs_link_cross')
  const allLinksIn = document.querySelectorAll('.new_tabs_naw_link_in')
  const allTabsContentArr = document.querySelectorAll('.new_tabs_content')

  const linkOutWrap = document.querySelector('.new_tabs_naw_link_out_wrap')
  linkOutWrap.classList.add('active')
  outLinksArr[0].classList.add('active')
  allTabsContentArr[0].classList.add('active')

  // Открытие подменю
  allCrossArr.forEach(function (item, i, arr) {

    item.addEventListener('click', () => {
      let crossParent = item.parentElement
      let hidenList = crossParent.nextElementSibling
      if (hidenList.classList.contains('active') == true) {
        hidenList.classList.remove('active')
        crossParent.classList.remove('active')
      } else {
        hidenList.classList.add('active')
        crossParent.classList.add('active')
      }

    })
  })



  // показ таба основной категории

  outLinksArr.forEach(function (item, i, arr) {

    item.addEventListener('click', () => {
      arr.forEach(function (e) {

        e.parentElement.classList.remove('active')


      })
      allTabsContentArr.forEach(function (el) {
        el.classList.remove('active')
      })
      item.parentElement.classList.add('active')
      item.classList.add('active')
      let tabNow = allTabsArr[i]
      let tableNow = tabNow.firstElementChild
      tableNow.classList.add('active')
      allLinksIn.forEach(function (e) {
        e.classList.remove('active')
      })
    })


  })


  // показ таба вложенной категории
  // счетчик для таблиц b


  allLinksIn.forEach(function (item, i, arr) {



    item.addEventListener('click', () => {

      // let outWrap1 = item.parentElement
      // outWrap1.previousElementSibling.classList.add('active')

      // Получаем счетчик для таба из атрибута в подменю
      let itemCounter = Number(item.getAttribute('tabincounter'))

      // Убираем активный класс у всех элементов подменю
      arr.forEach(function (e) {
        if (e.classList.contains('active')) {
          e.classList.remove('active')
        }
      })

      outLinksArr.forEach(function (e) {
        if (e.classList.contains('active') == true) {
          e.classList.remove('active')
        }
      })

      // добавляем активный класс пункту подменю
      item.classList.add('active')

      // Скрываем весь контент
      allTabsContentArr.forEach(function (el) {
        el.classList.remove('active')
      })




      // получаем номер таба
      itemParent = item.parentElement.parentElement
      itemParentCount = itemParent.getAttribute('counter')
      // получаем таб
      let tabNow1 = document.querySelector('[tabcounter=' + CSS.escape(itemParentCount) + ']')

      // получаем блоки с контентом в нужном табе
      let tableNow1Arr = tabNow1.querySelectorAll('.new_tabs_content')

      // добавляем активный класс табу для подменю
      tableNow1Arr[itemCounter + 1].classList.add('active')

    })

  })
</script>



<?php get_footer(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    (function ($, window, document, undefined) {
      "use strict";
      var pluginName = 'simpleAccordion',
        defaults = {
          multiple: false,
          speedOpen: 300,
          speedClose: 150,
          easingOpen: null,
          easingClose: null,
          headClass: 'accordion-header',
          bodyClass: 'accordion-body',
          openClass: 'open',
          defaultOpenClass: 'default-open',
          cbClose: null, //function (e, $this) {},
          cbOpen: null //function (e, $this) {}
        };
      function Accordion(element, options) {
        this.$el = $(element);
        this.options = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        if (typeof this.$el.data('multiple') !== 'undefined') {
          this.options.multiple = this.$el.data('multiple');
        } else {
          this.options.multiple = this._defaults.multiple;
        }
        this.init();
      }
      Accordion.prototype = {
        init: function () {
          var o = this.options,
            $headings = this.$el.children('.' + o.headClass);
          $headings.on('click', { _t: this }, this.headingClick);
          $headings.filter('.' + o.defaultOpenClass).first().click();
        },
        headingClick: function (e) {
          var $this = $(this),
            _t = e.data._t,
            o = _t.options,
            $headings = _t.$el.children('.' + o.headClass),
            $currentOpen = $headings.filter('.' + o.openClass);
          if (!$this.hasClass(o.openClass)) {
            if ($currentOpen.length && o.multiple === false) {
              $currentOpen.removeClass(o.openClass).next('.' + o.bodyClass).slideUp(o.speedClose, o.easingClose, function () {
                if ($.isFunction(o.cbClose)) {
                  o.cbClose(e, $currentOpen);
                }
                $this.addClass(o.openClass).next('.' + o.bodyClass).slideDown(o.speedOpen, o.easingOpen, function () {
                  if ($.isFunction(o.cbOpen)) {
                    o.cbOpen(e, $this);
                  }
                });
              });
            } else {
              $this.addClass(o.openClass).next('.' + o.bodyClass).slideDown(o.speedOpen, o.easingOpen, function () {
                $this.removeClass(o.defaultOpenClass);
                if ($.isFunction(o.cbOpen)) {
                  o.cbOpen(e, $this);
                }
              });
            }
          } else {
            $this.removeClass(o.openClass).next('.' + o.bodyClass).slideUp(o.speedClose, o.easingClose, function () {
              if ($.isFunction(o.cbClose)) {
                o.cbClose(e, $this);
              }
            });
          }
        }
      };
      $.fn[pluginName] = function (options) {
        return this.each(function () {
          if (!$.data(this, 'plugin_' + pluginName)) {
            $.data(this, 'plugin_' + pluginName,
              new Accordion(this, options));
          }
        });
      };
    }(jQuery, window, document));

  jQuery('.accordion-group').simpleAccordion({

    multiple: false, // возможность открытия одной вкладки или всех
    speedOpen: 300, // скорость открытия вкладки
    speedClose: 150, // скорость закрытия вкладки
    easingOpen: null, // эффект плавности открытия вкладки
    easingClose: null, // эффект плавности закрытия вкладки
    headClass: 'accordion-header', // класс для заголовка вкладки
    bodyClass: 'accordion-body', // класс для тела вкладки
    openClass: 'open',  // класс для открытой вкладки, применяется к accordion-header
    defaultOpenClass: 'default-open', // класс для открытой вкладки по умолчанию
    cbClose: null, // callback-функция при закрытии вкладки - function (e, $this) {},
    cbOpen: null // callback-функция при открытии вкладки - function (e, $this) {}

  });


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>
  const exelBtn = document.querySelector('.downloadExcel');
  exelBtn.addEventListener('click', () => {
    const wb = XLSX.utils.book_new();
    const sheetNames = ['Повышение квалификации', 'Профпереподготовка', 'Рабочие профессии'];

    const contactInfo = [
      ['Учебный центр:', 'ООО «ЕЦОП»'],
      ['Адрес:', 'г. Санкт-Петербург, ул. Новорощинская, д. 4А, офис 505-1'],
      ['Телефон:', '8 (800) 550-03-20, 8 (921) 960-50-08'],
      ['Электронный адрес:', 'info@ecoprf.ru'],
      [''], // пустая строка-разделитель
    ];

    const tabBlocks = document.querySelectorAll('.new_tabs_block');

    tabBlocks.forEach((tabBlock, tabIndex) => {
      const tables = tabBlock.querySelectorAll('.tablepress');
      let combinedSheet = [...contactInfo];

      tables.forEach((table) => {
        const ws = XLSX.utils.table_to_sheet(table);
        const data = XLSX.utils.sheet_to_json(ws, { header: 1 });

        data.forEach((row, rowIndex) => {
          const newRow = [];

          row.forEach(cell => {
            if (typeof cell === 'string') {
              if (cell.includes('Дистанционное обучение, руб/чел при коллективных заявках1+5+10+')) {
                newRow.push('1+', '5+', '10+');
              } else if (cell.includes('Дистанционное обучение, руб/чел при коллективных заявках')) {
                // Пропускаем (не добавляем в newRow)
              } else {
                newRow.push(cell);
              }
            } else {
              newRow.push(cell);
            }
          });

          // Добавляем строку только если она не пустая
          if (newRow.length > 0) {
            combinedSheet.push(newRow);
          }
        });
      });

      const wsCombined = XLSX.utils.aoa_to_sheet(combinedSheet);
      XLSX.utils.book_append_sheet(wb, wsCombined, sheetNames[tabIndex]);
    });

    const today = new Date();
    const formattedDate = today.toISOString().slice(0, 10).split('-').reverse().join('-');
    XLSX.writeFile(wb, `Прайс ЕЦОП ${formattedDate}.xlsx`);
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tabsLinkArr = document.querySelectorAll('.new_tabs_naw_link_out')
    console.log(tabsLinkArr);
    tabsLinkArr.forEach(element => {
      element.addEventListener('click', () => {
        const counter = parseInt(element.parentElement.parentElement.getAttribute('counter'), 10);
        let pdfButton = document.querySelector('.downloadExcel')
        if (counter === 2) {
          pdfButton.classList.add('active')
        } else {
          pdfButton.classList.remove('active')

        }
      })
    });
  });

</script>