<?php
/**
 * Template Name: РљРѕСЂР·РёРЅР°
 */ ?>


<?php get_header(); ?>


<div class="wcat wcatinner superFormWrap">
    <h1>РћС„РѕСЂРјР»РµРЅРёРµ Р·Р°СЏРІРєРё РЅР° РѕР±СѓС‡РµРЅРёРµ</h1>
    <p>РћРЅР»Р°Р№РЅ-РѕРїР»Р°С‚Р° Рё СЂР°СЃСЃСЂРѕС‡РєР° РґРѕСЃС‚СѓРїРЅС‹ С‚РѕР»СЊРєРѕ РґР»СЏ С„РёР·РёС‡РµСЃРєРёС… Р»РёС†. Р Р°СЃСЃСЂРѕС‡РєР° РїСЂРµРґРѕСЃС‚Р°РІР»СЏРµС‚СЃСЏ РѕС‚ РїР°СЂС‚РЅС‘СЂРѕРІ РїСЂРё СЃСѓРјРјРµ РѕР±СѓС‡РµРЅРёСЏ РѕС‚ 9 900 в‚Ѕ. РњРѕР¶РЅРѕ РѕР±СЉРµРґРёРЅРёС‚СЊ РЅРµСЃРєРѕР»СЊРєРѕ РїСЂРѕРіСЂР°РјРј РІ РѕРґРёРЅ РґРѕРіРѕРІРѕСЂ, С‡С‚РѕР±С‹ РЅР°Р±СЂР°С‚СЊ РЅСѓР¶РЅСѓСЋ СЃСѓРјРјСѓ.</p>

    <p>Р®СЂРёРґРёС‡РµСЃРєРёРµ Р»РёС†Р° РјРѕРіСѓС‚ РѕС„РѕСЂРјРёС‚СЊ Р·Р°СЏРІРєСѓ Рё РїРѕР»СѓС‡РёС‚СЊ СЃС‡С‘С‚ РЅР° РѕРїР»Р°С‚Сѓ РїРѕ СЌР»РµРєС‚СЂРѕРЅРЅРѕР№ РїРѕС‡С‚Рµ.</p>
    <div class="superForm">
        <div class="superForm__stepsWrap">
            <div class="superForm__stepsWrap-step active">1</div>
            <div class="superForm__stepsWrap-step">2</div>
            <div class="superForm__stepsWrap-step">3</div>
        </div>

        <?php
        $selected_cart_ids = isset($_COOKIE['cart_courses'])
            ? array_values(array_filter(array_map('absint', explode(',', $_COOKIE['cart_courses']))))
            : [];
        $selected_course_titles = [];

        if (!empty($selected_cart_ids)) {
            $selected_courses_for_step1 = get_posts([
                'post_type' => 'post',
                'post__in' => $selected_cart_ids,
                'orderby' => 'post__in',
                'posts_per_page' => -1,
                'fields' => 'ids',
            ]);

            foreach ($selected_courses_for_step1 as $selected_course_id) {
                $selected_course_title = get_the_title($selected_course_id);
                if (!empty($selected_course_title)) {
                    $selected_course_titles[] = $selected_course_title;
                }
            }
        }
        ?>


        <div class="superForm__step superForm__step-1 active">

        <div class="superForm__selectedCourses">
            <div class="superForm__selectedCourses-title">Р’С‹ РІС‹Р±СЂР°Р»Рё РєСѓСЂСЃС‹:</div>
            <?php if (!empty($selected_course_titles)): ?>
                <?php foreach ($selected_course_titles as $selected_course_title): ?>
                    <div class="superForm__selectedCourses-item"><?php echo esc_html($selected_course_title); ?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="superForm__selectedCourses-item">РљСѓСЂСЃС‹ РЅРµ РІС‹Р±СЂР°РЅС‹</div>
            <?php endif; ?>
        </div>
            <div class="superForm__formTitle">РљРѕРЅС‚Р°РєС‚РЅРѕРµ Р»РёС†Рѕ</div>
            <div class="superForm__step-contactsForm">
                <div class="superForm__inputWrap">
                    <label for="name">Р¤РРћ:</label>
                    <input type="text" name="name" id="name" placeholder="Р¤РРћ">
                </div>
                <div class="superForm__inputWrap">
                    <label for="phone">РљРѕРЅС‚Р°РєС‚РЅС‹Р№ С‚РµР»РµС„РѕРЅ:</label>
                    <input type="tel" name="phone" id="phone" placeholder="+7-999-999-99-99">
                </div>
                <div class="superForm__inputWrap">
                    <label for="email">Р­Р»РµРєС‚СЂРѕРЅРЅР°СЏ РїРѕС‡С‚Р°:</label>
                    <input type="email" name="email" id="email" placeholder="youremail@mail.ru">
                </div>

                <div class="superForm__formTitle" style="margin-top:10px">Р¤РѕСЂРјР° РѕР±СѓС‡РµРЅРёСЏ</div>
                <div class="customSwitcher">
                    <ul>
                        <li>
                            <input type="radio" name="learning_form" id="one" value="Р”РёСЃС‚Р°РЅС†РёРѕРЅРЅР°СЏ" checked />
                            <label for="one">Р”РёСЃС‚Р°РЅС†РёРѕРЅРЅР°СЏ</label>

                            <div class="check"></div>
                        </li>

                        <li>
                            <input type="radio" name="learning_form" id="two" value="РћС‡РЅР°СЏ" />
                            <label for="two">РћС‡РЅР°СЏ</label>

                            <div class="check"></div>
                        </li>
                    </ul>
                </div>
                <div class="superForm__nextBtn header-message">Р”Р°Р»РµРµ</div>

            </div>
        </div>

        <div class="superForm__step superForm__step-2 distanceFormLearning">
            <div class="superForm__formTitle">Р—Р°РїРѕР»РЅРёС‚Рµ СЃР»СѓС€Р°С‚РµР»РµР№ РґР»СЏ РєР°Р¶РґРѕРіРѕ РєСѓСЂСЃР°</div>

            <div class="superForm__cources">


                <?php
                // РџРѕР»СѓС‡Р°РµРј ID РєСѓСЂСЃРѕРІ РёР· РєРѕСЂР·РёРЅС‹ (cookie)
                $cart = isset($_COOKIE['cart_courses']) ? explode(',', $_COOKIE['cart_courses']) : [];

                if (!empty($cart)):

                    $courses = get_posts([
                        'post_type' => 'post',
                        'post__in' => $cart,
                        'orderby' => 'post__in',
                        'posts_per_page' => -1,
                    ]);

                    foreach ($courses as $course):
                        setup_postdata($course);

                        $price = get_field('stoimost_kursa', $course->ID);
                        $cats = get_the_category($course->ID);
                        $cat_id = $cats[0]->term_id ?? 0;
                        $main_cat_id = $cat_id;

                        if ($cat_id) {
                            $ancestors = get_ancestors($cat_id, 'category');
                            if (!empty($ancestors)) {
                                $top_parent_id = end($ancestors);
                                if (!empty($top_parent_id)) {
                                    $main_cat_id = (int) $top_parent_id;
                                }
                            }
                        }
                        ?>

                        <div class="superForm__cource" data-product-id="<?php echo $course->ID; ?>"
                            data-category-id="<?php echo $cat_id; ?>"
                            data-main-category-id="<?php echo (int) $main_cat_id; ?>"
                            data-price="<?php echo (int) $price; ?>">

                            <div class="superForm__cource-title">
                                <?php echo get_the_title($course->ID); ?>
                            </div>

                            <!-- <div class="superForm__cource-price">
                                <?php echo number_format((int) $price, 0, '', ' '); ?> в‚Ѕ
                            </div> -->

                            <div class="superForm__studentsCounterWrap">
                                <div class="superForm__studentsCounter-title">РљРѕР»РёС‡РµСЃС‚РІРѕ СЃР»СѓС€Р°С‚РµР»РµР№:</div>

                                <div class="superForm__studentsCounter">
                                    <button type="button" class="superForm__counter-button" data-action="decrease">-</button>
                                    <input type="number" class="superForm__counter-input" value="0" min="0">
                                    <button type="button" class="superForm__counter-button" data-action="increase">+</button>
                                </div>
                            </div>

                            <div class="superForm__studentsWrap">
                                <div class="superForm__students-title">Р”Р°РЅРЅС‹Рµ СЃР»СѓС€Р°С‚РµР»РµР№:</div>
                                <div class="superForm__students"></div>
                            </div>

                            <div class="superForm__removeWrap">
                                <button type="button" class="removeFromCartBtn"
                                    data-product-id="<?php echo $course->ID; ?>">РЈРґР°Р»РёС‚СЊ РёР· РєРѕСЂР·РёРЅС‹</button>
                            </div>

                        </div>

                        <?php
                    endforeach;
                    wp_reset_postdata();
                else:
                    echo '<p>Р’ РєРѕСЂР·РёРЅРµ РїРѕРєР° РЅРµС‚ РєСѓСЂСЃРѕРІ</p>';
                endif;
                ?>




            </div>


            <div class="toggleAddCourceBar">Р”РѕР±Р°РІРёС‚СЊ РєСѓСЂСЃС‹ +</div>
            <div class="addCourceWrap">
                <div class="addCourceWrap__cont">
                    <select name="category" id="category-select">
                        <option value="">Р’РёРґ РѕР±СѓС‡РµРЅРёСЏ</option>
                        <option value="2">РџРѕРІС‹С€РµРЅРёРµ РєРІР°Р»РёС„РёРєР°С†РёРё</option>
                        <option value="3">РџСЂРѕС„РµСЃСЃРёРѕРЅР°Р»СЊРЅР°СЏ РїРµСЂРµРїРѕРґРіРѕС‚РѕРІРєР°</option>
                        <option value="24">Р Р°Р±РѕС‡РёРµ РїСЂРѕС„РµСЃСЃРёРё</option>
                    </select>

                    <select name="subcategory" id="subcategory-select">
                        <option value="">Р’С‹Р±РµСЂРёС‚Рµ РїРѕРґРєР°С‚РµРіРѕСЂРёСЋ</option>
                    </select>

                    <select name="cource" id="cource-select">
                        <option value="">Р’С‹Р±РµСЂРёС‚Рµ РєСѓСЂСЃ</option>
                    </select>
                </div>

                <div class="customBtnsWrap">
                    <div class="addCourceBtn">Р”РѕР±Р°РІРёС‚СЊ РєСѓСЂСЃ</div>

                </div>


            </div>
            <div class="superForm__buttonsWrap">
                <div class="wrap">
                    <div class="backBtn">РќР°Р·Р°Рґ</div>
                    <div class="toSlideThreeBtn">Р”Р°Р»РµРµ</div>
                </div>
                <div class="clearCartWrap">
                    <button type="button" id="clearCartBtn">РћС‡РёСЃС‚РёС‚СЊ РєРѕСЂР·РёРЅСѓ</button>
                </div>
            </div>





        </div>

        <div class="superForm__step superForm__step-2 fullTimeFormLearning">
            <div class="superForm__formTitle">РћРЅР»Р°Р№РЅ РѕРїР»Р°С‚Р° РЅРµРІРѕР·РјРѕР¶РЅР°, РґР»СЏ РґР°Р»СЊРЅРµР№С€РµРіРѕ РѕР±СѓС‡РµРЅРёСЏ СЃ РІР°РјРё СЃРІСЏР¶РµС‚СЃСЏ РЅР°С€
                РјРµРЅРµРґР¶РµСЂ</div>

        </div>

        <div class="superForm__step superForm__step-3">

            <div class="superForm__formTitle">Р’С‹Р±РµСЂРёС‚Рµ С‚РёРї РѕРїР»Р°С‚С‹</div>

            <div class="payTypeButtons">

                <div class="payForListBtn">
                    РћРїР»Р°С‚Р° РїРѕ СЃС‡РµС‚Сѓ
                </div>

                <div class="payBtn">
                    РћРїР»Р°С‚Р° РѕРЅР»Р°Р№РЅ
                </div>

                <div class="payBtn installmentBtn">
                    Р Р°СЃСЃСЂРѕС‡РєР°
                    <span class="installmentHint">
                        Р Р°СЃСЃСЂРѕС‡РєР° РІРѕР·РјРѕР¶РЅР°, РµСЃР»Рё РѕР±С‰РёР№ С‡РµРє РѕС‚ 9 900 СЂСѓР±Р»РµР№.
                    </span>
                </div>

            </div>

            <div class="superForm__buttonsWrap">
                <div class="backBtn">РќР°Р·Р°Рґ</div>
            </div>

        </div>

        <div class="superForm__step superForm__step-4 invoiceSlide">

            <div class="superForm__formTitle">РћРїР»Р°С‚Р° РїРѕ СЃС‡РµС‚Сѓ</div>
            <div class="superForm__formTitle">РЈРєР°Р¶РёС‚Рµ РёРЅС„РѕСЂРјР°С†РёСЋ РѕР± РѕСЂРіР°РЅРёР·Р°С†РёРё:</div>


            <div class="superForm__invoice">

                <div class="superForm__invoice-info">
                    * Р§Р°СЃС‚СЊ РґР°РЅРЅС‹С… РјРѕР¶РµС‚ Р·Р°РїРѕР»РЅСЏС‚СЊСЃСЏ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРё РїРѕСЃР»Рµ РІРІРѕРґР° РєРѕСЂСЂРµРєС‚РЅРѕРіРѕ РРќРќ.
                    РџСЂРѕРІРµСЂСЊС‚Рµ РёС… Рё РїСЂРё РЅРµРѕР±С…РѕРґРёРјРѕСЃС‚Рё РѕС‚СЂРµРґР°РєС‚РёСЂСѓР№С‚Рµ.
                </div>

                <!-- ================= Р Р•РљР’РР—РРўР« РћР Р“РђРќРР—РђР¦РР ================= -->

                <div class="superForm__invoice-sectionTitle">
                    Р РµРєРІРёР·РёС‚С‹ РѕСЂРіР°РЅРёР·Р°С†РёРё
                </div>

                <div class="superForm__invoice-fields">

                    <input type="text" name="ORGANIZATION_INN" placeholder="РРќРќ">

                    <input type="text" name="ORGANIZATION_KPP" placeholder="РљРџРџ">

                    <input type="text" name="ORGANIZATION_UR_ADDR" placeholder="Р®СЂРёРґРёС‡РµСЃРєРёР№ Р°РґСЂРµСЃ">

                    <input type="text" name="ORGANIZATION_FACT_ADDR" placeholder="Р¤Р°РєС‚РёС‡РµСЃРєРёР№ Р°РґСЂРµСЃ">

                    <input type="text" name="ORGANIZATION_PHONE" placeholder="РўРµР»РµС„РѕРЅ">

                    <input type="email" name="ORGANIZATION_EMAIL" placeholder="E-mail">

                    <input type="text" name="ORGANIZATION_RS" placeholder="Р Р°СЃС‡РµС‚РЅС‹Р№ СЃС‡РµС‚">

                    <input type="text" name="ORGANIZATION_KS" placeholder="РљРѕСЂСЂРµСЃРїРѕРЅРґРµРЅС‚СЃРєРёР№ СЃС‡РµС‚">

                    <input type="text" name="ORGANIZATION_BANK" placeholder="Р‘Р°РЅРє">

                    <input type="text" name="ORGANIZATION_BIK" placeholder="Р‘РРљ">

                </div>

                <!-- ================= РџРћР”РџРРЎРђРќРў ================= -->

                <div class="superForm__invoice-sectionTitle">
                    РџРѕРґРїРёСЃР°РЅС‚ РґРѕРіРѕРІРѕСЂР°
                </div>

                <div class="superForm__invoice-fields">

                    <input type="text" name="SIGNER_FIO" placeholder="Р¤РРћ">

                    <input type="text" name="SIGNER_POSITION" placeholder="Р”РѕР»Р¶РЅРѕСЃС‚СЊ">

                    <input type="text" name="SIGNER_BASE" placeholder="РќР° РѕСЃРЅРѕРІР°РЅРёРё (СѓРєР°Р·Р°С‚СЊ РґРѕРєСѓРјРµРЅС‚)">

                </div>

                <div class="superForm__buttonsWrap">
                    <div class="backBtn">РќР°Р·Р°Рґ</div>
                    <div class="nextAfterInvoice">Р”Р°Р»РµРµ</div>
                </div>
            </div>

        </div>

        <div class="superForm__step superForm__step-4 onlinePaySlide">
            <div class="superForm__formTitle">РћРїР»Р°С‚Р° РѕРЅР»Р°Р№РЅ</div>

            <div class="superForm__buttonsWrap">
                <div class="backBtn">РќР°Р·Р°Рґ</div>
            </div>
        </div>
        <div class="superForm__step superForm__step-4 installmentSlide">
            <div class="superForm__formTitle">Р Р°СЃСЃСЂРѕС‡РєР°</div>

            <div class="superForm__buttonsWrap">
                <div class="backBtn">РќР°Р·Р°Рґ</div>
            </div>
        </div>

        <div class="superForm__step superForm__step-5 lastStep">
            <div class="superForm__formTitle">Р—Р°СЏРІРєР° РїСЂРёРЅСЏС‚Р°</div>

            <div class="superForm__buttonsWrap">
                <div class="backBtn">РќР°Р·Р°Рґ</div>
            </div>
        </div>


    </div>
