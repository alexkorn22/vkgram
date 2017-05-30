<?php

namespace vendor\core\base;

class View {

    /**
     * текущий маршрут
     * @var array
     */
    public $route = [];

    /**
     * имя файла вида
     * @var string
     */
    public $view;

    /**
     * текущий файл шаблона
     * @var string
     */
    public $layout;

    public $scripts = [];

    public static $meta = [
        'title' => '',
        'desc' => '',
        'keywords' => '',
    ];

    public function __construct($route,$layout = '',$view = ''){

        $this->route = $route;
        $this->view = $view;
        if ($layout === false){
            $this->layout = false;
        } else {
            $this->layout = $layout ? $layout : LAYOUT;
        }

    }

    public function render($vars) {

        if (is_array($vars)) {
            extract($vars);
        }

        $fileView =  APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($fileView)){
            require $fileView;
        } else {
            echo "<p>Не найден вид <b>$fileView</b></p>";
        }
        /** @noinspection PhpUnusedLocalVariableInspection */
        $content = ob_get_clean();

        if ($this->layout !== false){
            $fileLayout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($fileLayout)){
                $content = $this->getScript($content);
                $scripts = [];
                if(!empty($this->scripts[0])){
                    $scripts = $this->scripts[0];
                }
                require $fileLayout;
            } else {
                echo "<p>Не найден шаблон <b>$fileLayout</b></p>";
            }
        }

    }

    protected function getScript($content){
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if(!empty($this->scripts)){
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }


    public static function getMeta(){
        echo '<title>' . self::$meta['title'] . '</title>
        <meta name="description" content="' . self::$meta['desc'] . '">
        <meta name="keywords" content="' . self::$meta['keywords'] . '">';

    }


    public static function setMeta($title = '', $desc ='', $keywords = ''){
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;

    }

}