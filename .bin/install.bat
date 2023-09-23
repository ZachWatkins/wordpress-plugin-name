@REM Install Visual Studio Code, Windows Subsystem for Linux, NodeJS, Docker
@REM Desktop, PHP, and Composer on Windows.
@REM Running this file as an administrator will add the paths to the user's
@REM system path, so they can run node, php, and composer from the command
@REM line. Otherwise, the user will need to add the paths manually.
@REM
@REM Usage:
@REM   install.bat [phpversion] [nodeversion] [dir] [arch]
@REM
@REM   phpversion:  PHP version to install (default: 8.1.21)
@REM   nodeversion: Node version to install (default: LTS)
@REM   dir:         Directory to install to (default: %USERPROFILE%\bin)
@REM   arch:        Architecture to install (default: x64)
@REM
@REM Examples:
@REM   install.bat
@REM   install.bat 8.1.23
@REM   install.bat 8.1.23 LTS
@REM   install.bat 8.1.23 LTS %USERPROFILE%\bin
@REM   install.bat 8.1.23 LTS %USERPROFILE%\bin x64

@ECHO OFF

SET TEMP_DIR=%~dp0\.tmp
SET PHP_VERSION=%1
SET NODE_VERSION=%2
SET PATH_DIR=%3
SET PHP_ARCH=%4

IF "%PHP_VERSION%" == "" SET PHP_VERSION=8.1.23
IF "%NODE_VERSION%" == "" SET NODE_VERSION=LTS
IF "%PATH_DIR%" == "" SET PHP_DIR=%USERPROFILE%\bin\php
IF "%PHP_ARCH%" == "" SET PHP_ARCH=x64

SET PHP_EXE=%PHP_DIR%\php.exe
SET PHP_ZIP=php-%PHP_VERSION%-nts-Win32-vs16-%PHP_ARCH%.zip
SET PHP_URL=https://windows.php.net/downloads/releases/%PHP_ZIP%

SET COMPOSER_URL=https://getcomposer.org/installer
SET COMPOSER_SIG_URL=https://composer.github.io/installer.sig

ECHO Installing Visual Studio Code, Windows Subsystem for Linux, NodeJS, Docker Desktop, PHP, and Composer on Windows

IF NOT EXIST %TEMP_DIR% (
    MKDIR %TEMP_DIR%
)

ECHO Installing Visual Studio Code
call winget install -e --id Microsoft.VisualStudioCode

ECHO Installing Windows Subsystem for Linux Version 2 using Ubuntu.
call wsl --install -d Ubuntu
call wsl --set-version Ubuntu 2
call wsl --set-default-version 2
call wsl --set-default Ubuntu

ECHO Installing NodeJS %NODE_VERSION% for Windows
IF %NODE_VERSION% == LTS (call winget install -e --id OpenJS.NodeJS.LTS)
ELSE (call winget install -e --id OpenJS.NodeJS --version %NODE_VERSION%)

IF %errorlevel% NEQ 0 (
    ECHO ERROR: Failed to install NodeJS %NODE_VERSION% for Windows
    EXIT /b 1
)

ECHO Installing Docker Desktop
call winget install -e --id Docker.DockerDesktop

IF %errorlevel% NEQ 0 (
    ECHO ERROR: Failed to install Docker Desktop
    EXIT /b 1
)

IF EXIST %TEMP_DIR%\%PHP_ZIP% (
    ECHO %PHP_ZIP% already downloaded to %TEMP_DIR%\%PHP_ZIP%
) ELSE (
    ECHO Downloading %PHP_URL% to %TEMP_DIR%\%PHP_ZIP%
    powershell -Command "Invoke-WebRequest -Uri %PHP_URL% -UserAgent WordPressDeveloper -OutFile %TEMP_DIR%\%PHP_ZIP%"

    IF %errorlevel% NEQ 0 (
        ECHO ERROR: Failed to download %PHP_URL% to %TEMP_DIR%\%PHP_ZIP%
        EXIT /b 1
    )
)

IF EXIST %TEMP_DIR%\composer-installer.sig (
    ECHO composer-installer.sig already downloaded to %TEMP_DIR%\composer-installer.sig
) ELSE (
    ECHO Downloading composer-installer.sig to %TEMP_DIR%\composer-installer.sig
    powershell -Command "Invoke-WebRequest -Uri '%COMPOSER_SIG_URL%' -OutFile '%TEMP_DIR%\composer-installer.sig'"

    IF %errorlevel% NEQ 0 (
        ECHO ERROR: Failed to download %COMPOSER_SIG_URL% to %TEMP_DIR%\composer-installer.sig
        EXIT /b 1
    )
)

IF EXIST %TEMP_DIR%\composer-setup.php (
    ECHO composer-setup.php already downloaded to %TEMP_DIR%\composer-setup.php
) ELSE (
    ECHO Downloading composer-setup.php to %TEMP_DIR%\composer-setup.php
    powershell -Command "Invoke-WebRequest -Uri '%COMPOSER_URL%' -OutFile '%TEMP_DIR%\composer-setup.php'"

    IF %errorlevel% NEQ 0 (
        ECHO ERROR: Failed to download %COMPOSER_URL% to %TEMP_DIR%\composer-setup.php
        EXIT /b 1
    )
)

IF NOT EXIST "%PHP_DIR%" (
    MKDIR "%PHP_DIR%"
) ELSE (
    ECHO Deleting existing PHP installation at %PHP_DIR%
    DEL /q /s /f "%PHP_DIR%\*"
)

ECHO Extracting %TEMP_DIR%\%PHP_ZIP% to %PHP_DIR%
powershell -Command "Expand-Archive %TEMP_DIR%\%PHP_ZIP% -DestinationPath %PHP_DIR%"

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

SET "EXPECTED_CHECKSUM="
FOR /f "usebackq delims=" %%a IN (`type %TEMP_DIR%\composer-installer.sig`) DO SET "EXPECTED_CHECKSUM=%%a"

SET "ACTUAL_CHECKSUM="
FOR /f "usebackq delims=" %%a IN (`certutil -hashfile %TEMP_DIR%\composer-setup.php SHA384 ^| findstr /i /v "certutil"`) DO SET "ACTUAL_CHECKSUM=%%a"

if not "%EXPECTED_CHECKSUM%" == "%ACTUAL_CHECKSUM%" (
    ECHO ERROR: Invalid installer checksum
    ECHO EXPECTED: %EXPECTED_CHECKSUM%
    ECHO ACTUAL: %ACTUAL_CHECKSUM%
    DEL %TEMP_DIR%\composer-installer.sig
    DEL %TEMP_DIR%\composer-setup.php
    EXIT /b 1
)

powershell -Command "%PHP_DIR%\php.exe %TEMP_DIR%\composer-setup.php --quiet --install-dir=%PHP_DIR% --filename=composer.phar"
SET "RESULT=%errorlevel%"
ECHO Composer installed to %PHP_DIR%\composer.phar
EXIT /b %RESULT%

@REM Attempt to add the paths for these applications to the user's system path.
@REM This will only work if the user ran the script with admin privileges.
@REM If this fails, the user will need to add the paths manually.
SETX PATH "%PATH%;%PHP_DIR%;%NODE_DIR%" /M
IF %errorlevel% NEQ 0 (
    ECHO ERROR: Failed to add paths to system path. If you wish to use node, php, and composer from your command line without using an absolute path to those executables, then you will need administrative rights. If you have administrative rights, then re-run this script as an administrator to add the paths to the system path automatically.
    EXIT /b 1
)
