<?php

class LogUsers
{
    private $pseudo;
    private $password;
    private $statut;

    public function __construct($pseudo, $password, $statut)
    {

        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->statut = $statut;

    }

    public function getUsersPseudoLog()
    {
        return $this->pseudo;
    }

    public function getUsersPasswordLog()
    {
        return $this->password;
    }
    public function getUsersStatutLog()
    {
        return $this->statut;
    }


}
?>