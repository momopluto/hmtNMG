<?php
namespace Recruit\Controller;
use Common\Controller\CommonController;
class BaseController extends CommonController {
/**
 * 项目总控制器，直接继承CommonController
 */

	const LOGIN_FROM 			= 'recruit/resume/login';

	protected function _initialize(){

		parent::_initialize();

		// 判断登录是否过期
		if (session('?RESUME_EXPIRE') && (NOW_TIME - session('RESUME_EXPIRE') > self::SESSION_EXPIRE_USER_DEFINED)) {
			// 用户2次操作时间间隔已经超过session过期时间间隔
			session('RESUME_INFO', null);
			session('RESUME_LOGIN_FLAG', null);
            session('RESUME_EXPIRE', null);

			$this->error("登录过期！请重新登录！", U(self::LOGIN_FROM));
			return;
		}

		$CUR_ASK_FROM = strtolower(MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME);

		if (strcmp(self::LOGIN_FROM, $CUR_ASK_FROM) == 0) {
			
			if (session('RESUME_LOGIN_FLAG')) {
				// 重复登录，跳转到简历编辑页面
				switch (self::$RECRUIT_STAGE) {
					case 0:
						$target_URL = U('Recruit/Resume/edit');
						break;
					case 1:
					case 2:
					case 3:
					case 4:
						$target_URL = U('Recruit/Resume/status');
						break;
					default:// 不可能执行这里
                        $target_URL = '#';
						break;
				}
				$this->error("您已经登录！", $target_URL, 1);
				
				// 更新销毁session时间
				session('RESUME_EXPIRE', NOW_TIME);
			}else{
				// 进入登录页面
			}
		}else{

			if (session('RESUME_LOGIN_FLAG')) {
				// 进入目标页面
				
				// 更新销毁session时间
				session('RESUME_EXPIRE', NOW_TIME);
			}else{

				// 未登录，跳转到登录页面
				$this->error("请先登录！", U(self::LOGIN_FROM), 1);
			}
		}
	}

}

?>