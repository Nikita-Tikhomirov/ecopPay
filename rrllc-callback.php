<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$logFile = $_SERVER['DOCUMENT_ROOT'] . '/rrllc_callback_log.txt';

/* Фиксируем HIT */
file_put_contents($logFile, "HIT " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

/* Подключаем WP */
define('WP_USE_THEMES', false);
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

/* Получаем RAW */
$input = file_get_contents('php://input');
$data = json_decode($input, true);

/* Лог */
$log = "\n\n==== " . date('Y-m-d H:i:s') . " ====\n";
$log .= "RAW:\n" . $input . "\n\n";
$log .= "PARSED:\n" . print_r($data, true) . "\n";
file_put_contents($logFile, $log, FILE_APPEND);

/* Данные RRLLC */
$orderId = $data['id'] ?? '';
$status = $data['newStatus'] ?? '';
$type = $data['type'] ?? '';

if (!$orderId) {
    file_put_contents($logFile, "ERROR: no orderId\n", FILE_APPEND);
    http_response_code(200);
    echo 'OK';
    exit;
}

/* Важно: получаем заказ после того, как есть orderId */
$orderData = get_option('rrllc_order_' . $orderId);

/* Если нет - логируем */
if (!$orderData) {
    file_put_contents($logFile, "ERROR: order not found in WP\n", FILE_APPEND);
}

/* Достаём данные */
$email = $orderData['email'] ?? '';
$phone = $orderData['phone'] ?? '';
$amount = $orderData['amount'] ?? '';

/* Человекочитаемый статус */
$statusText = 'Неизвестный статус';

switch ($status) {
    case 'created':
        $statusText = 'Заказ создан';
        break;

    case 'authorized':
        $statusText = 'Оплата успешно прошла';
        break;

    case 'failed':
        $statusText = 'Ошибка оплаты';
        break;

    case 'cancelled':
        $statusText = 'Оплата отменена';
        break;
}

/* Обновляем статус в WP */
if ($orderData) {
    $orderData['status'] = $status;
    update_option('rrllc_order_' . $orderId, $orderData);
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

$headers = ['Content-Type: text/html; charset=UTF-8'];

/* ===================== */
/* ПИСЬМО АДМИНУ */
/* ===================== */

$adminMessage = "
<html><body>
<h3>Статус заказа RRLLC</h3>
<p><b>ID:</b> {$orderId}</p>
<p><b>Статус:</b> {$statusText}</p>
<p><b>Код:</b> {$status}</p>
<p><b>Email:</b> {$email}</p>
<p><b>Телефон:</b> {$phone}</p>
<p><b>Сумма:</b> {$amount}</p>
</body></html>";

wp_mail('dir@ecoprf.ru', 'RRLLC заказ ' . $orderId, $adminMessage, $headers);

/* ===================== */
/* ПИСЬМО КЛИЕНТУ */
/* ===================== */

if ($email) {
    $clientMessage = "
    <html><body>
        <h3>Статус вашего заказа</h3>
        <p>{$statusText}</p>
        <p><b>Номер заказа:</b> {$orderId}</p>
        <p><b>Сумма:</b> {$amount} ₽</p>
    </body></html>";

    wp_mail($email, 'Статус заказа', $clientMessage, $headers);
    file_put_contents($logFile, "CLIENT EMAIL SENT to {$email}\n", FILE_APPEND);
} else {
    file_put_contents($logFile, "NO EMAIL FOUND\n", FILE_APPEND);
}

/* Ответ RRLLC */
http_response_code(200);
echo 'OK';
