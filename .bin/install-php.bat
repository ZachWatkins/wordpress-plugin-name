@REM Install PHP and Composer on Windows
@REM
@REM Usage:
@REM   install-php.bat [version] [arch] [dir]
@REM
@REM   version: PHP version to install (default: 8.1.21)
@REM   arch:    Architecture to install (default: x64)
@REM   dir:     Directory to install to (default: $HOME\bin\php)
@REM
@REM Examples:
@REM   install-php.bat
@REM   install-php.bat 8.1.21
@REM   install-php.bat 8.1.21
@REM   install-php.bat 8.1.21 x64
@REM   install-php.bat 8.1.21 x64 $HOME\bin\php

@ECHO OFF

SET PHP_VERSION=%1
SET PHP_ARCH=%2
SET PHP_DIR=%3

IF "%PHP_VERSION%" == "" SET PHP_VERSION=8.1.21
IF "%PHP_ARCH%" == "" SET PHP_ARCH=x64
IF "%PHP_DIR%" == "" SET PHP_DIR=%USERPROFILE%\bin\php

SET PHP_ZIP=php-%PHP_VERSION%-nts-Win32-vs16-%PHP_ARCH%.zip
SET PHP_URL=https://windows.php.net/downloads/releases/%PHP_ZIP%
SET PHP_EXE=%PHP_DIR%\php.exe

IF EXIST %PHP_ZIP% (
    ECHO %PHP_ZIP% already downloaded.
) ELSE (
    ECHO Downloading %PHP_URL% to %PHP_ZIP%
    powershell -Command "Invoke-WebRequest -Uri %PHP_URL% -UserAgent WordPressDeveloper -OutFile %PHP_ZIP%"
)

IF NOT EXIST "%PHP_DIR%" (
    @ECHO Creating %PHP_DIR%
    MKDIR "%PHP_DIR%"
) ELSE (
    ECHO Deleting existing installation at %PHP_DIR%
    DEL /q /s /f "%PHP_DIR%\*"
)

ECHO Extracting %PHP_ZIP% to %PHP_DIR%
powershell -Command "Expand-Archive %PHP_ZIP% -DestinationPath %PHP_DIR%"

ECHO Configuring PHP installation
COPY /Y "%PHP_DIR%\php.ini-development" "%PHP_DIR%\php.ini"

powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=openssl', 'extension=openssl' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=pdo_sqlite', 'extension=pdo_sqlite' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=sqlite3', 'extension=sqlite3' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=zip', 'extension=zip' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';zend_extension=opcache', 'zend_extension=opcache' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=gd', 'extension=gd' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=mbstring', 'extension=mbstring' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=fileinfo', 'extension=fileinfo' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';extension=curl', 'extension=curl' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';opcache.enable=1', 'opcache.enable=On' | Out-File -encoding ASCII %PHP_DIR%\php.ini"
powershell -Command "(gc %PHP_DIR%\php.ini) -replace ';opcache.enable_cli=0', 'opcache.enable_cli=On' | Out-File -encoding ASCII %PHP_DIR%\php.ini"

ECHO PHP %PHP_VERSION% %PHP_ARCH% installed to %PHP_DIR%

@REM Install Composer package manager for PHP.
SET COMPOSER_EXE=%PHP_DIR%\composer.phar
IF EXIST "%COMPOSER_EXE%" (
    ECHO Composer already installed at %COMPOSER_EXE%
    EXIT /B 0
)

SET "EXPECTED_CHECKSUM="
FOR /f "usebackq delims=" %%a IN (`php -r "copy('https://composer.github.io/installer.sig', 'php://stdout');"`) DO SET "EXPECTED_CHECKSUM=%%a"

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
SET "ACTUAL_CHECKSUM="
FOR /f "usebackq delims=" %%a IN (`certutil -hashfile composer-setup.php SHA384 ^| findstr /i /v "certutil"`) DO SET "ACTUAL_CHECKSUM=%%a"

if not "%EXPECTED_CHECKSUM%" == "%ACTUAL_CHECKSUM%" (
    ECHO ERROR: Invalid installer checksum
    ECHO EXPECTED: %EXPECTED_CHECKSUM%
    ECHO ACTUAL: %ACTUAL_CHECKSUM%
    DEL composer-setup.php
    EXIT /b 1
)

php composer-setup.php --quiet
SET "RESULT=%errorlevel%"
DEL composer-setup.php
ECHO Composer installed to %COMPOSER_EXE%
EXIT /b %RESULT%
