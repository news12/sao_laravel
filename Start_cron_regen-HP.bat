@echo off
TITLE [Cron NewsGames]
echo Servico de CronJobs funcionando...
:loop
cd C:\xampp\htdocs\sword_art\sao_ng
C:\xampp\php\php.exe artisan schedule:run 1>> NUL 2>&1
echo Cron Regen Executada
echo "5 minutos para o proximo reset"
timeout /t 60
CLS
goto loop