</div>




<style>
    .addCourceWrap {
        display: none;

    }

    .addCourceWrap.active {
        display: block;
    }

    .toggleAddCourceBar {
        background: #0d5bd9;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        font-size: 16px;
        width: fit-content;
        cursor: pointer;
    }

    .backBtn {
        background: #6c757d;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        font-size: 16px;
        width: fit-content;
        cursor: pointer;
        transition: .5s;
        border: none;
    }

    .backBtn:hover {
        background: #5a6268;
        opacity: 0.9;
    }

    .superForm__buttonsWrap {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        align-items: center;
        justify-content: space-between;
    }
    .superForm__buttonsWrap .wrap{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 20px;
    }
    .toSlideThreeBtn {
        /* margin-top: 20px; */
    }

    .payForListBtn,
    .payBtn {
        background: #0d5bd9;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        transition: .5s;
        width: fit-content;
        cursor: pointer;
    }

    .payTypeButtons {
        display: flex;
        gap: 12px;
    }

    .payBtn {
        padding: 12px 20px;
        /* background: #111; */
        color: #fff;
        cursor: pointer;
        user-select: none;
        position: relative;
    }

    .payBtn.disabled {
        opacity: .5;
        cursor: not-allowed;
    }

    /* С…РёРЅС‚ */
    .installmentHint {
        position: absolute;
        bottom: 110%;
        left: 50%;
        transform: translateX(-50%);
        background: #000;
        color: #fff;
        font-size: 12px;
        padding: 6px 10px;
        white-space: nowrap;
        display: none;
    }

    .installmentBtn.disabled:hover .installmentHint {
        display: block;
    }

    .nextAfterInvoice {
        background: #0d5bd9;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        transition: .5s;
        width: fit-content;
        СЃРіursor: pointer;
    }

    .superForm__invoice-sectionTitle {
        margin-bottom: 20px;
    }

    .superForm__invoice-info {
        margin-bottom: 40px;
    }

    .superForm__invoice-fields {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-gap: 15px;
        /* max-width: 500px; */
        margin-bottom: 20px;
    }

    .superForm__invoice-fields input {
        border: 1px solid #a1a1a1;
        box-shadow: 0.5px 0.5px 5px #a1a1a180;
        border-radius: 4px;
        height: 30px;
        box-sizing: border-box;
        padding-left: 10px;
        padding-right: 10px;
    }
    .superForm .field-error {
        border-color: #d93025 !important;
        box-shadow: 0 0 0 2px rgba(217, 48, 37, 0.15) !important;
        background: #fff6f6;
    }
    .superForm .field-error::placeholder {
        color: #d93025;
    }
    .superForm select.field-error {
        color: #d93025;
    }

    .payType select {
        width: 500px;
        height: 40px;
        border: 1px solid #b6b6b65e;
        padding-left: 15px;
    }

    .payTypeBtn {
        background: #0d5bd9;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        font-size: 16px;
        width: fit-content;
        border: none;
        cursor: pointer;
        margin-top: 40px;
    }

    .superForm__cources {
        margin-bottom: 40px;

    }

    .clearCartWrap button,
    .removeFromCartBtn {
        background: #0d5bd9;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        font-size: 16px;
        width: fit-content;
        border: none;
        cursor: pointer;
    }

    .clearCartWrap {
        margin-top: 25px;
    }

    .superFormWrap {
        padding: 25px;
    }

    .superForm__stepsWrap {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 40px;
        margin-bottom: 40px;
    }

    .superForm__stepsWrap-step {
        font-size: 20px;
        font-weight: bold;
        border: 4px solid #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        position: relative;
        transition: 0.2s;
    }

    .superForm__step {
        display: none;
    }

    .superForm__step.active {
        display: block;
    }

    .superForm__stepsWrap-step:after {
        content: '';
        width: 24px;
        height: 4px;
        display: block;
        position: absolute;
        top: 23px;
        left: 100%;
        background: #eee;
        transition: 0.2s;
    }

    .superForm__stepsWrap-step:before {
        content: '';
        width: 24px;
        height: 4px;
        display: block;
        position: absolute;
        top: 23px;
        right: 100%;
        background: #eee;
        transition: 0.2s;
    }

    .superForm__stepsWrap-step:first-child:before {
        display: none;
    }

    .superForm__stepsWrap-step:last-child:after {
        display: none;
    }

    .superForm__stepsWrap-step.active {
        border-color: #0D5BD9;
    }

    .superForm__stepsWrap-step.active:before,
    .superForm__stepsWrap-step.active:after {
        background: #0D5BD9;
    }


    .superForm__formTitle {
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .superForm__selectedCourses {
        margin-bottom: 16px;
    }

    .superForm__selectedCourses-title {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .superForm__selectedCourses-item {
        line-height: 1.4;
    }

    .superForm__inputWrap {
        min-width: 600px;
        max-width: 600px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
        align-items: center;

    }

    .superForm__inputWrap:not(:last-child) {
        margin-bottom: 15px;
    }

    .superForm__inputWrap input {
        border: 1px solid #a1a1a1;
        box-shadow: 0.5px 0.5px 5px #a1a1a180;
        border-radius: 4px;
        height: 30px;
        box-sizing: border-box;
        padding-left: 10px;
        padding-right: 10px;
    }

    /* iOS Safari only: prevent auto-zoom on focus when controls look "small". */
    @supports (-webkit-touch-callout: none) {
        .superForm input,
        .superForm select,
        .superForm textarea {
            font-size: 16px;
        }
    }

    .customSwitcher {
        display: flex;
        flex-direction: column;
        width: 300px;

    }


    /* Radio Button
вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“вЂ“ */
    .customSwitcher input[type=radio] {
        position: absolute;
        visibility: hidden;
    }

    .customSwitcher ul {
        padding-left: 28px;
        margin: 0;
    }

    .customSwitcher li {
        display: block;
        position: relative;
        padding: 10px 0px;
    }

    .customSwitcher label {
        cursor: pointer;
        font-weight: 400;
    }

    .customSwitcher .check {
        width: 30px;
        height: 30px;
        position: absolute;
        border-radius: 50%;
        transition: transform .6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        cursor: pointer;
        z-index: 10;
        pointer-events: auto;
    }

    /* Reset */
    .customSwitcher input#one~.check {
        transform: translate(-40px, -25px);
        background: #B2D7F5;
    }

    .customSwitcher input#two~.check {
        transform: translate(-40px, -63px);
        background: #2196F3;
        box-shadow: 0 6px 12px rgba(33, 150, 243, 0.35);
    }

    /* Radio Input #1 */
    .customSwitcher input#one:checked~.check {
        transform: translate(-40px, 14px);
    }

    /* Radio Input #2  */
    .customSwitcher input#two:checked~.check {
        transform: translate(-40px, -25px);
    }

    .superForm__nextBtn {
        width: fit-content;
        margin-top: 10px;
    }

    .superForm__cource-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .superForm__student {
        margin-bottom: 20px;
    }

    .superForm__studentsCounterWrap {
        display: grid;
        grid-template-columns: 1fr 3fr;
        grid-gap: 20px;
        margin-bottom: 20px;
    }

    .superForm__studentsWrap {
        display: grid;
        grid-template-columns: 1fr 3fr;
        grid-gap: 20px;
        margin-bottom: 20px;
    }

    .superForm__student {
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 10px;
        box-sizing: border-box;
        max-width: 500px;
        border-bottom: 1px solid #0d5bd9;
        padding-bottom: 20px;
    }

    .superForm__studentsCounter {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
    }

    .superForm__counter-button {
        width: 40px;
        height: 40px;
        font-size: 30px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        align-self: center;
        background: #0D5BD9;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .superForm__counter-input {
        width: 60px;
        height: 38px;
        border: 1px solid #b6b6b65e;
        text-align: center;
    }

    .superForm__student select {
        max-width: 500px;
        height: 40px;
        border: 1px solid #b6b6b65e;
        padding-left: 15px;
    }

    .superForm__student input {
        /* width: 100%; */
        max-width: 500px;
        height: 40px;
        border: 1px solid #b6b6b65e;
        padding-left: 15px;
        cursor: pointer;
    }

    .addCourceWrap {
        margin-top: 20px;
    }

    .addCourceWrap__cont {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    .addCourceWrap__cont select {
        height: 40px;
        border: 1px solid #b6b6b65e;
        padding-left: 15px;
        width: 100%;
        padding-right: 15px;
    }

    .addCourceBtn {
        background: #0d5bd9;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        font-size: 16px;
        width: fit-content;
    }

    .superForm__student input {
        box-sizing: border-box;
    }

    .toSlideThreeBtn {
        background: #0d5bd9;
        color: #fff;
        padding: 13px 44px;
        border-radius: 75px;
        font-size: 16px;
        width: fit-content;
        cursor: pointer;
        /* margin-top: 20px; */
    }

    .toSlideThreeBtn.disabled {
        opacity: .5;
        cursor: not-allowed;
        pointer-events: none;
    }

    .customBtnsWrap {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 20px;
        flex-wrap: wrap;
        cursor: pointer;
    }

    .addCourceBtn {
        cursor: pointer;
    }

    .superForm__cource {
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid #0d5bd9;
    }

    @media (max-width: 768px) {
        .superForm__inputWrap {
            grid-template-columns: 1fr;
            grid-gap: 6px;
            max-width: 100%;
            min-width: 100%;
        }

        .superForm__studentsCounterWrap {
            grid-template-columns: 1fr;
        }

        .superForm__studentsWrap {
            grid-template-columns: 1fr;
        }

        .addCourceWrap__cont {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .payTypeButtons {
            flex-direction: column;
        }

        .superForm__invoice-fields {
            grid-template-columns: 1fr;
        }
        .superForm__buttonsWrap{
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }
    }
    .customSwitcher {
        width: min(100%, 440px);
        margin-bottom: 14px;
    }

    .customSwitcher ul {
        list-style: none;
        margin: 0;
        padding: 6px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 6px;
        border-radius: 24px;
        /* background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 52%, #e0f2fe 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8), 0 18px 44px rgba(13, 91, 217, 0.14); */
    }

    .customSwitcher li {
        padding: 0;
        margin: 0;
    }

    .customSwitcher input[type=radio] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .customSwitcher label {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 43px;
        padding: 0 18px;
        border-radius: 18px;
        background: #fff;
        border: 1px solid #0d5bd9;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.29)
        color: #0d5bd9;
        font-size: 15px;
        font-weight: 600;
        text-align: center;
        letter-spacing: 0.01em;
        cursor: pointer;
        transition: transform .25s ease, box-shadow .25s ease, background .25s ease, color .25s ease;
        backdrop-filter: blur(6px);
    }

    .customSwitcher li:hover label {
        transform: translateY(-1px);
    }

    .customSwitcher .check {
        display: none;
    }

    .customSwitcher input#one:checked + label,
    .customSwitcher input#two:checked + label {
        background: #0d5bd9;
        color: #fff;
        box-shadow: 0 12px 28px rgba(13, 91, 217, 0.18);
    }

    .customSwitcher input[type=radio]:focus-visible + label {
        outline: 2px solid #0d5bd9;
        outline-offset: 2px;
    }
    .superForm__invoice input{
        cursor: pointer;
    }

    @media (max-width: 640px) {
        .customSwitcher {
            width: 100%;
        }

        .customSwitcher ul {
            grid-template-columns: 1fr;
        }

        .customSwitcher label {
            min-height: 54px;
        }
    }
</style>


<!-- РЎР»Р°РґС‹ Рё РѕС‚РїСЂР°РІРєР° -->

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const counter = document.querySelectorAll('.superForm__stepsWrap-step')
        const slides = document.querySelectorAll('.superForm__step')
        const firstBtn = document.querySelector('.superForm__step-1 .superForm__nextBtn')
        const payBtns = document.querySelectorAll('.payBtn')
        let formDataMain = new FormData()
        const slideHistory = []
        const FIELD_ERROR_CLASS = 'field-error'

        function markFieldError(field) {
            if (!field) return
            field.classList.add(FIELD_ERROR_CLASS)
            field.setAttribute('aria-invalid', 'true')
        }

        function clearFieldError(field) {
            if (!field) return
            field.classList.remove(FIELD_ERROR_CLASS)
            field.removeAttribute('aria-invalid')
        }

        function clearFieldErrorsInScope(scope) {
            if (!scope) return
            scope.querySelectorAll(`.${FIELD_ERROR_CLASS}`).forEach(clearFieldError)
        }

        function isValidEmail(value) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((value || '').trim())
        }

        function normalizePhoneDigits(value) {
            let digits = String(value || '').replace(/\D/g, '')

            if (!digits) return ''
            if (digits[0] === '8') digits = '7' + digits.slice(1)
            if (digits[0] === '9') digits = '7' + digits

            return digits.slice(0, 11)
        }

        function formatRussianPhone(value) {
            const digits = normalizePhoneDigits(value)
            if (!digits) return ''

            const local = digits.slice(1)
            const p1 = local.slice(0, 3)
            const p2 = local.slice(3, 6)
            const p3 = local.slice(6, 8)
            const p4 = local.slice(8, 10)

            let result = '+7'
            if (p1) result += ` (${p1}`
            if (p1.length === 3) result += ')'
            if (p2) result += ` ${p2}`
            if (p3) result += `-${p3}`
            if (p4) result += `-${p4}`

            return result
        }

        function isValidRussianPhone(value) {
            const digits = normalizePhoneDigits(value)
            return digits.length === 11 && digits[0] === '7'
        }

        function attachRussianPhoneMask(input) {
            if (!input || input.dataset.phoneMaskInit === '1') return
            input.dataset.phoneMaskInit = '1'

            const applyMask = () => {
                input.value = formatRussianPhone(input.value)
            }

            const handleMaskedDelete = (event) => {
                if (event.key !== 'Backspace' && event.key !== 'Delete') return
                if (input.selectionStart !== input.selectionEnd) return

                const digits = normalizePhoneDigits(input.value)
                if (!digits) {
                    input.value = ''
                    return
                }

                event.preventDefault()
                const nextDigits = digits.length > 1 ? digits.slice(0, -1) : ''
                input.value = formatRussianPhone(nextDigits)
            }

            input.addEventListener('input', applyMask)
            input.addEventListener('keydown', handleMaskedDelete)
            input.addEventListener('focus', () => {
                if (!input.value.trim()) input.value = '+7'
            })
            input.addEventListener('blur', () => {
                if (!isValidRussianPhone(input.value)) {
                    // Clear incomplete mask fragments like "+7 (" so brackets never get stuck.
                    input.value = ''
                }
            })

            if (input.value.trim()) {
                applyMask()
            }
        }

        function initRussianPhoneMasks(scope = document) {
            scope.querySelectorAll('input[type="tel"], input[name="ORGANIZATION_PHONE"]').forEach(attachRussianPhoneMask)
        }

        window.superFormValidationUtils = {
            formatRussianPhone,
            clearFieldError,
            attachRussianPhoneMask
        }

        initRussianPhoneMasks()

        document.addEventListener('input', (e) => {
            if (e.target.matches('input[type="tel"], input[name="ORGANIZATION_PHONE"]')) {
                attachRussianPhoneMask(e.target)
            }
            if (e.target.matches(`input.${FIELD_ERROR_CLASS}, select.${FIELD_ERROR_CLASS}`)) {
                clearFieldError(e.target)
            }
        })

        document.addEventListener('change', (e) => {
            if (e.target.matches(`input.${FIELD_ERROR_CLASS}, select.${FIELD_ERROR_CLASS}`)) {
                clearFieldError(e.target)
            }
        })

        function updateStepCounter(activeSlide) {
            if (!activeSlide) return

            counter.forEach(step => step.classList.remove('active'))

            const stepClass = Array.from(activeSlide.classList)
                .find(className => /^superForm__step-\d+$/.test(className))

            if (!stepClass) return

            const stepNumber = parseInt(stepClass.replace('superForm__step-', ''), 10)

            if (Number.isNaN(stepNumber)) return

            const activeStepsCount = Math.min(stepNumber, counter.length)

            for (let i = 0; i < activeStepsCount; i++) {
                counter[i].classList.add('active')
            }
        }

        function setActiveSlide(targetSlide, options = {}) {
            const { pushToHistory = true } = options
            if (!targetSlide) return

            const currentSlide = document.querySelector('.superForm__step.active')

            if (currentSlide === targetSlide) return

            if (currentSlide && pushToHistory) {
                slideHistory.push(currentSlide)
            }

            slides.forEach(slide => slide.classList.remove('active'))
            targetSlide.classList.add('active')
            updateStepCounter(targetSlide)
        }

        function goBackToPreviousSlide() {
            const previousSlide = slideHistory.pop()

            if (!previousSlide) return

            setActiveSlide(previousSlide, { pushToHistory: false })
        }

        window.superFormNavigation = {
            setActiveSlide,
            goBackToPreviousSlide
        }

        updateStepCounter(document.querySelector('.superForm__step.active'))

        document.addEventListener('click', (e) => {
            const backBtn = e.target.closest('.backBtn')

            if (!backBtn) return

            e.preventDefault()
            e.stopPropagation()
            e.stopImmediatePropagation()
            goBackToPreviousSlide()
        }, true)

        document.addEventListener('click', (e) => {
            const switcherOption = e.target.closest('.customSwitcher li')

            if (!switcherOption) return

            const radio = switcherOption.querySelector('input[type="radio"]')

            if (!radio) return

            radio.checked = true
            e.preventDefault()
            e.stopPropagation()
            e.stopImmediatePropagation()
        }, true)

        // CustomSwitcher functionality
        const customSwitcher = document.querySelector('.customSwitcher')
        if (customSwitcher) {
            customSwitcher.addEventListener('click', (e) => {
                // Find all radio buttons in the switcher
                const allRadios = customSwitcher.querySelectorAll('input[type="radio"]')
                
                // Find the unchecked radio button
                const uncheckedRadio = Array.from(allRadios).find(radio => !radio.checked)
                
                // If found unchecked radio, check it
                if (uncheckedRadio) {
                    uncheckedRadio.checked = true
                }
            })
        }

        firstBtn.addEventListener('click', () => {

            const fioInput = slides[0].querySelector('input[name="name"]')
            const phoneInput = slides[0].querySelector('input[name="phone"]')
            const emailInput = slides[0].querySelector('input[name="email"]')

            clearFieldErrorsInScope(slides[0])

            const fio = fioInput.value.trim()
            const phoneNumber = phoneInput.value.trim()
            const email = emailInput.value.trim()

            const learningRadio = slides[0].querySelector('input[name="learning_form"]:checked')

            // ===== РџР РћР’Р•Р РљР =====
            let hasErrors = false

            if (!fio) {
                markFieldError(fioInput)
                hasErrors = true
            }

            if (!isValidRussianPhone(phoneNumber)) {
                markFieldError(phoneInput)
                hasErrors = true
            }

            if (!email || !isValidEmail(email)) {
                markFieldError(emailInput)
                hasErrors = true
            }

            if (hasErrors) {
                alert('Р—Р°РїРѕР»РЅРёС‚Рµ Р¤РРћ, С‚РµР»РµС„РѕРЅ Рё email РІ РєРѕСЂСЂРµРєС‚РЅРѕРј С„РѕСЂРјР°С‚Рµ')
                return
            }

            if (!learningRadio) {
                alert('Р’С‹Р±РµСЂРёС‚Рµ С„РѕСЂРјСѓ РѕР±СѓС‡РµРЅРёСЏ')
                return
            }

            const learningForm = learningRadio.value

            // ===== РћРўРџР РђР’РљРђ Р”РђРќРќР«РҐ =====
            formDataMain = new FormData()

            formDataMain.append('formid', 'quiz')
            formDataMain.append('fio', fio)
            formDataMain.append('phone', formatRussianPhone(phoneNumber))
            formDataMain.append('email', email)
            formDataMain.append('learning_form', learningForm)
            formDataMain.append('page', location.href)

            if (learningForm === "Р”РёСЃС‚Р°РЅС†РёРѕРЅРЅР°СЏ") {
                setActiveSlide(slides[1])
            } else {
                const fullTimeSlide = document.querySelector('.superForm__step-2.fullTimeFormLearning')
                if (fullTimeSlide) {
                    setActiveSlide(fullTimeSlide)
                } else {
                    setActiveSlide(slides[2])
                }

                fetch('/mail.php', {
                    method: 'POST',
                    body: formDataMain
                })
                    .then(r => r.json())
                    .then(res => {
                        if (!res.success) {
                            console.warn('РћС€РёР±РєР° РѕС‚РїСЂР°РІРєРё РѕС‡РЅРѕР№ Р·Р°СЏРІРєРё:', res.message || 'unknown error')
                        }
                    })
                    .catch(() => {
                        console.warn('РћС€РёР±РєР° СЃРѕРµРґРёРЅРµРЅРёСЏ РїСЂРё РѕС‚РїСЂР°РІРєРµ РѕС‡РЅРѕР№ Р·Р°СЏРІРєРё')
                    })

            }
        })

        // =============================
        // РћР‘Р РђР‘РћРўР§РРљР РљРќРћРџРћРљ "РќРђР—РђР”"
        // =============================
        const backBtns = document.querySelectorAll('.backBtn')

        backBtns.forEach((backBtn, index) => {
            backBtn.addEventListener('click', () => {
                // РћРїСЂРµРґРµР»СЏРµРј С‚РµРєСѓС‰РёР№ Р°РєС‚РёРІРЅС‹Р№ СЃР»Р°Р№Рґ
                const activeSlide = document.querySelector('.superForm__step.active')
                const activeIndex = Array.from(slides).indexOf(activeSlide)

                if (activeIndex > 0) {
                    // РЈР±РёСЂР°РµРј Р°РєС‚РёРІРЅС‹Р№ РєР»Р°СЃСЃ СЃ С‚РµРєСѓС‰РµРіРѕ СЃР»Р°Р№РґР°
                    activeSlide.classList.remove('active')
                    counter[activeIndex].classList.remove('active')

                    // Р”РѕР±Р°РІР»СЏРµРј Р°РєС‚РёРІРЅС‹Р№ РєР»Р°СЃСЃ РЅР° РїСЂРµРґС‹РґСѓС‰РёР№ СЃР»Р°Р№Рґ
                    slides[activeIndex - 1].classList.add('active')
                    counter[activeIndex - 1].classList.add('active')
                }
            })
        })

        const toSlideThreeBtn = document.querySelector('.toSlideThreeBtn')

        function getEducationTrack(course) {
            const mainCategoryId = Number(course.dataset.mainCategoryId || 0)
            const categoryId = Number(course.dataset.categoryId || 0)
            const normalizedCategoryId = mainCategoryId || categoryId

            if (normalizedCategoryId === 24) return 'worker'
            if ([2, 3, 39, 67].includes(normalizedCategoryId)) return 'pro'

            return 'pro'
        }

        function isEducationAllowed(educationTrack, educationValue) {
            if (!educationValue) return false

            if (educationTrack === 'worker') {
                return educationValue === '1' || educationValue === '2'
            }

            return educationValue === '2'
        }

        function getStudentSurname(student) {
            const fullName = student.querySelector('input[name="student_name[]"]')?.value?.trim() || ''
            if (!fullName) return 'Р¤Р°РјРёР»РёСЏ РЅРµ СѓРєР°Р·Р°РЅР°'
            return fullName.split(/\s+/)[0] || 'Р¤Р°РјРёР»РёСЏ РЅРµ СѓРєР°Р·Р°РЅР°'
        }

        function formatInvalidStudentsList(surnames) {
            const uniqueSurnames = [...new Set(surnames.filter(Boolean))]
            if (!uniqueSurnames.length) return ''
            return `\n\nРЎР»СѓС€Р°С‚РµР»Рё: ${uniqueSurnames.join(', ')}`
        }

        function getEducationErrorMessage(educationTrack) {
            if (educationTrack === 'worker') {
                return 'РЈСЂРѕРІРµРЅСЊ РѕР±СЂР°Р·РѕРІР°РЅРёСЏ Сѓ СЃР»СѓС€Р°С‚РµР»СЏ РЅРµ СЃРѕРѕС‚РІРµС‚СЃС‚РІСѓРµС‚ РЅРѕСЂРјРµ'
            }

            return 'РЈСЂРѕРІРµРЅСЊ РѕР±СЂР°Р·РѕРІР°РЅРёСЏ Сѓ СЃР»СѓС€Р°С‚РµР»СЏ РЅРµ СЃРѕРѕС‚РІРµС‚СЃС‚РІСѓРµС‚ РЅРѕСЂРјРµ'
        }

        document.addEventListener('click', (e) => {
            const trigger = e.target.closest('.toSlideThreeBtn')

            if (!trigger) return
            if (trigger.classList.contains('disabled')) return

            e.preventDefault()
            e.stopPropagation()
            e.stopImmediatePropagation()

            const courses = document.querySelectorAll('.superForm__cource')
            clearFieldErrorsInScope(document.querySelector('.superForm__step-2.distanceFormLearning'))

            let hasInvalidStudent = false
            let invalidReason = ''
            const invalidSurnames = []
            let shouldSendToManager = false

            courses.forEach(course => {
                if (hasInvalidStudent) return

                const educationTrack = getEducationTrack(course)
                const students = course.querySelectorAll('.superForm__student')

                students.forEach(student => {
                    if (hasInvalidStudent) return

                    const nameInput = student.querySelector('input[name="student_name[]"]')
                    const birthInput = student.querySelector('input[name="student_birthdate[]"]')
                    const snilsInput = student.querySelector('input[name="student_snils[]"]')
                    const eduSelect = student.querySelector('select[name="student_education[]"]')
                    const emailInput = student.querySelector('input[name="student_email[]"]')

                    const nameValue = nameInput?.value?.trim() || ''
                    const birthValue = birthInput?.value || ''
                    const snilsValue = snilsInput?.value?.trim() || ''
                    const eduValue = eduSelect?.value || ''
                    const emailValue = emailInput?.value?.trim() || ''

                    if (!nameValue || !snilsValue || !emailValue || !isValidEmail(emailValue)) {
                        hasInvalidStudent = true
                        invalidReason = 'Р—Р°РїРѕР»РЅРёС‚Рµ Р¤РРћ, РЎРќРР›РЎ Рё email РґР»СЏ РєР°Р¶РґРѕРіРѕ СЃР»СѓС€Р°С‚РµР»СЏ'
                        invalidSurnames.push(getStudentSurname(student))
                        if (!nameValue) markFieldError(nameInput)
                        if (!snilsValue) markFieldError(snilsInput)
                        if (!emailValue || !isValidEmail(emailValue)) markFieldError(emailInput)
                        return
                    }

                    if (!isAdult(birthValue)) {
                        hasInvalidStudent = true
                        invalidReason = 'Р’РѕР·СЂР°СЃС‚ СЃР»СѓС€Р°С‚РµР»СЏ РјРµРЅСЊС€Рµ 18 Р»РµС‚ РёР»Рё РґР°С‚Р° СЂРѕР¶РґРµРЅРёСЏ Р·Р°РїРѕР»РЅРµРЅР° РЅРµРєРѕСЂСЂРµРєС‚РЅРѕ'
                        markFieldError(birthInput)
                        shouldSendToManager = true
                        return
                    }

                    if (!eduValue) {
                        hasInvalidStudent = true
                        invalidReason = 'Р’С‹Р±РµСЂРёС‚Рµ СѓСЂРѕРІРµРЅСЊ РѕР±СЂР°Р·РѕРІР°РЅРёСЏ РґР»СЏ РєР°Р¶РґРѕРіРѕ СЃР»СѓС€Р°С‚РµР»СЏ'
                        invalidSurnames.push(getStudentSurname(student))
                        markFieldError(eduSelect)
                        return
                    }

                    if (!isEducationAllowed(educationTrack, eduValue)) {
                        hasInvalidStudent = true
                        invalidReason = getEducationErrorMessage(educationTrack)
                        invalidSurnames.push(getStudentSurname(student))
                        markFieldError(eduSelect)
                        shouldSendToManager = true
                    }
                })

            })

            // =========================
            // Р•РЎР›Р Р•РЎРўР¬ РћРЁРР‘РљРђ
            // =========================
            if (hasInvalidStudent) {
                if (shouldSendToManager) {
                    alert(
                        invalidReason +
                        formatInvalidStudentsList(invalidSurnames) +
                        '\n\nРћРЅР»Р°Р№РЅ РѕРїР»Р°С‚Р° РЅРµРІРѕР·РјРѕР¶РЅР°. РЎ Р’Р°РјРё СЃРІСЏР¶РµС‚СЃСЏ РјРµРЅРµРґР¶РµСЂ.'
                    )
                    sendToManager()
                    return
                }

                alert(invalidReason + formatInvalidStudentsList(invalidSurnames))
                return
            }

            goToSlide3()
            window.scrollTo(0, 0)
        }, true)

        function isAdult(dateStr) {

            // РѕР¶РёРґР°РµРј Р”Р”.РњРњ.Р“Р“Р“Р“
            if (!dateStr || dateStr.length !== 10) return false

            const parts = dateStr.split('.')
            if (parts.length !== 3) return false

            const day = Number(parts[0])
            const month = Number(parts[1]) - 1
            const year = Number(parts[2])

            const birthDate = new Date(year, month, day)
            if (isNaN(birthDate.getTime())) return false

            const today = new Date()

            let age = today.getFullYear() - birthDate.getFullYear()

            const monthDiff = today.getMonth() - birthDate.getMonth()
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--
            }

            // РћС‚Р»Р°РґРѕС‡РЅС‹Р№ РІС‹РІРѕРґ
            console.log('РџСЂРѕРІРµСЂРєР° РІРѕР·СЂР°СЃС‚Р°:', {
                input: dateStr,
                birthDate: birthDate.toLocaleDateString(),
                today: today.toLocaleDateString(),
                calculatedAge: age,
                isAdult: age >= 18
            })

            return age >= 18
        }

        function goToSlide3() {
            setActiveSlide(document.querySelector('.superForm__step-3'))
        }

        function sendToManager() {

            const formData = new FormData()

            // =========================
            // РћРЎРќРћР’РќР«Р• Р”РђРќРќР«Р• (slide 1)
            // =========================
            for (let [key, value] of formDataMain.entries()) {
                formData.append(key, value)
            }

            formData.append('formid', 'quiz_manager')

            // =========================
            // РљРЈР РЎР« + РЎР›РЈРЁРђРўР•Р›Р
            // =========================
            document.querySelectorAll('.superForm__cource')
                .forEach((course, courseIndex) => {

                    const courseTitle =
                        course.querySelector('.superForm__cource-title')?.innerText.trim() || 'Р‘РµР· РЅР°Р·РІР°РЅРёСЏ'

                    formData.append(`courses[${courseIndex}][title]`, courseTitle)

                    const students = course.querySelectorAll('.superForm__student')

                    students.forEach((student, studentIndex) => {

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][name]`,
                            student.querySelector('input[name="student_name[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][birthdate]`,
                            student.querySelector('input[name="student_birthdate[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][snils]`,
                            student.querySelector('input[name="student_snils[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][education]`,
                            student.querySelector('select[name="student_education[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][email]`,
                            student.querySelector('input[name="student_email[]"]').value
                        )

                    })

                })

            // =========================
            // РћРўРџР РђР’РљРђ
            // =========================
            fetch('/mail2.php', {
                method: 'POST',
                body: formData
            })
        }

        function sendInvoiceData() {

            const formData = new FormData()

            // =========================
            // РћРЎРќРћР’РќР«Р• Р”РђРќРќР«Р• (step 1)
            // =========================
            for (let [key, value] of formDataMain.entries()) {
                formData.append(key, value)
            }

            formData.append('formid', 'quiz_invoice')

            // =========================
            // Р”РђРќРќР«Р• РћР Р“РђРќРР—РђР¦РР
            // =========================
            document
                .querySelectorAll('.invoiceSlide input')
                .forEach(input => {
                    formData.append(input.name, input.value)
                })


            // =========================
            // РљРЈР РЎР« + РЎР›РЈРЁРђРўР•Р›Р
            // =========================
            document.querySelectorAll('.superForm__cource')
                .forEach((course, courseIndex) => {

                    const courseTitle =
                        course.querySelector('.superForm__cource-title')?.innerText.trim() || 'Р‘РµР· РЅР°Р·РІР°РЅРёСЏ'

                    formData.append(`courses[${courseIndex}][title]`, courseTitle)

                    const students = course.querySelectorAll('.superForm__student')

                    students.forEach((student, studentIndex) => {

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][name]`,
                            student.querySelector('input[name="student_name[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][birthdate]`,
                            student.querySelector('input[name="student_birthdate[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][snils]`,
                            student.querySelector('input[name="student_snils[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][education]`,
                            student.querySelector('select[name="student_education[]"]').value
                        )

                        formData.append(
                            `courses[${courseIndex}][students][${studentIndex}][email]`,
                            student.querySelector('input[name="student_email[]"]').value
                        )

                    })

                })


            // =========================
            // РћРўРџР РђР’РљРђ
            // =========================
            return fetch('/mail3.php', {
                method: 'POST',
                body: formData
            })
                .then(r => r.json())
                .then(res => {
                    if (!res.success) {
                        throw new Error(res.message || 'РћС€РёР±РєР° РѕС‚РїСЂР°РІРєРё Р·Р°СЏРІРєРё')
                    }
                    return res
                })
        }

        const nextAfterInvoice = document.querySelector('.nextAfterInvoice')
        const lastStep = document.querySelector('.lastStep')

        nextAfterInvoice.addEventListener('click', async () => {
            const invoiceSlide = document.querySelector('.invoiceSlide')
            const signerFioInput = invoiceSlide.querySelector('[name="SIGNER_FIO"]')
            const innInput = invoiceSlide.querySelector('[name="ORGANIZATION_INN"]')
            const urAddrInput = invoiceSlide.querySelector('[name="ORGANIZATION_UR_ADDR"]')
            const orgPhoneInput = invoiceSlide.querySelector('[name="ORGANIZATION_PHONE"]')
            const orgEmailInput = invoiceSlide.querySelector('[name="ORGANIZATION_EMAIL"]')
            const rsInput = invoiceSlide.querySelector('[name="ORGANIZATION_RS"]')
            const signerFio = signerFioInput?.value?.trim() || ''
            const inn = innInput?.value?.trim() || ''
            const urAddr = urAddrInput?.value?.trim() || ''
            const orgPhone = orgPhoneInput?.value?.trim() || ''
            const orgEmail = orgEmailInput?.value?.trim() || ''
            const rs = rsInput?.value?.trim() || ''

            clearFieldErrorsInScope(invoiceSlide)

            let hasInvoiceErrors = false

            if (!signerFio) {
                markFieldError(signerFioInput)
                hasInvoiceErrors = true
            }
            if (!inn) {
                markFieldError(innInput)
                hasInvoiceErrors = true
            }
            if (!urAddr) {
                markFieldError(urAddrInput)
                hasInvoiceErrors = true
            }
            if (!rs) {
                markFieldError(rsInput)
                hasInvoiceErrors = true
            }

            if (!isValidRussianPhone(orgPhone)) {
                markFieldError(orgPhoneInput)
                hasInvoiceErrors = true
            }

            if (!orgEmail || !isValidEmail(orgEmail)) {
                markFieldError(orgEmailInput)
                hasInvoiceErrors = true
            }

            if (hasInvoiceErrors) {
                alert('Р—Р°РїРѕР»РЅРёС‚Рµ РІСЃРµ РѕР±СЏР·Р°С‚РµР»СЊРЅС‹Рµ РїРѕР»СЏ СЂРµРєРІРёР·РёС‚РѕРІ Рё РїРѕРґРїРёСЃР°РЅС‚Р°')
                return
            }

            try {
                await sendInvoiceData()
                if (typeof window.clearCartAfterSuccessfulOrder === 'function') {
                    window.clearCartAfterSuccessfulOrder()
                }
                setActiveSlide(lastStep)
            } catch (error) {
                alert(error?.message || 'РћС€РёР±РєР° РѕС‚РїСЂР°РІРєРё Р·Р°СЏРІРєРё')
            }
        })

        payBtns.forEach(payBtn => {
            payBtn.addEventListener('click', () => {

                if (!payBtn.classList.contains('disabled')) {
                    const formData = new FormData()
                    const paymentType = payBtn.classList.contains('installmentBtn')
                        ? 'Р Р°СЃСЃСЂРѕС‡РєР°'
                        : 'РћРЅР»Р°Р№РЅ-РѕРїР»Р°С‚Р°'

                    // =========================
                    // РћРЎРќРћР’РќР«Р• Р”РђРќРќР«Р•
                    // =========================
                    for (let [key, value] of formDataMain.entries()) {
                        formData.append(key, value)
                    }

                    formData.append('formid', 'quiz_pay')
                    formData.append('payment_type', paymentType)

                    // =========================
                    // РљРЈР РЎР« + РЎР›РЈРЁРђРўР•Р›Р
                    // =========================
                    document.querySelectorAll('.superForm__cource')
                        .forEach((course, courseIndex) => {

                            const courseTitle =
                                course.querySelector('.superForm__cource-title')?.innerText.trim() || 'Р‘РµР· РЅР°Р·РІР°РЅРёСЏ'

                            const coursePrice = course.dataset.price || 0

                            formData.append(`courses[${courseIndex}][title]`, courseTitle)
                            formData.append(`courses[${courseIndex}][price]`, coursePrice)

                            const students = course.querySelectorAll('.superForm__student')

                            students.forEach((student, studentIndex) => {

                                formData.append(
                                    `courses[${courseIndex}][students][${studentIndex}][name]`,
                                    student.querySelector('input[name="student_name[]"]').value
                                )

                                formData.append(
                                    `courses[${courseIndex}][students][${studentIndex}][email]`,
                                    student.querySelector('input[name="student_email[]"]').value
                                )

                                formData.append(
                                    `courses[${courseIndex}][students][${studentIndex}][birthdate]`,
                                    student.querySelector('input[name="student_birthdate[]"]').value
                                )

                                formData.append(
                                    `courses[${courseIndex}][students][${studentIndex}][snils]`,
                                    student.querySelector('input[name="student_snils[]"]').value
                                )

                                formData.append(
                                    `courses[${courseIndex}][students][${studentIndex}][education]`,
                                    student.querySelector('select[name="student_education[]"]').value
                                )

                            })
                        })

                    // =========================
                    // РЎРћР—Р”РђРќРР• Р—РђРљРђР—Рђ
                    // =========================
                    fetch('/payscript.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(r => r.json())
                        .then(res => {

                            if (!res.success) {
                                alert(res.message || 'РћС€РёР±РєР° СЃРѕР·РґР°РЅРёСЏ РѕРїР»Р°С‚С‹')
                                return
                            }

                            if (typeof window.clearCartAfterSuccessfulOrder === 'function') {
                                window.clearCartAfterSuccessfulOrder()
                            }
                            window.location.href = res.payment_link
                        })
                        .catch(() => {
                            alert('РћС€РёР±РєР° СЃРѕРµРґРёРЅРµРЅРёСЏ')
                        })
                }



            })
        });




    })

