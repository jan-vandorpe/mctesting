<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\MediaDAO;
//use Mctesting\Exception\ApplicationException;

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
    
    public static function create($questionId, $mediaFileNames)
    {
//        if (is_array($media)) {
            foreach ($mediaFileNames as $id => $filename) {
                MediaDAO::insert($questionId, $id, $filename);
            }
//        } else {
//            throw new ApplicationException('Parameter die media bevat is geen array');
//        }
    }
}
