<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

define('WP_USE_THEMES', false);
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

$logFile = $_SERVER['DOCUMENT_ROOT'] . '/rrllc_log.txt';

function log_rrllc($msg)
{
    global $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . ' ' . $msg . "\n", FILE_APPEND);
}

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

$login = 'battle-ecoprf';
$password = 'SpgmpAijJpfGavgsvoKJLOjF';
$url = 'https://pay.rrllc.ru/api/v2/createOrder';

log_rrllc('POST data: ' . print_r($_POST, true));

$fio = trim($_POST['fio'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$form = trim($_POST['learning_form'] ?? '');
$page = trim($_POST['page'] ?? '');
$paymentType = trim($_POST['payment_type'] ?? 'Онлайн-оплата');
$courses = $_POST['courses'] ?? [];

if (!$fio || !$phone || !$email) {
    log_rrllc('Ошибка: нет данных клиента');
    echo json_encode(['success' => false, 'message' => 'Нет данных клиента']);
    exit;
}

// RRLLC принимает телефон ограниченной длины (до 14 символов),
// поэтому отправляем номер в нормализованном международном формате.
$phoneDigits = preg_replace('/\D+/', '', $phone);
if (strlen($phoneDigits) === 11 && strpos($phoneDigits, '8') === 0) {
    $phoneDigits = '7' . substr($phoneDigits, 1);
}
if (strlen($phoneDigits) === 10) {
    $phoneDigits = '7' . $phoneDigits;
}
$phone = '+' . $phoneDigits;

if (strlen($phone) > 14 || strlen($phoneDigits) < 10) {
    log_rrllc('Ошибка: некорректный телефон после нормализации: ' . $phone);
    echo json_encode([
        'success' => false,
        'message' => 'Некорректный телефон. Используйте формат +7XXXXXXXXXX',
    ]);
    exit;
}

$items = [];
$totalAmount = 0;

if (!empty($courses)) {
    foreach ($courses as $course) {
        $title = $course['title'] ?? 'Курс';
        $price = (float) ($course['price'] ?? 0);
        $studentsCount = isset($course['students']) ? count($course['students']) : 1;
        $sum = $price * $studentsCount;
        $totalAmount += $sum;

        $items[] = [
            'name' => $title,
            'quantity' => $studentsCount,
            'price' => number_format($price, 2, '.', ''),
        ];
    }
}

log_rrllc("Сумма заказа: {$totalAmount} ₽");

if (empty($items) || $totalAmount <= 0) {
    log_rrllc('Ошибка: пустая корзина или нулевая сумма заказа');
    echo json_encode([
        'success' => false,
        'message' => 'Добавьте курс и укажите хотя бы одного слушателя',
    ]);
    exit;
}

$orderId = 'ecoprf_' . time() . '_' . uniqid();

$params = [
    'order' => [
        'version' => '2.0',
        'id' => $orderId,
        'amount' => number_format($totalAmount, 2, '.', ''),
        'currency' => 'RUB',
        'items' => $items,
    ],
    'client_info' => [
        'first_name' => $fio,
        'phone' => $phone,
        'email' => $email,
    ],
    'notification_url' => 'https://ecoprf.ru/rrllc-callback.php',
    'complete_url' => 'https://ecoprf.ru/payment-success/',
    'fail_url' => 'https://ecoprf.ru/payment-error/',
];

$orderData = [
    'fio' => $fio,
    'phone' => $phone,
    'email' => $email,
    'learning_form' => $form,
    'payment_type' => $paymentType,
    'page' => $page,
    'amount' => $totalAmount,
    'items' => $items,
    'courses' => $courses,
    'status' => 'created',
];

update_option('rrllc_order_' . $orderId, $orderData);

$headers = [
    'Authorization: Basic ' . base64_encode($login . ':' . $password),
    'Content-Type: application/json',
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($params, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 20,
    CURLOPT_CONNECTTIMEOUT => 10,
]);

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$curlError = curl_error($curl);
$jsonResponse = json_decode($response, true);
$jsonError = json_last_error();
$jsonErrorMessage = json_last_error_msg();
curl_close($curl);

log_rrllc("RRLLC HTTP code: $httpCode");
log_rrllc("RRLLC raw response: " . ($response === false ? 'false' : $response));
if (!empty($curlError)) {
    log_rrllc("RRLLC cURL error: $curlError");
}
if ($jsonError !== JSON_ERROR_NONE) {
    log_rrllc("RRLLC JSON decode error: $jsonErrorMessage");
}
log_rrllc("RRLLC parsed response: " . print_r($jsonResponse, true));

if ($response === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка связи с платежным шлюзом',
        'details' => $curlError ?: 'empty cURL error',
    ]);
    exit;
}

