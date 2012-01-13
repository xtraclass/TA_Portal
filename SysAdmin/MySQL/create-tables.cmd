@echo off
c:
cd C:\SWD\xampp\mysql\bin
@REM mysql --user=blattkopie   --password=bk4cash  blattkopie
mysql --user=root  taportal   < C:\Workspace-Zend\TA_Portal\SysAdmin\MySQL\create-tables.sql
pause