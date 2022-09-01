<?php
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getRepository("FilmRepository"));
class Film extends FilmRepository
{
    public function __construct(
        $id_movie,
        $title,
        $year,
        $genres,
        $plot,
        $directors,
        $cast
        )
    {
        $this->setId_movie($id_movie);
        $this->setTitle($title);
        $this->setYear($year);
        $this->setGenres($genres);
        $this->setPlot($plot);
        $this->setDirectors($directors);
        $this->setCast($cast);
    }
    private $id_movie;
    private $title;
    private $year;
    private $genres;
    private $plot;
    private $directors;
    private $cast;
    
    public function getId_movie()
    {
        return $this->id_movie;
    }
    /**
     * Fonction setter pour id_movie
     *
     * @param [int] $id_movie
     * @return void
     */
    public function setId_movie($id_movie)
    {
        if (is_int($id_movie)) {
            $this->id_movie = $id_movie;
        } else {
            throw new Exception("id_movie doit êrte de type int!");
        }
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        
        if (is_string($title)) {
            $this->title = $title;
        } else {
            throw new Exception("title doit êrte de type string!");
        }
    }
    public function getYear()
    {
        return $this->year;
    }
    public function setYear($year)
    {
        if (is_int($year)) {
            $this->year = $year;
        } else {
            throw new Exception("year doit êrte de type int!");
        }
    }
    public function getGenres()
    {
        return $this->genres;
    }
    public function setGenres($genres)
    {
        if (is_string($genres)) {
            $this->genres = $genres;
        } else {
            throw new Exception("genres doit êrte de type string!");
        }
    }
    public function getPlot()
    {
        return $this->plot;
    }
    public function setPlot($plot)
    {
        if (is_string($plot)) {
            $this->plot = $plot;
        } else {
            throw new Exception("plot doit être de type string!");
        }
    }
    public function getDirectors()
    {
        return $this->directors;
    }
    public function setDirectors($directors)
    {
        if (is_string($directors)) {
            $this->directors = $directors;
        } else {
            throw new Exception("directors doit êrte de type string!");
        }
    }
    public function getCast()
    {
        return $this->cast;
    }
    public function setCast($cast)
    {
        if (is_string($cast)) {
            $this->cast = $cast;
        } else {
            throw new Exception("cast doit êrte de type string!");
        }
    }
}
