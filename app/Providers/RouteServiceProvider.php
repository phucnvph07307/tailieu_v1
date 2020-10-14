<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        ///Phuc kiem tra id role keyword 10:11 - 01/06/20
        Route::pattern('id', '[0-9]+');
        Route::pattern('role', '[0-9]+');
        Route::pattern('status', '[0-9]+');
        Route::pattern('keyword', '.*');

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAccountRoutes();

        $this->mapProfileRoutes();

        $this->mapCoSoDaoTaoRoutes();

        $this->mapNganhNgheRoutes();

        $this->mapXuatBaoCaoRoutes();

        $this->mapNhapBaoCaoRoutes();

        $this->mapChartRoutes();


        //
        $this->mapHoTroRoutes();

        // 17/06/2020 Tuanbt - chia thêm Route Giấy phép
        $this->mapGiayPhepRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    // 2020-05-30 - thienth - chia thêm route account
    protected function mapAccountRoutes()
    {
        Route::middleware('web', 'auth')
            ->prefix('account')
            ->namespace($this->namespace)
            ->group(base_path('routes/account.php'));
    }

    // 2020-05-30 - thienth - chia thêm route profile
    protected function mapProfileRoutes()
    {
        Route::middleware('web', 'auth')
            ->prefix('thong-tin-tai-khoan')
            ->namespace($this->namespace)
            ->group(base_path('routes/profile.php'));
    }

    // 2020-05-30 - thienth - chia thêm route co-so-dao-tao
    protected function mapCoSoDaoTaoRoutes()
    {
        // $permissions = implode(',', config('permissions_setting.quan_ly_co_so_dao_tao'));
        // , "permission:{$permissions}"
        Route::middleware('web', 'auth')
            ->prefix('co-so-dao-tao')
            ->namespace($this->namespace)
            ->group(base_path('routes/co-so-dao-tao.php'));
    }

    // 2020-05-30 - thienth - chia thêm route nganh-nghe
    protected function mapNganhNgheRoutes()
    {
        Route::middleware('web', 'auth')
            ->prefix('nganh-nghe')
            ->namespace($this->namespace)
            ->group(base_path('routes/nganh-nghe.php'));
    }

    // 2020-05-30 - thienth - chia thêm route xuat-bao-cao
    protected function mapXuatBaoCaoRoutes()
    {
        Route::middleware('web', 'auth')
            ->prefix('xuat-bao-cao')
            ->namespace($this->namespace)
            ->group(base_path('routes/xuat-bao-cao.php'));
    }

    // 2020-05-30 - thienth - chia thêm route nhap-bao-cao
    protected function mapNhapBaoCaoRoutes()
    {
        Route::middleware('web', 'auth')
            ->prefix('nhap-bao-cao')
            ->namespace($this->namespace)
            ->group(base_path('routes/nhap-bao-cao.php'));
    }

        // 2020-06-23 - hieupt - chia thêm route chart
        protected function mapChartRoutes()
        {
            Route::middleware('web', 'auth')
                ->prefix('chart')
                ->namespace($this->namespace)
                ->group(base_path('routes/chart.php'));
        }
    // 2020-05-30 - thienth - chia thêm route nhap-bao-cao
    protected function mapHoTroRoutes()
    {
        Route::middleware('web', 'auth')
            ->prefix('tu-van-ho-tro')
            ->namespace($this->namespace)
            ->group(base_path('routes/ho-tro.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    // 17/06/2020 Tuanbt - chia thêm Route giay-phep
    protected function mapGiayPhepRoutes()
    {
        Route::middleware('web', 'auth')
            ->prefix('giay-phep')
            ->namespace($this->namespace)
            ->group(base_path('routes/giay-phep.php'));
    }
}
