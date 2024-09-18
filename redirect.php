<?php
require '../vendor/autoload.php'; // Include Composer's autoloader

use Google\Client as GoogleClient;

session_start();

$client = new GoogleClient();
$client->setClientId('66112749250-e5rbqip7mi4q25i6mbs4nfdmb0lcdqvm.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/your-redirect-uri.php'); // Replace with your redirect URI

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $client->fetchAccessTokenWithAuthCode($code);

    $accessToken = $client->getAccessToken();
    $refreshToken = $client->getRefreshToken();

    $_SESSION['access_token'] = $accessToken['access_token'];
    $_SESSION['refresh_token'] = $refreshToken;

    header('Location: /your-email-script.php'); // Redirect to the email sending script
    exit();
}
?>
