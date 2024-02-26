<?php

namespace Infrastructure\Http;

use Application\Http\ViewInterface;

class View implements ViewInterface {
    /**
     * Initialize a new view context.
     */
    private function __construct(
        private readonly string $template,
        private array $params,
    ) {
    }

    public static function create(string $template, array $params = []): View
    {
        return new View($template, $params);
    }

    public function render(): void
    {
        extract($this->params);

        ob_start();
        include APP_PATH . DIRECTORY_SEPARATOR . $this->template;
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }
}