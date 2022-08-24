<?php
class Film{
    public function __construct($id_movie ,$title,$year,$genres,$plot,$directors,$cast)
    {
       
        
        $this->setId_movie($id_movie);
        $this->setTitle($title);
        $this->setYear($year);
        $this->setGenre($genres);
        $this->setPlot($plot);
        $this->setDirector($directors);
        $this->setCast($cast);
    }

    private $id_movie;
    private $title;
    private $year;
    private $genres;
    private $plot;
    private $directors;
    private $cast;

    /**
     * function setter pour id_movie
     * 
     * @param [int] $id_movie
     * @return void
     */
    function setId_movie($id_movie){
        if(is_int($id_movie)){
            $this->id_movie = $id_movie;
        }else{
            throw new Exception("id_movie doit etre un int");
        }
    }
    function setTitle($title){
        if(is_string($title)){
            $this->title = $title;
        }else{
            throw new Exception("id_movie doit etre un text");

        }
    }  
    function setYear($year){
        if(is_int($year)){
            $this->year = $year;
        }else{
             throw new Exception("id_movie doit etre un int");
        }
        

     }
    function setGenre($genres){
        if(is_string($genres)){
            $this->genres = $genres;
        }else{
             throw new Exception("id_movie doit etre un int");
        }
    }
    function setPlot($plot){
        if(is_string($plot)){
            $this->plot = $plot;
        }else{
             throw new Exception("id_movie doit etre un int");
        }
     }
    
    function setDirector($directors){
        if(is_string($directors)){
            $this->directors = $directors;
        }else{
             throw new Exception("id_movie doit etre un string");
        }
     }
    function setCast($cast){
        if(is_string($cast)){
            $this->cast = $cast;
        }else{
             throw new Exception("id_movie doit etre un string");
        }
     }

    function getId_movie(){
        return $this->id_movie;
    }
    function getTitle(){
        return $this->title;
    }
    function getYear(){
        return $this->year;
    }
    function getGenre(){
        return $this->genres;
    }
    function getPlot(){
        return $this->plot;
    }
    function getDirector(){
        return $this->directors;
    }
    function getCast(){
        return $this->cast;
    }


}
?>