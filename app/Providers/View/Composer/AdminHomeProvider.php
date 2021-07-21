<?php

namespace App\Providers\View\Composer;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AdminHomeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.partials.top_widgets', function($view){
            $countAccounts = DB::table('products')
                            ->select('products.*')
                            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                            ->where('categories.category_name', '=', 'accounts')
                            ->orWhere('categories.category_name', '=', 'account')
                            ->where('products.in_stock', '=', 1)
                            ->count();

            $countTools = DB::table('products')
                            ->select('products.*')
                            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                            ->where('categories.category_name', '=', 'tools')
                            ->orWhere('categories.category_name', '=', 'tool')
                            ->where('products.in_stock', '=', 1)
                            ->count();

            $countTutorials = DB::table('products')
                            ->select('products.*')
                            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                            ->where('categories.category_name', '=', 'tutorials')
                            ->orWhere('categories.category_name', '=', 'tutorial')
                            ->where('products.in_stock', '=', 1)
                            ->count();

            $countBankLogs = DB::table('products')
                            ->select('products.*')
                            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                            ->where('categories.category_name', '=', 'bank logs')
                            ->orWhere('categories.category_name', '=', 'bank log')
                            ->orWhere('categories.category_name', '=', 'bank cheques')
                            ->orWhere('categories.category_name', '=', 'bank checks')
                            ->orWhere('categories.category_name', '=', 'bank check')
                            ->where('products.in_stock', '=', 1)
                            ->count();
            $view->with([
                'countAccounts' => $countAccounts,
                'countTools'    => $countTools,
                'countTutorials' => $countTutorials,
                'countBankLogs'     =>  $countBankLogs
                ]);
        });

        View::composer('admin.layouts.sidebar', function($view){
            $mainCategories = DB::table('categories')->get();
            $view->with(['mainCategories' => $mainCategories]);
        });

        View::composer('admin.layouts.header', function($view){
            $ticketNotifications = DB::table('tickets')
                                    ->select('tickets.subject')
                                    ->where('tickets.status', '=', false)
                                    ->get();
            $view->with(['ticketNotifications' => $ticketNotifications]);
        });
    }
}
