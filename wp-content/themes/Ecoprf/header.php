<!DOCTYPE html>
<html lang="ru">

<head>

    <?php wp_head(); ?>

    <?php if (is_category()) {
        $categories = get_the_category();
        $category_id = $categories[0]->term_id;
        echo '<link rel="canonical" href="' . get_category_link($category_id) . '" />';
    } else { ?>
        <link rel="canonical" href="<?php echo get_permalink(get_the_ID()); ?>">
    <?php } ?>

    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">




</head>

<style>
    .customMobilePhone {
        display: none;
    }

    @media (max-width: 768px) {
        .header__phones span {
            display: none;
        }

        .head-messengers {
            display: none;
        }

        .customMobilePhone {
            display: block;
            text-align: center;
            order: 1;
        }

        .logo {
            order: 1;
            flex: 35%;
        }

        .menu_fixed__open .head-messengers {
            display: flex;
        }
    }
</style>

<body <?php body_class(); ?>>


    <div class="header-wrap">

        <div class="header" id="myHeader">

            <div class="header-top">

                <a href="/" class="logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/Logo2.webp"
                        alt="Логотип Учебного центра">
                </a>

                <div class="header-lic">
                    Образовательная лицензия <br />Л035-01271-78/00176710
                </div>
                <a class="htel" href="mailto:info@ecoprf.ru">info@ecoprf.ru</a>
                <div class="header__phones">
                    <a class="htel" style="margin-bottom:5px" href="tel:88005500320">8 (800) 550-03-20</a>
                    <span>Бесплатно по всей России</span>
                </div>
                <!-- <a class="htel" href="tel:+78129605008">+7 (812) 960-50-08</a> -->

                <div class="head-messengers">

                    <a target="_blank" href="https://wa.me/79219605008" class="whatsapp">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/whatsapp.svg" alt="whatsapp">
                    </a>
                    <a target="_blank" href="https://t.me/ecoprf" class="telegram">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/telegram.svg" alt="telegram">
                    </a>
					 <a target="_blank" href="https://max.ru/u/f9LHodD0cOJYwKfJtpipc8bc6MHHMQz2NRP-oTA2YM00m2-ShL3Iok7aWnk" class="telegram">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/max.svg" alt="Макс">
                    </a>


                </div>
                <a href="tel:88005500320" class="customMobilePhone">
                    <i class="svg inline  svg-inline-phone" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg"
                            width="14" height="14" viewBox="0 0 14 14">
                            <defs>
                                <style>
                                    .pcls-1 {
                                        fill: #222;
                                        fill-rule: evenodd;
                                    }
                                </style>
                            </defs>
                            <path class="pcls-1"
                                d="M14,11.052a0.5,0.5,0,0,0-.03-0.209,1.758,1.758,0,0,0-.756-0.527C12.65,10,12.073,9.69,11.515,9.363a2.047,2.047,0,0,0-.886-0.457c-0.607,0-1.493,1.8-2.031,1.8a2.138,2.138,0,0,1-.856-0.388A9.894,9.894,0,0,1,3.672,6.253,2.134,2.134,0,0,1,3.283,5.4c0-.536,1.8-1.421,1.8-2.027a2.045,2.045,0,0,0-.458-0.885C4.3,1.932,3.99,1.355,3.672.789A1.755,1.755,0,0,0,3.144.034,0.5,0.5,0,0,0,2.935,0,4.427,4.427,0,0,0,1.551.312,2.62,2.62,0,0,0,.5,1.524,3.789,3.789,0,0,0-.011,3.372a7.644,7.644,0,0,0,.687,2.6A9.291,9.291,0,0,0,1.5,7.714a16.783,16.783,0,0,0,4.778,4.769,9.283,9.283,0,0,0,1.742.825,7.673,7.673,0,0,0,2.608.686,3.805,3.805,0,0,0,1.851-.507,2.62,2.62,0,0,0,1.214-1.052A4.418,4.418,0,0,0,14,11.052Z">
                            </path>
                        </svg>
                    </i>
                    8 (800) 550-03-20</a>

                <div class="header__buttons-wrap">
                    <a data-fancybox data-src="#hidden-content" href="javascript:;"
                        class="header-message header-message__top">Заказать
                        звонок</a>
                    <a href="https://ecoprf.upft.ru/" target="_blank" class="header-message"
                        style="margin-top:10px;text-align:center;">Личный кабинет</a>
                </div>


                <a href="#" class="header-menu-mobile">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>

            </div>

            <div class="header-bottom" style="position:relative">

                <?php echo get_template_part('templates/header-menu'); ?>

                <div class="hederSearch">
                    <svg fill="#0d5bd9" height="30px" width="30px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 512.001 512.001" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <g>
                                    <path
                                        d="M499.987,441.994L357.588,299.594c-3.984-3.983-10.44-3.983-14.425,0l-14.578,14.578l-21.924-21.924 c27.654-31.039,44.488-71.92,44.488-116.664c0-96.812-78.763-175.575-175.575-175.575S0,78.772,0,175.585 s78.763,175.575,175.575,175.575c44.744,0,85.624-16.833,116.664-44.487l21.924,21.924l-14.578,14.578 c-3.983,3.983-3.983,10.441,0,14.425l142.398,142.398c0,0,0,0,0.001,0c7.996,7.995,18.498,11.993,29.001,11.993 c10.503,0,21.006-3.998,29.001-11.993c7.748-7.746,12.014-18.046,12.014-29.001C512,460.039,507.734,449.74,499.987,441.994z M175.575,330.761c-85.565,0-155.177-69.612-155.177-155.176c0-85.565,69.612-155.177,155.177-155.177 S330.752,90.02,330.752,175.585S261.14,330.761,175.575,330.761z M485.563,485.573c-8.037,8.038-21.115,8.039-29.156,0h0.001 L321.221,350.386l29.155-29.155l135.187,135.186c3.893,3.894,6.038,9.071,6.038,14.578 C491.602,476.502,489.457,481.679,485.563,485.573z">
                                    </path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M58.309,182.024c-0.115-2.13-0.173-4.297-0.173-6.44c0-5.633-4.566-10.199-10.199-10.199 c-5.633,0-10.199,4.566-10.199,10.199c0,2.508,0.068,5.046,0.203,7.54c0.294,5.437,4.795,9.649,10.176,9.649 c0.186,0,0.372-0.005,0.559-0.015C54.3,192.456,58.613,187.65,58.309,182.024z">
                                    </path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M175.575,293.024c-44.357,0-84.459-24.559-104.654-64.091c-2.563-5.016-8.704-7.006-13.723-4.443 c-5.016,2.563-7.006,8.706-4.443,13.723c23.699,46.391,70.761,75.21,122.819,75.21c5.633,0,10.199-4.566,10.199-10.199 S181.208,293.024,175.575,293.024z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>

            </div>



        </div>

        <?php if (function_exists('dimox_breadcrumbs'))
            dimox_breadcrumbs(); ?>

    </div>

    <style>
        .hederSearch {
            width: 30px;
            height: 30px;
            position: absolute;
            top: 9px;
            right: 40px;
            z-index: 2;
            cursor: pointer;
        }

        .newCustomPopupSearch {
            background: rgba(0, 0, 0, 0.747) !important
        }

        .newCustomPopupSearch .newCustomPopup__wrap {
            max-width: 1000px;
        }

        .newCustomPopupSearch .newCustomPopup__wrap form {
            max-width: 100%;
        }

        .newCustomPopupSearch .form-group input:first-child {
            min-width: 500px;
        }

        .newCustomPopupSearch .form-group input:last-child {
            width: fit-content;
            padding: 0px 35px;
        }

        .hederSearch svg {}

        @media (min-width: 320px) and (max-width: 1500px) {
            .hederSearch {
                top: 0;
            }

            .hederSearch svg {
                width: 24px;
            }
        }

        @media (max-width: 768px) {
            .newCustomPopupSearch .newCustomPopup__wrap {
                max-width: 100%;
                background: none
            }

            .newCustomPopupSearch .form-group input:first-child {
                min-width: max-content;
            }
        }
    </style>