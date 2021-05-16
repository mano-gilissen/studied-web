<?php



namespace App\Http\Traits;



trait BaseTrait {



    public static

        $BASE_ID                                = 'id',
        $BASE_CREATED_AT                        = 'created_at',
        $BASE_DELETED_AT                        = 'deleted_at',

        $NAMESPACE_MODEL                        = "App\\Models\\";



    public function getOneToOne($type, $key = null) {

        return $this->belongsTo(self::getModelClass($type), $key ? $key : $type);

    }

    public function getOneToMany($type, $foreign_key, $local_key) {

        return $this->hasMany(self::getModelClass($type), $foreign_key, $local_key);

    }

    public function getManyToMany($type, $pivot, $local_key, $foreign_key) {

        return $this->belongsToMany(self::getModelClass($type), $pivot, $local_key, $foreign_key);

    }



    public static function getModel($type) {

        return (ucfirst($type));

    }

    public static function getModelClass($type) {

        return self::$NAMESPACE_MODEL . self::getModel($type);

    }



}
