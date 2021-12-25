php artisan migrate:fresh --env=testing
php artisan db:seed --class=PermissionSeeder --env=testing
php artisan db:seed --class=RoleSeeder --env=testing
php artisan db:seed --class=UserSeeder --env=testing
php artisan test --env=testing