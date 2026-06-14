
<?php
$config = include('config.php');

$token = $config['token'];
$chat_id = $config['chat_id'];

echo "<h3>Probando conexión a Telegram...</h3>";
echo "Token: " . substr($token, 0, 10) . "...<br>";
echo "Chat ID: " . $chat_id . "<br><br>";

$mensaje_prueba = "🔔 Mensaje de prueba desde tu bot PHP";

$telegram_url = "https://api.telegram.org/bot".$token."/sendMessage";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $telegram_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => array(
        'chat_id' => $chat_id,
        'text' => $mensaje_prueba
    ),
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 10
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$curl_error = curl_error($curl);
curl_close($curl);

echo "<strong>Resultado:</strong><br>";
echo "HTTP Code: " . $http_code . "<br>";
echo "Response: " . htmlspecialchars($response) . "<br>";

if($curl_error) {
    echo "Error cURL: " . $curl_error . "<br>";
}

if($http_code == 200) {
    echo "<span style='color: green;'>✅ Mensaje enviado correctamente!</span>";
} else {
    echo "<span style='color: red;'>❌ Error al enviar mensaje</span>";
}
?>
