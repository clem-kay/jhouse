<?php

namespace Table;

use \Constant\UserCode;

/**
 * Description of UsersTable
 *
 * @author user
 */
class UsersTable extends \Core\Model\Table {

    public function getLoginData($username) {
        $result = [];
        $attrib[':username'] = strtoupper(trim($username));
        $sql = " SELECT  u.id AS id, u.name AS name, u.username AS username, u.token AS token, ug.id AS groupId  	
                    FROM users u JOIN user_group ug ON ug.id = u.id_usr_group WHERE username = :username ";


        $user = $this->query($sql, $attrib, true);


        if ($user) {
            $grpId = $user['groupId'];
            $result['user'] = $user;
            $result['userGroup'] = $this->getUserGroup($grpId);
            $result['department'] = $this->table('department')->getByGoupId($grpId);

            //controle of user group id based on level
            $level = isset($result['userGroup']['level']) ? $result['userGroup']['level'] : UserCode::GROUP_LEVEL_UNKNOWN;
            $controlledId = ( intval($level) == UserCode::GROUP_LEVEL_SYSTEM_ADMIN) ? 0 : $grpId;
            $rights = $this->table('department')->getRightsByGroupId($controlledId);
           
            $list = [];
            foreach ($rights as $r) {
                $list[] = trim($r['code']);
            }
            $result['rights'] = $list;
        }

        return $result;
    }

    public function getUserGroup($idGroup) {
        $sql = " SELECT  ug.id AS id, ug.name AS name, ug.level level FROM user_group ug  WHERE ug.id = :id ";
        return $this->query($sql, [':id' => $idGroup], true);
    }

}
