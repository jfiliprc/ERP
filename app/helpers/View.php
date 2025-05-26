<?php

namespace App\Helpers;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);

        // Monta caminho absoluto da view
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            http_response_code(500);
            echo "View '{$view}' não encontrada.";
        }
    }
}
