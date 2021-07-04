#!/bin/sh

echo "Installing:"

php artisan adminlte:install
php artisan adminlte:plugins install --plugin=toastr
php artisan adminlte:plugins install --plugin=select2
php artisan adminlte:plugins install --plugin=summernote
php artisan adminlte:plugins install --plugin=bootstrapSlider
php artisan adminlte:plugins install --plugin=bootstrapSwitch