</script>




<!-- РџРѕР»СѓС‡РµРЅРёРµ РєР°С‚РµРіРѕСЂРёР№ Рё РєСѓСЂСЃРѕРІ РґР»СЏ РґРѕР±Р°РІР»РµРЅРёСЏ -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const categorySelect = document.getElementById('category-select');
        const subcategorySelect = document.getElementById('subcategory-select');
        const courseSelect = document.getElementById('cource-select');

        categorySelect.addEventListener('change', () => {
            resetSelect(subcategorySelect, 'Р’С‹Р±РµСЂРёС‚Рµ РїРѕРґРєР°С‚РµРіРѕСЂРёСЋ');
            resetSelect(courseSelect, 'Р’С‹Р±РµСЂРёС‚Рµ РєСѓСЂСЃ');

            if (!categorySelect.value) return;

            fetch(`/wp-admin/admin-ajax.php?action=get_subcategories&category_id=${categorySelect.value}`)
                .then(r => r.json())
                .then(data => {
                    data.forEach(item => {
                        subcategorySelect.append(new Option(item.name, item.id));
                    });
                });
        });

        subcategorySelect.addEventListener('change', () => {
            resetSelect(courseSelect, 'Р’С‹Р±РµСЂРёС‚Рµ РєСѓСЂСЃ');

            if (!subcategorySelect.value) return;

            fetch(`/wp-admin/admin-ajax.php?action=get_courses&subcategory_id=${subcategorySelect.value}`)
                .then(r => r.json())
                .then(data => {
                    data.forEach(item => {
                        const option = new Option(item.name, item.id);
                        option.dataset.price = item.price || 0;
                        courseSelect.append(option);
                    });
                });
        });

        function resetSelect(select, placeholder) {
            select.innerHTML = `<option value="">${placeholder}</option>`;
        }
    });