if ($response !== false && $httpCode == 200 && !empty($jsonResponse['link'])) {
    $adminMessage = "<html><body>";
    $adminMessage .= "<h2>Заявка на {$paymentType}</h2>";
    $adminMessage .= "<p><b>ФИО:</b> " . esc_html($fio) . "</p>";
    $adminMessage .= "<p><b>Телефон:</b> " . esc_html($phone) . "</p>";
    $adminMessage .= "<p><b>Email:</b> " . esc_html($email) . "</p>";
    $adminMessage .= "<p><b>Форма обучения:</b> " . esc_html($form) . "</p>";
    $adminMessage .= "<p><b>Тип оплаты:</b> " . esc_html($paymentType) . "</p>";
    $adminMessage .= "<p><b>Сумма:</b> " . number_format($totalAmount, 2, '.', ' ') . " ₽</p>";
    $adminMessage .= "<p><b>Order ID:</b> " . esc_html($orderId) . "</p>";
    $adminMessage .= "<p><b>Страница:</b> " . esc_html($page) . "</p>";
    $adminMessage .= "<p><b>Ссылка на оплату:</b> <a href='" . esc_url($jsonResponse['link']) . "'>" . esc_html($jsonResponse['link']) . "</a></p>";
    $adminMessage .= "<hr><h3>Курсы и слушатели</h3>";

    foreach ($courses as $course) {
        $title = esc_html($course['title'] ?? '');
        $price = number_format((float) ($course['price'] ?? 0), 2, '.', ' ');
        $students = $course['students'] ?? [];

        $adminMessage .= "<h4>{$title}</h4>";
        $adminMessage .= "<p><b>Цена за слушателя:</b> {$price} ₽</p>";
        $adminMessage .= "<p><b>Количество слушателей:</b> " . count($students) . "</p>";

        if (!empty($students)) {
            $adminMessage .= "<table border='1' cellpadding='6' cellspacing='0'>
            <tr>
                <th>ФИО</th>
                <th>Дата рождения</th>
                <th>СНИЛС</th>
                <th>Образование</th>
                <th>Email</th>
            </tr>";

            foreach ($students as $student) {
                $adminMessage .= "<tr>
                    <td>" . esc_html($student['name'] ?? '') . "</td>
                    <td>" . esc_html($student['birthdate'] ?? '') . "</td>
                    <td>" . esc_html($student['snils'] ?? '') . "</td>
                    <td>" . esc_html(normalize_education_label($student['education'] ?? '')) . "</td>
                    <td>" . esc_html($student['email'] ?? '') . "</td>
                </tr>";
            }

            $adminMessage .= "</table><br>";
        }
    }

    $adminMessage .= "</body></html>";

    wp_mail(
        'dir@ecoprf.ru',
        'Новая заявка: ' . $paymentType,
        $adminMessage,
        ['Content-Type: text/html; charset=UTF-8']
    );

    echo json_encode([
        'success' => true,
        'payment_link' => $jsonResponse['link'],
        'order_id' => $orderId,
    ]);
} else {
    $apiMessage = '';
    if (is_array($jsonResponse)) {
        $apiMessage = $jsonResponse['message']
            ?? ($jsonResponse['error']['text'] ?? '')
            ?? $jsonResponse['error']
            ?? ($jsonResponse['errors'][0]['message'] ?? '');
    }

    if (is_array($apiMessage)) {
        $apiMessage = $apiMessage['text'] ?? 'RRLLC error';
    }

    if (!$apiMessage && $httpCode !== 200) {
        $apiMessage = "HTTP {$httpCode}";
    }

    if (!$apiMessage && $jsonError !== JSON_ERROR_NONE) {
        $apiMessage = 'Некорректный ответ платежного шлюза';
    }

    if (!$apiMessage) {
        $apiMessage = 'RRLLC error';
    }

    log_rrllc('Ошибка при создании заказа: ' . $apiMessage . '; response=' . print_r($jsonResponse, true));
    echo json_encode([
        'success' => false,
        'message' => $apiMessage,
        'response' => $jsonResponse,
        'http_code' => $httpCode,
    ]);
}
