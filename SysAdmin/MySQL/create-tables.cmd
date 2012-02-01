@echo off
c:
cd C:\SWD\xampp\mysql\bin
mysql --user=root  taportal   < C:\Workspace-Zend\TA_Portal\SysAdmin\MySQL\create-tables.sql
pause