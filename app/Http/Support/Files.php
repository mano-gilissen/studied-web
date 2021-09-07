<?php



namespace App\Http\Support;



class Files {



    const

        LOCATION_AVATAR                 = "/storage/avatar/";



    public static function storeFile($request, $type, $id, $file = null) {

        $filename                                               = '';
        $file                                                   = $request->file($file ?? $type);

        if ($file && $file->isValid()) {

            $extension                                          = $file->extension();
            $filename                                           = $type . '_' . $id . '_' . Func::generate_key() . '.' . $extension;

            $file->storeAs($type, $filename);
        }

        return $filename;
    }



}
