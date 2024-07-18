<?php
class RegUsers
{
    private $lname;
    private $fname;
    private $pseudo;
    private $password;
    private $statut;


    public function __construct($lname, $fname, $pseudo, $password, $statut)
    {
        $this->lname = $lname;
        $this->fname = $fname;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->statut = $statut;
    }

    public function getUserslnameReg()
    {
        return $this->lname;
    }

    public function getUsersfnameReg()
    {
        return $this->fname;
    }

    public function getUsersPseudoReg()
    {
        return $this->pseudo;
    }

    public function getUsersPasswordReg()
    {
        return $this->password;
    }
    public function getUsersStatutReg()
    {
        return $this->statut;
    }

}


class SearchUsers
{
    private $id_us;
    private $lname_us;
    private $fname_us;
    private $pseudo_us;
    private $date_us;
    private $statut_us;


    public function getIdSearchUsers()
    {
        return $this->id_us;
    }

    public function setIdSearchUsers($id_us)
    {
        $this->id_us = $id_us;
    }
    public function getLnameSearchUsers()
    {
        return $this->lname_us;
    }
    public function setLnameSearchUsers($lname_us)
    {
        $this->lname_us = $lname_us;
    }

    public function getFnameSearchUsers()
    {
        return $this->fname_us;
    }


    public function setFnameSearchUsers($fname_us)
    {
        $this->fname_us = $fname_us;
    }

    public function getPseudoSearchUsers()
    {
        return $this->pseudo_us;
    }

    public function setPseudoSearchUsers($pseudo_us)
    {
        $this->pseudo_us = $pseudo_us;
    }

    public function getDateSearchUsers()
    {
        return $this->date_us;
    }

    public function setDateSearchUsers($date_us)
    {
        $this->date_us = $date_us;
    }

    public function getStatutSearchUsers()
    {
        return $this->statut_us;
    }

    public function setStatutSearchUsers($statut_us)
    {
        $this->statut_us = $statut_us;
    }
}
?>