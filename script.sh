while true; do
    STATUS=$(curl -s -o /dev/null -w "%{http_code}" -L https://www.altstu.ru/)
    LOG="/tmp/mysql/access.log"
    if [ "$STATUS" -eq 200 ]; then
      echo "$(date '+%Y-%m-%d %H:%M:%S') - SUCCESS (Status: $STATUS)" >> $LOG
    else
      echo "$(date '+%Y-%m-%d %H:%M:%S') - FAILED (Status: $STATUS)" >> $LOG
done
