<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index', [
            'pageTitle'       => 'Home',
            'pageDescription' => 'Engels811 Network - Gaming, Streaming & Community',
            'currentPage'     => 'home'
        ]);
    }
}
