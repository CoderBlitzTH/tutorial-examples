<?php

/**
 * โค้ดจากบทความ: วิธีสร้าง Telegram Notify Bot ด้วย PHP แบบง่ายๆ
 *
 * @link https://coderblitz.com/blog/how-to-create-telegram-notify-bot-with-php/
 */


/**
 * ส่งข้อความไปยังแชทที่กำหนดใน Telegram โดยใช้ Telegram Bot API
 *
 * @param string $botToken รหัสบอทที่ได้รับจาก BotFather
 * @param string $chatId   ID ของแชทที่ผู้รับ (สามารถเป็น ID ของผู้ใช้หรือกลุ่ม)
 * @param string $message  ข้อความที่ต้องการส่ง
 *
 * @return string|false การตอบกลับจาก Telegram API ในรูปแบบ JSON หรือ false หากเกิดข้อผิดพลาด
 */
function sendTelegramMessageWithHtml(string $botToken, string $chatId, string $message)
{
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $postData = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML',
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
$message = "<b>Bold Text</b> <i>Italic Text</i> <a href='https://coderblitz.com'>Click Here</a>";

$response = sendTelegramMessageWithHtml($botToken, $chatId, $message);

if ($response) {
    echo "Message sent successfully!";
} else {
    echo "Failed to send message.";
}
