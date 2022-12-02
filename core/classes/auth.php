<?php

class auth extends Main
{
    public function _registration_($step)
    {
        if(empty($this -> user -> id))
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
        }else{
            header( "Location: /@" . $this -> user -> login);
        }
    }

    public function _sign_in_()
    {
        if(empty($this -> user -> id))
        {
            $this -> header ();
            $this -> module ('top-container');
            $this -> page( 'sign_in');
            $this -> footer();
        }else{
            header( "Location: /@" . $this -> user -> login);
        }
    }

}