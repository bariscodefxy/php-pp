--TEST--
mb_send_mail() test 7 (lang=Korean)
--EXTENSIONS--
mbstring
--SKIPIF--
<?php
if (!function_exists("mb_send_mail") || !mb_language("Korean")) {
    die("skip mb_send_mail() not available");
}
if (!@mb_internal_encoding('ISO-2022-KR')) {
    die("skip ISO-2022-KR encoding is not available on this platform");
}
?>
--INI--
sendmail_path={MAIL:{PWD}/mb_send_mail07.eml}
mail.add_x_header=off
--FILE--
<?php
$to = 'example@example.com';

/* default setting */
mb_send_mail($to, mb_language(), "test");
readfile(__DIR__ . "/mb_send_mail07.eml");

/* Korean */
if (mb_language("korean")) {
    mb_internal_encoding('EUC-KR');
    mb_send_mail($to, "테스트 ".mb_language(), "테스트");
    readfile(__DIR__ . "/mb_send_mail07.eml");
}
?>
--CLEAN--
<?php
@unlink(__DIR__ . "/mb_send_mail07.eml");
?>
--EXPECTF--
To: example@example.com
Subject: %s
MIME-Version: 1.0
Content-Type: text/plain; charset=%s
Content-Transfer-Encoding: %s

%s
To: example@example.com
Subject: =?ISO-2022-KR?B?GyQpQw5FVz06Ri4PIEtvcmVhbg8=?=
MIME-Version: 1.0
Content-Type: text/plain; charset=ISO-2022-KR
Content-Transfer-Encoding: 7bit

$)CEW=:F.
