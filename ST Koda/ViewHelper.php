<?php

class ViewHelper {

    //Displays a given view and sets the $variables array into scope.
    public static function render($file, $variables = array()) {
        extract($variables);

        ob_start();
        include($file);
        $renderedView = ob_get_clean();

        echo $renderedView;
    }
}
