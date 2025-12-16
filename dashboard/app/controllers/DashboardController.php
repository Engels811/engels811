<?php

class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();

        $kpis   = StatsService::getKpis();
        $system = StatsService::getSystem();

        View::render('dashboard/index', [
            'pageTitle' => 'Dashboard',
            'kpis'      => $kpis,
            'system'    => $system
        ]);
    }
}