</script>


<!-- Р”РѕР±Р°РІР»РµРЅРёРµ РєСѓСЂСЃРѕРІ Рё СЃС‚СѓРґРµРЅС‚РѕРІ -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const studentsCache = {} // { "РёРІР°РЅРѕРІРёРІР°РЅ": { birthdate:'', snils:'', education:'', email:'' } }


        const coursesWrap = document.querySelector('.superForm__cources')
        const addCourseBtn = document.querySelector('.addCourceBtn')
        const COOKIE_NAME = 'cart_courses'
        const COOKIE_MAX_AGE = 60 * 60 * 24 * 30

        function escapeAttr(value) {
            return String(value ?? '')
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
        }

        function getStudentData(student) {
            return {
                name: student.querySelector('[name="student_name[]"]')?.value || '',
                birthdate: student.querySelector('[name="student_birthdate[]"]')?.value || '',
                snils: student.querySelector('[name="student_snils[]"]')?.value || '',
                education: student.querySelector('[name="student_education[]"]')?.value || '',
                email: student.querySelector('[name="student_email[]"]')?.value || ''
            }
        }

        function getCourseStudentsData(course) {
            return Array.from(course.querySelectorAll('.superForm__student')).map(getStudentData)
        }

        function createStudentMarkup(student = {}) {
            return `
                <input type="text" name="student_name[]" placeholder="Р¤РРћ" value="${escapeAttr(student.name)}">
                <select name="student_education[]">
                    <option value="" ${student.education === '' ? 'selected' : ''}>Р’С‹Р±РµСЂРёС‚Рµ СѓСЂРѕРІРµРЅСЊ РѕР±СЂР°Р·РѕРІР°РЅРёСЏ</option>
                    <option value="0" ${student.education === '0' ? 'selected' : ''}>РќРµС‚ (РќРµС‚ Р°С‚С‚РµСЃС‚Р°С‚Р°)</option>
                    <option value="1" ${student.education === '1' ? 'selected' : ''}>РЎСЂРµРґРЅРµРµ (РЁРєРѕР»Р°)</option>
                    <option value="2" ${student.education === '2' ? 'selected' : ''}>РЎСЂРµРґРЅРµРµ РїСЂРѕС„РµСЃСЃРёРѕРЅР°Р»СЊРЅРѕРµ / Р’С‹СЃС€РµРµ</option>
                </select>
                <input type="email" name="student_email[]" placeholder="Email" value="${escapeAttr(student.email)}">
            `
        }

        // =============================
        // Р¤РЈРќРљР¦РР Р”Р›РЇ РљРћР Р—РРќР«
        // =============================
        function getCookieValuesByName(name) {
            return document.cookie
                .split('; ')
                .filter(row => row.startsWith(name + '='))
                .map(row => row.split('=').slice(1).join('='))
        }

        function getCart() {
            const allValues = getCookieValuesByName(COOKIE_NAME)
            if (!allValues.length) return []
            const latestValue = allValues[allValues.length - 1]
            return latestValue
                .split(',')
                .map(id => decodeURIComponent(String(id).trim()))
                .filter(id => id !== '')
        }

        function writeCartCookie(rawValue, maxAge, path, domain = '') {
            const securePart = location.protocol === 'https:' ? '; Secure' : ''
            const domainPart = domain ? `; domain=${domain}` : ''
            document.cookie = `${COOKIE_NAME}=${rawValue}; path=${path}; max-age=${maxAge}; SameSite=Lax${securePart}${domainPart}`
        }

        function getCookieDomainVariants() {
            const host = window.location.hostname
            const variants = ['']

            if (!host || host === 'localhost' || /^\d+\.\d+\.\d+\.\d+$/.test(host)) {
                return variants
            }

            variants.push(host)
            const parts = host.split('.')
            if (parts.length >= 2) {
                variants.push('.' + parts.slice(-2).join('.'))
            }

            return [...new Set(variants)]
        }

        function clearLegacyCartCookies() {
            const legacyPaths = new Set(['/korzina', '/korzina/', window.location.pathname])
            const domains = getCookieDomainVariants()
            legacyPaths.forEach(path => {
                if (!path) return
                domains.forEach(domain => {
                    writeCartCookie('', 0, path, domain)
                })
            })
        }

        function saveCart(ids) {
            const normalized = [...new Set(
                ids
                    .map(id => decodeURIComponent(String(id ?? '').trim()))
                    .filter(Boolean)
            )]

            clearLegacyCartCookies()
            writeCartCookie(normalized.join(','), COOKIE_MAX_AGE, '/')
        }

        function clearCartAfterSuccessfulOrder() {
            saveCart([])
            coursesWrap?.querySelectorAll('.superForm__cource').forEach(course => course.remove())
            if (typeof updateInstallmentButton === 'function') {
                updateInstallmentButton()
            }
            if (typeof updateCartWidget === 'function') {
                updateCartWidget()
            }
        }
        window.clearCartAfterSuccessfulOrder = clearCartAfterSuccessfulOrder

        function addToCart(productId) {
            let cart = getCart()
            const normalizedId = decodeURIComponent(String(productId))
            if (!cart.includes(normalizedId)) {
                cart.push(normalizedId)
                saveCart(cart)
                // РћР±РЅРѕРІР»СЏРµРј РІРёРґР¶РµС‚ РєРѕСЂР·РёРЅС‹
                if (typeof updateCartWidget === 'function') {
                    updateCartWidget()
                }
            }
        }

        function removeFromCart(productId) {
            let cart = getCart()
            const targetId = decodeURIComponent(String(productId))

            cart = cart.filter(id => String(id) !== targetId)
            saveCart(cart)
            // РћР±РЅРѕРІР»СЏРµРј РІРёРґР¶РµС‚ РєРѕСЂР·РёРЅС‹
            if (typeof updateCartWidget === 'function') {
                updateCartWidget()
            }
        }

        // =============================
        // Р”Р•Р›Р•Р“РР РћР’РђРќРР• РЎР§РЃРўР§РРљРђ Р РљРќРћРџРћРљ
        // =============================
        coursesWrap.addEventListener('click', e => {

            // --- СЃС‡С‘С‚С‡РёРєРё СЃР»СѓС€Р°С‚РµР»РµР№ ---
            const btn = e.target.closest('.superForm__counter-button')
            if (btn) {
                const course = btn.closest('.superForm__cource')
                const input = course.querySelector('.superForm__counter-input')
                let value = parseInt(input.value) || 0
                if (btn.dataset.action === 'increase') value++
                if (btn.dataset.action === 'decrease' && value > 0) value--
                input.value = value
                updateStudents(course)
                updateInstallmentButton()
            }

            // --- СѓРґР°Р»РёС‚СЊ РєСѓСЂСЃ РёР· РєРѕСЂР·РёРЅС‹ ---
            const removeBtn = e.target.closest('.removeFromCartBtn')
            if (removeBtn) {
                const productId = removeBtn.dataset.productId
                removeFromCart(productId)
                const course = removeBtn.closest('.superForm__cource')
                if (course) {
                    course.remove()
                    updateInstallmentButton() // РћР±РЅРѕРІР»СЏРµРј СЃРѕСЃС‚РѕСЏРЅРёРµ РєРЅРѕРїРєРё СЂР°СЃСЃСЂРѕС‡РєРё
                }
            }
        })

        coursesWrap.addEventListener('change', e => {
            if (e.target.classList.contains('superForm__counter-input')) {
                const course = e.target.closest('.superForm__cource')
                updateStudents(course)
                updateInstallmentButton()
            }
        })
        coursesWrap.addEventListener('input', e => {

            const studentBlock = e.target.closest('.superForm__student')
            if (!studentBlock) return

            // --- РІРІРѕРґ Р¤РРћ ---
            if (e.target.name === 'student_name[]') {
                tryAutofillStudent(studentBlock)
            }

            // --- Р»СЋР±РѕРµ РёР·РјРµРЅРµРЅРёРµ СЃРѕС…СЂР°РЅСЏРµРј ---
            if (
                e.target.name === 'student_name[]' ||
                e.target.name === 'student_birthdate[]' ||
                e.target.name === 'student_snils[]' ||
                e.target.name === 'student_education[]' ||
                e.target.name === 'student_email[]'
            ) {
                saveStudentToCache(studentBlock)
            }

        })

        // =============================
        // РћР‘РќРћР’Р›Р•РќРР• Р¤РћР Рњ РЎР›РЈРЁРђРўР•Р›Р•Р™
        // =============================
        function createStudentMarkup(student = {}) {
            return `
                <input type="text" name="student_name[]" placeholder="Р¤РРћ" value="${escapeAttr(student.name)}">
                <input type="text" name="student_birthdate[]" class="birthdate-input" placeholder="Р”Р°С‚Р° СЂРѕР¶РґРµРЅРёСЏ (Р”Р”.РњРњ.Р“Р“Р“Р“)" value="${escapeAttr(student.birthdate)}">
                <input type="text" name="student_snils[]" placeholder="РЎРќРР›РЎ" value="${escapeAttr(student.snils)}">
                <select name="student_education[]">
                    <option value="" ${student.education === '' ? 'selected' : ''}>Р’С‹Р±РµСЂРёС‚Рµ СѓСЂРѕРІРµРЅСЊ РѕР±СЂР°Р·РѕРІР°РЅРёСЏ</option>
                    <option value="0" ${student.education === '0' ? 'selected' : ''}>РќРµС‚ (РЅРµС‚ Р°С‚С‚РµСЃС‚Р°С‚Р°)</option>
                    <option value="1" ${student.education === '1' ? 'selected' : ''}>РЎСЂРµРґРЅРµРµ(РЁРєРѕР»Р°)</option>
                    <option value="2" ${student.education === '2' ? 'selected' : ''}>РЎСЂРµРґРЅРµРµ РїСЂРѕС„РµСЃСЃРёРѕРЅР°Р»СЊРЅРѕРµ / Р’С‹СЃС€РµРµ</option>
                </select>
                <input type="email" name="student_email[]" placeholder="Email" value="${escapeAttr(student.email)}">
            `
        }

        function updateStudents(course) {
            const input = course.querySelector('.superForm__counter-input')
            const container = course.querySelector('.superForm__students')
            const count = parseInt(input.value) || 0
            const existingStudents = getCourseStudentsData(course)

            container.innerHTML = ''
            for (let i = 0; i < count; i++) {
                const student = document.createElement('div')
                student.className = 'superForm__student'
                student.innerHTML = `
                <input type="text" name="student_name[]" placeholder="Р¤РРћ">
                <input type="text" name="student_birthdate[]" class="birthdate-input" placeholder="Р”Р°С‚Р° СЂРѕР¶РґРµРЅРёСЏ (Р”Р”.РњРњ.Р“Р“Р“Р“)">
                <input type="text" name="student_snils[]" placeholder="РЎРќРР›РЎ">
                <select name="student_education[]">
                    <option value="" selected>Р’С‹Р±РµСЂРёС‚Рµ СѓСЂРѕРІРµРЅСЊ РѕР±СЂР°Р·РѕРІР°РЅРёСЏ</option>
                    <option value="0">РќРµС‚ (РЅРµС‚ Р°С‚С‚РµСЃС‚Р°С‚Р°)</option>
                    <option value="1">РЎСЂРµРґРЅРµРµ(РЁРєРѕР»Р°)</option>
                    <option value="2">РЎСЂРµРґРЅРµРµ РїСЂРѕС„РµСЃСЃРёРѕРЅР°Р»СЊРЅРѕРµ / Р’С‹СЃС€РµРµ</option>
                </select>
                <input type="email" name="student_email[]" placeholder="Email">
            `
                container.appendChild(student)
            }

            initDateMask(container)
        }

        // =============================
        // РњРђРЎРљРђ Р”РђРўР«
        // =============================
        function initDateMask(scope) {
            scope.querySelectorAll('.birthdate-input').forEach(input => {
                input.addEventListener('input', e => {
                    let v = e.target.value.replace(/\D/g, '').slice(0, 8)
                    if (v.length > 4) {
                        e.target.value = `${v.slice(0, 2)}.${v.slice(2, 4)}.${v.slice(4)}`
                    } else if (v.length > 2) {
                        e.target.value = `${v.slice(0, 2)}.${v.slice(2)}`
                    } else {
                        e.target.value = v
                    }
                })
            })
        }

        // =============================
        // Р”РћР‘РђР’РРўР¬ РљРЈР РЎ
        // =============================
        if (addCourseBtn) {
            addCourseBtn.addEventListener('click', () => {
                const courceSelect = document.getElementById('cource-select')
                if (!courceSelect.value) {
                    alert('Р’С‹Р±РµСЂРёС‚Рµ РєСѓСЂСЃ')
                    return
                }

                const title = courceSelect.options[courceSelect.selectedIndex].text
                const selectCat = document.querySelector("#category-select")
                const selectCatVal = selectCat.options[selectCat.selectedIndex].value

                const course = document.createElement('div')
                course.className = 'superForm__cource'
                course.dataset.productId = courceSelect.value
                course.dataset.categoryId = selectCatVal
                course.dataset.mainCategoryId = selectCatVal
                course.dataset.price = courceSelect.options[courceSelect.selectedIndex].dataset.price || 0

                course.innerHTML = `
                <div class="superForm__cource-title">${title}</div>
                <div class="superForm__studentsCounterWrap">
                    <div class="superForm__studentsCounter-title">РљРѕР»РёС‡РµСЃС‚РІРѕ СЃР»СѓС€Р°С‚РµР»РµР№:</div>
                    <div class="superForm__studentsCounter">
                        <button type="button" class="superForm__counter-button" data-action="decrease">-</button>
                        <input type="number" class="superForm__counter-input" value="0" min="0">
                        <button type="button" class="superForm__counter-button" data-action="increase">+</button>
                    </div>
                </div>
                <div class="superForm__studentsWrap">
                    <div class="superForm__students-title">Р”Р°РЅРЅС‹Рµ СЃР»СѓС€Р°С‚РµР»РµР№:</div>
                    <div class="superForm__students"></div>
                </div>
                <div class="superForm__removeWrap">
                    <button type="button" class="removeFromCartBtn" data-product-id="${courceSelect.value}">РЈРґР°Р»РёС‚СЊ РёР· РєРѕСЂР·РёРЅС‹</button>
                </div>
            `

                coursesWrap.appendChild(course)
                addToCart(courceSelect.value)
                updateInstallmentButton()
            })
        }

        // =============================
        // РћР§РРЎРўРљРђ Р’РЎР•Р™ РљРћР Р—РРќР«
        // =============================
        function updateStudents(course) {
            const input = course.querySelector('.superForm__counter-input')
            const container = course.querySelector('.superForm__students')
            const count = parseInt(input.value) || 0
            const existingStudents = getCourseStudentsData(course)

            container.innerHTML = ''

            for (let i = 0; i < count; i++) {
                const student = document.createElement('div')
                student.className = 'superForm__student'
                student.innerHTML = createStudentMarkup(existingStudents[i] || {})
                container.appendChild(student)
            }

            initDateMask(container)
        }

        const clearBtn = document.querySelector('#clearCartBtn')
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                saveCart([])
                coursesWrap.querySelectorAll('.superForm__cource').forEach(c => c.remove())
                updateInstallmentButton() // РћР±РЅРѕРІР»СЏРµРј СЃРѕСЃС‚РѕСЏРЅРёРµ РєРЅРѕРїРєРё СЂР°СЃСЃСЂРѕС‡РєРё
                // РћР±РЅРѕРІР»СЏРµРј РІРёРґР¶РµС‚ РєРѕСЂР·РёРЅС‹
                if (typeof updateCartWidget === 'function') {
                    updateCartWidget()
                }
            })
        }

        function normalizeName(name) {
            return name.toLowerCase().replace(/\s+/g, '').trim()
        }

        // Р¤СѓРЅРєС†РёСЏ РґР»СЏ РѕР±РЅРѕРІР»РµРЅРёСЏ СЃРѕСЃС‚РѕСЏРЅРёСЏ РєРЅРѕРїРєРё СЂР°СЃСЃСЂРѕС‡РєРё
        function updateInstallmentButton() {
            const installmentBtn = document.querySelector('.installmentBtn')
            const nextBtn = document.querySelector('.toSlideThreeBtn')

            let totalSumm = 0
            let totalStudents = 0
            document.querySelectorAll('.superForm__cource').forEach(course => {
                const price = parseInt(course.dataset.price) || 0
                const input = course.querySelector('.superForm__counter-input')
                if (!input) return
                const count = parseInt(input.value) || 0
                totalSumm += price * count
                totalStudents += count
            })

            if (installmentBtn) {
                if (totalSumm >= 9900) {
                    installmentBtn.classList.remove('disabled')
                } else {
                    installmentBtn.classList.add('disabled')
                }
            }

            if (nextBtn) {
                if (totalStudents > 0) {
                    nextBtn.classList.remove('disabled')
                } else {
                    nextBtn.classList.add('disabled')
                }
            }
        }

        // РРЅРёС†РёР°Р»РёР·Р°С†РёСЏ РїСЂРё Р·Р°РіСЂСѓР·РєРµ СЃС‚СЂР°РЅРёС†С‹
        updateInstallmentButton()

        // РћР±РЅРѕРІР»СЏРµРј РІРёРґР¶РµС‚ РєРѕСЂР·РёРЅС‹ СЃ РЅРµР±РѕР»СЊС€РѕР№ Р·Р°РґРµСЂР¶РєРѕР№ РґР»СЏ РіР°СЂР°РЅС‚РёРё Р·Р°РіСЂСѓР·РєРё DOM
        setTimeout(() => {
            if (typeof updateCartWidget === 'function') {
                updateCartWidget()
            }
        }, 100)

        function saveStudentToCache(studentBlock) {

            const nameInput = studentBlock.querySelector('[name="student_name[]"]')
            const birthInput = studentBlock.querySelector('[name="student_birthdate[]"]')
            const snilsInput = studentBlock.querySelector('[name="student_snils[]"]')
            const eduSelect = studentBlock.querySelector('[name="student_education[]"]')
            const emailInput = studentBlock.querySelector('[name="student_email[]"]')

            if (!nameInput.value.trim()) return

            const key = normalizeName(nameInput.value)

            studentsCache[key] = {
                birthdate: birthInput.value,
                snils: snilsInput.value,
                education: eduSelect.value,
                email: emailInput.value
            }
        }

        function tryAutofillStudent(studentBlock) {

            const nameInput = studentBlock.querySelector('[name="student_name[]"]')
            const birthInput = studentBlock.querySelector('[name="student_birthdate[]"]')
            const snilsInput = studentBlock.querySelector('[name="student_snils[]"]')
            const eduSelect = studentBlock.querySelector('[name="student_education[]"]')
            const emailInput = studentBlock.querySelector('[name="student_email[]"]')

            const key = normalizeName(nameInput.value)

            if (studentsCache[key]) {
                const data = studentsCache[key]

                birthInput.value = data.birthdate
                snilsInput.value = data.snils
                eduSelect.value = data.education
                emailInput.value = data.email
            }
        }


    })
