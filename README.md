# Installation instructions
Required:
* [Composer](https://getcomposer.org/)
* [Npm](https://www.npmjs.com/)
* [Bower](https://bower.io/)



1. Clone repository to server
2. Install [Composer Asset Plugin](https://github.com/fxpio/composer-asset-plugin):
`composer global require "fxp/composer-asset-plugin:~1.1.1"`
3. Create files */config/db.php* from */config/db.php.dist* and */config/params.php* from */config/params.php.dist* and edit it
4. Assign */web* folder as document root
5. Install composer dependencies - `composer install`
6. Install bower dependencies - `bower install`
7. Make migrations - `php yii migrate` and `php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations`