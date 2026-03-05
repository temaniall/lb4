DIR="/tmp/mysql"
PHP="$DIR/index.php"
SH="$DIR/script.sh"
LOG="$DIR/logi.log"
GIT_PHP="https://raw.githubusercontent.com/temaniall/lb4/main/lab4.php"

if [ ! -f $PHP ]; then
    curl -s $GIT_PHP -o $PHP
fi

if [ ! -f $LOG ]; then touch $LOG; fi
COUNT=$(wc -l < $LOG)

if [ $COUNT -lt 10 ]; then
    curl -s -o /dev/null https://www.altstu.ru/
    NEXT=$((COUNT + 1))
    echo "$NEXT успешно" >> $LOG
fi
