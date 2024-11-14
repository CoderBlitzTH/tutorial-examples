<?php

/**
 * โค้ดจากบทความ: วิธีสร้าง Telegram Notify Bot ด้วย PHP แบบง่ายๆ
 *
 * @link https://coderblitz.com/blog/how-to-create-telegram-notify-bot-with-php/
 */


/**
 * ส่งรูปภาพไปยัง Telegram chat ผ่าน Telegram Bot API
 *
 * ฟังก์ชันนี้จะใช้เพื่อส่งรูปภาพไปยัง chat ที่กำหนดโดยใช้ URL รูปภาพที่ต้องการส่ง
 *
 * @param string $botToken รหัส Token ของบอทที่ได้รับจาก BotFather
 * @param string $chatId   ID ของแชทที่จะส่งรูปภาพไป (สามารถเป็น ID ของผู้ใช้หรือกลุ่ม)
 * @param string $photoUrl URL ของรูปภาพที่ต้องการส่ง (สามารถใช้ URL ภายนอกหรือไฟล์ภายในเซิร์ฟเวอร์)
 *
 * @return string|false การตอบกลับจาก API Telegram ในรูปแบบ JSON หรือ `false` หากเกิดข้อผิดพลาด
 */
function sendTelegramPhoto(string $botToken, string $chatId, string $photoUrl)
{
    $url = "https://api.telegram.org/bot$botToken/sendPhoto";
    $postData = [
        'chat_id' => $chatId,
        'photo' => $photoUrl
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$botToken = 'YOUR_BOT_TOKEN';
$chatId = 'YOUR_CHAT_ID';
$photoUrl = 'https://coderblitz.com/wp-content/uploads/2024/11/how-to-create-telegram-notify-bot-with-php.png';

$response = sendTelegramPhoto($botToken, $chatId, $photoUrl);

if ($response) {
    echo "Photo sent successfully!";
} else {
    echo "Failed to send photo.";
}
