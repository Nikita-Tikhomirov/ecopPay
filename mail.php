<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

define('WP_USE_THEMES', false);
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

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

if (($_POST['formid'] ?? '') !== 'quiz') {
    echo json_encode(['success' => false, 'message' => 'Неверный formid']);
    exit;
}

$fio   = trim($_POST['fio'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$form  = trim($_POST['learning_form'] ?? '');


if (!$fio || !$phone || !$email) {
    echo json_encode(['success' => false, 'message' => 'Не все поля заполнены']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Некорректный email']);
    exit;
}

$to = 'dir@ecoprf.ru';
$subject = 'Оформление заявки на обучение';

$message = "
<html>
<body>
    <h3>Новая заявка с квиза</h3>
    <p><b>ФИО:</b> {$fio}</p>
    <p><b>Телефон:</b> {$phone}</p>
    <p><b>Email:</b> {$email}</p>
    <p><b>Форма обучения:</b> {$form}</p>
</body>
</html>";

$headers = ['Content-Type: text/html; charset=UTF-8'];

if (wp_mail($to, $subject, $message, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка отправки']);
}
