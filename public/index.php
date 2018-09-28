<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|   Composer 生成一个类自动加载器 (第三方依赖)
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|生成容器Container APPlication实例 ，并向容器中加载核心组件（HttpKernel ConsoleKernel,ExceptionHandler）
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|   处理请求，生成并发送响应（99%的代码都是运行在这个handle中）
|   捕获用户的请求，生成一个Illuminate\Http\Request 实例 ,传递给handle方法，在方法内部，会将
|$request实例绑定到上面生成的$app容器中，然后在该请求处理之前，调用bootstrap方法，进行必要的加载和注册。
|如（检查环境、加载配置、注册Facades、注册服务提供者，启动服务提供者等等） 就是一个启动数组，具体在Illuminate\Foundation\Http\Kernel
|  protected $bootstrappers = [
        'Illuminate\Foundation\Bootstrap\DetectEnvironment',
        'Illuminate\Foundation\Bootstrap\LoadConfiguration',
        'Illuminate\Foundation\Bootstrap\ConfigureLogging',
        'Illuminate\Foundation\Bootstrap\HandleExceptions',
        'Illuminate\Foundation\Bootstrap\RegisterFacades',
        'Illuminate\Foundation\Bootstrap\RegisterProviders',
        'Illuminate\Foundation\Bootstrap\BootProviders',
    ];

|上面就是启动数组。其中注册Facades就是注册config\app.php 中的aliseas数组 最后三个类是用先后顺序
|Facades 先于ServiceProciders 先于 Boot
|
*/
/**
 * 通过make 的方法来实例化Illuminate\Contracts\Http\Kernel这个类
 * 具体make方法 见具体的注释
 */
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
dd($kernel);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

//请求结束，进行回调
$kernel->terminate($request, $response);
