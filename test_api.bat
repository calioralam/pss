@echo off

:: URL Endpoint
set REGISTER_URL=http://localhost/uas/public/register.php
set LOGIN_URL=http://localhost/uas/public/login.php

:: Data untuk Register dan Login
set USERNAME=newuser
set PASSWORD=newpassword

:: Debug: Print the URLs
echo REGISTER_URL=%REGISTER_URL%
echo LOGIN_URL=%LOGIN_URL%

:: Test Register
echo Testing Register API...
curl -s -o temp_register.json -w "HTTPSTATUS:%%{http_code}" -X POST "%REGISTER_URL%" ^
    -d "username=%USERNAME%" -d "password=%PASSWORD%" > temp_register.txt

:: Parse response status for Register
for /f "delims=" %%i in (temp_register.txt) do set REGISTER_RESULT=%%i
for /f "tokens=2 delims=:" %%i in ("%REGISTER_RESULT%") do set REGISTER_BODY=%%i
if "%REGISTER_BODY%"=="200" (
    echo Register Success: No Errors.
) else (
    echo Register Error: HTTP Status %REGISTER_BODY%.
)

:: Test Login
echo Testing Login API...
curl -s -o temp_login.json -w "HTTPSTATUS:%%{http_code}" -X POST "%LOGIN_URL%" ^
    -d "username=%USERNAME%" -d "password=%PASSWORD%" > temp_login.txt

:: Parse response status for Login
for /f "delims=" %%i in (temp_login.txt) do set LOGIN_RESULT=%%i
for /f "tokens=2 delims=:" %%i in ("%LOGIN_RESULT%") do set LOGIN_BODY=%%i
if "%LOGIN_BODY%"=="200" (
    echo Login Success: No Errors.
) else (
    echo Login Error: HTTP Status %LOGIN_BODY%.
)

:: Clean up temporary files
del temp_register.json temp_register.txt temp_login.json temp_login.txt
