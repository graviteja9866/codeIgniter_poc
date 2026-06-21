<?php

namespace App\Controllers;

use App\Models\UserModel;

class DashboardController extends BaseController
{
    /**
     * Display the dashboard with user statistics.
     */
    public function index()
    {
        // Get the first day of the current month
        $firstDayOfMonth = date('Y-m-01 00:00:00');

        // Each count needs a fresh model instance to avoid query builder stacking
        $data = [
            'totalUsers'    => (new UserModel())->countAllResults(),
            'activeUsers'   => (new UserModel())->where('status', 'active')->countAllResults(),
            'inactiveUsers' => (new UserModel())->where('status', 'inactive')->countAllResults(),
            'newThisMonth'  => (new UserModel())->where('created_at >=', $firstDayOfMonth)->countAllResults(),
            'pageTitle'     => 'Dashboard',
        ];

        return view('dashboard/index', $data);
    }
}
