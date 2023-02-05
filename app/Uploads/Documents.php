<?php

namespace App\Uploads;

class Documents {
    public static function upload($document)
    {
        if($document){
            $imageName = time() . '.' . $document->extension();
            $document->storeAs('public/document/', $imageName);

            return $imageName;
        }

        return null;
    }
}