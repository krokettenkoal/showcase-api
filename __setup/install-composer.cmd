@echo off
set HOME=./
for /f "tokens=*" %%a in ('php -r "copy(\"https://composer.github.io/installer.sig\", \"php://stdout\");"') do set EXPECTED_CHECKSUM=%%a
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
for /f "tokens=*" %%a in ('php -r "echo hash_file(\"sha384\", \"composer-setup.php\");"') do set ACTUAL_CHECKSUM=%%a

if %EXPECTED_CHECKSUM% NEQ %ACTUAL_CHECKSUM% (
    >&2 echo 'ERROR: Invalid installer checksum'
    del composer-setup.php
    exit 1
)

rd bin /s /q
mkdir bin
php composer-setup.php --install-dir=bin
set RESULT=%ERRORLEVEL%
del composer-setup.php
exit %RESULT%