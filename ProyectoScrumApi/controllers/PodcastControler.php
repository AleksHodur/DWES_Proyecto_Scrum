<?php

require_once('../services/PodcastService.php');

class PodcastController{

    //???public $servicio; //objeto PodcastService

    public function getPodcast($id){
        return json_encode(PodcastService::getPodcast($id));
    }

    public function getPodcastTags($tag){
        return json_encode(PodcastService::getPodcastTags($tag));
    }

    public function subirPodcast($json){//post
        $parseado = json_decode($json);
        PodcastService::postPodcast($parseado);
    }

    public function actualizarPodcast($json){//put: mismo json que post
        $parseado = json_decode($json);
        PodcastService::putPodcast($parseado);
    }

    public function deletePodcast($id){
        PodcastService::deletePodcast($id);
    }
}
?>