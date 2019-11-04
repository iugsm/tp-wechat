<?php

return [
    'APPID' => '',
    'APPSECRET' => '',
    'LOGIN_URL' => "https://api.weixin.qq.com/sns/jscode2session?appid=%s" .
        "&secret=%s&js_code=%s&grant_type=authorization_code",
];