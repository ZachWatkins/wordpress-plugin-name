@echo off

setlocal enabledelayedexpansion

set merged=

for /f "tokens=*" %%a in ('git branch --merged ^| findstr /v "*" ^| findstr /v "master" ^| findstr /v "main" ^| findstr /v "develop" ^| findstr /v "trunk"') do (
  set merged=!merged!%%a
	set merged=!merged!^

)

if not defined merged (
  echo No branches to prune.
  exit /b 0
)

echo The following branches will be removed:
echo %merged%
echo Press enter to continue or ctrl+c to cancel.
set /p dummy=

for %%a in (%merged%) do (
  git branch -d "%%a"
)
