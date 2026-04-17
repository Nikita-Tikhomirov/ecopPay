<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

define('WP_USE_THEMES', false);
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

function normalize_education_label($value)
{
    $value = (string) $value;

    $map = [
        '0' => 'Нет (нет аттестата)',
        '1' => 'Среднее (школа)',
        '2' => 'Среднее профессиональное / Высшее',
    ];

    return $map[$value] ?? $value;
}


/* SMTP */
add_action('phpmailer_init', function ($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.yandex.ru';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = 'ecoprf@yandex.ru';
    $phpmailer->Password = 'avxpxtlimyzmyvuy';
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Port = 465;
    $phpmailer->CharSet = 'UTF-8';
    $phpmailer->setFrom('ecoprf@yandex.ru', 'ecoprf.ru');
});


if (($_POST['formid'] ?? '') !== 'quiz_invoice') {
    echo json_encode(['success' => false]);
    exit;
}


/* =========================
   ОСНОВНЫЕ ДАННЫЕ
========================= */

$fio   = $_POST['fio'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$form  = $_POST['learning_form'] ?? '';
$page  = $_POST['page'] ?? '';

/* =========================
   ОРГАНИЗАЦИЯ
========================= */

$org = [
    'ИНН' => $_POST['ORGANIZATION_INN'] ?? '',
    'КПП' => $_POST['ORGANIZATION_KPP'] ?? '',
    'Юр. адрес' => $_POST['ORGANIZATION_UR_ADDR'] ?? '',
    'Факт. адрес' => $_POST['ORGANIZATION_FACT_ADDR'] ?? '',
    'Телефон' => $_POST['ORGANIZATION_PHONE'] ?? '',
    'Email' => $_POST['ORGANIZATION_EMAIL'] ?? '',
    'Р/С' => $_POST['ORGANIZATION_RS'] ?? '',
    'К/С' => $_POST['ORGANIZATION_KS'] ?? '',
    'Банк' => $_POST['ORGANIZATION_BANK'] ?? '',
    'БИК' => $_POST['ORGANIZATION_BIK'] ?? '',
];

$signer = [
    'ФИО' => $_POST['SIGNER_FIO'] ?? '',
    'Должность' => $_POST['SIGNER_POSITION'] ?? '',
    'Основание' => $_POST['SIGNER_BASE'] ?? '',
];

$courses = $_POST['courses'] ?? [];


/* =========================
   ПИСЬМО
========================= */

$message = "<html><body>";

$message .= "<h2>Заявка на оплату по счету</h2>";

$message .= "
<p><b>ФИО:</b> {$fio}</p>
<p><b>Телефон:</b> {$phone}</p>
<p><b>Email:</b> {$email}</p>
<p><b>Форма обучения:</b> {$form}</p>
<p><b>Страница:</b> {$page}</p>
<hr>
<h3>Реквизиты организации</h3>
";

foreach ($org as $k => $v) {
    $message .= "<p><b>{$k}:</b> " . esc_html($v) . "</p>";
}

$message .= "<hr><h3>Подписант</h3>";

foreach ($signer as $k => $v) {
    $message .= "<p><b>{$k}:</b> " . esc_html($v) . "</p>";
}

$message .= "<hr><h3>Курсы и слушатели</h3>";

foreach ($courses as $course) {

    $title = esc_html($course['title'] ?? '');

    $message .= "<h4>{$title}</h4>";

    if (!empty($course['students'])) {

        $message .= "<table border='1' cellpadding='6' cellspacing='0'>
        <tr>
            <th>ФИО</th>
            <th>Дата рождения</th>
            <th>СНИЛС</th>
            <th>Образование</th>
            <th>Email</th>
        </tr>";

        foreach ($course['students'] as $student) {

            $message .= "<tr>
                <td>" . esc_html($student['name'] ?? '') . "</td>
                <td>" . esc_html($student['birthdate'] ?? '') . "</td>
                <td>" . esc_html($student['snils'] ?? '') . "</td>
                <td>" . esc_html(normalize_education_label($student['education'] ?? '')) . "</td>
                <td>" . esc_html($student['email'] ?? '') . "</td>
            </tr>";
        }

        $message .= "</table><br>";
    }
}

$message .= "</body></html>";


$headers = ['Content-Type: text/html; charset=UTF-8'];

if (wp_mail('dir@ecoprf.ru', 'Оплата по счету', $message, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
