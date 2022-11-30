<?php

class auth extends Main
{
    public function _registration_($step)
    {
        $this -> header ();
        $this -> module ('top-container');
        if($step == 'step1')
        {
            $this -> page( 'registration');
        }
        elseif ($step == 'step2')
        {
            $this -> page( 'confirmEmail');
        }
        elseif ($step == 'step3')
        {
            $this -> page( 'confirmPass');
        }
        $this -> footer();
    }
}