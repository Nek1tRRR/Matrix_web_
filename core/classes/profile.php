<?php

class profile extends Main
{
    public function _main_()
    {
        $this -> header ();
        $this -> module ('top-container');
        $this -> page( 'userPage');
        $this -> footer();
    }
}