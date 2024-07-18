<?php
class RegPatient
{
    private $lname_pat;
    private $fname_pat;
    private $sex_pat;
    private $dob_pat;
    private $pob_pat;
    private $ad_pat;
 
    private $tel_pat;
   

    public function __construct($lname_pat, $fname_pat, $sex_pat, $dob_pat, $pob_pat, $ad_pat,$tel_pat)
    {
        $this->lname_pat = $lname_pat;
        $this->fname_pat = $fname_pat;
        $this->sex_pat = $sex_pat;
        $this->dob_pat = $dob_pat;
        $this->pob_pat = $pob_pat;
        $this->ad_pat = $ad_pat;
        $this->tel_pat = $tel_pat;
    }

    public function getpatLnameSign()
    {
        return $this->lname_pat;
    }
    public function getpatFnameSign()
    {
        return $this->fname_pat;
    }
    public function getpatSexSign()
    {
        return $this->sex_pat;
    }
    public function getpatDobSign()
    {
        return $this->dob_pat;
    }
    public function getpatPobSign()
    {
        return $this->pob_pat;
    }
    public function getpatAdresseSign()
    {
        return $this->ad_pat;
    }
    public function getpatTelSign()
    {
        return $this->tel_pat;
    }
   
}

class AddServicepatient
{
    private $id_service;
    private $name_service;

    public function __construct($id_service, $name_service)
    {
        $this->id_service = $id_service;
        $this->name_service = $name_service;
    }

    public function getIdServicepatient()
    {
        return $this->id_service;
    }

    public function getNameServicepatient()
    {
        return $this->name_service;
    }
}



class ServicePatient
{
    private $srvc_id;
    private $srvc_name;

    public function __construct($srvc_id, $srvc_name)
    {
        $this->srvc_id = $srvc_id;
        $this->srvc_name = $srvc_name;
    }

    public function getServicepatId()
    {
        return $this->srvc_id;
    }

    public function getServicepatName()
    {
        return $this->srvc_name;
    }
}

class Searchpatient
{
    private $id_p;
    private $lname_p;
    private $fname_p;
    private $sex_p;
    private $pob_p;
    private $srvc_p;
    private $ad_p;
    private $tel_p;
   
    public function getIdSearchpat()
    {
        return $this->id_p;
    }

    public function setIdSearchpat($id_p)
    {
        $this->id_p = $id_p;
    }

    public function getLnameSearchpat()
    {
        return $this->lname_p;
    }

    public function setLnameSearchpat($lname_p)
    {
        $this->lname_p = $lname_p;
    }
    public function getFnameSearchpat()
    {
        return $this->fname_p;
    }

    public function setFnameSearchpat($fname_p)
    {
        $this->fname_p = $fname_p;
    }
    public function getSexSearchpat()
    {
        return $this->sex_p;
    }
    
    public function setSexSearchpat($sex_p)
    {
        $this->sex_p = $sex_p;
    }
    public function getPobSearchpat()
    {
        return $this->pob_p;
    }

    public function setPobSearchpat($pob_p)
    {
        $this->pob_p = $pob_p;
    }
    public function getSrvcSearchpat()
    {
        return $this->srvc_p;
    }

    public function setSrvcSearchpat($srvc_p)
    {
        $this->srvc_p = $srvc_p;
    }
    public function getAdSearchpat()
    {
        return $this->ad_p;
    }

    public function setAdSearchpat($ad_p)
    {
        $this->ad_p = $ad_p;
    }
    public function getTelSearchpat()
    {
        return $this->tel_p;
    }

    public function setTelSearchpat($tel_p)
    {
        $this->tel_p = $tel_p;
    }
    
}


?>