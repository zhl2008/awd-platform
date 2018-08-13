<?php
namespace Common\Model;

class AuthGroupModel extends \Think\Model
{
	const TYPE_ADMIN = 1;
	const MEMBER = 'admin';
	const UCENTER_MEMBER = 'ucenter_member';
	const AUTH_GROUP_ACCESS = 'auth_group_access';
	const AUTH_EXTEND = 'auth_extend';
	const AUTH_GROUP = 'auth_group';
	const AUTH_EXTEND_CATEGORY_TYPE = 1;
	const AUTH_EXTEND_MODEL_TYPE = 2;

	protected $_validate = array(
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'title', 'un-handled kind  in zend_ast' => 'require', 'un-handled kind  in zend_ast' => '必须设置用户组标题', 'un-handled kind  in zend_ast' => \Think\Model::MUST_VALIDATE, 'un-handled kind  in zend_ast' => 'regex', 'un-handled kind  in zend_ast' => \Think\Model::MODEL_INSERT),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'description', 'un-handled kind  in zend_ast' => '0,80', 'un-handled kind  in zend_ast' => '描述最多80字符', 'un-handled kind  in zend_ast' => \Think\Model::VALUE_VALIDATE, 'un-handled kind  in zend_ast' => 'length', 'un-handled kind  in zend_ast' => \Think\Model::MODEL_BOTH)
		);

	public function getGroups($where = array())
	{
		$map = array('status' => 1, 'type' => self::TYPE_ADMIN, 'module' => 'admin');
		$map = array_merge($map, $where);
		return $this->where($map)->select();
	}

	public function addToGroup($uid, $gid)
	{
		$uid = (is_array($uid) ? implode(',', $uid) : trim($uid, ','));
		$gid = (is_array($gid) ? $gid : explode(',', trim($gid, ',')));
		$Access = M(self::AUTH_GROUP_ACCESS);

		if (isset($_REQUEST['batch'])) {
			$del = $Access->where(array(
				'uid' => array('in', $uid)
				))->delete();
		}

		$uid_arr = explode(',', $uid);
		$uid_arr = array_diff($uid_arr, array(C('USER_ADMINISTRATOR')));
		$add = array();

		if ($del !== false) {
			foreach ($uid_arr as $u) {
				foreach ($gid as $g) {
					if (is_numeric($u) && is_numeric($g)) {
						$add[] = array('group_id' => $g, 'uid' => $u);
					}
				}
			}

			$Access->addAll($add);
		}

		if ($Access->getDbError()) {
			if ((count($uid_arr) == 1) && (count($gid) == 1)) {
				$this->error = '不能重复添加';
			}

			return false;
		}
		else {
			return true;
		}
	}

	static public function getUserGroup($uid)
	{
		static $groups = array();

		if (isset($groups[$uid])) {
			return $groups[$uid];
		}

		$prefix = C('DB_PREFIX');
		$user_groups = M()->field('uid,group_id,title,description,rules')->table($prefix . self::AUTH_GROUP_ACCESS . ' a')->join($prefix . self::AUTH_GROUP . ' g on a.group_id=g.id')->where('a.uid=\'' . $uid . '\' and g.status=\'1\'')->select();
		$groups[$uid] = ($user_groups ? $user_groups : array());
		return $groups[$uid];
	}

	static public function getAuthExtend($uid, $type, $session)
	{
		if (!$type) {
			return false;
		}

		if ($session) {
			$result = session($session);
		}

		if (($uid == UID) && !empty($result)) {
			return $result;
		}

		$prefix = C('DB_PREFIX');
		$result = M()->table($prefix . self::AUTH_GROUP_ACCESS . ' g')->join($prefix . self::AUTH_EXTEND . ' c on g.group_id=c.group_id')->where('g.uid=\'' . $uid . '\' and c.type=\'' . $type . '\' and !isnull(extend_id)')->getfield('extend_id', true);

		if (($uid == UID) && $session) {
			session($session, $result);
		}

		return $result;
	}

	static public function getAuthCategories($uid)
	{
		return self::getAuthExtend($uid, self::AUTH_EXTEND_CATEGORY_TYPE, 'AUTH_CATEGORY');
	}

	static public function getExtendOfGroup($gid, $type)
	{
		if (!is_numeric($type)) {
			return false;
		}

		return M(self::AUTH_EXTEND)->where(array('group_id' => $gid, 'type' => $type))->getfield('extend_id', true);
	}

	static public function getCategoryOfGroup($gid)
	{
		return self::getExtendOfGroup($gid, self::AUTH_EXTEND_CATEGORY_TYPE);
	}

	static public function addToExtend($gid, $cid, $type)
	{
		$gid = (is_array($gid) ? implode(',', $gid) : trim($gid, ','));
		$cid = (is_array($cid) ? $cid : explode(',', trim($cid, ',')));
		$Access = M(self::AUTH_EXTEND);
		$del = $Access->where(array(
			'group_id' => array('in', $gid),
			'type'     => $type
			))->delete();
		$gid = explode(',', $gid);
		$add = array();

		if ($del !== false) {
			foreach ($gid as $g) {
				foreach ($cid as $c) {
					if (is_numeric($g) && is_numeric($c)) {
						$add[] = array('group_id' => $g, 'extend_id' => $c, 'type' => $type);
					}
				}
			}

			$Access->addAll($add);
		}

		if ($Access->getDbError()) {
			return false;
		}
		else {
			return true;
		}
	}

	static public function addToCategory($gid, $cid)
	{
		return self::addToExtend($gid, $cid, self::AUTH_EXTEND_CATEGORY_TYPE);
	}

	public function removeFromGroup($uid, $gid)
	{
		return M(self::AUTH_GROUP_ACCESS)->where(array('uid' => $uid, 'group_id' => $gid))->delete();
	}

	static public function memberInGroup($group_id)
	{
		$prefix = C('DB_PREFIX');
		$l_table = $prefix . self::MEMBER;
		$r_table = $prefix . self::AUTH_GROUP_ACCESS;
		$r_table2 = $prefix . self::UCENTER_MEMBER;
		$list = M()->field('m.uid,u.username,m.last_login_time,m.last_login_ip,m.status')->table($l_table . ' m')->join($r_table . ' a ON m.uid=a.uid')->join($r_table2 . ' u ON m.uid=u.id')->where(array('a.group_id' => $group_id))->select();
		return $list;
	}

	public function checkId($modelname, $mid, $msg = '以下id不存在:')
	{
		if (is_array($mid)) {
			$count = count($mid);
			$ids = implode(',', $mid);
		}
		else {
			$mid = explode(',', $mid);
			$count = count($mid);
			$ids = $mid;
		}

		$s = M($modelname)->where(array(
			'id' => array('IN', $ids)
			))->getField('id', true);

		if (count($s) === $count) {
			return true;
		}
		else {
			$diff = implode(',', array_diff($mid, $s));
			$this->error = $msg . $diff;
			return false;
		}
	}

	public function checkGroupId($gid)
	{
		return $this->checkId('AuthGroup', $gid, '以下用户组id不存在:');
	}

	public function checkCategoryId($cid)
	{
		return $this->checkId('Category', $cid, '以下分类id不存在:');
	}
}

?>