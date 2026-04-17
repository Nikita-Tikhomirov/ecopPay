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


if (($_POST['formid'] ?? '') !== 'quiz_manager') {
    echo json_encode(['success' => false, 'message' => 'Неверный formid']);
    exit;
}


/* =========================
   ОСНОВНЫЕ ДАННЫЕ
========================= */

$fio   = trim($_POST['fio'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$form  = trim($_POST['learning_form'] ?? '');


/* =========================
   КУРСЫ
========================= */

$courses = $_POST['courses'] ?? [];


/* =========================
   ФОРМИРУЕМ ПИСЬМО
========================= */

$message = "
<html>
<body>
<h2>Оформление заявки на обучение (требуется связь менеджера)</h2>

<p><b>ФИО:</b> {$fio}</p>
<p><b>Телефон:</b> {$phone}</p>
<p><b>Email:</b> {$email}</p>
<p><b>Форма обучения:</b> {$form}</p>


<hr>
<h3>Курсы и слушатели</h3>
";


foreach ($courses as $courseIndex => $course) {

    $title = esc_html($course['title'] ?? 'Без названия');

    $message .= "<h4>Курс: {$title}</h4>";

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


/* =========================
   ОТПРАВКА
========================= */

$to = 'dir@ecoprf.ru';
$subject = 'Оформление заявки на обучение (требуется связь менеджера)';

$headers = ['Content-Type: text/html; charset=UTF-8'];

if (wp_mail($to, $subject, $message, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка отправки']);
}
