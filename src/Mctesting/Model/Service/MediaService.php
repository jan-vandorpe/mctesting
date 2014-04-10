<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\MediaDAO;

/**
 * Description of MediaService
 *
 * @author cyber01
 */
class MediaService
{
    public static function getByQuestion($questionId)
    {
        return MediaDAO::selectByQuestion($questionId);
    }
    
    public static function create($questionId, $mediaId, $filename)
    {
        MediaDAO::insert($questionId, $mediaId, $filename);
    }
}
