@echo off
c:
cd C:\SWD\RDBMS\MySQL\mysql-5.5.15-winx64\bin
@REM mysql --user=blattkopie   --password=bk4cash  blattkopie
mysql --user=root --password=bitnami  taportal   < C:\Workspace-Zend\TA_Portal\SysAdmin\MySQL\create-tables.sql
@REM pause