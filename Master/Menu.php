<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/uts_oop/index.php?target=";
        $data = [
            array('text' => 'Home', 'link' => $base . 'home'),
            array('text' => 'Admin', 'link' => $base . 'admin'),
            array('text' => 'Kabag', 'link' => $base . 'kabag'),
            array('text' => 'Staf', 'link' => $base . 'staf')
        ];
        return $data;
    }
}
