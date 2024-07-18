<?php
class RegEmployee
{
    private $lname_emp;
    private $fname_emp;
    private $sex_emp;
    private $email_emp;
    private $age_emp;
    private $tel_emp;
    private $role_emp;

    public function __construct($lname_emp, $fname_emp, $sex_emp, $email_emp, $age_emp, $tel_emp, $role_emp)
    {
        $this->lname_emp = $lname_emp;
        $this->fname_emp = $fname_emp;
        $this->sex_emp = $sex_emp;
        $this->email_emp = $email_emp;
        $this->age_emp = $age_emp;
        $this->tel_emp = $tel_emp;

        $this->role_emp = $role_emp;
    }

    public function getEmpLnameSign()
    {
        return $this->lname_emp;
    }
    public function getEmpFnameSign()
    {
        return $this->fname_emp;
    }
    public function getEmpSexSign()
    {
        return $this->sex_emp;
    }
    public function getEmpEmailSign()
    {
        return $this->email_emp;
    }
    public function getEmpAgeSign()
    {
        return $this->age_emp;
    }
    public function getEmpTelSign()
    {
        return $this->tel_emp;
    }
    public function getEmpRoleSign()
    {
        return $this->role_emp;
    }
}

class AddServiceEmployee
{
    private $id_service;
    private $name_service;

    public function __construct($id_service, $name_service)
    {
        $this->id_service = $id_service;
        $this->name_service = $name_service;
    }

    public function getIdServiceEmployee()
    {
        return $this->id_service;
    }

    public function getNameServiceEmployee()
    {
        return $this->name_service;
    }
}



class ServiceEmployee
{
    private $srvc_id;
    private $srvc_name;

    public function __construct($srvc_id, $srvc_name)
    {
        $this->srvc_id = $srvc_id;
        $this->srvc_name = $srvc_name;
    }

    public function getServiceEmpId()
    {
        return $this->srvc_id;
    }

    public function getServiceEmpName()
    {
        return $this->srvc_name;
    }
}

class SearchEmp
{
    private $id_e;
    private $lname_e;
    private $fname_e;
    private $sex_e;
    private $email_e;
    private $age_e;
    private $tel_e;
    private $srvc_e;
    private $role_e;

    public function getIdSearchEmp()
    {
        return $this->id_e;
    }

    public function setIdSearchEmp($id_e)
    {
        $this->id_e = $id_e;
    }

    public function getLnameSearchEmp()
    {
        return $this->lname_e;
    }

    public function setLnameSearchEmp($lname_e)
    {
        $this->lname_e = $lname_e;
    }
    public function getFnameSearchEmp()
    {
        return $this->fname_e;
    }

    public function setFnameSearchEmp($fname_e)
    {
        $this->fname_e = $fname_e;
    }
    public function getSexSearchEmp()
    {
        return $this->sex_e;
    }
    
    public function setSexSearchEmp($sex_e)
    {
        $this->sex_e = $sex_e;
    }
    public function getEmailSearchEmp()
    {
        return $this->email_e;
    }

    public function setEmailSearchEmp($email_e)
    {
        $this->email_e = $email_e;
    }
    public function getAgeSearchEmp()
    {
        return $this->age_e;
    }

    public function setAgeSearchEmp($age_e)
    {
        $this->age_e = $age_e;
    }
    public function getTelSearchEmp()
    {
        return $this->tel_e;
    }

    public function setTelSearchEmp($tel_e)
    {
        $this->tel_e = $tel_e;
    }
    public function getSrvcSearchEmp()
    {
        return $this->srvc_e;
    }

    public function setSrvcSearchEmp($srvc_e)
    {
        $this->srvc_e = $srvc_e;
    }
    public function getRoleSearchEmp()
    {
        return $this->role_e;
    }

    public function setRolSearchEmp($role_e)
    {
        $this->fname_e = $role_e;
    }

    
}


?>