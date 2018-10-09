<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-08
 * Time: 오전 5:51
 */

namespace Mirage\MainBundle\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;
use Mirage\MainBundle\Document\Story;
use Doctrine\ORM\NoResultException;

class StoryRepository extends DocumentRepository
{
    public function findAllSortYear()
    {
        $all = $this->findAll();
        $sort = array();
        foreach($all as &$story){
            $year = $story->getYear();
            $yearUiValue = $story->getYearUiValue();
            if(empty($sort[$year])){
                $sort[$year] = array();
                $sort[$year]['year'] = $year;
                $sort[$year]['yearUiValue'] = $yearUiValue;
                if(empty($sort[$year]['stories'])) $sort[$year]['stories'] = array();
            }
            array_push($sort[$year]['stories'], $story->unsetYearAndValue());
        }

        $result = array();
        foreach($sort as $s){
            $result[] = $s;
        }

        return $result;
    }

    public function findOneByIdEpisode($idEpisode){
        try{
            $story = $this->dm->getRepository(Story::class)->findOneBy(['chapters.episodes.idEpisode' => $idEpisode]);
            
            $result = null;
            foreach($story->getChapters() as $chapter){
                foreach($chapter->getEpisodes() as $episode){
                    if($idEpisode == $episode->getIdEpisode()){
                        $result = $episode;
                        break;
                    }
                }
            }
            return $result;
        } catch (NeResultException $e){
            return $e;
        }



    }

}