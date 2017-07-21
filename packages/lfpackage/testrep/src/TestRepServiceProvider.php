<?php
namespace LFPackage\TestRep;

use Illuminate\Support\ServiceProvider;
use LFPackage\TestRep\Providers\RouteServiceProvider;

class TestRepServiceProvider extends ServiceProvider
{
    /**
     * 执行顺序: 1th
     * 首先所有的 provider 的 register 方法都会被执行
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/testrep.php', 'testrep'
        );
        $this->app->register(RouteServiceProvider::class);

    }

    /**
     * 执行顺序: 2st
     * 在所有的 provider 都执行完毕 register 后, 各个 provider 的 boot 方法才会被执行
     *
     * @return void
     */
    public function boot()
    {
        // 初始化 view 相关
        $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'testrep');

        // 如果用户选择 publish, 那么系统会使用 publish 之后的 view, 而不是package 内的 view
        $this->publishes([
            dirname(__DIR__).'/resources/views' => resource_path('views/vendor/lfpackage/testrep'),
        ], 'view');

        // 注意 laravel 只会将 public 下的文件作为资源文件加载, 所以对于资源文件来说, 必须
        // 在开发时, 需要在 public 文件夹下创建 vendor/testrep 文件夹
        // 在发布时, 将 public/vendor/testrep 下的内容丢到 package 的 resources/assets 文件夹中
        $this->publishes([
            dirname(__DIR__).'/resources/assets' => public_path('vendor/lfpackage/testrep'),
        ], 'view');

        // 如果用户选择 publish,那么系统会读取 publish 之后的 config, 而不是 package 内的 config
        $this->publishes([
            dirname(__DIR__).'/config/testrep.php' => config_path('lfpackage/testrep.php'),
        ], 'config');

        //如果模块有路由则将路由发布到项目中
        $this->publishes([
            __DIR__."/Routes/" => base_path("routes/lfpackage/testrep/")
        ], 'route');



        // 数据库相关设置
        // Todo 需要具体场景试验 migrate 以及 seed 能不能被正常的使用

        // publish 指定 serviceprovider
        // php artisan vendor:publish --provider="LFPackage\xxxx\xxxxServiceProvider" --tag="db" --force

        // migrate 指定路径: php artisan migrate --path="database/migrations/lfpackage/testrep" --refresh
        // 同样的如果需要 rollback, 也可以在 rollback 的时候加上 path 参数
        $this->publishes([
            dirname(__DIR__).'/database/migrations/' => database_path('migrations/lfpackage/testrep')
        ], 'db');

        $this->publishes([
            dirname(__DIR__).'/database/seeds/' => database_path('seeds/lfpackage/testrep')
        ], 'db');

        $this->publishes([
            dirname(__DIR__).'/database/factories/' => database_path('factories/lfpackage/testrep')
        ], 'db');

        // 数据库可以不 publish, 直接用下面这种方式进行 load, load 之后, 执行 migrate 命令就可以将下面
        // 这个路径的 migration  文件执行
        // 但是如果项目中有 seed 文件, seed 文件是无法被load 的, 所以还是采用 publish 的方式发布所有 db 相关的文件,
        // 这样较为统一, 也方便包的使用者对这些文件进行修改
        // $this->loadMigrationsFrom(__DIR__.'/path/to/migrations');

    }


    protected function registerProvider($provider, array $options = [], $force = false)
    {
        return $this->app->register($provider, $options, $force);
    }

}
