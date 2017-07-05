## 项目安装指南


app.php 添加

 LFPackage\Comment\CommentServiceProvider::class,

 'LFComment' => LFPackage\Comment\Facades\LFComment::class,


php artisan vendor:publish --provider="LFPackage\Comment\CommentServiceProvider" --tag="db" --force

php artisan migrate --path="database/migrations/comment" 

php artisan vendor:publish --provider="LFPackage\Comment\CommentServiceProvider" --tag="view" --force


在主页面 view 的  Head 内加入 
    @yield('asset_links')
    



