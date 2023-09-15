@REM Install PHP and Composer on Windows
@REM
@REM Usage:
@REM   install-php.bat [version] [arch] [dir]
@REM
@REM   version: PHP version to install (default: 8.1.21)
@REM   arch:    Architecture to install (default: x64)
@REM   dir:     Directory to install to (default: C:\php)
@REM
@REM Examples:
@REM   install-php.bat
@REM   install-php.bat 8.1.21
@REM   install-php.bat 8.1.21 x64
@REM   install-php.bat 8.1.21 x64 C:\php
@REM

@ECHO OFF

SET PHP_VERSION=%1
SET PHP_ARCH=%2
SET PHP_DIR=%3

IF "%PHP_VERSION%" == "" SET PHP_VERSION=8.1.21
IF "%PHP_ARCH%" == "" SET PHP_ARCH=x64
IF "%PHP_DIR%" == "" SET PHP_DIR=C:\php

SET PHP_ZIP=php-%PHP_VERSION%-nts-Win32-vs16-%PHP_ARCH%.zip
SET PHP_URL=https://windows.php.net/downloads/releases/%PHP_ZIP%

SET PHP_EXE=%PHP_DIR%\php.exe

IF EXIST "%PHP_EXE%" (
    ECHO PHP already installed at %PHP_DIR%
    GOTO install_composer
)

ECHO Installing PHP %PHP_VERSION% %PHP_ARCH% to %PHP_DIR%

IF NOT EXIST "%PHP_DIR%" (
    MKDIR "%PHP_DIR%"
)

IF NOT EXIST "%PHP_DIR%" (
    ECHO Failed to create directory %PHP_DIR%
    EXIT /B 1
)

IF NOT EXIST "%PHP_ZIP%" (
    ECHO Downloading %PHP_URL%
    IF NOT EXIST "%PHP_ZIP%" (
        powershell -Command "(New-Object Net.WebClient).DownloadFile('%PHP_URL%', '%PHP_ZIP%')"
    )
)

IF NOT EXIST "%PHP_ZIP%" (
    ECHO Failed to download %PHP_URL%
    EXIT /B 1
)

ECHO Extracting %PHP_ZIP%
powershell -Command "Expand-Archive -Path '%PHP_ZIP%' -DestinationPath '%PHP_DIR%'"

IF NOT EXIST "%PHP_EXE%" (
    ECHO Failed to extract %PHP_ZIP%
    EXIT /B 1
)

ECHO PHP %PHP_VERSION% %PHP_ARCH% installed to %PHP_DIR%

@REM Install Composer package manager for PHP.
:install_composer

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
