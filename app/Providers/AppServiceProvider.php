<?php

namespace App\Providers;

use App\Interfaces\Admin\FinancialReportRepositoryInterface;
use App\Interfaces\Admin\TransactionRepositoryInterface;
use App\Interfaces\Admin\UserRepositoryInterface as AdminUserRepositoryInterface;
use App\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Admin\EloquentFinancialReportRepository;
use App\Repositories\Admin\EloquentTransactionRepository;
use App\Repositories\Admin\EloquentUserRepository as AdminEloquentUserRepository;
use App\Repositories\User\EloquentUserRepository;
use App\Services\Admin\FinancialReportService;
use App\Services\Admin\TransactionService;
use App\Services\Admin\UserService as AdminUserService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Admin\AuthRepositoryInterface;
use App\Repositories\Admin\EloquentAuthRepository;
use App\Services\Admin\AuthService;
use App\Interfaces\Admin\PaymentRepositoryInterface;
use App\Repositories\Admin\EloquentPaymentRepository;
use App\Services\Admin\PaymentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, EloquentAuthRepository::class);
        $this->app->bind(AuthService::class);
        $this->app->bind(PaymentRepositoryInterface::class, EloquentPaymentRepository::class);
        $this->app->bind(PaymentService::class);
        $this->app->bind(TransactionRepositoryInterface::class, EloquentTransactionRepository::class);
        $this->app->bind(TransactionService::class);
        $this->app->bind(AdminUserRepositoryInterface::class, AdminEloquentUserRepository::class);
        $this->app->bind(AdminUserService::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(UserService::class);
        $this->app->bind(FinancialReportRepositoryInterface::class, EloquentFinancialReportRepository::class);
        $this->app->bind(FinancialReportService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
