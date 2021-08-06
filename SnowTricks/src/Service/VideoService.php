<?php


namespace App\Service;


use App\Entity\Video;

class VideoService
{

    public function parseUrl(Video $video): bool
    {
        if (preg_match(Video::YOUTUBE_REGEX, $video->getUrl(), $matches)) {
            $video->setPlatform(Video::YOUTUBE)
                ->setPlatformId($matches[1]);
            return true;
        }
        if (preg_match(Video::DAILYMOTION_REGEX, $video->getUrl(), $matches)) {
            $video->setPlatform(Video::DAILYMOTION)
                ->setPlatformId($matches[1]);
            return true;
        }
        if (preg_match(Video::VIMEO_REGEX, $video->getUrl(), $matches)) {
            $video->setPlatform(Video::VIMEO)
                ->setPlatformId($matches[1]);
            return true;
        }





        return false;
    }
}