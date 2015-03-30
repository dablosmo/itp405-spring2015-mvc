<?php 

namespace App\Services;
use Illuminate\Support\Facades\Cache;

class RottenTomatoes {

    public static function search($dvd)
    {
    	$dvd_title = urlencode($dvd);

        if(Cache::has("rottentomatoes-$dvd_title"))
        { 
        	$movieData = Cache::get("rottentomatoes-$dvd_title");
        }
        else 
        {
        	$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=jtzfmv3mc7hhupr75jpyem2d&q=$dvd_title";
        	$jsonString = file_get_contents($url);
        	$data = json_decode($jsonString, true); 
        	$movieData = NULL;

        	foreach($data['movies'] as $moviedata) 
        	{ 
        		$abridgedCast = '';
        		foreach($moviedata['abridged_cast'] as $actor)
        		{
        			$abridgedCast .= $actor['name'] . ', ';
        		}
        		$movieData = 
        			[
        				'critic_score'    => $moviedata['ratings']['critics_score'],
        				'audience_score'  => $moviedata['ratings']['audience_score'],
        				'poster'		  => $moviedata['posters']['thumbnail'],
        				'runtime'		  => $moviedata['runtime'],
        				'abridged_cast'	  => $abridgedCast
        			];
        		break;
        	}
        	Cache::put("rottentomatoes-$dvd_title", $movieData, 60);
        }
        return $movieData;
    }
};
