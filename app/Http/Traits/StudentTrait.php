<?php



namespace App\Http\Traits;



trait StudentTrait {





    public static

        $STUDENT                                        = 'student',

        $STUDENT_SCHOOL                                 = 'school',
        $STUDENT_NIVEAU                                 = 'niveau',
        $STUDENT_LEERJAAR                               = 'leerjaar',
        $STUDENT_PROFILE                                = 'profile';





    public static function hasCustomer($student) {

        return $student->getCustomer->exists();

    }





}
