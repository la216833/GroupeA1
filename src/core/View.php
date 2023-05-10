<?php

namespace CashRegister\core;

class View {

    private string $VIEW_PATH;

    public function __construct() {
        $this->VIEW_PATH = dirname(__DIR__) . '/views/';
    }

    private function renderLayout(): false|string {
        ob_start();
        include_once  $this->VIEW_PATH . 'layouts/default.php';
        return ob_get_clean();
    }
    private function renderView(string $view, $params): false|string {
        ob_start();
        $params = $params;
        include_once $this->VIEW_PATH . $view;
        return ob_get_clean();
    }

    public function render($view, $params): array|false|string {
        $layout = $this->renderLayout();
        $content = $this->renderView($view, $params);
        return str_replace('{{content}}', $content, $layout);
    }

}