</script>


<!-- Р’С‹Р±РѕСЂ С‚РёРїР° РѕРїР»Р°С‚С‹ -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navigation = window.superFormNavigation || {}

        const invoiceSlide = document.querySelector('.invoiceSlide')
        const onlinePaySlide = document.querySelector('.onlinePaySlide')
        const installmentSlide = document.querySelector('.installmentSlide')
        const slideNow = document.querySelector('.superForm__step-3')

        const payForListBtn = document.querySelector('.payForListBtn')
        console.log(payForListBtn);


        const installmentBtn = document.querySelector('.installmentBtn')

        const toSlideThreeBtn = document.querySelector('.toSlideThreeBtn')




        toSlideThreeBtn.addEventListener('click', () => {

            let totalSumm = 0

            document.querySelectorAll('.superForm__cource').forEach(course => {

                const price = parseInt(course.dataset.price) || 0
                const input = course.querySelector('.superForm__counter-input')

                if (!input) return

                const count = parseInt(input.value) || 0

                totalSumm += price * count
            })

            // Р•СЃР»Рё СЃСѓРјРјР° >= 9900, СѓР±РёСЂР°РµРј disabled СЃ РєРЅРѕРїРєРё СЂР°СЃСЃСЂРѕС‡РєРё
            if (totalSumm >= 9900) {
                installmentBtn.classList.remove('disabled')
            } else {
                installmentBtn.classList.add('disabled')
            }


        })

        payForListBtn.addEventListener('click', () => {

            navigation.setActiveSlide?.(invoiceSlide)



        })

        // Р”РѕР±Р°РІР»СЏРµРј РѕР±СЂР°Р±РѕС‚С‡РёРє РєР»РёРєР° РґР»СЏ РєРЅРѕРїРєРё СЂР°СЃСЃСЂРѕС‡РєРё
        installmentBtn.addEventListener('click', () => {

            // РџСЂРѕРІРµСЂСЏРµРј, С‡С‚Рѕ РєРЅРѕРїРєР° РЅРµ Р·Р°Р±Р»РѕРєРёСЂРѕРІР°РЅР°
            if (!installmentBtn.classList.contains('disabled')) {
                navigation.setActiveSlide?.(installmentSlide)
            }
        })

        // Р”РѕР±Р°РІР»СЏРµРј РѕР±СЂР°Р±РѕС‚С‡РёРє РґР»СЏ РєРЅРѕРїРєРё РѕРЅР»Р°Р№РЅ-РѕРїР»Р°С‚С‹
        const onlinePayBtn = document.querySelector('.payBtn:not(.installmentBtn)')
        if (onlinePayBtn) {
            onlinePayBtn.addEventListener('click', () => {
                navigation.setActiveSlide?.(onlinePaySlide)
            })
        }

        // Р¤СѓРЅРєС†РёСЏ РґР»СЏ РѕР±РЅРѕРІР»РµРЅРёСЏ СЃРѕСЃС‚РѕСЏРЅРёСЏ РєРЅРѕРїРєРё СЂР°СЃСЃСЂРѕС‡РєРё
        function updateInstallmentButton() {
            let totalSumm = 0

            document.querySelectorAll('.superForm__cource').forEach(course => {
                const price = parseInt(course.dataset.price) || 0
                const input = course.querySelector('.superForm__counter-input')

                if (!input) return

                const count = parseInt(input.value) || 0
                totalSumm += price * count

                // РћС‚Р»Р°РґРєР° - РІС‹РІРѕРґРёРј РєР°Р¶РґС‹Р№ РєСѓСЂСЃ
                console.log(`РљСѓСЂСЃ: С†РµРЅР°=${price}, РєРѕР»-РІРѕ=${count}, СЃСѓРјРјР°=${price * count}`)
            })

            // РћС‚Р»Р°РґРєР° - РІС‹РІРѕРґРёРј РѕР±С‰СѓСЋ СЃСѓРјРјСѓ
            console.log(`РћР±С‰Р°СЏ СЃСѓРјРјР°: ${totalSumm}, РїРѕСЂРѕРі: 9900`)
            console.log(`РЈСЃР»РѕРІРёРµ РґР»СЏ Р°РєС‚РёРІР°С†РёРё: ${totalSumm >= 9900}`)

            // Р•СЃР»Рё СЃСѓРјРјР° >= 9900, СѓР±РёСЂР°РµРј disabled СЃ РєРЅРѕРїРєРё СЂР°СЃСЃСЂРѕС‡РєРё
            if (totalSumm >= 9900) {
                installmentBtn.classList.remove('disabled')
                console.log('РљР»Р°СЃСЃ disabled РЈР‘Р РђРќ')
            } else {
                installmentBtn.classList.add('disabled')
                console.log('РљР»Р°СЃСЃ disabled Р”РћР‘РђР’Р›Р•Рќ')
            }
        }

        // Р’С‹Р·С‹РІР°РµРј С„СѓРЅРєС†РёСЋ РїСЂРё Р·Р°РіСЂСѓР·РєРµ СЃС‚СЂР°РЅРёС†С‹
        updateInstallmentButton()

        // Р”РѕР±Р°РІР»СЏРµРј РѕР±СЂР°Р±РѕС‚С‡РёРєРё РґР»СЏ РѕР±РЅРѕРІР»РµРЅРёСЏ РїСЂРё РёР·РјРµРЅРµРЅРёРё РєРѕР»РёС‡РµСЃС‚РІР°
        document.addEventListener('input', (e) => {
            if (e.target.classList.contains('superForm__counter-input')) {
                updateInstallmentButton()
            }
        })

        // Р”РѕР±Р°РІР»СЏРµРј РѕР±СЂР°Р±РѕС‚С‡РёРєРё РґР»СЏ РєРЅРѕРїРѕРє + Рё -
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('superForm__counter-button')) {
                setTimeout(updateInstallmentButton, 10) // РќРµР±РѕР»СЊС€Р°СЏ Р·Р°РґРµСЂР¶РєР° РґР»СЏ РѕР±РЅРѕРІР»РµРЅРёСЏ Р·РЅР°С‡РµРЅРёСЏ
            }
        })

        // РђРІС‚РѕР·Р°РїРѕР»РЅРµРЅРёРµ РїРѕР»РµР№ РѕСЂРіР°РЅРёР·Р°С†РёРё РїРѕ РРќРќ
        document.addEventListener('input', (e) => {
            if (e.target.name === 'ORGANIZATION_INN') {
                const inn = e.target.value.trim();
                
                // Р—Р°РїСѓСЃРєР°РµРј Р°РІС‚РѕР·Р°РїРѕР»РЅРµРЅРёРµ С‚РѕР»СЊРєРѕ РµСЃР»Рё РРќРќ СЃРѕСЃС‚РѕРёС‚ РёР· 10 С†РёС„СЂ
                if (inn.length === 10) {
                    fetchOrganizationData(inn);
                }
            }
        });

        // Р¤СѓРЅРєС†РёСЏ РґР»СЏ РїРѕР»СѓС‡РµРЅРёСЏ РґР°РЅРЅС‹С… РѕСЂРіР°РЅРёР·Р°С†РёРё РїРѕ РРќРќ
        async function fetchOrganizationData(inn) {
            try {
                // Р—РґРµСЃСЊ РЅСѓР¶РЅРѕ СѓРєР°Р·Р°С‚СЊ РІР°С€ API РєР»СЋС‡ DaData
                const response = await fetch('https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Token b807bc59c7faa1ab5c67376b51df520341736485',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        query: inn,
                        count: 1
                    })
                });

                const data = await response.json();
                
                if (data.suggestions && data.suggestions.length > 0) {
                    const org = data.suggestions[0].data;
                    fillOrganizationFields(org);
                }
            } catch (error) {
                console.error('РћС€РёР±РєР° РїСЂРё РїРѕР»СѓС‡РµРЅРёРё РґР°РЅРЅС‹С… РѕСЂРіР°РЅРёР·Р°С†РёРё:', error);
            }
        }

        // Р¤СѓРЅРєС†РёСЏ РґР»СЏ Р·Р°РїРѕР»РЅРµРЅРёСЏ РїРѕР»РµР№ С„РѕСЂРјС‹
        function fillOrganizationFields(org) {
            // Р—Р°РїРѕР»РЅСЏРµРј РїРѕР»СЏ РµСЃР»Рё РґР°РЅРЅС‹Рµ РµСЃС‚СЊ
            if (org.name?.full_with_opf) {
                document.querySelector('[name="ORGANIZATION_NAME"]')?.setAttribute('value', org.name.full_with_opf);
            }
            
            if (org.inn) {
                document.querySelector('[name="ORGANIZATION_INN"]').value = org.inn;
            }
            
            if (org.kpp) {
                document.querySelector('[name="ORGANIZATION_KPP"]').value = org.kpp;
            }
            
            if (org.address?.unrestricted_value) {
                document.querySelector('[name="ORGANIZATION_UR_ADDR"]').value = org.address.unrestricted_value;
            }
            
            if (org.address?.data?.source) {
                document.querySelector('[name="ORGANIZATION_FACT_ADDR"]').value = org.address.data.source;
            }
            
            if (org.phones && org.phones.length > 0) {
                const orgPhoneInput = document.querySelector('[name="ORGANIZATION_PHONE"]');
                if (orgPhoneInput) {
                    const formatPhone = window.superFormValidationUtils?.formatRussianPhone;
                    const clearField = window.superFormValidationUtils?.clearFieldError;
                    const attachMask = window.superFormValidationUtils?.attachRussianPhoneMask;
                    orgPhoneInput.value = typeof formatPhone === 'function'
                        ? formatPhone(org.phones[0].value)
                        : org.phones[0].value;
                    if (typeof attachMask === 'function') attachMask(orgPhoneInput);
                    if (typeof clearField === 'function') clearField(orgPhoneInput);
                }
            }
            
            if (org.emails && org.emails.length > 0) {
                const orgEmailInput = document.querySelector('[name="ORGANIZATION_EMAIL"]');
                if (orgEmailInput) {
                    orgEmailInput.value = org.emails[0].value;
                    const clearField = window.superFormValidationUtils?.clearFieldError;
                    if (typeof clearField === 'function') clearField(orgEmailInput);
                }
            }
        }

        document.addEventListener('input', (e) => {
            if (e.target.classList.contains('superForm__counter-input')) {
                updateInstallmentButton()
            }
        })

        // Р”РѕР±Р°РІР»СЏРµРј РѕР±СЂР°Р±РѕС‚С‡РёРєРё РґР»СЏ РєРЅРѕРїРѕРє + Рё -
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('superForm__counter-button')) {
                setTimeout(updateInstallmentButton, 10) // РќРµР±РѕР»СЊС€Р°СЏ Р·Р°РґРµСЂР¶РєР° РґР»СЏ РѕР±РЅРѕРІР»РµРЅРёСЏ Р·РЅР°С‡РµРЅРёСЏ
            }
        })

    })
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleAddCourceBar = document.querySelector('.toggleAddCourceBar')
        const addCourceWrap = document.querySelector('.addCourceWrap')

        toggleAddCourceBar.addEventListener('click', () => {
            addCourceWrap.classList.toggle('active')
        })

    })
</script>



<?php get_footer(); ?>
