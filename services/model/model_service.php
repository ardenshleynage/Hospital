<?php
class RegService
{
    private $name_srvc;
    private $des;

    public function __construct($name_srvc, $des)
    {
        $this->name_srvc = $name_srvc;
        $this->des = $des;
    }

    public function getServiceName()
    {
        return $this->name_srvc;
    }
    public function getServiceDes()
    {
        return $this->des;
    }
}


class SearchService
{
    private $id_sr;
    private $name_sr;
    private $des_sr;
    private $date_sr;


    public function getIdSearchService()
    {
        return $this->id_sr;
    }

    public function setIdSearchService($id_sr)
    {
        $this->id_sr = $id_sr;
    }

    public function getNameSearchService()
    {
        return $this->name_sr;
    }

    public function setNameSearchService($name_sr)
    {
        $this->name_sr = $name_sr;
    }

    public function getDescriptionSearchService()
    {
        return $this->des_sr;
    }

    public function setDescriptionSearchService($des_sr)
    {
        $this->des_sr = $des_sr;
    }

    public function getDateSearchService()
    {
        return $this->date_sr;
    }

    public function setDateSearchService($date_sr)
    {
        $this->date_sr = $date_sr;
    }
}
?>