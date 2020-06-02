<?php

namespace Constant;

/**
 * Description of UserCode
 *
 * @author Mensah
 */
class UserCode {
    
    const GROUP_LEVEL_SYSTEM_ADMIN = 3;
    const GROUP_LEVEL_HOD = 2;
    const GROUP_LEVEL_ADMIN = 1;
    const GROUP_LEVEL_USER = 0;
    const GROUP_LEVEL_UNKNOWN = -1;
    
    
   
    public static function isHOD($level) {
        return  $level == self::GROUP_LEVEL_HOD;
    }
   
    
}
