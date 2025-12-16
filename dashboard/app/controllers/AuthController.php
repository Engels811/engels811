<?php

class AuthController extends Controller
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = trim($_POST['username'] ?? '');
            $pass = trim($_POST['password'] ?? '');

            // 🔐 TEMP: Hardcoded Login (DB kommt im nächsten Block)
            if ($user === 'engels811' && $pass === 'admin123') {
                Auth::login($user);
                header('Location: /dashboard');
                exit;
            }

            $error = 'Login fehlgeschlagen';
        }

        View::render('auth/login', [
            'pageTitle' => 'Dashboard Login',
            'error'     => $error ?? null
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /dashboard/login');
        exit;
    }
}
