<?php
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getModele("Film"));
require_once($routeController->getRepository("FilmRepository"));
class FilmController
{
    public static function selectRandomFilms($nbFilm){
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets()."img/posters/";
        $ext = ".jpg";
        $filmRepository = new FilmRepository;
        $films = $filmRepository->selectFilmsR($nbFilm);
        foreach ($films as $key => $value) {
            if(file_exists($urlPoster.$value['id_movie'].$ext)){
                $films[$key]['urlFilm'] = $urlPoster.$value['id_movie'].$ext;
            } else {
                $films[$key]['urlFilm'] = $urlPoster."default.jpg";
            }
        }
        return $films;
    } 
    public static function menuGenre(){
        $filmRepository = new FilmRepository;
        return $filmRepository->selectGenres();
    }
    public static function getFilmsByGenre($genre , $currentPage){
        $filmRepository = new FilmRepository;
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets()."img/posters/";
        $ext = ".jpg";
        
        $index = ($currentPage-1)*20;
        $nbFilms = 20;


        $pagemax = $filmRepository->pageByGenre($genre);
        $pagemax = ceil($pagemax/20);
         
        if ($currentPage >= $pagemax){
            $index = $pagemax-1;

        }elseif ($currentPage<= 1){
            $index = 0;
        }

        $films = $filmRepository->selectFilmsByGenre($genre,$index,$nbFilms);
        foreach ($films as $key => $value) {
            if(file_exists($urlPoster.$value['id_movie'].$ext)){
                $films[$key]['urlFilm'] = $urlPoster.$value['id_movie'].$ext;
            } else {
                $films[$key]['urlFilm'] = $urlPoster."default.jpg";
            }
        }
        return $films;
    } 
    public static  function getNbPage($genre){
        $filmRepository = new FilmRepository;
        $count  = $filmRepository->pageByGenre($genre);
        return ceil($count/20);
    }  

    public static function getSearch($search){
        $filmRepository = new FilmRepository;
        $resultJson = $filmRepository->selectSearch($search);
        return($resultJson);
    }

    public static function getFilmById($id){
        $routeController = new RouteController($_SERVER);
        $filmRepository = new FilmRepository;
        $result = $filmRepository->selectFilmById($id);
        $film = new Film(
            intval($result['id_movie']),
            $result['title'],
            intval($result['year']),
            $result['genres'],
            $result['plot'],
            $result['directors'],
            $result['cast'],
            


        );
        $urlPoster = $routeController->getAssets()."img/posters/";
        $ext =".jpg";
        
        
        if(file_exists($urlPoster.$film->getId_movie().$ext)){
            $film->urlFilm = $urlPoster.$film->getId_movie().$ext;
        } else {
            $film->urlFilm = $urlPoster."default.jpg";
        }
        //var_dump($film);
        $reactFilm = [
            'title' => $film->getTitle(),
            'urlFilm' => $film->urlFilm,
            'plot' =>$film->getPlot(),
            'year' =>$film->getYear(),
            'cast' =>$film->getcast(),
            'genre'=>$film->getGenres(),
            'director'=>$film->getDirectors()

        ];
        $reactFilm = (object)($reactFilm);
        return json_encode([$reactFilm]);
            

        

            
        

        
    }
}

