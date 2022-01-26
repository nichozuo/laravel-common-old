# laravel-common 快速开发包

### Install
```bash
composer require nichozuo/laravel-common:dev-develop -vvv
```

### vendor publish
```bash
php artisan vendor:publish --provider="Nichozuo\LaravelCommon\ServiceProvider"
```

### App\Exceptions\Handler.php
```php
// 增加两个方法调用
public function register()
{
    $this->reportable(function (Throwable $e) {
        //
    })->stop();
    $this->renderable(function (Throwable $e) {
        return ExceptionRender::Render($e);
    });
}
```

### App\Http\Controllers\Controller.php
```php
// 增加一个trait
use ControllerTrait;
```

### App\Http\Middleware\Authenticate.php
```php
protected function redirectTo($request)
{
// 这里注释掉
//    if (! $request->expectsJson()) {
//        return route('login');
//    }
}
```

### App\Http\Kernel.php
```php
'api' => [
    // ...
    // 增加这里
    JsonResponseMiddleware::class
],
```