Yii2 based simple freelance marketplace example

View demo: backend: http://pmd-ua.000webhostapp.com/pmd/backend/web/index.php

login: admin password: avs03021998

website: http://pmd-ua.000webhostapp.com/pmd/frontend/web/index.php/

installing:

clone github repository;
execute command : composer install;
go to cd C:\ ... repository and execute command : php init;
in file : common\config\main-params.php change database configuration;
execute command: yii migrate;
in common\config\bootstrap.php add frontendWebroot and backendWebroot aliases (similar to samdark ecommerce project);

if you upload project on hosting: in backend\views\layouts\main.php change link for website(frontend) : /main_folder/frontend/web (for example: http://shopdemo2.epizy.com/demoshop3/frontend/web/ link: 'Website' => '/demoshop3/frontend/web' )
Requirements: php >= 5.6.0 mysql >= 5.5
