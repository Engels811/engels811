<?php
class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);

        require BASE_PATH . '/app/views/layouts/header.dashboard.php';
        require BASE_PATH . '/app/views/' . $view . '.php';
        require BASE_PATH . '/app/views/layouts/footer.dashboard.php';
    }
}
