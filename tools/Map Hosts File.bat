@echo off
echo.
echo WARNING: This batch file edits your Windows Host Files.
echo This will overwrite the RED7Community domains and make them resolve to your web-servers.
echo If you wish to remove these domains, you must edit the hosts file, it is: C:\Windows\System32\drivers\etc\hosts.
echo Proceed with caution, close to cancel or press any key to continue.
pause > nul
echo.

:: BatchGotAdmin
REM https://stackoverflow.com/questions/1894967/how-to-request-administrator-access-inside-a-batch-file
:-------------------------------------
REM  --> Check for permissions
    IF "%PROCESSOR_ARCHITECTURE%" EQU "amd64" (
>nul 2>&1 "%SYSTEMROOT%\SysWOW64\cacls.exe" "%SYSTEMROOT%\SysWOW64\config\system"
) ELSE (
>nul 2>&1 "%SYSTEMROOT%\system32\cacls.exe" "%SYSTEMROOT%\system32\config\system"
)

REM --> If error flag set, we do not have admin.
if '%errorlevel%' NEQ '0' (
    echo Requesting administrative privileges...
    goto UACPrompt
) else ( goto gotAdmin )

:UACPrompt
    echo Set UAC = CreateObject^("Shell.Application"^) > "%temp%\getadmin.vbs"
    set params= %*
    echo UAC.ShellExecute "cmd.exe", "/c ""%~s0"" %params:"=""%", "", "runas", 1 >> "%temp%\getadmin.vbs"

    "%temp%\getadmin.vbs"
    del "%temp%\getadmin.vbs"
    exit /B

:gotAdmin
    pushd "%CD%"
    CD /D "%~dp0"
:-------------------------------------
echo Mapping hosts file...
xcopy /y "C:\Windows\System32\drivers\etc\hosts" "%~dp0/hosts.bak.*"

REM the hosts mapping part
echo 127.0.0.1   red7community.ml >> C:\Windows\System32\drivers\etc\hosts
REM -----------------------

echo Done!
echo.
echo To resolve the host names properly, you must set these up in your web-servers.
echo The default development environment for RED7Community is on Windows IIS.
echo You must create sites in this with the Host Names set to the according domains.
echo.
pause