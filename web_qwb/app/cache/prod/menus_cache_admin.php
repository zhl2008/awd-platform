<?php 
return array (
  'admin' => 
  array (
    'name' => '后台管理员',
    'parent' => NULL,
    'children' => 
    array (
      'admin_user' => 
      array (
        'name' => '用户',
        'children' => 
        array (
          'admin_user_show' => 
          array (
            'name' => '用户管理',
            'children' => 
            array (
              'admin_user_manage' => 
              array (
                'name' => '用户管理',
                'router_name' => 'admin_user',
                'children' => 
                array (
                  'admin_user_create' => 
                  array (
                    'name' => '添加新用户',
                    'mode' => 'modal',
                    'group' => 'topBtn',
                    'visable' => '(user.type != \'system\')',
                  ),
                  'admin_user_edit' => 
                  array (
                    'name' => '编辑用户信息',
                    'mode' => 'modal',
                    'group' => 'groupButton',
                    'visable' => '(user.type != \'system\')',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                  'admin_user_roles' => 
                  array (
                    'name' => '设置用户组',
                    'mode' => 'modal',
                    'group' => 'groupButton',
                    'visable' => '(user.type != \'system\')',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                  'admin_user_avatar' => 
                  array (
                    'name' => '修改用户头像',
                    'mode' => 'modal',
                    'group' => 'groupButton',
                    'visable' => '(user.type != \'system\')',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                  'admin_user_change_password' => 
                  array (
                    'name' => '修改密码',
                    'mode' => 'modal',
                    'group' => 'groupButton',
                    'visable' => '(user.type != \'system\')',
                    'router_params' => 
                    array (
                      'userId' => '(user.id)',
                    ),
                  ),
                  'admin_user_send_passwordreset_email' => 
                  array (
                    'name' => '发送密码重置邮件',
                    'group' => 'groupButton',
                    'class' => 'send-passwordreset-email',
                    'mode' => 'none',
                    'visable' => '(user.type != \'system\')',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                  'admin_user_send_emailverify_email' => 
                  array (
                    'name' => '发送Email验证邮件',
                    'class' => 'send-emailverify-email',
                    'group' => 'groupButton',
                    'mode' => 'none',
                    'visable' => '(user.type != \'system\')',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                  'admin_user_lock' => 
                  array (
                    'name' => '封禁用户',
                    'group' => 'groupButton',
                    'class' => 'lock-user',
                    'mode' => 'none',
                    'visable' => '(user.type != \'system\' and user.locked == 0)',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                  'admin_user_unlock' => 
                  array (
                    'name' => '解禁用户',
                    'class' => 'unlock-user',
                    'group' => 'groupButton',
                    'mode' => 'none',
                    'visable' => '(user.type != \'system\' and user.locked == 1)',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                  'admin_user_org_update' => 
                  array (
                    'name' => '修改用户组织机构',
                    'parent' => 'admin_user_manage',
                    'mode' => 'modal',
                    'group' => 'groupButton',
                    'visable' => '( app.user.id != user.id and setting(\'magic.enable_org\', 0) == 1 )',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                    'disable' => true,
                  ),
                ),
              ),
              'admin_login_record' => 
              array (
                'name' => '登录日志',
              ),
            ),
          ),
          'admin_teacher' => 
          array (
            'name' => '教师管理',
            'children' => 
            array (
              'admin_teacher_manage' => 
              array (
                'name' => '教师管理',
                'router_name' => 'admin_teacher',
                'disable' => true,
                'children' => 
                array (
                  'admin_teacher_promote' => 
                  array (
                    'name' => '推荐老师',
                    'class' => 'promote-teacher',
                    'mode' => 'modal',
                    'icon' => 'glyphicon glyphicon-hand-up',
                    'group' => 'groupButton',
                    'visable' => '(user.promoted == 0)',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                      'type' => 'teacherList',
                    ),
                  ),
                  'admin_teacher_promote_cancel' => 
                  array (
                    'name' => '取消推荐',
                    'class' => 'cancel-promote-teacher',
                    'mode' => 'none',
                    'group' => 'groupButton',
                    'visable' => '(user.promoted == 1)',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                  ),
                ),
              ),
              'admin_teacher_promote_list' => 
              array (
                'name' => '教师推荐',
                'disable' => true,
              ),
            ),
          ),
          'admin_approval_manage' => 
          array (
            'name' => '实名认证管理',
            'children' => 
            array (
              'admin_approval_approvals' => 
              array (
                'name' => '实名认证管理',
                'router_params' => 
                array (
                  'approvalStatus' => 'approving',
                ),
                'disable' => true,
                'children' => 
                array (
                  'admin_approval_cancel' => 
                  array (
                    'name' => '撤销',
                    'router_params' => 
                    array (
                      'id' => '(user.id)',
                    ),
                    'class' => 'btn cancel-approval',
                    'mode' => 'none',
                    'group' => 'groupButton',
                  ),
                ),
              ),
            ),
          ),
          'admin_message_manage' => 
          array (
            'name' => '私信管理',
            'children' => 
            array (
              'admin_message' => 
              array (
                'name' => '私信管理',
                'disable' => true,
              ),
            ),
          ),
        ),
      ),
      'admin_course' => 
      array (
        'name' => '课程',
        'children' => 
        array (
          'admin_course_show' => 
          array (
            'name' => '课程管理',
            'children' => 
            array (
              'admin_course_manage' => 
              array (
                'name' => '课程管理',
                'router_name' => 'admin_course_set',
                'children' => 
                array (
                  'admin_course_content_manage' => 
                  array (
                    'name' => '管理课程',
                  ),
                  'admin_course_add' => 
                  array (
                    'name' => '创建课程',
                    'router_name' => 'course_set_manage_create',
                    'group' => 'topBtn',
                    'blank' => 1,
                  ),
                  'admin_course_set_recommend' => 
                  array (
                    'name' => '推荐课程',
                    'router_params' => 
                    array (
                      'id' => '(courseSet.id)',
                      'filter' => '(filter)',
                      'ref' => 'courseList',
                    ),
                    'group' => 'groupButton',
                    'visable' => '( filter == \'normal\' and not courseSet.recommended )',
                    'icon' => 'glyphicon glyphicon-hand-up',
                    'mode' => 'modal',
                  ),
                  'admin_course_set_cancel_recommend' => 
                  array (
                    'name' => '取消推荐',
                    'router_params' => 
                    array (
                      'id' => '(courseSet.id)',
                      'filter' => '(filter)',
                      'target' => '(target)',
                    ),
                    'group' => 'groupButton',
                    'class' => 'cancel-recommend-course',
                    'visable' => '( filter == \'normal\' and courseSet.recommended )',
                    'icon' => 'glyphicon glyphicon-hand-right',
                    'mode' => 'none',
                  ),
                  'admin_course_guest_member_preview' => 
                  array (
                    'name' => '预览',
                    'router_name' => 'course_show',
                    'router_params' => 
                    array (
                      'id' => '(courseSet.defaultCourseId)',
                      'previewAs' => 'guest',
                    ),
                    'group' => 'groupButton',
                    'icon' => 'glyphicon glyphicon-eye-open',
                    'blank' => 1,
                  ),
                  'admin_course_set_close' => 
                  array (
                    'name' => '关闭课程',
                    'router_params' => 
                    array (
                      'id' => '(courseSet.id)',
                      'filter' => '(filter)',
                    ),
                    'group' => 'groupButton',
                    'icon' => 'glyphicon glyphicon-ban-circle',
                    'mode' => 'none',
                    'class' => 'close-course',
                    'visable' => '(courseSet.status == \'published\')',
                  ),
                  'admin_course_sms_prepare' => 
                  array (
                    'name' => '发送发布通知短信',
                    'router_name' => 'sms_prepare',
                    'router_params' => 
                    array (
                      'id' => '(courseSet.id)',
                      'targetType' => 'course',
                    ),
                    'group' => 'groupButton',
                    'icon' => 'glyphicon glyphicon-envelope',
                    'mode' => 'modal',
                    'visable' => '(courseSet.status == \'published\')',
                  ),
                  'admin_course_set_publish' => 
                  array (
                    'name' => '发布课程',
                    'router_params' => 
                    array (
                      'id' => '(courseSet.id)',
                      'filter' => '(filter)',
                    ),
                    'group' => 'groupButton',
                    'class' => 'publish-course',
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'mode' => 'none',
                    'visable' => '(courseSet.status != \'published\')',
                  ),
                  'admin_course_set_delete' => 
                  array (
                    'name' => '删除课程',
                    'class' => 'delete-course',
                    'router_params' => 
                    array (
                      'id' => '(courseSet.id)',
                      'filter' => '(filter)',
                      'type' => '',
                    ),
                    'group' => 'groupButton',
                    'icon' => 'glyphicon glyphicon-trash',
                    'mode' => 'none',
                    'visable' => '( courseSet.status in [\'closed\', \'draft\', \'published\'])',
                  ),
                ),
              ),
              'admin_course_set_recommend_list' => 
              array (
                'name' => '课程推荐',
              ),
              'admin_course_set_data' => 
              array (
                'name' => '课程统计',
              ),
            ),
          ),
          'admin_classroom' => 
          array (
            'name' => '班级管理',
            'parent' => 'admin_course',
            'before' => 'admin_course_thread',
            'children' => 
            array (
              'admin_classroom_manage' => 
              array (
                'name' => '班级管理',
                'router_name' => 'admin_classroom',
                'children' => 
                array (
                  'admin_classroom_content_manage' => 
                  array (
                    'name' => '管理班级',
                    'router_name' => 'classroom_manage',
                    'group' => 'btn',
                    'router_params' => 
                    array (
                      'id' => '(classroom.id)',
                    ),
                    'blank' => true,
                  ),
                  'admin_classroom_create' => 
                  array (
                    'name' => '创建班级',
                    'group' => 'topBtn',
                    'blank' => true,
                  ),
                  'admin_classroom_cancel_recommend' => 
                  array (
                    'name' => '取消推荐',
                    'mode' => 'none',
                    'class' => 'cancel-recommend-classroom',
                    'icon' => 'glyphicon glyphicon-hand-right',
                    'group' => 'groupButton',
                    'router_params' => 
                    array (
                      'id' => '(classroom.id)',
                      'ref' => 'classroomList',
                    ),
                    'visable' => '( classroom.recommended )',
                  ),
                  'admin_classroom_set_recommend' => 
                  array (
                    'name' => '推荐班级',
                    'mode' => 'modal',
                    'icon' => 'glyphicon glyphicon-hand-up',
                    'group' => 'groupButton',
                    'router_params' => 
                    array (
                      'id' => '(classroom.id)',
                      'ref' => 'classroomList',
                    ),
                    'visable' => '( not classroom.recommended )',
                  ),
                  'admin_classroom_close' => 
                  array (
                    'name' => '关闭班级',
                    'mode' => 'none',
                    'class' => 'close-classroom',
                    'icon' => 'glyphicon glyphicon-off',
                    'group' => 'groupButton',
                    'router_params' => 
                    array (
                      'id' => '(classroom.id)',
                    ),
                    'visable' => '( classroom.status == \'published\' )',
                  ),
                  'admin_sms_prepare' => 
                  array (
                    'name' => '发送发布通知短信',
                    'router_name' => 'sms_prepare',
                    'mode' => 'modal',
                    'icon' => 'glyphicon glyphicon-envelope',
                    'group' => 'groupButton',
                    'router_params' => 
                    array (
                      'id' => '(classroom.id)',
                      'targetType' => 'classroom',
                    ),
                    'visable' => '( classroom.status == \'published\' )',
                  ),
                  'admin_classroom_open' => 
                  array (
                    'name' => '发布班级',
                    'mode' => 'none',
                    'icon' => 'glyphicon glyphicon-ok',
                    'group' => 'groupButton',
                    'class' => 'open-classroom',
                    'router_params' => 
                    array (
                      'id' => '(classroom.id)',
                    ),
                    'visable' => '( classroom.status != \'published\' )',
                  ),
                  'admin_classroom_delete' => 
                  array (
                    'name' => '删除班级',
                    'mode' => 'none',
                    'icon' => 'glyphicon glyphicon-remove',
                    'class' => 'delete-classroom',
                    'group' => 'groupButton',
                    'router_params' => 
                    array (
                      'id' => '(classroom.id)',
                    ),
                    'visable' => '( classroom.status==\'draft\' )',
                  ),
                ),
              ),
              'admin_classroom_recommend' => 
              array (
                'name' => '班级推荐',
                'router_name' => 'admin_classroom_recommend_list',
              ),
            ),
          ),
          'admin_open_course_manage' => 
          array (
            'name' => '公开课管理',
            'router_name' => 'admin_open_course',
            'children' => 
            array (
              'admin_open_course' => 
              array (
                'name' => '公开课管理',
                'disable' => true,
                'router_name' => 'admin_open_course',
              ),
              'admin_open_course_recommend_list' => 
              array (
                'name' => '公开课推荐',
                'disable' => true,
              ),
              'admin_opencourse_analysis' => 
              array (
                'name' => '公开课统计',
                'disable' => true,
              ),
            ),
          ),
          'admin_live_course' => 
          array (
            'name' => '直播管理',
            'children' => 
            array (
              'admin_live_course_manage' => 
              array (
                'name' => '直播管理',
                'router_params' => 
                array (
                  'status' => 'coming',
                ),
                'router_name' => 'admin_live_course',
                'disable' => true,
              ),
            ),
          ),
          'admin_course_thread' => 
          array (
            'name' => '话题管理',
            'children' => 
            array (
              'admin_course_thread_manage' => 
              array (
                'name' => '课程话题',
                'router_name' => 'admin_thread',
                'disable' => true,
              ),
              'admin_classroom_thread_manage' => 
              array (
                'name' => '班级话题',
                'parent' => 'admin_course_thread',
                'router_name' => 'admin_classroom_thread',
                'disable' => true,
              ),
            ),
          ),
          'admin_course_question' => 
          array (
            'name' => '问答管理',
            'children' => 
            array (
              'admin_course_question_manage' => 
              array (
                'name' => '问答管理',
                'router_name' => 'admin_question',
                'router_params' => 
                array (
                  'postStatus' => 'unPosted',
                ),
                'disable' => true,
              ),
            ),
          ),
          'admin_course_note' => 
          array (
            'name' => '笔记管理',
            'children' => 
            array (
              'admin_course_note_manage' => 
              array (
                'name' => '笔记管理',
                'router_name' => 'admin_course_note',
                'disable' => true,
              ),
            ),
          ),
          'admin_course_review' => 
          array (
            'name' => '评价管理',
            'children' => 
            array (
              'admin_course_review_tab' => 
              array (
                'name' => '课程评价',
                'router_name' => 'admin_review',
                'group' => 1,
                'disable' => true,
              ),
              'admin_classroom_review_tab' => 
              array (
                'name' => '班级评价',
                'router_name' => 'admin_classroom_review',
                'parent' => 'admin_course_review',
                'disable' => true,
              ),
            ),
          ),
          'admin_course_category' => 
          array (
            'name' => '分类管理',
            'children' => 
            array (
              'admin_course_category_manage' => 
              array (
                'name' => '课程分类',
                'router_name' => 'admin_course_category',
                'disable' => true,
                'children' => 
                array (
                  'admin_category_create' => 
                  array (
                    'name' => '添加分类',
                    'router_params' => 
                    array (
                      'groupId' => '(group.id)',
                    ),
                    'router_params_context' => 1,
                    'group' => 'topBtn',
                    'mode' => 'modal',
                  ),
                ),
              ),
              'admin_classroom_category_manage' => 
              array (
                'name' => '班级分类',
                'parent' => 'admin_course_category',
                'router_name' => 'admin_classroom_category',
                'disable' => true,
                'children' => 
                array (
                  'admin_classroom_category_create' => 
                  array (
                    'name' => '添加分类',
                    'parent' => 'admin_classroom_category_manage',
                    'router_name' => 'admin_category_create',
                    'router_params' => 
                    array (
                      'groupId' => '(group.id)',
                    ),
                    'router_params_context' => 1,
                    'group' => 'topBtn',
                    'mode' => 'modal',
                  ),
                ),
              ),
            ),
          ),
          'admin_course_tag' => 
          array (
            'name' => '标签管理',
            'children' => 
            array (
              'admin_course_tag_manage' => 
              array (
                'name' => '标签管理',
                'router_name' => 'admin_tag',
                'disable' => true,
                'children' => 
                array (
                  'admin_course_tag_add' => 
                  array (
                    'name' => '新增标签',
                    'router_name' => 'admin_tag_create',
                    'mode' => 'modal',
                    'group' => 'topBtn',
                  ),
                ),
              ),
              'admin_course_tag_group_manage' => 
              array (
                'name' => '标签组管理',
                'router_name' => 'admin_tag_group',
                'disable' => true,
                'children' => 
                array (
                  'admin_course_tag_group_add' => 
                  array (
                    'name' => '新建标签组',
                    'router_name' => 'admin_tag_group_create',
                    'mode' => 'modal',
                    'group' => 'topBtn',
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
      'admin_operation' => 
      array (
        'name' => '运营',
        'children' => 
        array (
          'admin_operation_article' => 
          array (
            'name' => '资讯管理',
            'children' => 
            array (
              'admin_operation_article_manage' => 
              array (
                'name' => '资讯管理',
                'disable' => true,
                'router_name' => 'admin_article',
                'children' => 
                array (
                  'admin_operation_article_create' => 
                  array (
                    'name' => '添加资讯',
                    'router_name' => 'admin_article_create',
                    'group' => 'topBtn',
                  ),
                ),
              ),
              'admin_operation_article_category' => 
              array (
                'name' => '栏目管理',
                'disable' => true,
                'router_name' => 'admin_article_category',
                'children' => 
                array (
                  'admin_operation_category_create' => 
                  array (
                    'name' => '添加栏目',
                    'router_name' => 'admin_article_category_create',
                    'mode' => 'modal',
                    'group' => 'topBtn',
                  ),
                ),
              ),
            ),
          ),
          'admin_operation_group' => 
          array (
            'name' => '小组管理',
            'children' => 
            array (
              'admin_operation_group_manage' => 
              array (
                'name' => '小组管理',
                'disable' => true,
                'router_name' => 'admin_group',
                'children' => 
                array (
                  'admin_operation_group_create' => 
                  array (
                    'name' => '创建小组',
                    'router_name' => 'group_add',
                    'group' => 'topBtn',
                    'blank' => 1,
                  ),
                ),
              ),
              'admin_operation_group_thread' => 
              array (
                'name' => '小组话题管理',
                'disable' => true,
                'router_name' => 'admin_groupThread',
              ),
            ),
          ),
          'admin_operation_invite' => 
          array (
            'name' => '邀请管理',
            'children' => 
            array (
              'admin_operation_invite_manage' => 
              array (
                'name' => '邀请管理',
                'disable' => true,
                'router_name' => 'admin_invite',
              ),
              'admin_operation_invite_coupon' => 
              array (
                'name' => '奖励查询',
                'disable' => true,
                'router_name' => 'admin_invite_coupon',
              ),
            ),
          ),
          'admin_announcement' => 
          array (
            'name' => '网站公告管理',
            'group' => 2,
            'children' => 
            array (
              'admin_announcement_manage' => 
              array (
                'name' => '网站公告管理',
                'disable' => true,
                'router_name' => 'admin_announcement',
                'children' => 
                array (
                  'admin_announcement_create' => 
                  array (
                    'name' => '新增公告',
                    'mode' => 'modal',
                    'group' => 'topBtn',
                  ),
                ),
              ),
            ),
          ),
          'admin_operation_notification' => 
          array (
            'name' => '全站站内通知',
            'group' => 2,
            'children' => 
            array (
              'admin_batch_notification' => 
              array (
                'name' => '全站站内通知',
                'disable' => true,
                'children' => 
                array (
                  'admin_batch_notification_create' => 
                  array (
                    'name' => '创建站内通知',
                    'group' => 'topBtn',
                  ),
                ),
              ),
            ),
          ),
          'admin_block_manage' => 
          array (
            'name' => '编辑区管理',
            'group' => 2,
            'children' => 
            array (
              'admin_block' => 
              array (
                'name' => '编辑区管理',
                'disable' => true,
                'router_params' => 
                array (
                  'category' => 'all',
                ),
                'children' => 
                array (
                  'admin_block_visual_edit' => 
                  array (
                    'name' => '编辑',
                    'router_params' => 
                    array (
                      'blockId' => '(blockTemplateId:block.blockTemplateId)',
                    ),
                  ),
                ),
              ),
            ),
          ),
          'admin_operation_content' => 
          array (
            'name' => '自定义页面管理',
            'group' => 2,
            'children' => 
            array (
              'admin_content' => 
              array (
                'name' => '自定义页面管理',
                'disable' => true,
                'router_params' => 
                array (
                  'type' => 'page',
                ),
              ),
            ),
          ),
          'admin_operation_mobile' => 
          array (
            'name' => '移动端内容管理',
            'group' => 2,
            'children' => 
            array (
              'admin_operation_mobile_banner_manage' => 
              array (
                'name' => '轮播图设置',
                'disable' => true,
                'router_name' => 'admin_operation_mobile',
              ),
              'admin_operation_mobile_select_manage' => 
              array (
                'name' => '每周精选设置',
                'disable' => true,
                'router_name' => 'admin_operation_mobile_select',
              ),
              'admin_discovery_column_index' => 
              array (
                'name' => '发现页栏目管理',
                'disable' => true,
                'children' => 
                array (
                  'admin_discovery_column_create' => 
                  array (
                    'name' => '添加栏目',
                    'group' => 'topBtn',
                    'mode' => 'modal',
                  ),
                ),
              ),
            ),
          ),
          'admin_operation_analysis_register' => 
          array (
            'name' => '数据统计',
            'group' => 3,
            'children' => 
            array (
              'admin_operation_analysis' => 
              array (
                'disable' => true,
                'name' => '数据统计',
                'router_params' => 
                array (
                  'tab' => 'trend',
                  'analysisDateType' => 'register',
                ),
                'router_name' => 'admin_operation_analysis_register',
              ),
            ),
          ),
          'admin_operation_keyword' => 
          array (
            'name' => '敏感词管理',
            'parent' => 'admin_operation',
            'group' => 4,
            'children' => 
            array (
              'admin_keyword' => 
              array (
                'name' => '敏感词列表',
                'disable' => true,
                'children' => 
                array (
                  'admin_keyword_create' => 
                  array (
                    'name' => '添加敏感词',
                    'mode' => 'modal',
                    'group' => 'topBtn',
                  ),
                ),
              ),
              'admin_keyword_banlogs' => 
              array (
                'name' => '屏蔽记录',
                'disable' => true,
              ),
            ),
          ),
        ),
      ),
      'admin_order' => 
      array (
        'name' => '订单',
        'children' => 
        array (
          'admin_course_order_manage' => 
          array (
            'name' => '课程订单',
            'children' => 
            array (
              'admin_course_order' => 
              array (
                'name' => '课程订单',
                'router_name' => 'admin_course_order_manage',
                'disable' => true,
              ),
            ),
          ),
          'admin_coin_order_manange' => 
          array (
            'name' => '虚拟币订单',
            'children' => 
            array (
              'admin_coin_orders' => 
              array (
                'name' => '虚拟币订单',
                'disable' => true,
              ),
            ),
          ),
          'admin_classroom_order_manage' => 
          array (
            'name' => '班级订单',
            'parent' => 'admin_order',
            'after' => 'admin_course_order',
            'children' => 
            array (
              'admin_classroom_order' => 
              array (
                'name' => '班级订单',
                'disable' => true,
              ),
            ),
          ),
        ),
      ),
      'admin_finance' => 
      array (
        'name' => '账务',
        'children' => 
        array (
          'admin_bills' => 
          array (
            'name' => '账单管理',
            'children' => 
            array (
              'admin_bill' => 
              array (
                'name' => '现金账单',
                'disable' => true,
              ),
              'admin_coin_records' => 
              array (
                'name' => '虚拟币账单',
                'disable' => true,
              ),
            ),
          ),
          'admin_coin_user' => 
          array (
            'name' => '虚拟币管理',
            'children' => 
            array (
              'admin_coin_user_records' => 
              array (
                'name' => '虚拟币管理',
                'disable' => true,
                'router_name' => 'admin_coin_user_records',
              ),
            ),
          ),
          'admin_course_refunds' => 
          array (
            'name' => '课程退款管理',
            'children' => 
            array (
              'admin_course_refunds_manage' => 
              array (
                'name' => '课程退款管理',
                'disable' => true,
                'router_name' => 'admin_order_refunds',
                'router_params' => 
                array (
                  'targetType' => 'course',
                  'status' => 'created',
                ),
              ),
            ),
          ),
          'admin_classroom_refunds' => 
          array (
            'name' => '班级退款管理',
            'parent' => 'admin_finance',
            'router_name' => 'admin_order_refunds',
            'router_params' => 
            array (
              'targetType' => 'classroom',
              'status' => 'created',
            ),
            'after' => 'admin_course_refunds',
            'children' => 
            array (
              'admin_classroom_refunds_manage' => 
              array (
                'name' => '班级退款管理',
                'disable' => true,
                'router_name' => 'admin_order_refunds',
                'router_params' => 
                array (
                  'targetType' => 'classroom',
                  'status' => 'created',
                ),
              ),
            ),
          ),
        ),
      ),
      'admin_app' => 
      array (
        'name' => '教育云',
        'visable' => '(not (setting(\'copyright.thirdCopyright\', false) == 1) and not is_without_network())',
        'children' => 
        array (
          'admin_my_cloud' => 
          array (
            'name' => '概览',
            'children' => 
            array (
              'admin_my_cloud_overview' => 
              array (
                'name' => '教育云概览',
                'disable' => true,
              ),
            ),
          ),
          'admin_cloud_video_setting' => 
          array (
            'name' => '云视频',
            'router_name' => 'admin_cloud_video_overview',
            'visable' => '(cloudStatus())',
            'children' => 
            array (
              'admin_cloud_video_overview' => 
              array (
                'name' => '概览',
                'disable' => true,
              ),
              'admin_cloud_setting_video' => 
              array (
                'name' => '设置',
                'disable' => true,
              ),
            ),
          ),
          'admin_cloud_edulive_setting' => 
          array (
            'name' => '云直播',
            'visable' => '(cloudStatus())',
            'router_name' => 'admin_cloud_edulive_overview',
            'children' => 
            array (
              'admin_cloud_edulive_overview' => 
              array (
                'name' => '概览',
                'disable' => true,
              ),
              'admin_setting_cloud_edulive' => 
              array (
                'name' => '设置',
                'disable' => true,
              ),
            ),
          ),
          'admin_edu_cloud_sms' => 
          array (
            'name' => '云短信',
            'visable' => '(cloudStatus())',
            'children' => 
            array (
              'admin_edu_cloud_sms_overview' => 
              array (
                'name' => '概览',
                'router_name' => 'admin_edu_cloud_sms',
                'disable' => true,
              ),
              'admin_edu_cloud_setting_sms' => 
              array (
                'name' => '设置',
                'disable' => true,
              ),
            ),
          ),
          'admin_edu_cloud_email' => 
          array (
            'name' => '云邮件',
            'visable' => '(cloudStatus())',
            'children' => 
            array (
              'admin_edu_cloud_email_overview' => 
              array (
                'name' => '概览',
                'router_name' => 'admin_edu_cloud_email',
                'disable' => true,
              ),
              'admin_edu_cloud_email_setting' => 
              array (
                'name' => '设置',
                'disable' => true,
              ),
            ),
          ),
          'admin_edu_cloud_search_setting' => 
          array (
            'name' => '云搜索',
            'visable' => '(cloudStatus())',
            'router_name' => 'admin_edu_cloud_search',
            'children' => 
            array (
              'admin_edu_cloud_search_overview' => 
              array (
                'name' => '概览',
                'router_name' => 'admin_edu_cloud_search',
                'disable' => true,
              ),
              'admin_edu_cloud_setting_search' => 
              array (
                'name' => '设置',
                'disable' => true,
              ),
            ),
          ),
          'admin_app_im' => 
          array (
            'name' => '即时聊天设置',
            'visable' => '(cloudStatus())',
            'children' => 
            array (
              'admin_app_im_setting' => 
              array (
                'name' => '即时聊天设置',
                'router_name' => 'admin_app_im',
                'disable' => true,
              ),
            ),
          ),
          'admin_cloud_file_manage' => 
          array (
            'name' => '云资源',
            'visable' => '(cloudStatus())',
            'parent' => 'admin_app',
            'after' => 'admin_app_center_show',
            'children' => 
            array (
              'admin_cloud_file' => 
              array (
                'name' => '云资源',
                'disable' => true,
              ),
            ),
          ),
          'admin_setting_cloud_attachment' => 
          array (
            'name' => '云附件设置',
            'visable' => '(cloudStatus())',
            'children' => 
            array (
              'admin_edu_cloud_attachment' => 
              array (
                'name' => '云附件设置',
                'disable' => true,
              ),
            ),
          ),
          'admin_app_center_show' => 
          array (
            'name' => 'ES应用',
            'router_name' => 'admin_app_center',
            'router_params' => 
            array (
              'postStatus' => 'all',
            ),
            'children' => 
            array (
              'admin_app_center' => 
              array (
                'name' => '应用中心',
                'router_name' => 'admin_app_center',
                'disable' => true,
                'router_params' => 
                array (
                  'postStatus' => 'all',
                ),
              ),
              'admin_app_installed' => 
              array (
                'name' => '已购项目',
                'disable' => true,
                'router_params' => 
                array (
                  'postStatus' => 'all',
                ),
              ),
              'admin_app_upgrades' => 
              array (
                'name' => '更新',
                'class' => 'app-upgrade',
                'disable' => true,
              ),
              'admin_app_logs' => 
              array (
                'name' => '更新日志',
                'disable' => true,
              ),
            ),
          ),
          'admin_cloud_attachment_manage' => 
          array (
            'name' => '云附件',
            'visable' => '(cloudStatus())',
            'children' => 
            array (
              'admin_cloud_attachment' => 
              array (
                'name' => '云附件',
                'disable' => true,
              ),
            ),
          ),
          'admin_cloud_consult' => 
          array (
            'name' => '云问答',
            'router_name' => 'admin_cloud_consult_setting',
            'visable' => '(cloudStatus())',
            'children' => 
            array (
              'admin_cloud_consult_setting' => 
              array (
                'name' => '设置',
                'disable' => true,
              ),
            ),
          ),
          'admin_setting_cloud' => 
          array (
            'name' => '授权信息',
            'children' => 
            array (
              'admin_setting_my_cloud' => 
              array (
                'name' => '授权信息',
                'router_name' => 'admin_setting_cloud',
                'disable' => true,
              ),
            ),
          ),
        ),
      ),
      'admin_system' => 
      array (
        'name' => '系统',
        'router_name' => 'admin_setting_site',
        'children' => 
        array (
          'admin_setting' => 
          array (
            'name' => '站点设置',
            'router_name' => 'admin_setting_site',
            'children' => 
            array (
              'admin_setting_message' => 
              array (
                'name' => '基础信息',
                'router_name' => 'admin_setting_site',
                'disable' => true,
              ),
              'admin_setting_theme' => 
              array (
                'name' => '主题',
                'disable' => true,
              ),
              'admin_setting_mailer' => 
              array (
                'name' => '邮件服务器设置',
                'disable' => true,
              ),
              'admin_top_navigation' => 
              array (
                'name' => '顶部导航',
                'router_name' => 'admin_navigation',
                'disable' => true,
                'router_params' => 
                array (
                  'type' => 'top',
                ),
              ),
              'admin_foot_navigation' => 
              array (
                'name' => '底部导航',
                'router_name' => 'admin_navigation',
                'disable' => true,
                'router_params' => 
                array (
                  'type' => 'foot',
                ),
              ),
              'admin_friendlyLink_navigation' => 
              array (
                'name' => '友情链接',
                'router_name' => 'admin_navigation',
                'disable' => true,
                'router_params' => 
                array (
                  'type' => 'friendlyLink',
                ),
              ),
              'admin_setting_consult_setting' => 
              array (
                'name' => '客服',
                'disable' => true,
              ),
              'admin_setting_es_bar' => 
              array (
                'name' => '侧边栏',
                'disable' => true,
              ),
              'admin_setting_share' => 
              array (
                'name' => '分享',
                'disable' => true,
              ),
              'admin_setting_security' => 
              array (
                'name' => '安全',
                'disable' => true,
              ),
            ),
          ),
          'admin_setting_user' => 
          array (
            'name' => '用户设置',
            'children' => 
            array (
              'admin_user_auth' => 
              array (
                'name' => '注册',
                'disable' => true,
                'router_name' => 'admin_setting_auth',
              ),
              'admin_setting_login_bind' => 
              array (
                'name' => '登录',
                'disable' => true,
              ),
              'admin_setting_user_center' => 
              array (
                'name' => '用户中心',
                'disable' => true,
              ),
              'admin_setting_user_fields' => 
              array (
                'name' => '用户信息设置',
                'disable' => true,
              ),
              'admin_setting_avatar' => 
              array (
                'name' => '默认头像',
                'disable' => true,
              ),
            ),
          ),
          'admin_roles' => 
          array (
            'name' => '角色管理',
            'children' => 
            array (
              'admin_role_manage' => 
              array (
                'name' => '角色管理',
                'disable' => true,
                'router_name' => 'admin_roles',
                'children' => 
                array (
                  'admin_role_create' => 
                  array (
                    'name' => '新增角色',
                    'mode' => 'modal',
                    'group' => 'topBtn',
                  ),
                  'admin_role_edit' => 
                  array (
                    'name' => '编辑角色',
                    'mode' => 'modal',
                    'group' => 'groupBtn',
                    'router_params' => 
                    array (
                      'id' => '(role.id)',
                    ),
                  ),
                  'admin_role_delete' => 
                  array (
                    'name' => '删除角色',
                    'class' => 'role-delete js-delete-role',
                    'group' => 'groupBtn',
                    'mode' => 'none',
                    'router_params' => 
                    array (
                      'id' => '(role.id)',
                    ),
                  ),
                ),
              ),
            ),
          ),
          'admin_setting_course_setting' => 
          array (
            'name' => '课程设置',
            'children' => 
            array (
              'admin_setting_course' => 
              array (
                'name' => '课程',
                'disable' => true,
                'router_name' => 'admin_setting_course_setting',
              ),
              'admin_setting_questions_setting' => 
              array (
                'name' => '题库',
                'disable' => true,
              ),
              'admin_setting_course_avatar' => 
              array (
                'name' => '默认图片',
                'disable' => true,
              ),
              'admin_classroom_setting' => 
              array (
                'name' => '班级',
                'disable' => true,
                'parent' => 'admin_setting_course_setting',
                'after' => 'admin_setting_live_course',
              ),
            ),
          ),
          'admin_setting_operation' => 
          array (
            'name' => '运营设置',
            'children' => 
            array (
              'admin_article_setting' => 
              array (
                'name' => '资讯',
                'disable' => true,
              ),
              'admin_group_set' => 
              array (
                'name' => '小组',
                'disable' => true,
              ),
              'admin_invite_set' => 
              array (
                'name' => '邀请注册设置',
                'disable' => true,
              ),
              'admin_wap_set' => 
              array (
                'name' => '手机微网校',
                'disable' => true,
              ),
            ),
          ),
          'admin_setting_finance' => 
          array (
            'name' => '账务设置',
            'children' => 
            array (
              'admin_payment' => 
              array (
                'name' => '支付',
                'disable' => true,
                'router_name' => 'admin_setting_payment',
              ),
              'admin_coin_settings' => 
              array (
                'name' => '虚拟币',
                'disable' => true,
                'router_name' => 'admin_coin_settings',
              ),
              'admin_setting_refund' => 
              array (
                'name' => '退款',
                'disable' => true,
              ),
            ),
          ),
          'admin_setting_mobile' => 
          array (
            'name' => '移动端设置',
            'children' => 
            array (
              'admin_setting_mobile_settings' => 
              array (
                'name' => '移动端设置',
                'disable' => true,
                'router_name' => 'admin_setting_mobile',
              ),
            ),
          ),
          'admin_setting_mobile_iap_product' => 
          array (
            'name' => 'IOS内购商品设置',
            'disable' => true,
            'visable' => '(setting(\'magic.enable_mobile_iap\', \'0\'))',
            'children' => 
            array (
              'admin_setting_mobile_iap_product_list' => 
              array (
                'name' => 'IOS内购商品设置',
                'router_name' => 'admin_setting_mobile_iap_product',
              ),
            ),
          ),
          'admin_optimize' => 
          array (
            'name' => '系统优化',
            'group' => 2,
            'children' => 
            array (
              'admin_optimize_settings' => 
              array (
                'name' => '系统优化',
                'disable' => true,
                'router_name' => 'admin_optimize',
              ),
            ),
          ),
          'admin_jobs' => 
          array (
            'name' => '定时任务',
            'group' => 2,
            'children' => 
            array (
              'admin_jobs_manage' => 
              array (
                'name' => '定时任务',
                'disable' => true,
                'router_name' => 'admin_jobs',
              ),
            ),
          ),
          'admin_setting_ip_blacklist' => 
          array (
            'name' => 'IP黑名单',
            'group' => 2,
            'children' => 
            array (
              'admin_setting_ip_blacklist_manage' => 
              array (
                'name' => 'IP黑名单',
                'disable' => true,
                'router_name' => 'admin_setting_ip_blacklist',
              ),
            ),
          ),
          'admin_setting_post_num_rules' => 
          array (
            'name' => '发帖限制设置',
            'group' => 2,
            'children' => 
            array (
              'admin_setting_post_num_rules_settings' => 
              array (
                'name' => '发帖限制设置',
                'disable' => true,
                'router_name' => 'admin_setting_post_num_rules',
              ),
            ),
          ),
          'admin_report_status' => 
          array (
            'name' => '系统自检',
            'group' => 2,
            'children' => 
            array (
              'admin_report_status_list' => 
              array (
                'name' => '系统自检',
                'disable' => true,
                'router_name' => 'admin_report_status',
              ),
            ),
          ),
          'admin_logs' => 
          array (
            'name' => '系统日志',
            'group' => 2,
            'children' => 
            array (
              'admin_logs_query' => 
              array (
                'name' => '系统操作日志',
                'disable' => true,
                'router_name' => 'admin_logs',
              ),
              'admin_logs_prod' => 
              array (
                'name' => '程序运行日志',
                'disable' => true,
              ),
            ),
          ),
          'admin_org_manage' => 
          array (
            'name' => '组织机构管理',
            'parent' => 'admin_system',
            'group' => 2,
            'disable' => true,
            'visable' => false,
            'children' => 
            array (
              'admin_org' => 
              array (
                'name' => '组织机构',
                'disable' => true,
              ),
            ),
          ),
        ),
      ),
    ),
    'code' => 'admin',
  ),
  'admin_user' => 
  array (
    'name' => '用户',
    'children' => 
    array (
      'admin_user_show' => 
      array (
        'name' => '用户管理',
        'children' => 
        array (
          'admin_user_manage' => 
          array (
            'name' => '用户管理',
            'router_name' => 'admin_user',
            'children' => 
            array (
              'admin_user_create' => 
              array (
                'name' => '添加新用户',
                'mode' => 'modal',
                'group' => 'topBtn',
                'visable' => '(user.type != \'system\')',
              ),
              'admin_user_edit' => 
              array (
                'name' => '编辑用户信息',
                'mode' => 'modal',
                'group' => 'groupButton',
                'visable' => '(user.type != \'system\')',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
              'admin_user_roles' => 
              array (
                'name' => '设置用户组',
                'mode' => 'modal',
                'group' => 'groupButton',
                'visable' => '(user.type != \'system\')',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
              'admin_user_avatar' => 
              array (
                'name' => '修改用户头像',
                'mode' => 'modal',
                'group' => 'groupButton',
                'visable' => '(user.type != \'system\')',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
              'admin_user_change_password' => 
              array (
                'name' => '修改密码',
                'mode' => 'modal',
                'group' => 'groupButton',
                'visable' => '(user.type != \'system\')',
                'router_params' => 
                array (
                  'userId' => '(user.id)',
                ),
              ),
              'admin_user_send_passwordreset_email' => 
              array (
                'name' => '发送密码重置邮件',
                'group' => 'groupButton',
                'class' => 'send-passwordreset-email',
                'mode' => 'none',
                'visable' => '(user.type != \'system\')',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
              'admin_user_send_emailverify_email' => 
              array (
                'name' => '发送Email验证邮件',
                'class' => 'send-emailverify-email',
                'group' => 'groupButton',
                'mode' => 'none',
                'visable' => '(user.type != \'system\')',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
              'admin_user_lock' => 
              array (
                'name' => '封禁用户',
                'group' => 'groupButton',
                'class' => 'lock-user',
                'mode' => 'none',
                'visable' => '(user.type != \'system\' and user.locked == 0)',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
              'admin_user_unlock' => 
              array (
                'name' => '解禁用户',
                'class' => 'unlock-user',
                'group' => 'groupButton',
                'mode' => 'none',
                'visable' => '(user.type != \'system\' and user.locked == 1)',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
              'admin_user_org_update' => 
              array (
                'name' => '修改用户组织机构',
                'parent' => 'admin_user_manage',
                'mode' => 'modal',
                'group' => 'groupButton',
                'visable' => '( app.user.id != user.id and setting(\'magic.enable_org\', 0) == 1 )',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
                'disable' => true,
              ),
            ),
          ),
          'admin_login_record' => 
          array (
            'name' => '登录日志',
          ),
        ),
      ),
      'admin_teacher' => 
      array (
        'name' => '教师管理',
        'children' => 
        array (
          'admin_teacher_manage' => 
          array (
            'name' => '教师管理',
            'router_name' => 'admin_teacher',
            'disable' => true,
            'children' => 
            array (
              'admin_teacher_promote' => 
              array (
                'name' => '推荐老师',
                'class' => 'promote-teacher',
                'mode' => 'modal',
                'icon' => 'glyphicon glyphicon-hand-up',
                'group' => 'groupButton',
                'visable' => '(user.promoted == 0)',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                  'type' => 'teacherList',
                ),
              ),
              'admin_teacher_promote_cancel' => 
              array (
                'name' => '取消推荐',
                'class' => 'cancel-promote-teacher',
                'mode' => 'none',
                'group' => 'groupButton',
                'visable' => '(user.promoted == 1)',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
              ),
            ),
          ),
          'admin_teacher_promote_list' => 
          array (
            'name' => '教师推荐',
            'disable' => true,
          ),
        ),
      ),
      'admin_approval_manage' => 
      array (
        'name' => '实名认证管理',
        'children' => 
        array (
          'admin_approval_approvals' => 
          array (
            'name' => '实名认证管理',
            'router_params' => 
            array (
              'approvalStatus' => 'approving',
            ),
            'disable' => true,
            'children' => 
            array (
              'admin_approval_cancel' => 
              array (
                'name' => '撤销',
                'router_params' => 
                array (
                  'id' => '(user.id)',
                ),
                'class' => 'btn cancel-approval',
                'mode' => 'none',
                'group' => 'groupButton',
              ),
            ),
          ),
        ),
      ),
      'admin_message_manage' => 
      array (
        'name' => '私信管理',
        'children' => 
        array (
          'admin_message' => 
          array (
            'name' => '私信管理',
            'disable' => true,
          ),
        ),
      ),
    ),
    'parent' => 'admin',
    'code' => 'admin_user',
  ),
  'admin_user_show' => 
  array (
    'name' => '用户管理',
    'children' => 
    array (
      'admin_user_manage' => 
      array (
        'name' => '用户管理',
        'router_name' => 'admin_user',
        'children' => 
        array (
          'admin_user_create' => 
          array (
            'name' => '添加新用户',
            'mode' => 'modal',
            'group' => 'topBtn',
            'visable' => '(user.type != \'system\')',
          ),
          'admin_user_edit' => 
          array (
            'name' => '编辑用户信息',
            'mode' => 'modal',
            'group' => 'groupButton',
            'visable' => '(user.type != \'system\')',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
          'admin_user_roles' => 
          array (
            'name' => '设置用户组',
            'mode' => 'modal',
            'group' => 'groupButton',
            'visable' => '(user.type != \'system\')',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
          'admin_user_avatar' => 
          array (
            'name' => '修改用户头像',
            'mode' => 'modal',
            'group' => 'groupButton',
            'visable' => '(user.type != \'system\')',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
          'admin_user_change_password' => 
          array (
            'name' => '修改密码',
            'mode' => 'modal',
            'group' => 'groupButton',
            'visable' => '(user.type != \'system\')',
            'router_params' => 
            array (
              'userId' => '(user.id)',
            ),
          ),
          'admin_user_send_passwordreset_email' => 
          array (
            'name' => '发送密码重置邮件',
            'group' => 'groupButton',
            'class' => 'send-passwordreset-email',
            'mode' => 'none',
            'visable' => '(user.type != \'system\')',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
          'admin_user_send_emailverify_email' => 
          array (
            'name' => '发送Email验证邮件',
            'class' => 'send-emailverify-email',
            'group' => 'groupButton',
            'mode' => 'none',
            'visable' => '(user.type != \'system\')',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
          'admin_user_lock' => 
          array (
            'name' => '封禁用户',
            'group' => 'groupButton',
            'class' => 'lock-user',
            'mode' => 'none',
            'visable' => '(user.type != \'system\' and user.locked == 0)',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
          'admin_user_unlock' => 
          array (
            'name' => '解禁用户',
            'class' => 'unlock-user',
            'group' => 'groupButton',
            'mode' => 'none',
            'visable' => '(user.type != \'system\' and user.locked == 1)',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
          'admin_user_org_update' => 
          array (
            'name' => '修改用户组织机构',
            'parent' => 'admin_user_manage',
            'mode' => 'modal',
            'group' => 'groupButton',
            'visable' => '( app.user.id != user.id and setting(\'magic.enable_org\', 0) == 1 )',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
            'disable' => true,
          ),
        ),
      ),
      'admin_login_record' => 
      array (
        'name' => '登录日志',
      ),
    ),
    'parent' => 'admin_user',
    'code' => 'admin_user_show',
  ),
  'admin_user_manage' => 
  array (
    'name' => '用户管理',
    'router_name' => 'admin_user',
    'children' => 
    array (
      'admin_user_create' => 
      array (
        'name' => '添加新用户',
        'mode' => 'modal',
        'group' => 'topBtn',
        'visable' => '(user.type != \'system\')',
      ),
      'admin_user_edit' => 
      array (
        'name' => '编辑用户信息',
        'mode' => 'modal',
        'group' => 'groupButton',
        'visable' => '(user.type != \'system\')',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
      'admin_user_roles' => 
      array (
        'name' => '设置用户组',
        'mode' => 'modal',
        'group' => 'groupButton',
        'visable' => '(user.type != \'system\')',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
      'admin_user_avatar' => 
      array (
        'name' => '修改用户头像',
        'mode' => 'modal',
        'group' => 'groupButton',
        'visable' => '(user.type != \'system\')',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
      'admin_user_change_password' => 
      array (
        'name' => '修改密码',
        'mode' => 'modal',
        'group' => 'groupButton',
        'visable' => '(user.type != \'system\')',
        'router_params' => 
        array (
          'userId' => '(user.id)',
        ),
      ),
      'admin_user_send_passwordreset_email' => 
      array (
        'name' => '发送密码重置邮件',
        'group' => 'groupButton',
        'class' => 'send-passwordreset-email',
        'mode' => 'none',
        'visable' => '(user.type != \'system\')',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
      'admin_user_send_emailverify_email' => 
      array (
        'name' => '发送Email验证邮件',
        'class' => 'send-emailverify-email',
        'group' => 'groupButton',
        'mode' => 'none',
        'visable' => '(user.type != \'system\')',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
      'admin_user_lock' => 
      array (
        'name' => '封禁用户',
        'group' => 'groupButton',
        'class' => 'lock-user',
        'mode' => 'none',
        'visable' => '(user.type != \'system\' and user.locked == 0)',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
      'admin_user_unlock' => 
      array (
        'name' => '解禁用户',
        'class' => 'unlock-user',
        'group' => 'groupButton',
        'mode' => 'none',
        'visable' => '(user.type != \'system\' and user.locked == 1)',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
      'admin_user_org_update' => 
      array (
        'name' => '修改用户组织机构',
        'parent' => 'admin_user_manage',
        'mode' => 'modal',
        'group' => 'groupButton',
        'visable' => '( app.user.id != user.id and setting(\'magic.enable_org\', 0) == 1 )',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
        'disable' => true,
      ),
    ),
    'parent' => 'admin_user_show',
    'code' => 'admin_user_manage',
  ),
  'admin_user_create' => 
  array (
    'name' => '添加新用户',
    'mode' => 'modal',
    'group' => 'topBtn',
    'visable' => '(user.type != \'system\')',
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_create',
  ),
  'admin_user_edit' => 
  array (
    'name' => '编辑用户信息',
    'mode' => 'modal',
    'group' => 'groupButton',
    'visable' => '(user.type != \'system\')',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_edit',
  ),
  'admin_user_roles' => 
  array (
    'name' => '设置用户组',
    'mode' => 'modal',
    'group' => 'groupButton',
    'visable' => '(user.type != \'system\')',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_roles',
  ),
  'admin_user_avatar' => 
  array (
    'name' => '修改用户头像',
    'mode' => 'modal',
    'group' => 'groupButton',
    'visable' => '(user.type != \'system\')',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_avatar',
  ),
  'admin_user_change_password' => 
  array (
    'name' => '修改密码',
    'mode' => 'modal',
    'group' => 'groupButton',
    'visable' => '(user.type != \'system\')',
    'router_params' => 
    array (
      'userId' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_change_password',
  ),
  'admin_user_send_passwordreset_email' => 
  array (
    'name' => '发送密码重置邮件',
    'group' => 'groupButton',
    'class' => 'send-passwordreset-email',
    'mode' => 'none',
    'visable' => '(user.type != \'system\')',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_send_passwordreset_email',
  ),
  'admin_user_send_emailverify_email' => 
  array (
    'name' => '发送Email验证邮件',
    'class' => 'send-emailverify-email',
    'group' => 'groupButton',
    'mode' => 'none',
    'visable' => '(user.type != \'system\')',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_send_emailverify_email',
  ),
  'admin_user_lock' => 
  array (
    'name' => '封禁用户',
    'group' => 'groupButton',
    'class' => 'lock-user',
    'mode' => 'none',
    'visable' => '(user.type != \'system\' and user.locked == 0)',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_lock',
  ),
  'admin_user_unlock' => 
  array (
    'name' => '解禁用户',
    'class' => 'unlock-user',
    'group' => 'groupButton',
    'mode' => 'none',
    'visable' => '(user.type != \'system\' and user.locked == 1)',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_user_manage',
    'code' => 'admin_user_unlock',
  ),
  'admin_user_org_update' => 
  array (
    'name' => '修改用户组织机构',
    'parent' => 'admin_user_manage',
    'mode' => 'modal',
    'group' => 'groupButton',
    'visable' => '( app.user.id != user.id and setting(\'magic.enable_org\', 0) == 1 )',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'disable' => true,
    'code' => 'admin_user_org_update',
  ),
  'admin_login_record' => 
  array (
    'name' => '登录日志',
    'parent' => 'admin_user_show',
    'code' => 'admin_login_record',
  ),
  'admin_teacher' => 
  array (
    'name' => '教师管理',
    'children' => 
    array (
      'admin_teacher_manage' => 
      array (
        'name' => '教师管理',
        'router_name' => 'admin_teacher',
        'disable' => true,
        'children' => 
        array (
          'admin_teacher_promote' => 
          array (
            'name' => '推荐老师',
            'class' => 'promote-teacher',
            'mode' => 'modal',
            'icon' => 'glyphicon glyphicon-hand-up',
            'group' => 'groupButton',
            'visable' => '(user.promoted == 0)',
            'router_params' => 
            array (
              'id' => '(user.id)',
              'type' => 'teacherList',
            ),
          ),
          'admin_teacher_promote_cancel' => 
          array (
            'name' => '取消推荐',
            'class' => 'cancel-promote-teacher',
            'mode' => 'none',
            'group' => 'groupButton',
            'visable' => '(user.promoted == 1)',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
          ),
        ),
      ),
      'admin_teacher_promote_list' => 
      array (
        'name' => '教师推荐',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_user',
    'code' => 'admin_teacher',
  ),
  'admin_teacher_manage' => 
  array (
    'name' => '教师管理',
    'router_name' => 'admin_teacher',
    'disable' => true,
    'children' => 
    array (
      'admin_teacher_promote' => 
      array (
        'name' => '推荐老师',
        'class' => 'promote-teacher',
        'mode' => 'modal',
        'icon' => 'glyphicon glyphicon-hand-up',
        'group' => 'groupButton',
        'visable' => '(user.promoted == 0)',
        'router_params' => 
        array (
          'id' => '(user.id)',
          'type' => 'teacherList',
        ),
      ),
      'admin_teacher_promote_cancel' => 
      array (
        'name' => '取消推荐',
        'class' => 'cancel-promote-teacher',
        'mode' => 'none',
        'group' => 'groupButton',
        'visable' => '(user.promoted == 1)',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
      ),
    ),
    'parent' => 'admin_teacher',
    'code' => 'admin_teacher_manage',
  ),
  'admin_teacher_promote' => 
  array (
    'name' => '推荐老师',
    'class' => 'promote-teacher',
    'mode' => 'modal',
    'icon' => 'glyphicon glyphicon-hand-up',
    'group' => 'groupButton',
    'visable' => '(user.promoted == 0)',
    'router_params' => 
    array (
      'id' => '(user.id)',
      'type' => 'teacherList',
    ),
    'parent' => 'admin_teacher_manage',
    'code' => 'admin_teacher_promote',
  ),
  'admin_teacher_promote_cancel' => 
  array (
    'name' => '取消推荐',
    'class' => 'cancel-promote-teacher',
    'mode' => 'none',
    'group' => 'groupButton',
    'visable' => '(user.promoted == 1)',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'parent' => 'admin_teacher_manage',
    'code' => 'admin_teacher_promote_cancel',
  ),
  'admin_teacher_promote_list' => 
  array (
    'name' => '教师推荐',
    'disable' => true,
    'parent' => 'admin_teacher',
    'code' => 'admin_teacher_promote_list',
  ),
  'admin_approval_manage' => 
  array (
    'name' => '实名认证管理',
    'children' => 
    array (
      'admin_approval_approvals' => 
      array (
        'name' => '实名认证管理',
        'router_params' => 
        array (
          'approvalStatus' => 'approving',
        ),
        'disable' => true,
        'children' => 
        array (
          'admin_approval_cancel' => 
          array (
            'name' => '撤销',
            'router_params' => 
            array (
              'id' => '(user.id)',
            ),
            'class' => 'btn cancel-approval',
            'mode' => 'none',
            'group' => 'groupButton',
          ),
        ),
      ),
    ),
    'parent' => 'admin_user',
    'code' => 'admin_approval_manage',
  ),
  'admin_approval_approvals' => 
  array (
    'name' => '实名认证管理',
    'router_params' => 
    array (
      'approvalStatus' => 'approving',
    ),
    'disable' => true,
    'children' => 
    array (
      'admin_approval_cancel' => 
      array (
        'name' => '撤销',
        'router_params' => 
        array (
          'id' => '(user.id)',
        ),
        'class' => 'btn cancel-approval',
        'mode' => 'none',
        'group' => 'groupButton',
      ),
    ),
    'parent' => 'admin_approval_manage',
    'code' => 'admin_approval_approvals',
  ),
  'admin_approval_cancel' => 
  array (
    'name' => '撤销',
    'router_params' => 
    array (
      'id' => '(user.id)',
    ),
    'class' => 'btn cancel-approval',
    'mode' => 'none',
    'group' => 'groupButton',
    'parent' => 'admin_approval_approvals',
    'code' => 'admin_approval_cancel',
  ),
  'admin_message_manage' => 
  array (
    'name' => '私信管理',
    'children' => 
    array (
      'admin_message' => 
      array (
        'name' => '私信管理',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_user',
    'code' => 'admin_message_manage',
  ),
  'admin_message' => 
  array (
    'name' => '私信管理',
    'disable' => true,
    'parent' => 'admin_message_manage',
    'code' => 'admin_message',
  ),
  'admin_course' => 
  array (
    'name' => '课程',
    'children' => 
    array (
      'admin_course_show' => 
      array (
        'name' => '课程管理',
        'children' => 
        array (
          'admin_course_manage' => 
          array (
            'name' => '课程管理',
            'router_name' => 'admin_course_set',
            'children' => 
            array (
              'admin_course_content_manage' => 
              array (
                'name' => '管理课程',
              ),
              'admin_course_add' => 
              array (
                'name' => '创建课程',
                'router_name' => 'course_set_manage_create',
                'group' => 'topBtn',
                'blank' => 1,
              ),
              'admin_course_set_recommend' => 
              array (
                'name' => '推荐课程',
                'router_params' => 
                array (
                  'id' => '(courseSet.id)',
                  'filter' => '(filter)',
                  'ref' => 'courseList',
                ),
                'group' => 'groupButton',
                'visable' => '( filter == \'normal\' and not courseSet.recommended )',
                'icon' => 'glyphicon glyphicon-hand-up',
                'mode' => 'modal',
              ),
              'admin_course_set_cancel_recommend' => 
              array (
                'name' => '取消推荐',
                'router_params' => 
                array (
                  'id' => '(courseSet.id)',
                  'filter' => '(filter)',
                  'target' => '(target)',
                ),
                'group' => 'groupButton',
                'class' => 'cancel-recommend-course',
                'visable' => '( filter == \'normal\' and courseSet.recommended )',
                'icon' => 'glyphicon glyphicon-hand-right',
                'mode' => 'none',
              ),
              'admin_course_guest_member_preview' => 
              array (
                'name' => '预览',
                'router_name' => 'course_show',
                'router_params' => 
                array (
                  'id' => '(courseSet.defaultCourseId)',
                  'previewAs' => 'guest',
                ),
                'group' => 'groupButton',
                'icon' => 'glyphicon glyphicon-eye-open',
                'blank' => 1,
              ),
              'admin_course_set_close' => 
              array (
                'name' => '关闭课程',
                'router_params' => 
                array (
                  'id' => '(courseSet.id)',
                  'filter' => '(filter)',
                ),
                'group' => 'groupButton',
                'icon' => 'glyphicon glyphicon-ban-circle',
                'mode' => 'none',
                'class' => 'close-course',
                'visable' => '(courseSet.status == \'published\')',
              ),
              'admin_course_sms_prepare' => 
              array (
                'name' => '发送发布通知短信',
                'router_name' => 'sms_prepare',
                'router_params' => 
                array (
                  'id' => '(courseSet.id)',
                  'targetType' => 'course',
                ),
                'group' => 'groupButton',
                'icon' => 'glyphicon glyphicon-envelope',
                'mode' => 'modal',
                'visable' => '(courseSet.status == \'published\')',
              ),
              'admin_course_set_publish' => 
              array (
                'name' => '发布课程',
                'router_params' => 
                array (
                  'id' => '(courseSet.id)',
                  'filter' => '(filter)',
                ),
                'group' => 'groupButton',
                'class' => 'publish-course',
                'icon' => 'glyphicon glyphicon-ok-circle',
                'mode' => 'none',
                'visable' => '(courseSet.status != \'published\')',
              ),
              'admin_course_set_delete' => 
              array (
                'name' => '删除课程',
                'class' => 'delete-course',
                'router_params' => 
                array (
                  'id' => '(courseSet.id)',
                  'filter' => '(filter)',
                  'type' => '',
                ),
                'group' => 'groupButton',
                'icon' => 'glyphicon glyphicon-trash',
                'mode' => 'none',
                'visable' => '( courseSet.status in [\'closed\', \'draft\', \'published\'])',
              ),
            ),
          ),
          'admin_course_set_recommend_list' => 
          array (
            'name' => '课程推荐',
          ),
          'admin_course_set_data' => 
          array (
            'name' => '课程统计',
          ),
        ),
      ),
      'admin_classroom' => 
      array (
        'name' => '班级管理',
        'parent' => 'admin_course',
        'before' => 'admin_course_thread',
        'children' => 
        array (
          'admin_classroom_manage' => 
          array (
            'name' => '班级管理',
            'router_name' => 'admin_classroom',
            'children' => 
            array (
              'admin_classroom_content_manage' => 
              array (
                'name' => '管理班级',
                'router_name' => 'classroom_manage',
                'group' => 'btn',
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
                'blank' => true,
              ),
              'admin_classroom_create' => 
              array (
                'name' => '创建班级',
                'group' => 'topBtn',
                'blank' => true,
              ),
              'admin_classroom_cancel_recommend' => 
              array (
                'name' => '取消推荐',
                'mode' => 'none',
                'class' => 'cancel-recommend-classroom',
                'icon' => 'glyphicon glyphicon-hand-right',
                'group' => 'groupButton',
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                  'ref' => 'classroomList',
                ),
                'visable' => '( classroom.recommended )',
              ),
              'admin_classroom_set_recommend' => 
              array (
                'name' => '推荐班级',
                'mode' => 'modal',
                'icon' => 'glyphicon glyphicon-hand-up',
                'group' => 'groupButton',
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                  'ref' => 'classroomList',
                ),
                'visable' => '( not classroom.recommended )',
              ),
              'admin_classroom_close' => 
              array (
                'name' => '关闭班级',
                'mode' => 'none',
                'class' => 'close-classroom',
                'icon' => 'glyphicon glyphicon-off',
                'group' => 'groupButton',
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
                'visable' => '( classroom.status == \'published\' )',
              ),
              'admin_sms_prepare' => 
              array (
                'name' => '发送发布通知短信',
                'router_name' => 'sms_prepare',
                'mode' => 'modal',
                'icon' => 'glyphicon glyphicon-envelope',
                'group' => 'groupButton',
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                  'targetType' => 'classroom',
                ),
                'visable' => '( classroom.status == \'published\' )',
              ),
              'admin_classroom_open' => 
              array (
                'name' => '发布班级',
                'mode' => 'none',
                'icon' => 'glyphicon glyphicon-ok',
                'group' => 'groupButton',
                'class' => 'open-classroom',
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
                'visable' => '( classroom.status != \'published\' )',
              ),
              'admin_classroom_delete' => 
              array (
                'name' => '删除班级',
                'mode' => 'none',
                'icon' => 'glyphicon glyphicon-remove',
                'class' => 'delete-classroom',
                'group' => 'groupButton',
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
                'visable' => '( classroom.status==\'draft\' )',
              ),
            ),
          ),
          'admin_classroom_recommend' => 
          array (
            'name' => '班级推荐',
            'router_name' => 'admin_classroom_recommend_list',
          ),
        ),
      ),
      'admin_open_course_manage' => 
      array (
        'name' => '公开课管理',
        'router_name' => 'admin_open_course',
        'children' => 
        array (
          'admin_open_course' => 
          array (
            'name' => '公开课管理',
            'disable' => true,
            'router_name' => 'admin_open_course',
          ),
          'admin_open_course_recommend_list' => 
          array (
            'name' => '公开课推荐',
            'disable' => true,
          ),
          'admin_opencourse_analysis' => 
          array (
            'name' => '公开课统计',
            'disable' => true,
          ),
        ),
      ),
      'admin_live_course' => 
      array (
        'name' => '直播管理',
        'children' => 
        array (
          'admin_live_course_manage' => 
          array (
            'name' => '直播管理',
            'router_params' => 
            array (
              'status' => 'coming',
            ),
            'router_name' => 'admin_live_course',
            'disable' => true,
          ),
        ),
      ),
      'admin_course_thread' => 
      array (
        'name' => '话题管理',
        'children' => 
        array (
          'admin_course_thread_manage' => 
          array (
            'name' => '课程话题',
            'router_name' => 'admin_thread',
            'disable' => true,
          ),
          'admin_classroom_thread_manage' => 
          array (
            'name' => '班级话题',
            'parent' => 'admin_course_thread',
            'router_name' => 'admin_classroom_thread',
            'disable' => true,
          ),
        ),
      ),
      'admin_course_question' => 
      array (
        'name' => '问答管理',
        'children' => 
        array (
          'admin_course_question_manage' => 
          array (
            'name' => '问答管理',
            'router_name' => 'admin_question',
            'router_params' => 
            array (
              'postStatus' => 'unPosted',
            ),
            'disable' => true,
          ),
        ),
      ),
      'admin_course_note' => 
      array (
        'name' => '笔记管理',
        'children' => 
        array (
          'admin_course_note_manage' => 
          array (
            'name' => '笔记管理',
            'router_name' => 'admin_course_note',
            'disable' => true,
          ),
        ),
      ),
      'admin_course_review' => 
      array (
        'name' => '评价管理',
        'children' => 
        array (
          'admin_course_review_tab' => 
          array (
            'name' => '课程评价',
            'router_name' => 'admin_review',
            'group' => 1,
            'disable' => true,
          ),
          'admin_classroom_review_tab' => 
          array (
            'name' => '班级评价',
            'router_name' => 'admin_classroom_review',
            'parent' => 'admin_course_review',
            'disable' => true,
          ),
        ),
      ),
      'admin_course_category' => 
      array (
        'name' => '分类管理',
        'children' => 
        array (
          'admin_course_category_manage' => 
          array (
            'name' => '课程分类',
            'router_name' => 'admin_course_category',
            'disable' => true,
            'children' => 
            array (
              'admin_category_create' => 
              array (
                'name' => '添加分类',
                'router_params' => 
                array (
                  'groupId' => '(group.id)',
                ),
                'router_params_context' => 1,
                'group' => 'topBtn',
                'mode' => 'modal',
              ),
            ),
          ),
          'admin_classroom_category_manage' => 
          array (
            'name' => '班级分类',
            'parent' => 'admin_course_category',
            'router_name' => 'admin_classroom_category',
            'disable' => true,
            'children' => 
            array (
              'admin_classroom_category_create' => 
              array (
                'name' => '添加分类',
                'parent' => 'admin_classroom_category_manage',
                'router_name' => 'admin_category_create',
                'router_params' => 
                array (
                  'groupId' => '(group.id)',
                ),
                'router_params_context' => 1,
                'group' => 'topBtn',
                'mode' => 'modal',
              ),
            ),
          ),
        ),
      ),
      'admin_course_tag' => 
      array (
        'name' => '标签管理',
        'children' => 
        array (
          'admin_course_tag_manage' => 
          array (
            'name' => '标签管理',
            'router_name' => 'admin_tag',
            'disable' => true,
            'children' => 
            array (
              'admin_course_tag_add' => 
              array (
                'name' => '新增标签',
                'router_name' => 'admin_tag_create',
                'mode' => 'modal',
                'group' => 'topBtn',
              ),
            ),
          ),
          'admin_course_tag_group_manage' => 
          array (
            'name' => '标签组管理',
            'router_name' => 'admin_tag_group',
            'disable' => true,
            'children' => 
            array (
              'admin_course_tag_group_add' => 
              array (
                'name' => '新建标签组',
                'router_name' => 'admin_tag_group_create',
                'mode' => 'modal',
                'group' => 'topBtn',
              ),
            ),
          ),
        ),
      ),
    ),
    'parent' => 'admin',
    'code' => 'admin_course',
  ),
  'admin_course_show' => 
  array (
    'name' => '课程管理',
    'children' => 
    array (
      'admin_course_manage' => 
      array (
        'name' => '课程管理',
        'router_name' => 'admin_course_set',
        'children' => 
        array (
          'admin_course_content_manage' => 
          array (
            'name' => '管理课程',
          ),
          'admin_course_add' => 
          array (
            'name' => '创建课程',
            'router_name' => 'course_set_manage_create',
            'group' => 'topBtn',
            'blank' => 1,
          ),
          'admin_course_set_recommend' => 
          array (
            'name' => '推荐课程',
            'router_params' => 
            array (
              'id' => '(courseSet.id)',
              'filter' => '(filter)',
              'ref' => 'courseList',
            ),
            'group' => 'groupButton',
            'visable' => '( filter == \'normal\' and not courseSet.recommended )',
            'icon' => 'glyphicon glyphicon-hand-up',
            'mode' => 'modal',
          ),
          'admin_course_set_cancel_recommend' => 
          array (
            'name' => '取消推荐',
            'router_params' => 
            array (
              'id' => '(courseSet.id)',
              'filter' => '(filter)',
              'target' => '(target)',
            ),
            'group' => 'groupButton',
            'class' => 'cancel-recommend-course',
            'visable' => '( filter == \'normal\' and courseSet.recommended )',
            'icon' => 'glyphicon glyphicon-hand-right',
            'mode' => 'none',
          ),
          'admin_course_guest_member_preview' => 
          array (
            'name' => '预览',
            'router_name' => 'course_show',
            'router_params' => 
            array (
              'id' => '(courseSet.defaultCourseId)',
              'previewAs' => 'guest',
            ),
            'group' => 'groupButton',
            'icon' => 'glyphicon glyphicon-eye-open',
            'blank' => 1,
          ),
          'admin_course_set_close' => 
          array (
            'name' => '关闭课程',
            'router_params' => 
            array (
              'id' => '(courseSet.id)',
              'filter' => '(filter)',
            ),
            'group' => 'groupButton',
            'icon' => 'glyphicon glyphicon-ban-circle',
            'mode' => 'none',
            'class' => 'close-course',
            'visable' => '(courseSet.status == \'published\')',
          ),
          'admin_course_sms_prepare' => 
          array (
            'name' => '发送发布通知短信',
            'router_name' => 'sms_prepare',
            'router_params' => 
            array (
              'id' => '(courseSet.id)',
              'targetType' => 'course',
            ),
            'group' => 'groupButton',
            'icon' => 'glyphicon glyphicon-envelope',
            'mode' => 'modal',
            'visable' => '(courseSet.status == \'published\')',
          ),
          'admin_course_set_publish' => 
          array (
            'name' => '发布课程',
            'router_params' => 
            array (
              'id' => '(courseSet.id)',
              'filter' => '(filter)',
            ),
            'group' => 'groupButton',
            'class' => 'publish-course',
            'icon' => 'glyphicon glyphicon-ok-circle',
            'mode' => 'none',
            'visable' => '(courseSet.status != \'published\')',
          ),
          'admin_course_set_delete' => 
          array (
            'name' => '删除课程',
            'class' => 'delete-course',
            'router_params' => 
            array (
              'id' => '(courseSet.id)',
              'filter' => '(filter)',
              'type' => '',
            ),
            'group' => 'groupButton',
            'icon' => 'glyphicon glyphicon-trash',
            'mode' => 'none',
            'visable' => '( courseSet.status in [\'closed\', \'draft\', \'published\'])',
          ),
        ),
      ),
      'admin_course_set_recommend_list' => 
      array (
        'name' => '课程推荐',
      ),
      'admin_course_set_data' => 
      array (
        'name' => '课程统计',
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_course_show',
  ),
  'admin_course_manage' => 
  array (
    'name' => '课程管理',
    'router_name' => 'admin_course_set',
    'children' => 
    array (
      'admin_course_content_manage' => 
      array (
        'name' => '管理课程',
      ),
      'admin_course_add' => 
      array (
        'name' => '创建课程',
        'router_name' => 'course_set_manage_create',
        'group' => 'topBtn',
        'blank' => 1,
      ),
      'admin_course_set_recommend' => 
      array (
        'name' => '推荐课程',
        'router_params' => 
        array (
          'id' => '(courseSet.id)',
          'filter' => '(filter)',
          'ref' => 'courseList',
        ),
        'group' => 'groupButton',
        'visable' => '( filter == \'normal\' and not courseSet.recommended )',
        'icon' => 'glyphicon glyphicon-hand-up',
        'mode' => 'modal',
      ),
      'admin_course_set_cancel_recommend' => 
      array (
        'name' => '取消推荐',
        'router_params' => 
        array (
          'id' => '(courseSet.id)',
          'filter' => '(filter)',
          'target' => '(target)',
        ),
        'group' => 'groupButton',
        'class' => 'cancel-recommend-course',
        'visable' => '( filter == \'normal\' and courseSet.recommended )',
        'icon' => 'glyphicon glyphicon-hand-right',
        'mode' => 'none',
      ),
      'admin_course_guest_member_preview' => 
      array (
        'name' => '预览',
        'router_name' => 'course_show',
        'router_params' => 
        array (
          'id' => '(courseSet.defaultCourseId)',
          'previewAs' => 'guest',
        ),
        'group' => 'groupButton',
        'icon' => 'glyphicon glyphicon-eye-open',
        'blank' => 1,
      ),
      'admin_course_set_close' => 
      array (
        'name' => '关闭课程',
        'router_params' => 
        array (
          'id' => '(courseSet.id)',
          'filter' => '(filter)',
        ),
        'group' => 'groupButton',
        'icon' => 'glyphicon glyphicon-ban-circle',
        'mode' => 'none',
        'class' => 'close-course',
        'visable' => '(courseSet.status == \'published\')',
      ),
      'admin_course_sms_prepare' => 
      array (
        'name' => '发送发布通知短信',
        'router_name' => 'sms_prepare',
        'router_params' => 
        array (
          'id' => '(courseSet.id)',
          'targetType' => 'course',
        ),
        'group' => 'groupButton',
        'icon' => 'glyphicon glyphicon-envelope',
        'mode' => 'modal',
        'visable' => '(courseSet.status == \'published\')',
      ),
      'admin_course_set_publish' => 
      array (
        'name' => '发布课程',
        'router_params' => 
        array (
          'id' => '(courseSet.id)',
          'filter' => '(filter)',
        ),
        'group' => 'groupButton',
        'class' => 'publish-course',
        'icon' => 'glyphicon glyphicon-ok-circle',
        'mode' => 'none',
        'visable' => '(courseSet.status != \'published\')',
      ),
      'admin_course_set_delete' => 
      array (
        'name' => '删除课程',
        'class' => 'delete-course',
        'router_params' => 
        array (
          'id' => '(courseSet.id)',
          'filter' => '(filter)',
          'type' => '',
        ),
        'group' => 'groupButton',
        'icon' => 'glyphicon glyphicon-trash',
        'mode' => 'none',
        'visable' => '( courseSet.status in [\'closed\', \'draft\', \'published\'])',
      ),
    ),
    'parent' => 'admin_course_show',
    'code' => 'admin_course_manage',
  ),
  'admin_course_content_manage' => 
  array (
    'name' => '管理课程',
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_content_manage',
  ),
  'admin_course_add' => 
  array (
    'name' => '创建课程',
    'router_name' => 'course_set_manage_create',
    'group' => 'topBtn',
    'blank' => 1,
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_add',
  ),
  'admin_course_set_recommend' => 
  array (
    'name' => '推荐课程',
    'router_params' => 
    array (
      'id' => '(courseSet.id)',
      'filter' => '(filter)',
      'ref' => 'courseList',
    ),
    'group' => 'groupButton',
    'visable' => '( filter == \'normal\' and not courseSet.recommended )',
    'icon' => 'glyphicon glyphicon-hand-up',
    'mode' => 'modal',
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_set_recommend',
  ),
  'admin_course_set_cancel_recommend' => 
  array (
    'name' => '取消推荐',
    'router_params' => 
    array (
      'id' => '(courseSet.id)',
      'filter' => '(filter)',
      'target' => '(target)',
    ),
    'group' => 'groupButton',
    'class' => 'cancel-recommend-course',
    'visable' => '( filter == \'normal\' and courseSet.recommended )',
    'icon' => 'glyphicon glyphicon-hand-right',
    'mode' => 'none',
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_set_cancel_recommend',
  ),
  'admin_course_guest_member_preview' => 
  array (
    'name' => '预览',
    'router_name' => 'course_show',
    'router_params' => 
    array (
      'id' => '(courseSet.defaultCourseId)',
      'previewAs' => 'guest',
    ),
    'group' => 'groupButton',
    'icon' => 'glyphicon glyphicon-eye-open',
    'blank' => 1,
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_guest_member_preview',
  ),
  'admin_course_set_close' => 
  array (
    'name' => '关闭课程',
    'router_params' => 
    array (
      'id' => '(courseSet.id)',
      'filter' => '(filter)',
    ),
    'group' => 'groupButton',
    'icon' => 'glyphicon glyphicon-ban-circle',
    'mode' => 'none',
    'class' => 'close-course',
    'visable' => '(courseSet.status == \'published\')',
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_set_close',
  ),
  'admin_course_sms_prepare' => 
  array (
    'name' => '发送发布通知短信',
    'router_name' => 'sms_prepare',
    'router_params' => 
    array (
      'id' => '(courseSet.id)',
      'targetType' => 'course',
    ),
    'group' => 'groupButton',
    'icon' => 'glyphicon glyphicon-envelope',
    'mode' => 'modal',
    'visable' => '(courseSet.status == \'published\')',
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_sms_prepare',
  ),
  'admin_course_set_publish' => 
  array (
    'name' => '发布课程',
    'router_params' => 
    array (
      'id' => '(courseSet.id)',
      'filter' => '(filter)',
    ),
    'group' => 'groupButton',
    'class' => 'publish-course',
    'icon' => 'glyphicon glyphicon-ok-circle',
    'mode' => 'none',
    'visable' => '(courseSet.status != \'published\')',
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_set_publish',
  ),
  'admin_course_set_delete' => 
  array (
    'name' => '删除课程',
    'class' => 'delete-course',
    'router_params' => 
    array (
      'id' => '(courseSet.id)',
      'filter' => '(filter)',
      'type' => '',
    ),
    'group' => 'groupButton',
    'icon' => 'glyphicon glyphicon-trash',
    'mode' => 'none',
    'visable' => '( courseSet.status in [\'closed\', \'draft\', \'published\'])',
    'parent' => 'admin_course_manage',
    'code' => 'admin_course_set_delete',
  ),
  'admin_course_set_recommend_list' => 
  array (
    'name' => '课程推荐',
    'parent' => 'admin_course_show',
    'code' => 'admin_course_set_recommend_list',
  ),
  'admin_course_set_data' => 
  array (
    'name' => '课程统计',
    'parent' => 'admin_course_show',
    'code' => 'admin_course_set_data',
  ),
  'admin_classroom' => 
  array (
    'name' => '班级管理',
    'parent' => 'admin_course',
    'before' => 'admin_course_thread',
    'children' => 
    array (
      'admin_classroom_manage' => 
      array (
        'name' => '班级管理',
        'router_name' => 'admin_classroom',
        'children' => 
        array (
          'admin_classroom_content_manage' => 
          array (
            'name' => '管理班级',
            'router_name' => 'classroom_manage',
            'group' => 'btn',
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
            'blank' => true,
          ),
          'admin_classroom_create' => 
          array (
            'name' => '创建班级',
            'group' => 'topBtn',
            'blank' => true,
          ),
          'admin_classroom_cancel_recommend' => 
          array (
            'name' => '取消推荐',
            'mode' => 'none',
            'class' => 'cancel-recommend-classroom',
            'icon' => 'glyphicon glyphicon-hand-right',
            'group' => 'groupButton',
            'router_params' => 
            array (
              'id' => '(classroom.id)',
              'ref' => 'classroomList',
            ),
            'visable' => '( classroom.recommended )',
          ),
          'admin_classroom_set_recommend' => 
          array (
            'name' => '推荐班级',
            'mode' => 'modal',
            'icon' => 'glyphicon glyphicon-hand-up',
            'group' => 'groupButton',
            'router_params' => 
            array (
              'id' => '(classroom.id)',
              'ref' => 'classroomList',
            ),
            'visable' => '( not classroom.recommended )',
          ),
          'admin_classroom_close' => 
          array (
            'name' => '关闭班级',
            'mode' => 'none',
            'class' => 'close-classroom',
            'icon' => 'glyphicon glyphicon-off',
            'group' => 'groupButton',
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
            'visable' => '( classroom.status == \'published\' )',
          ),
          'admin_sms_prepare' => 
          array (
            'name' => '发送发布通知短信',
            'router_name' => 'sms_prepare',
            'mode' => 'modal',
            'icon' => 'glyphicon glyphicon-envelope',
            'group' => 'groupButton',
            'router_params' => 
            array (
              'id' => '(classroom.id)',
              'targetType' => 'classroom',
            ),
            'visable' => '( classroom.status == \'published\' )',
          ),
          'admin_classroom_open' => 
          array (
            'name' => '发布班级',
            'mode' => 'none',
            'icon' => 'glyphicon glyphicon-ok',
            'group' => 'groupButton',
            'class' => 'open-classroom',
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
            'visable' => '( classroom.status != \'published\' )',
          ),
          'admin_classroom_delete' => 
          array (
            'name' => '删除班级',
            'mode' => 'none',
            'icon' => 'glyphicon glyphicon-remove',
            'class' => 'delete-classroom',
            'group' => 'groupButton',
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
            'visable' => '( classroom.status==\'draft\' )',
          ),
        ),
      ),
      'admin_classroom_recommend' => 
      array (
        'name' => '班级推荐',
        'router_name' => 'admin_classroom_recommend_list',
      ),
    ),
    'code' => 'admin_classroom',
  ),
  'admin_classroom_manage' => 
  array (
    'name' => '班级管理',
    'router_name' => 'admin_classroom',
    'children' => 
    array (
      'admin_classroom_content_manage' => 
      array (
        'name' => '管理班级',
        'router_name' => 'classroom_manage',
        'group' => 'btn',
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
        'blank' => true,
      ),
      'admin_classroom_create' => 
      array (
        'name' => '创建班级',
        'group' => 'topBtn',
        'blank' => true,
      ),
      'admin_classroom_cancel_recommend' => 
      array (
        'name' => '取消推荐',
        'mode' => 'none',
        'class' => 'cancel-recommend-classroom',
        'icon' => 'glyphicon glyphicon-hand-right',
        'group' => 'groupButton',
        'router_params' => 
        array (
          'id' => '(classroom.id)',
          'ref' => 'classroomList',
        ),
        'visable' => '( classroom.recommended )',
      ),
      'admin_classroom_set_recommend' => 
      array (
        'name' => '推荐班级',
        'mode' => 'modal',
        'icon' => 'glyphicon glyphicon-hand-up',
        'group' => 'groupButton',
        'router_params' => 
        array (
          'id' => '(classroom.id)',
          'ref' => 'classroomList',
        ),
        'visable' => '( not classroom.recommended )',
      ),
      'admin_classroom_close' => 
      array (
        'name' => '关闭班级',
        'mode' => 'none',
        'class' => 'close-classroom',
        'icon' => 'glyphicon glyphicon-off',
        'group' => 'groupButton',
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
        'visable' => '( classroom.status == \'published\' )',
      ),
      'admin_sms_prepare' => 
      array (
        'name' => '发送发布通知短信',
        'router_name' => 'sms_prepare',
        'mode' => 'modal',
        'icon' => 'glyphicon glyphicon-envelope',
        'group' => 'groupButton',
        'router_params' => 
        array (
          'id' => '(classroom.id)',
          'targetType' => 'classroom',
        ),
        'visable' => '( classroom.status == \'published\' )',
      ),
      'admin_classroom_open' => 
      array (
        'name' => '发布班级',
        'mode' => 'none',
        'icon' => 'glyphicon glyphicon-ok',
        'group' => 'groupButton',
        'class' => 'open-classroom',
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
        'visable' => '( classroom.status != \'published\' )',
      ),
      'admin_classroom_delete' => 
      array (
        'name' => '删除班级',
        'mode' => 'none',
        'icon' => 'glyphicon glyphicon-remove',
        'class' => 'delete-classroom',
        'group' => 'groupButton',
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
        'visable' => '( classroom.status==\'draft\' )',
      ),
    ),
    'parent' => 'admin_classroom',
    'code' => 'admin_classroom_manage',
  ),
  'admin_classroom_content_manage' => 
  array (
    'name' => '管理班级',
    'router_name' => 'classroom_manage',
    'group' => 'btn',
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'blank' => true,
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_classroom_content_manage',
  ),
  'admin_classroom_create' => 
  array (
    'name' => '创建班级',
    'group' => 'topBtn',
    'blank' => true,
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_classroom_create',
  ),
  'admin_classroom_cancel_recommend' => 
  array (
    'name' => '取消推荐',
    'mode' => 'none',
    'class' => 'cancel-recommend-classroom',
    'icon' => 'glyphicon glyphicon-hand-right',
    'group' => 'groupButton',
    'router_params' => 
    array (
      'id' => '(classroom.id)',
      'ref' => 'classroomList',
    ),
    'visable' => '( classroom.recommended )',
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_classroom_cancel_recommend',
  ),
  'admin_classroom_set_recommend' => 
  array (
    'name' => '推荐班级',
    'mode' => 'modal',
    'icon' => 'glyphicon glyphicon-hand-up',
    'group' => 'groupButton',
    'router_params' => 
    array (
      'id' => '(classroom.id)',
      'ref' => 'classroomList',
    ),
    'visable' => '( not classroom.recommended )',
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_classroom_set_recommend',
  ),
  'admin_classroom_close' => 
  array (
    'name' => '关闭班级',
    'mode' => 'none',
    'class' => 'close-classroom',
    'icon' => 'glyphicon glyphicon-off',
    'group' => 'groupButton',
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'visable' => '( classroom.status == \'published\' )',
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_classroom_close',
  ),
  'admin_sms_prepare' => 
  array (
    'name' => '发送发布通知短信',
    'router_name' => 'sms_prepare',
    'mode' => 'modal',
    'icon' => 'glyphicon glyphicon-envelope',
    'group' => 'groupButton',
    'router_params' => 
    array (
      'id' => '(classroom.id)',
      'targetType' => 'classroom',
    ),
    'visable' => '( classroom.status == \'published\' )',
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_sms_prepare',
  ),
  'admin_classroom_open' => 
  array (
    'name' => '发布班级',
    'mode' => 'none',
    'icon' => 'glyphicon glyphicon-ok',
    'group' => 'groupButton',
    'class' => 'open-classroom',
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'visable' => '( classroom.status != \'published\' )',
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_classroom_open',
  ),
  'admin_classroom_delete' => 
  array (
    'name' => '删除班级',
    'mode' => 'none',
    'icon' => 'glyphicon glyphicon-remove',
    'class' => 'delete-classroom',
    'group' => 'groupButton',
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'visable' => '( classroom.status==\'draft\' )',
    'parent' => 'admin_classroom_manage',
    'code' => 'admin_classroom_delete',
  ),
  'admin_classroom_recommend' => 
  array (
    'name' => '班级推荐',
    'router_name' => 'admin_classroom_recommend_list',
    'parent' => 'admin_classroom',
    'code' => 'admin_classroom_recommend',
  ),
  'admin_open_course_manage' => 
  array (
    'name' => '公开课管理',
    'router_name' => 'admin_open_course',
    'children' => 
    array (
      'admin_open_course' => 
      array (
        'name' => '公开课管理',
        'disable' => true,
        'router_name' => 'admin_open_course',
      ),
      'admin_open_course_recommend_list' => 
      array (
        'name' => '公开课推荐',
        'disable' => true,
      ),
      'admin_opencourse_analysis' => 
      array (
        'name' => '公开课统计',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_open_course_manage',
  ),
  'admin_open_course' => 
  array (
    'name' => '公开课管理',
    'disable' => true,
    'router_name' => 'admin_open_course',
    'parent' => 'admin_open_course_manage',
    'code' => 'admin_open_course',
  ),
  'admin_open_course_recommend_list' => 
  array (
    'name' => '公开课推荐',
    'disable' => true,
    'parent' => 'admin_open_course_manage',
    'code' => 'admin_open_course_recommend_list',
  ),
  'admin_opencourse_analysis' => 
  array (
    'name' => '公开课统计',
    'disable' => true,
    'parent' => 'admin_open_course_manage',
    'code' => 'admin_opencourse_analysis',
  ),
  'admin_live_course' => 
  array (
    'name' => '直播管理',
    'children' => 
    array (
      'admin_live_course_manage' => 
      array (
        'name' => '直播管理',
        'router_params' => 
        array (
          'status' => 'coming',
        ),
        'router_name' => 'admin_live_course',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_live_course',
  ),
  'admin_live_course_manage' => 
  array (
    'name' => '直播管理',
    'router_params' => 
    array (
      'status' => 'coming',
    ),
    'router_name' => 'admin_live_course',
    'disable' => true,
    'parent' => 'admin_live_course',
    'code' => 'admin_live_course_manage',
  ),
  'admin_course_thread' => 
  array (
    'name' => '话题管理',
    'children' => 
    array (
      'admin_course_thread_manage' => 
      array (
        'name' => '课程话题',
        'router_name' => 'admin_thread',
        'disable' => true,
      ),
      'admin_classroom_thread_manage' => 
      array (
        'name' => '班级话题',
        'parent' => 'admin_course_thread',
        'router_name' => 'admin_classroom_thread',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_course_thread',
  ),
  'admin_course_thread_manage' => 
  array (
    'name' => '课程话题',
    'router_name' => 'admin_thread',
    'disable' => true,
    'parent' => 'admin_course_thread',
    'code' => 'admin_course_thread_manage',
  ),
  'admin_classroom_thread_manage' => 
  array (
    'name' => '班级话题',
    'parent' => 'admin_course_thread',
    'router_name' => 'admin_classroom_thread',
    'disable' => true,
    'code' => 'admin_classroom_thread_manage',
  ),
  'admin_course_question' => 
  array (
    'name' => '问答管理',
    'children' => 
    array (
      'admin_course_question_manage' => 
      array (
        'name' => '问答管理',
        'router_name' => 'admin_question',
        'router_params' => 
        array (
          'postStatus' => 'unPosted',
        ),
        'disable' => true,
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_course_question',
  ),
  'admin_course_question_manage' => 
  array (
    'name' => '问答管理',
    'router_name' => 'admin_question',
    'router_params' => 
    array (
      'postStatus' => 'unPosted',
    ),
    'disable' => true,
    'parent' => 'admin_course_question',
    'code' => 'admin_course_question_manage',
  ),
  'admin_course_note' => 
  array (
    'name' => '笔记管理',
    'children' => 
    array (
      'admin_course_note_manage' => 
      array (
        'name' => '笔记管理',
        'router_name' => 'admin_course_note',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_course_note',
  ),
  'admin_course_note_manage' => 
  array (
    'name' => '笔记管理',
    'router_name' => 'admin_course_note',
    'disable' => true,
    'parent' => 'admin_course_note',
    'code' => 'admin_course_note_manage',
  ),
  'admin_course_review' => 
  array (
    'name' => '评价管理',
    'children' => 
    array (
      'admin_course_review_tab' => 
      array (
        'name' => '课程评价',
        'router_name' => 'admin_review',
        'group' => 1,
        'disable' => true,
      ),
      'admin_classroom_review_tab' => 
      array (
        'name' => '班级评价',
        'router_name' => 'admin_classroom_review',
        'parent' => 'admin_course_review',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_course_review',
  ),
  'admin_course_review_tab' => 
  array (
    'name' => '课程评价',
    'router_name' => 'admin_review',
    'group' => 1,
    'disable' => true,
    'parent' => 'admin_course_review',
    'code' => 'admin_course_review_tab',
  ),
  'admin_classroom_review_tab' => 
  array (
    'name' => '班级评价',
    'router_name' => 'admin_classroom_review',
    'parent' => 'admin_course_review',
    'disable' => true,
    'code' => 'admin_classroom_review_tab',
  ),
  'admin_course_category' => 
  array (
    'name' => '分类管理',
    'children' => 
    array (
      'admin_course_category_manage' => 
      array (
        'name' => '课程分类',
        'router_name' => 'admin_course_category',
        'disable' => true,
        'children' => 
        array (
          'admin_category_create' => 
          array (
            'name' => '添加分类',
            'router_params' => 
            array (
              'groupId' => '(group.id)',
            ),
            'router_params_context' => 1,
            'group' => 'topBtn',
            'mode' => 'modal',
          ),
        ),
      ),
      'admin_classroom_category_manage' => 
      array (
        'name' => '班级分类',
        'parent' => 'admin_course_category',
        'router_name' => 'admin_classroom_category',
        'disable' => true,
        'children' => 
        array (
          'admin_classroom_category_create' => 
          array (
            'name' => '添加分类',
            'parent' => 'admin_classroom_category_manage',
            'router_name' => 'admin_category_create',
            'router_params' => 
            array (
              'groupId' => '(group.id)',
            ),
            'router_params_context' => 1,
            'group' => 'topBtn',
            'mode' => 'modal',
          ),
        ),
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_course_category',
  ),
  'admin_course_category_manage' => 
  array (
    'name' => '课程分类',
    'router_name' => 'admin_course_category',
    'disable' => true,
    'children' => 
    array (
      'admin_category_create' => 
      array (
        'name' => '添加分类',
        'router_params' => 
        array (
          'groupId' => '(group.id)',
        ),
        'router_params_context' => 1,
        'group' => 'topBtn',
        'mode' => 'modal',
      ),
    ),
    'parent' => 'admin_course_category',
    'code' => 'admin_course_category_manage',
  ),
  'admin_category_create' => 
  array (
    'name' => '添加分类',
    'router_params' => 
    array (
      'groupId' => '(group.id)',
    ),
    'router_params_context' => 1,
    'group' => 'topBtn',
    'mode' => 'modal',
    'parent' => 'admin_course_category_manage',
    'code' => 'admin_category_create',
  ),
  'admin_classroom_category_manage' => 
  array (
    'name' => '班级分类',
    'parent' => 'admin_course_category',
    'router_name' => 'admin_classroom_category',
    'disable' => true,
    'children' => 
    array (
      'admin_classroom_category_create' => 
      array (
        'name' => '添加分类',
        'parent' => 'admin_classroom_category_manage',
        'router_name' => 'admin_category_create',
        'router_params' => 
        array (
          'groupId' => '(group.id)',
        ),
        'router_params_context' => 1,
        'group' => 'topBtn',
        'mode' => 'modal',
      ),
    ),
    'code' => 'admin_classroom_category_manage',
  ),
  'admin_classroom_category_create' => 
  array (
    'name' => '添加分类',
    'parent' => 'admin_classroom_category_manage',
    'router_name' => 'admin_category_create',
    'router_params' => 
    array (
      'groupId' => '(group.id)',
    ),
    'router_params_context' => 1,
    'group' => 'topBtn',
    'mode' => 'modal',
    'code' => 'admin_classroom_category_create',
  ),
  'admin_course_tag' => 
  array (
    'name' => '标签管理',
    'children' => 
    array (
      'admin_course_tag_manage' => 
      array (
        'name' => '标签管理',
        'router_name' => 'admin_tag',
        'disable' => true,
        'children' => 
        array (
          'admin_course_tag_add' => 
          array (
            'name' => '新增标签',
            'router_name' => 'admin_tag_create',
            'mode' => 'modal',
            'group' => 'topBtn',
          ),
        ),
      ),
      'admin_course_tag_group_manage' => 
      array (
        'name' => '标签组管理',
        'router_name' => 'admin_tag_group',
        'disable' => true,
        'children' => 
        array (
          'admin_course_tag_group_add' => 
          array (
            'name' => '新建标签组',
            'router_name' => 'admin_tag_group_create',
            'mode' => 'modal',
            'group' => 'topBtn',
          ),
        ),
      ),
    ),
    'parent' => 'admin_course',
    'code' => 'admin_course_tag',
  ),
  'admin_course_tag_manage' => 
  array (
    'name' => '标签管理',
    'router_name' => 'admin_tag',
    'disable' => true,
    'children' => 
    array (
      'admin_course_tag_add' => 
      array (
        'name' => '新增标签',
        'router_name' => 'admin_tag_create',
        'mode' => 'modal',
        'group' => 'topBtn',
      ),
    ),
    'parent' => 'admin_course_tag',
    'code' => 'admin_course_tag_manage',
  ),
  'admin_course_tag_add' => 
  array (
    'name' => '新增标签',
    'router_name' => 'admin_tag_create',
    'mode' => 'modal',
    'group' => 'topBtn',
    'parent' => 'admin_course_tag_manage',
    'code' => 'admin_course_tag_add',
  ),
  'admin_course_tag_group_manage' => 
  array (
    'name' => '标签组管理',
    'router_name' => 'admin_tag_group',
    'disable' => true,
    'children' => 
    array (
      'admin_course_tag_group_add' => 
      array (
        'name' => '新建标签组',
        'router_name' => 'admin_tag_group_create',
        'mode' => 'modal',
        'group' => 'topBtn',
      ),
    ),
    'parent' => 'admin_course_tag',
    'code' => 'admin_course_tag_group_manage',
  ),
  'admin_course_tag_group_add' => 
  array (
    'name' => '新建标签组',
    'router_name' => 'admin_tag_group_create',
    'mode' => 'modal',
    'group' => 'topBtn',
    'parent' => 'admin_course_tag_group_manage',
    'code' => 'admin_course_tag_group_add',
  ),
  'admin_operation' => 
  array (
    'name' => '运营',
    'children' => 
    array (
      'admin_operation_article' => 
      array (
        'name' => '资讯管理',
        'children' => 
        array (
          'admin_operation_article_manage' => 
          array (
            'name' => '资讯管理',
            'disable' => true,
            'router_name' => 'admin_article',
            'children' => 
            array (
              'admin_operation_article_create' => 
              array (
                'name' => '添加资讯',
                'router_name' => 'admin_article_create',
                'group' => 'topBtn',
              ),
            ),
          ),
          'admin_operation_article_category' => 
          array (
            'name' => '栏目管理',
            'disable' => true,
            'router_name' => 'admin_article_category',
            'children' => 
            array (
              'admin_operation_category_create' => 
              array (
                'name' => '添加栏目',
                'router_name' => 'admin_article_category_create',
                'mode' => 'modal',
                'group' => 'topBtn',
              ),
            ),
          ),
        ),
      ),
      'admin_operation_group' => 
      array (
        'name' => '小组管理',
        'children' => 
        array (
          'admin_operation_group_manage' => 
          array (
            'name' => '小组管理',
            'disable' => true,
            'router_name' => 'admin_group',
            'children' => 
            array (
              'admin_operation_group_create' => 
              array (
                'name' => '创建小组',
                'router_name' => 'group_add',
                'group' => 'topBtn',
                'blank' => 1,
              ),
            ),
          ),
          'admin_operation_group_thread' => 
          array (
            'name' => '小组话题管理',
            'disable' => true,
            'router_name' => 'admin_groupThread',
          ),
        ),
      ),
      'admin_operation_invite' => 
      array (
        'name' => '邀请管理',
        'children' => 
        array (
          'admin_operation_invite_manage' => 
          array (
            'name' => '邀请管理',
            'disable' => true,
            'router_name' => 'admin_invite',
          ),
          'admin_operation_invite_coupon' => 
          array (
            'name' => '奖励查询',
            'disable' => true,
            'router_name' => 'admin_invite_coupon',
          ),
        ),
      ),
      'admin_announcement' => 
      array (
        'name' => '网站公告管理',
        'group' => 2,
        'children' => 
        array (
          'admin_announcement_manage' => 
          array (
            'name' => '网站公告管理',
            'disable' => true,
            'router_name' => 'admin_announcement',
            'children' => 
            array (
              'admin_announcement_create' => 
              array (
                'name' => '新增公告',
                'mode' => 'modal',
                'group' => 'topBtn',
              ),
            ),
          ),
        ),
      ),
      'admin_operation_notification' => 
      array (
        'name' => '全站站内通知',
        'group' => 2,
        'children' => 
        array (
          'admin_batch_notification' => 
          array (
            'name' => '全站站内通知',
            'disable' => true,
            'children' => 
            array (
              'admin_batch_notification_create' => 
              array (
                'name' => '创建站内通知',
                'group' => 'topBtn',
              ),
            ),
          ),
        ),
      ),
      'admin_block_manage' => 
      array (
        'name' => '编辑区管理',
        'group' => 2,
        'children' => 
        array (
          'admin_block' => 
          array (
            'name' => '编辑区管理',
            'disable' => true,
            'router_params' => 
            array (
              'category' => 'all',
            ),
            'children' => 
            array (
              'admin_block_visual_edit' => 
              array (
                'name' => '编辑',
                'router_params' => 
                array (
                  'blockId' => '(blockTemplateId:block.blockTemplateId)',
                ),
              ),
            ),
          ),
        ),
      ),
      'admin_operation_content' => 
      array (
        'name' => '自定义页面管理',
        'group' => 2,
        'children' => 
        array (
          'admin_content' => 
          array (
            'name' => '自定义页面管理',
            'disable' => true,
            'router_params' => 
            array (
              'type' => 'page',
            ),
          ),
        ),
      ),
      'admin_operation_mobile' => 
      array (
        'name' => '移动端内容管理',
        'group' => 2,
        'children' => 
        array (
          'admin_operation_mobile_banner_manage' => 
          array (
            'name' => '轮播图设置',
            'disable' => true,
            'router_name' => 'admin_operation_mobile',
          ),
          'admin_operation_mobile_select_manage' => 
          array (
            'name' => '每周精选设置',
            'disable' => true,
            'router_name' => 'admin_operation_mobile_select',
          ),
          'admin_discovery_column_index' => 
          array (
            'name' => '发现页栏目管理',
            'disable' => true,
            'children' => 
            array (
              'admin_discovery_column_create' => 
              array (
                'name' => '添加栏目',
                'group' => 'topBtn',
                'mode' => 'modal',
              ),
            ),
          ),
        ),
      ),
      'admin_operation_analysis_register' => 
      array (
        'name' => '数据统计',
        'group' => 3,
        'children' => 
        array (
          'admin_operation_analysis' => 
          array (
            'disable' => true,
            'name' => '数据统计',
            'router_params' => 
            array (
              'tab' => 'trend',
              'analysisDateType' => 'register',
            ),
            'router_name' => 'admin_operation_analysis_register',
          ),
        ),
      ),
      'admin_operation_keyword' => 
      array (
        'name' => '敏感词管理',
        'parent' => 'admin_operation',
        'group' => 4,
        'children' => 
        array (
          'admin_keyword' => 
          array (
            'name' => '敏感词列表',
            'disable' => true,
            'children' => 
            array (
              'admin_keyword_create' => 
              array (
                'name' => '添加敏感词',
                'mode' => 'modal',
                'group' => 'topBtn',
              ),
            ),
          ),
          'admin_keyword_banlogs' => 
          array (
            'name' => '屏蔽记录',
            'disable' => true,
          ),
        ),
      ),
    ),
    'parent' => 'admin',
    'code' => 'admin_operation',
  ),
  'admin_operation_article' => 
  array (
    'name' => '资讯管理',
    'children' => 
    array (
      'admin_operation_article_manage' => 
      array (
        'name' => '资讯管理',
        'disable' => true,
        'router_name' => 'admin_article',
        'children' => 
        array (
          'admin_operation_article_create' => 
          array (
            'name' => '添加资讯',
            'router_name' => 'admin_article_create',
            'group' => 'topBtn',
          ),
        ),
      ),
      'admin_operation_article_category' => 
      array (
        'name' => '栏目管理',
        'disable' => true,
        'router_name' => 'admin_article_category',
        'children' => 
        array (
          'admin_operation_category_create' => 
          array (
            'name' => '添加栏目',
            'router_name' => 'admin_article_category_create',
            'mode' => 'modal',
            'group' => 'topBtn',
          ),
        ),
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_operation_article',
  ),
  'admin_operation_article_manage' => 
  array (
    'name' => '资讯管理',
    'disable' => true,
    'router_name' => 'admin_article',
    'children' => 
    array (
      'admin_operation_article_create' => 
      array (
        'name' => '添加资讯',
        'router_name' => 'admin_article_create',
        'group' => 'topBtn',
      ),
    ),
    'parent' => 'admin_operation_article',
    'code' => 'admin_operation_article_manage',
  ),
  'admin_operation_article_create' => 
  array (
    'name' => '添加资讯',
    'router_name' => 'admin_article_create',
    'group' => 'topBtn',
    'parent' => 'admin_operation_article_manage',
    'code' => 'admin_operation_article_create',
  ),
  'admin_operation_article_category' => 
  array (
    'name' => '栏目管理',
    'disable' => true,
    'router_name' => 'admin_article_category',
    'children' => 
    array (
      'admin_operation_category_create' => 
      array (
        'name' => '添加栏目',
        'router_name' => 'admin_article_category_create',
        'mode' => 'modal',
        'group' => 'topBtn',
      ),
    ),
    'parent' => 'admin_operation_article',
    'code' => 'admin_operation_article_category',
  ),
  'admin_operation_category_create' => 
  array (
    'name' => '添加栏目',
    'router_name' => 'admin_article_category_create',
    'mode' => 'modal',
    'group' => 'topBtn',
    'parent' => 'admin_operation_article_category',
    'code' => 'admin_operation_category_create',
  ),
  'admin_operation_group' => 
  array (
    'name' => '小组管理',
    'children' => 
    array (
      'admin_operation_group_manage' => 
      array (
        'name' => '小组管理',
        'disable' => true,
        'router_name' => 'admin_group',
        'children' => 
        array (
          'admin_operation_group_create' => 
          array (
            'name' => '创建小组',
            'router_name' => 'group_add',
            'group' => 'topBtn',
            'blank' => 1,
          ),
        ),
      ),
      'admin_operation_group_thread' => 
      array (
        'name' => '小组话题管理',
        'disable' => true,
        'router_name' => 'admin_groupThread',
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_operation_group',
  ),
  'admin_operation_group_manage' => 
  array (
    'name' => '小组管理',
    'disable' => true,
    'router_name' => 'admin_group',
    'children' => 
    array (
      'admin_operation_group_create' => 
      array (
        'name' => '创建小组',
        'router_name' => 'group_add',
        'group' => 'topBtn',
        'blank' => 1,
      ),
    ),
    'parent' => 'admin_operation_group',
    'code' => 'admin_operation_group_manage',
  ),
  'admin_operation_group_create' => 
  array (
    'name' => '创建小组',
    'router_name' => 'group_add',
    'group' => 'topBtn',
    'blank' => 1,
    'parent' => 'admin_operation_group_manage',
    'code' => 'admin_operation_group_create',
  ),
  'admin_operation_group_thread' => 
  array (
    'name' => '小组话题管理',
    'disable' => true,
    'router_name' => 'admin_groupThread',
    'parent' => 'admin_operation_group',
    'code' => 'admin_operation_group_thread',
  ),
  'admin_operation_invite' => 
  array (
    'name' => '邀请管理',
    'children' => 
    array (
      'admin_operation_invite_manage' => 
      array (
        'name' => '邀请管理',
        'disable' => true,
        'router_name' => 'admin_invite',
      ),
      'admin_operation_invite_coupon' => 
      array (
        'name' => '奖励查询',
        'disable' => true,
        'router_name' => 'admin_invite_coupon',
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_operation_invite',
  ),
  'admin_operation_invite_manage' => 
  array (
    'name' => '邀请管理',
    'disable' => true,
    'router_name' => 'admin_invite',
    'parent' => 'admin_operation_invite',
    'code' => 'admin_operation_invite_manage',
  ),
  'admin_operation_invite_coupon' => 
  array (
    'name' => '奖励查询',
    'disable' => true,
    'router_name' => 'admin_invite_coupon',
    'parent' => 'admin_operation_invite',
    'code' => 'admin_operation_invite_coupon',
  ),
  'admin_announcement' => 
  array (
    'name' => '网站公告管理',
    'group' => 2,
    'children' => 
    array (
      'admin_announcement_manage' => 
      array (
        'name' => '网站公告管理',
        'disable' => true,
        'router_name' => 'admin_announcement',
        'children' => 
        array (
          'admin_announcement_create' => 
          array (
            'name' => '新增公告',
            'mode' => 'modal',
            'group' => 'topBtn',
          ),
        ),
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_announcement',
  ),
  'admin_announcement_manage' => 
  array (
    'name' => '网站公告管理',
    'disable' => true,
    'router_name' => 'admin_announcement',
    'children' => 
    array (
      'admin_announcement_create' => 
      array (
        'name' => '新增公告',
        'mode' => 'modal',
        'group' => 'topBtn',
      ),
    ),
    'parent' => 'admin_announcement',
    'code' => 'admin_announcement_manage',
  ),
  'admin_announcement_create' => 
  array (
    'name' => '新增公告',
    'mode' => 'modal',
    'group' => 'topBtn',
    'parent' => 'admin_announcement_manage',
    'code' => 'admin_announcement_create',
  ),
  'admin_operation_notification' => 
  array (
    'name' => '全站站内通知',
    'group' => 2,
    'children' => 
    array (
      'admin_batch_notification' => 
      array (
        'name' => '全站站内通知',
        'disable' => true,
        'children' => 
        array (
          'admin_batch_notification_create' => 
          array (
            'name' => '创建站内通知',
            'group' => 'topBtn',
          ),
        ),
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_operation_notification',
  ),
  'admin_batch_notification' => 
  array (
    'name' => '全站站内通知',
    'disable' => true,
    'children' => 
    array (
      'admin_batch_notification_create' => 
      array (
        'name' => '创建站内通知',
        'group' => 'topBtn',
      ),
    ),
    'parent' => 'admin_operation_notification',
    'code' => 'admin_batch_notification',
  ),
  'admin_batch_notification_create' => 
  array (
    'name' => '创建站内通知',
    'group' => 'topBtn',
    'parent' => 'admin_batch_notification',
    'code' => 'admin_batch_notification_create',
  ),
  'admin_block_manage' => 
  array (
    'name' => '编辑区管理',
    'group' => 2,
    'children' => 
    array (
      'admin_block' => 
      array (
        'name' => '编辑区管理',
        'disable' => true,
        'router_params' => 
        array (
          'category' => 'all',
        ),
        'children' => 
        array (
          'admin_block_visual_edit' => 
          array (
            'name' => '编辑',
            'router_params' => 
            array (
              'blockId' => '(blockTemplateId:block.blockTemplateId)',
            ),
          ),
        ),
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_block_manage',
  ),
  'admin_block' => 
  array (
    'name' => '编辑区管理',
    'disable' => true,
    'router_params' => 
    array (
      'category' => 'all',
    ),
    'children' => 
    array (
      'admin_block_visual_edit' => 
      array (
        'name' => '编辑',
        'router_params' => 
        array (
          'blockId' => '(blockTemplateId:block.blockTemplateId)',
        ),
      ),
    ),
    'parent' => 'admin_block_manage',
    'code' => 'admin_block',
  ),
  'admin_block_visual_edit' => 
  array (
    'name' => '编辑',
    'router_params' => 
    array (
      'blockId' => '(blockTemplateId:block.blockTemplateId)',
    ),
    'parent' => 'admin_block',
    'code' => 'admin_block_visual_edit',
  ),
  'admin_operation_content' => 
  array (
    'name' => '自定义页面管理',
    'group' => 2,
    'children' => 
    array (
      'admin_content' => 
      array (
        'name' => '自定义页面管理',
        'disable' => true,
        'router_params' => 
        array (
          'type' => 'page',
        ),
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_operation_content',
  ),
  'admin_content' => 
  array (
    'name' => '自定义页面管理',
    'disable' => true,
    'router_params' => 
    array (
      'type' => 'page',
    ),
    'parent' => 'admin_operation_content',
    'code' => 'admin_content',
  ),
  'admin_operation_mobile' => 
  array (
    'name' => '移动端内容管理',
    'group' => 2,
    'children' => 
    array (
      'admin_operation_mobile_banner_manage' => 
      array (
        'name' => '轮播图设置',
        'disable' => true,
        'router_name' => 'admin_operation_mobile',
      ),
      'admin_operation_mobile_select_manage' => 
      array (
        'name' => '每周精选设置',
        'disable' => true,
        'router_name' => 'admin_operation_mobile_select',
      ),
      'admin_discovery_column_index' => 
      array (
        'name' => '发现页栏目管理',
        'disable' => true,
        'children' => 
        array (
          'admin_discovery_column_create' => 
          array (
            'name' => '添加栏目',
            'group' => 'topBtn',
            'mode' => 'modal',
          ),
        ),
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_operation_mobile',
  ),
  'admin_operation_mobile_banner_manage' => 
  array (
    'name' => '轮播图设置',
    'disable' => true,
    'router_name' => 'admin_operation_mobile',
    'parent' => 'admin_operation_mobile',
    'code' => 'admin_operation_mobile_banner_manage',
  ),
  'admin_operation_mobile_select_manage' => 
  array (
    'name' => '每周精选设置',
    'disable' => true,
    'router_name' => 'admin_operation_mobile_select',
    'parent' => 'admin_operation_mobile',
    'code' => 'admin_operation_mobile_select_manage',
  ),
  'admin_discovery_column_index' => 
  array (
    'name' => '发现页栏目管理',
    'disable' => true,
    'children' => 
    array (
      'admin_discovery_column_create' => 
      array (
        'name' => '添加栏目',
        'group' => 'topBtn',
        'mode' => 'modal',
      ),
    ),
    'parent' => 'admin_operation_mobile',
    'code' => 'admin_discovery_column_index',
  ),
  'admin_discovery_column_create' => 
  array (
    'name' => '添加栏目',
    'group' => 'topBtn',
    'mode' => 'modal',
    'parent' => 'admin_discovery_column_index',
    'code' => 'admin_discovery_column_create',
  ),
  'admin_operation_analysis_register' => 
  array (
    'name' => '数据统计',
    'group' => 3,
    'children' => 
    array (
      'admin_operation_analysis' => 
      array (
        'disable' => true,
        'name' => '数据统计',
        'router_params' => 
        array (
          'tab' => 'trend',
          'analysisDateType' => 'register',
        ),
        'router_name' => 'admin_operation_analysis_register',
      ),
    ),
    'parent' => 'admin_operation',
    'code' => 'admin_operation_analysis_register',
  ),
  'admin_operation_analysis' => 
  array (
    'disable' => true,
    'name' => '数据统计',
    'router_params' => 
    array (
      'tab' => 'trend',
      'analysisDateType' => 'register',
    ),
    'router_name' => 'admin_operation_analysis_register',
    'parent' => 'admin_operation_analysis_register',
    'code' => 'admin_operation_analysis',
  ),
  'admin_operation_keyword' => 
  array (
    'name' => '敏感词管理',
    'parent' => 'admin_operation',
    'group' => 4,
    'children' => 
    array (
      'admin_keyword' => 
      array (
        'name' => '敏感词列表',
        'disable' => true,
        'children' => 
        array (
          'admin_keyword_create' => 
          array (
            'name' => '添加敏感词',
            'mode' => 'modal',
            'group' => 'topBtn',
          ),
        ),
      ),
      'admin_keyword_banlogs' => 
      array (
        'name' => '屏蔽记录',
        'disable' => true,
      ),
    ),
    'code' => 'admin_operation_keyword',
  ),
  'admin_keyword' => 
  array (
    'name' => '敏感词列表',
    'disable' => true,
    'children' => 
    array (
      'admin_keyword_create' => 
      array (
        'name' => '添加敏感词',
        'mode' => 'modal',
        'group' => 'topBtn',
      ),
    ),
    'parent' => 'admin_operation_keyword',
    'code' => 'admin_keyword',
  ),
  'admin_keyword_create' => 
  array (
    'name' => '添加敏感词',
    'mode' => 'modal',
    'group' => 'topBtn',
    'parent' => 'admin_keyword',
    'code' => 'admin_keyword_create',
  ),
  'admin_keyword_banlogs' => 
  array (
    'name' => '屏蔽记录',
    'disable' => true,
    'parent' => 'admin_operation_keyword',
    'code' => 'admin_keyword_banlogs',
  ),
  'admin_order' => 
  array (
    'name' => '订单',
    'children' => 
    array (
      'admin_course_order_manage' => 
      array (
        'name' => '课程订单',
        'children' => 
        array (
          'admin_course_order' => 
          array (
            'name' => '课程订单',
            'router_name' => 'admin_course_order_manage',
            'disable' => true,
          ),
        ),
      ),
      'admin_coin_order_manange' => 
      array (
        'name' => '虚拟币订单',
        'children' => 
        array (
          'admin_coin_orders' => 
          array (
            'name' => '虚拟币订单',
            'disable' => true,
          ),
        ),
      ),
      'admin_classroom_order_manage' => 
      array (
        'name' => '班级订单',
        'parent' => 'admin_order',
        'after' => 'admin_course_order',
        'children' => 
        array (
          'admin_classroom_order' => 
          array (
            'name' => '班级订单',
            'disable' => true,
          ),
        ),
      ),
    ),
    'parent' => 'admin',
    'code' => 'admin_order',
  ),
  'admin_course_order_manage' => 
  array (
    'name' => '课程订单',
    'children' => 
    array (
      'admin_course_order' => 
      array (
        'name' => '课程订单',
        'router_name' => 'admin_course_order_manage',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_order',
    'code' => 'admin_course_order_manage',
  ),
  'admin_course_order' => 
  array (
    'name' => '课程订单',
    'router_name' => 'admin_course_order_manage',
    'disable' => true,
    'parent' => 'admin_course_order_manage',
    'code' => 'admin_course_order',
  ),
  'admin_coin_order_manange' => 
  array (
    'name' => '虚拟币订单',
    'children' => 
    array (
      'admin_coin_orders' => 
      array (
        'name' => '虚拟币订单',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_order',
    'code' => 'admin_coin_order_manange',
  ),
  'admin_coin_orders' => 
  array (
    'name' => '虚拟币订单',
    'disable' => true,
    'parent' => 'admin_coin_order_manange',
    'code' => 'admin_coin_orders',
  ),
  'admin_classroom_order_manage' => 
  array (
    'name' => '班级订单',
    'parent' => 'admin_order',
    'after' => 'admin_course_order',
    'children' => 
    array (
      'admin_classroom_order' => 
      array (
        'name' => '班级订单',
        'disable' => true,
      ),
    ),
    'code' => 'admin_classroom_order_manage',
  ),
  'admin_classroom_order' => 
  array (
    'name' => '班级订单',
    'disable' => true,
    'parent' => 'admin_classroom_order_manage',
    'code' => 'admin_classroom_order',
  ),
  'admin_finance' => 
  array (
    'name' => '账务',
    'children' => 
    array (
      'admin_bills' => 
      array (
        'name' => '账单管理',
        'children' => 
        array (
          'admin_bill' => 
          array (
            'name' => '现金账单',
            'disable' => true,
          ),
          'admin_coin_records' => 
          array (
            'name' => '虚拟币账单',
            'disable' => true,
          ),
        ),
      ),
      'admin_coin_user' => 
      array (
        'name' => '虚拟币管理',
        'children' => 
        array (
          'admin_coin_user_records' => 
          array (
            'name' => '虚拟币管理',
            'disable' => true,
            'router_name' => 'admin_coin_user_records',
          ),
        ),
      ),
      'admin_course_refunds' => 
      array (
        'name' => '课程退款管理',
        'children' => 
        array (
          'admin_course_refunds_manage' => 
          array (
            'name' => '课程退款管理',
            'disable' => true,
            'router_name' => 'admin_order_refunds',
            'router_params' => 
            array (
              'targetType' => 'course',
              'status' => 'created',
            ),
          ),
        ),
      ),
      'admin_classroom_refunds' => 
      array (
        'name' => '班级退款管理',
        'parent' => 'admin_finance',
        'router_name' => 'admin_order_refunds',
        'router_params' => 
        array (
          'targetType' => 'classroom',
          'status' => 'created',
        ),
        'after' => 'admin_course_refunds',
        'children' => 
        array (
          'admin_classroom_refunds_manage' => 
          array (
            'name' => '班级退款管理',
            'disable' => true,
            'router_name' => 'admin_order_refunds',
            'router_params' => 
            array (
              'targetType' => 'classroom',
              'status' => 'created',
            ),
          ),
        ),
      ),
    ),
    'parent' => 'admin',
    'code' => 'admin_finance',
  ),
  'admin_bills' => 
  array (
    'name' => '账单管理',
    'children' => 
    array (
      'admin_bill' => 
      array (
        'name' => '现金账单',
        'disable' => true,
      ),
      'admin_coin_records' => 
      array (
        'name' => '虚拟币账单',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_finance',
    'code' => 'admin_bills',
  ),
  'admin_bill' => 
  array (
    'name' => '现金账单',
    'disable' => true,
    'parent' => 'admin_bills',
    'code' => 'admin_bill',
  ),
  'admin_coin_records' => 
  array (
    'name' => '虚拟币账单',
    'disable' => true,
    'parent' => 'admin_bills',
    'code' => 'admin_coin_records',
  ),
  'admin_coin_user' => 
  array (
    'name' => '虚拟币管理',
    'children' => 
    array (
      'admin_coin_user_records' => 
      array (
        'name' => '虚拟币管理',
        'disable' => true,
        'router_name' => 'admin_coin_user_records',
      ),
    ),
    'parent' => 'admin_finance',
    'code' => 'admin_coin_user',
  ),
  'admin_coin_user_records' => 
  array (
    'name' => '虚拟币管理',
    'disable' => true,
    'router_name' => 'admin_coin_user_records',
    'parent' => 'admin_coin_user',
    'code' => 'admin_coin_user_records',
  ),
  'admin_course_refunds' => 
  array (
    'name' => '课程退款管理',
    'children' => 
    array (
      'admin_course_refunds_manage' => 
      array (
        'name' => '课程退款管理',
        'disable' => true,
        'router_name' => 'admin_order_refunds',
        'router_params' => 
        array (
          'targetType' => 'course',
          'status' => 'created',
        ),
      ),
    ),
    'parent' => 'admin_finance',
    'code' => 'admin_course_refunds',
  ),
  'admin_course_refunds_manage' => 
  array (
    'name' => '课程退款管理',
    'disable' => true,
    'router_name' => 'admin_order_refunds',
    'router_params' => 
    array (
      'targetType' => 'course',
      'status' => 'created',
    ),
    'parent' => 'admin_course_refunds',
    'code' => 'admin_course_refunds_manage',
  ),
  'admin_classroom_refunds' => 
  array (
    'name' => '班级退款管理',
    'parent' => 'admin_finance',
    'router_name' => 'admin_order_refunds',
    'router_params' => 
    array (
      'targetType' => 'classroom',
      'status' => 'created',
    ),
    'after' => 'admin_course_refunds',
    'children' => 
    array (
      'admin_classroom_refunds_manage' => 
      array (
        'name' => '班级退款管理',
        'disable' => true,
        'router_name' => 'admin_order_refunds',
        'router_params' => 
        array (
          'targetType' => 'classroom',
          'status' => 'created',
        ),
      ),
    ),
    'code' => 'admin_classroom_refunds',
  ),
  'admin_classroom_refunds_manage' => 
  array (
    'name' => '班级退款管理',
    'disable' => true,
    'router_name' => 'admin_order_refunds',
    'router_params' => 
    array (
      'targetType' => 'classroom',
      'status' => 'created',
    ),
    'parent' => 'admin_classroom_refunds',
    'code' => 'admin_classroom_refunds_manage',
  ),
  'admin_app' => 
  array (
    'name' => '教育云',
    'visable' => '(not (setting(\'copyright.thirdCopyright\', false) == 1) and not is_without_network())',
    'children' => 
    array (
      'admin_my_cloud' => 
      array (
        'name' => '概览',
        'children' => 
        array (
          'admin_my_cloud_overview' => 
          array (
            'name' => '教育云概览',
            'disable' => true,
          ),
        ),
      ),
      'admin_cloud_video_setting' => 
      array (
        'name' => '云视频',
        'router_name' => 'admin_cloud_video_overview',
        'visable' => '(cloudStatus())',
        'children' => 
        array (
          'admin_cloud_video_overview' => 
          array (
            'name' => '概览',
            'disable' => true,
          ),
          'admin_cloud_setting_video' => 
          array (
            'name' => '设置',
            'disable' => true,
          ),
        ),
      ),
      'admin_cloud_edulive_setting' => 
      array (
        'name' => '云直播',
        'visable' => '(cloudStatus())',
        'router_name' => 'admin_cloud_edulive_overview',
        'children' => 
        array (
          'admin_cloud_edulive_overview' => 
          array (
            'name' => '概览',
            'disable' => true,
          ),
          'admin_setting_cloud_edulive' => 
          array (
            'name' => '设置',
            'disable' => true,
          ),
        ),
      ),
      'admin_edu_cloud_sms' => 
      array (
        'name' => '云短信',
        'visable' => '(cloudStatus())',
        'children' => 
        array (
          'admin_edu_cloud_sms_overview' => 
          array (
            'name' => '概览',
            'router_name' => 'admin_edu_cloud_sms',
            'disable' => true,
          ),
          'admin_edu_cloud_setting_sms' => 
          array (
            'name' => '设置',
            'disable' => true,
          ),
        ),
      ),
      'admin_edu_cloud_email' => 
      array (
        'name' => '云邮件',
        'visable' => '(cloudStatus())',
        'children' => 
        array (
          'admin_edu_cloud_email_overview' => 
          array (
            'name' => '概览',
            'router_name' => 'admin_edu_cloud_email',
            'disable' => true,
          ),
          'admin_edu_cloud_email_setting' => 
          array (
            'name' => '设置',
            'disable' => true,
          ),
        ),
      ),
      'admin_edu_cloud_search_setting' => 
      array (
        'name' => '云搜索',
        'visable' => '(cloudStatus())',
        'router_name' => 'admin_edu_cloud_search',
        'children' => 
        array (
          'admin_edu_cloud_search_overview' => 
          array (
            'name' => '概览',
            'router_name' => 'admin_edu_cloud_search',
            'disable' => true,
          ),
          'admin_edu_cloud_setting_search' => 
          array (
            'name' => '设置',
            'disable' => true,
          ),
        ),
      ),
      'admin_app_im' => 
      array (
        'name' => '即时聊天设置',
        'visable' => '(cloudStatus())',
        'children' => 
        array (
          'admin_app_im_setting' => 
          array (
            'name' => '即时聊天设置',
            'router_name' => 'admin_app_im',
            'disable' => true,
          ),
        ),
      ),
      'admin_cloud_file_manage' => 
      array (
        'name' => '云资源',
        'visable' => '(cloudStatus())',
        'parent' => 'admin_app',
        'after' => 'admin_app_center_show',
        'children' => 
        array (
          'admin_cloud_file' => 
          array (
            'name' => '云资源',
            'disable' => true,
          ),
        ),
      ),
      'admin_setting_cloud_attachment' => 
      array (
        'name' => '云附件设置',
        'visable' => '(cloudStatus())',
        'children' => 
        array (
          'admin_edu_cloud_attachment' => 
          array (
            'name' => '云附件设置',
            'disable' => true,
          ),
        ),
      ),
      'admin_app_center_show' => 
      array (
        'name' => 'ES应用',
        'router_name' => 'admin_app_center',
        'router_params' => 
        array (
          'postStatus' => 'all',
        ),
        'children' => 
        array (
          'admin_app_center' => 
          array (
            'name' => '应用中心',
            'router_name' => 'admin_app_center',
            'disable' => true,
            'router_params' => 
            array (
              'postStatus' => 'all',
            ),
          ),
          'admin_app_installed' => 
          array (
            'name' => '已购项目',
            'disable' => true,
            'router_params' => 
            array (
              'postStatus' => 'all',
            ),
          ),
          'admin_app_upgrades' => 
          array (
            'name' => '更新',
            'class' => 'app-upgrade',
            'disable' => true,
          ),
          'admin_app_logs' => 
          array (
            'name' => '更新日志',
            'disable' => true,
          ),
        ),
      ),
      'admin_cloud_attachment_manage' => 
      array (
        'name' => '云附件',
        'visable' => '(cloudStatus())',
        'children' => 
        array (
          'admin_cloud_attachment' => 
          array (
            'name' => '云附件',
            'disable' => true,
          ),
        ),
      ),
      'admin_cloud_consult' => 
      array (
        'name' => '云问答',
        'router_name' => 'admin_cloud_consult_setting',
        'visable' => '(cloudStatus())',
        'children' => 
        array (
          'admin_cloud_consult_setting' => 
          array (
            'name' => '设置',
            'disable' => true,
          ),
        ),
      ),
      'admin_setting_cloud' => 
      array (
        'name' => '授权信息',
        'children' => 
        array (
          'admin_setting_my_cloud' => 
          array (
            'name' => '授权信息',
            'router_name' => 'admin_setting_cloud',
            'disable' => true,
          ),
        ),
      ),
    ),
    'parent' => 'admin',
    'code' => 'admin_app',
  ),
  'admin_my_cloud' => 
  array (
    'name' => '概览',
    'children' => 
    array (
      'admin_my_cloud_overview' => 
      array (
        'name' => '教育云概览',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_my_cloud',
  ),
  'admin_my_cloud_overview' => 
  array (
    'name' => '教育云概览',
    'disable' => true,
    'parent' => 'admin_my_cloud',
    'code' => 'admin_my_cloud_overview',
  ),
  'admin_cloud_video_setting' => 
  array (
    'name' => '云视频',
    'router_name' => 'admin_cloud_video_overview',
    'visable' => '(cloudStatus())',
    'children' => 
    array (
      'admin_cloud_video_overview' => 
      array (
        'name' => '概览',
        'disable' => true,
      ),
      'admin_cloud_setting_video' => 
      array (
        'name' => '设置',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_cloud_video_setting',
  ),
  'admin_cloud_video_overview' => 
  array (
    'name' => '概览',
    'disable' => true,
    'parent' => 'admin_cloud_video_setting',
    'code' => 'admin_cloud_video_overview',
  ),
  'admin_cloud_setting_video' => 
  array (
    'name' => '设置',
    'disable' => true,
    'parent' => 'admin_cloud_video_setting',
    'code' => 'admin_cloud_setting_video',
  ),
  'admin_cloud_edulive_setting' => 
  array (
    'name' => '云直播',
    'visable' => '(cloudStatus())',
    'router_name' => 'admin_cloud_edulive_overview',
    'children' => 
    array (
      'admin_cloud_edulive_overview' => 
      array (
        'name' => '概览',
        'disable' => true,
      ),
      'admin_setting_cloud_edulive' => 
      array (
        'name' => '设置',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_cloud_edulive_setting',
  ),
  'admin_cloud_edulive_overview' => 
  array (
    'name' => '概览',
    'disable' => true,
    'parent' => 'admin_cloud_edulive_setting',
    'code' => 'admin_cloud_edulive_overview',
  ),
  'admin_setting_cloud_edulive' => 
  array (
    'name' => '设置',
    'disable' => true,
    'parent' => 'admin_cloud_edulive_setting',
    'code' => 'admin_setting_cloud_edulive',
  ),
  'admin_edu_cloud_sms' => 
  array (
    'name' => '云短信',
    'visable' => '(cloudStatus())',
    'children' => 
    array (
      'admin_edu_cloud_sms_overview' => 
      array (
        'name' => '概览',
        'router_name' => 'admin_edu_cloud_sms',
        'disable' => true,
      ),
      'admin_edu_cloud_setting_sms' => 
      array (
        'name' => '设置',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_edu_cloud_sms',
  ),
  'admin_edu_cloud_sms_overview' => 
  array (
    'name' => '概览',
    'router_name' => 'admin_edu_cloud_sms',
    'disable' => true,
    'parent' => 'admin_edu_cloud_sms',
    'code' => 'admin_edu_cloud_sms_overview',
  ),
  'admin_edu_cloud_setting_sms' => 
  array (
    'name' => '设置',
    'disable' => true,
    'parent' => 'admin_edu_cloud_sms',
    'code' => 'admin_edu_cloud_setting_sms',
  ),
  'admin_edu_cloud_email' => 
  array (
    'name' => '云邮件',
    'visable' => '(cloudStatus())',
    'children' => 
    array (
      'admin_edu_cloud_email_overview' => 
      array (
        'name' => '概览',
        'router_name' => 'admin_edu_cloud_email',
        'disable' => true,
      ),
      'admin_edu_cloud_email_setting' => 
      array (
        'name' => '设置',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_edu_cloud_email',
  ),
  'admin_edu_cloud_email_overview' => 
  array (
    'name' => '概览',
    'router_name' => 'admin_edu_cloud_email',
    'disable' => true,
    'parent' => 'admin_edu_cloud_email',
    'code' => 'admin_edu_cloud_email_overview',
  ),
  'admin_edu_cloud_email_setting' => 
  array (
    'name' => '设置',
    'disable' => true,
    'parent' => 'admin_edu_cloud_email',
    'code' => 'admin_edu_cloud_email_setting',
  ),
  'admin_edu_cloud_search_setting' => 
  array (
    'name' => '云搜索',
    'visable' => '(cloudStatus())',
    'router_name' => 'admin_edu_cloud_search',
    'children' => 
    array (
      'admin_edu_cloud_search_overview' => 
      array (
        'name' => '概览',
        'router_name' => 'admin_edu_cloud_search',
        'disable' => true,
      ),
      'admin_edu_cloud_setting_search' => 
      array (
        'name' => '设置',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_edu_cloud_search_setting',
  ),
  'admin_edu_cloud_search_overview' => 
  array (
    'name' => '概览',
    'router_name' => 'admin_edu_cloud_search',
    'disable' => true,
    'parent' => 'admin_edu_cloud_search_setting',
    'code' => 'admin_edu_cloud_search_overview',
  ),
  'admin_edu_cloud_setting_search' => 
  array (
    'name' => '设置',
    'disable' => true,
    'parent' => 'admin_edu_cloud_search_setting',
    'code' => 'admin_edu_cloud_setting_search',
  ),
  'admin_app_im' => 
  array (
    'name' => '即时聊天设置',
    'visable' => '(cloudStatus())',
    'children' => 
    array (
      'admin_app_im_setting' => 
      array (
        'name' => '即时聊天设置',
        'router_name' => 'admin_app_im',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_app_im',
  ),
  'admin_app_im_setting' => 
  array (
    'name' => '即时聊天设置',
    'router_name' => 'admin_app_im',
    'disable' => true,
    'parent' => 'admin_app_im',
    'code' => 'admin_app_im_setting',
  ),
  'admin_cloud_file_manage' => 
  array (
    'name' => '云资源',
    'visable' => '(cloudStatus())',
    'parent' => 'admin_app',
    'after' => 'admin_app_center_show',
    'children' => 
    array (
      'admin_cloud_file' => 
      array (
        'name' => '云资源',
        'disable' => true,
      ),
    ),
    'code' => 'admin_cloud_file_manage',
  ),
  'admin_cloud_file' => 
  array (
    'name' => '云资源',
    'disable' => true,
    'parent' => 'admin_cloud_file_manage',
    'code' => 'admin_cloud_file',
  ),
  'admin_setting_cloud_attachment' => 
  array (
    'name' => '云附件设置',
    'visable' => '(cloudStatus())',
    'children' => 
    array (
      'admin_edu_cloud_attachment' => 
      array (
        'name' => '云附件设置',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_setting_cloud_attachment',
  ),
  'admin_edu_cloud_attachment' => 
  array (
    'name' => '云附件设置',
    'disable' => true,
    'parent' => 'admin_setting_cloud_attachment',
    'code' => 'admin_edu_cloud_attachment',
  ),
  'admin_app_center_show' => 
  array (
    'name' => 'ES应用',
    'router_name' => 'admin_app_center',
    'router_params' => 
    array (
      'postStatus' => 'all',
    ),
    'children' => 
    array (
      'admin_app_center' => 
      array (
        'name' => '应用中心',
        'router_name' => 'admin_app_center',
        'disable' => true,
        'router_params' => 
        array (
          'postStatus' => 'all',
        ),
      ),
      'admin_app_installed' => 
      array (
        'name' => '已购项目',
        'disable' => true,
        'router_params' => 
        array (
          'postStatus' => 'all',
        ),
      ),
      'admin_app_upgrades' => 
      array (
        'name' => '更新',
        'class' => 'app-upgrade',
        'disable' => true,
      ),
      'admin_app_logs' => 
      array (
        'name' => '更新日志',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_app_center_show',
  ),
  'admin_app_center' => 
  array (
    'name' => '应用中心',
    'router_name' => 'admin_app_center',
    'disable' => true,
    'router_params' => 
    array (
      'postStatus' => 'all',
    ),
    'parent' => 'admin_app_center_show',
    'code' => 'admin_app_center',
  ),
  'admin_app_installed' => 
  array (
    'name' => '已购项目',
    'disable' => true,
    'router_params' => 
    array (
      'postStatus' => 'all',
    ),
    'parent' => 'admin_app_center_show',
    'code' => 'admin_app_installed',
  ),
  'admin_app_upgrades' => 
  array (
    'name' => '更新',
    'class' => 'app-upgrade',
    'disable' => true,
    'parent' => 'admin_app_center_show',
    'code' => 'admin_app_upgrades',
  ),
  'admin_app_logs' => 
  array (
    'name' => '更新日志',
    'disable' => true,
    'parent' => 'admin_app_center_show',
    'code' => 'admin_app_logs',
  ),
  'admin_cloud_attachment_manage' => 
  array (
    'name' => '云附件',
    'visable' => '(cloudStatus())',
    'children' => 
    array (
      'admin_cloud_attachment' => 
      array (
        'name' => '云附件',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_cloud_attachment_manage',
  ),
  'admin_cloud_attachment' => 
  array (
    'name' => '云附件',
    'disable' => true,
    'parent' => 'admin_cloud_attachment_manage',
    'code' => 'admin_cloud_attachment',
  ),
  'admin_cloud_consult' => 
  array (
    'name' => '云问答',
    'router_name' => 'admin_cloud_consult_setting',
    'visable' => '(cloudStatus())',
    'children' => 
    array (
      'admin_cloud_consult_setting' => 
      array (
        'name' => '设置',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_cloud_consult',
  ),
  'admin_cloud_consult_setting' => 
  array (
    'name' => '设置',
    'disable' => true,
    'parent' => 'admin_cloud_consult',
    'code' => 'admin_cloud_consult_setting',
  ),
  'admin_setting_cloud' => 
  array (
    'name' => '授权信息',
    'children' => 
    array (
      'admin_setting_my_cloud' => 
      array (
        'name' => '授权信息',
        'router_name' => 'admin_setting_cloud',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_app',
    'code' => 'admin_setting_cloud',
  ),
  'admin_setting_my_cloud' => 
  array (
    'name' => '授权信息',
    'router_name' => 'admin_setting_cloud',
    'disable' => true,
    'parent' => 'admin_setting_cloud',
    'code' => 'admin_setting_my_cloud',
  ),
  'admin_system' => 
  array (
    'name' => '系统',
    'router_name' => 'admin_setting_site',
    'children' => 
    array (
      'admin_setting' => 
      array (
        'name' => '站点设置',
        'router_name' => 'admin_setting_site',
        'children' => 
        array (
          'admin_setting_message' => 
          array (
            'name' => '基础信息',
            'router_name' => 'admin_setting_site',
            'disable' => true,
          ),
          'admin_setting_theme' => 
          array (
            'name' => '主题',
            'disable' => true,
          ),
          'admin_setting_mailer' => 
          array (
            'name' => '邮件服务器设置',
            'disable' => true,
          ),
          'admin_top_navigation' => 
          array (
            'name' => '顶部导航',
            'router_name' => 'admin_navigation',
            'disable' => true,
            'router_params' => 
            array (
              'type' => 'top',
            ),
          ),
          'admin_foot_navigation' => 
          array (
            'name' => '底部导航',
            'router_name' => 'admin_navigation',
            'disable' => true,
            'router_params' => 
            array (
              'type' => 'foot',
            ),
          ),
          'admin_friendlyLink_navigation' => 
          array (
            'name' => '友情链接',
            'router_name' => 'admin_navigation',
            'disable' => true,
            'router_params' => 
            array (
              'type' => 'friendlyLink',
            ),
          ),
          'admin_setting_consult_setting' => 
          array (
            'name' => '客服',
            'disable' => true,
          ),
          'admin_setting_es_bar' => 
          array (
            'name' => '侧边栏',
            'disable' => true,
          ),
          'admin_setting_share' => 
          array (
            'name' => '分享',
            'disable' => true,
          ),
          'admin_setting_security' => 
          array (
            'name' => '安全',
            'disable' => true,
          ),
        ),
      ),
      'admin_setting_user' => 
      array (
        'name' => '用户设置',
        'children' => 
        array (
          'admin_user_auth' => 
          array (
            'name' => '注册',
            'disable' => true,
            'router_name' => 'admin_setting_auth',
          ),
          'admin_setting_login_bind' => 
          array (
            'name' => '登录',
            'disable' => true,
          ),
          'admin_setting_user_center' => 
          array (
            'name' => '用户中心',
            'disable' => true,
          ),
          'admin_setting_user_fields' => 
          array (
            'name' => '用户信息设置',
            'disable' => true,
          ),
          'admin_setting_avatar' => 
          array (
            'name' => '默认头像',
            'disable' => true,
          ),
        ),
      ),
      'admin_roles' => 
      array (
        'name' => '角色管理',
        'children' => 
        array (
          'admin_role_manage' => 
          array (
            'name' => '角色管理',
            'disable' => true,
            'router_name' => 'admin_roles',
            'children' => 
            array (
              'admin_role_create' => 
              array (
                'name' => '新增角色',
                'mode' => 'modal',
                'group' => 'topBtn',
              ),
              'admin_role_edit' => 
              array (
                'name' => '编辑角色',
                'mode' => 'modal',
                'group' => 'groupBtn',
                'router_params' => 
                array (
                  'id' => '(role.id)',
                ),
              ),
              'admin_role_delete' => 
              array (
                'name' => '删除角色',
                'class' => 'role-delete js-delete-role',
                'group' => 'groupBtn',
                'mode' => 'none',
                'router_params' => 
                array (
                  'id' => '(role.id)',
                ),
              ),
            ),
          ),
        ),
      ),
      'admin_setting_course_setting' => 
      array (
        'name' => '课程设置',
        'children' => 
        array (
          'admin_setting_course' => 
          array (
            'name' => '课程',
            'disable' => true,
            'router_name' => 'admin_setting_course_setting',
          ),
          'admin_setting_questions_setting' => 
          array (
            'name' => '题库',
            'disable' => true,
          ),
          'admin_setting_course_avatar' => 
          array (
            'name' => '默认图片',
            'disable' => true,
          ),
          'admin_classroom_setting' => 
          array (
            'name' => '班级',
            'disable' => true,
            'parent' => 'admin_setting_course_setting',
            'after' => 'admin_setting_live_course',
          ),
        ),
      ),
      'admin_setting_operation' => 
      array (
        'name' => '运营设置',
        'children' => 
        array (
          'admin_article_setting' => 
          array (
            'name' => '资讯',
            'disable' => true,
          ),
          'admin_group_set' => 
          array (
            'name' => '小组',
            'disable' => true,
          ),
          'admin_invite_set' => 
          array (
            'name' => '邀请注册设置',
            'disable' => true,
          ),
          'admin_wap_set' => 
          array (
            'name' => '手机微网校',
            'disable' => true,
          ),
        ),
      ),
      'admin_setting_finance' => 
      array (
        'name' => '账务设置',
        'children' => 
        array (
          'admin_payment' => 
          array (
            'name' => '支付',
            'disable' => true,
            'router_name' => 'admin_setting_payment',
          ),
          'admin_coin_settings' => 
          array (
            'name' => '虚拟币',
            'disable' => true,
            'router_name' => 'admin_coin_settings',
          ),
          'admin_setting_refund' => 
          array (
            'name' => '退款',
            'disable' => true,
          ),
        ),
      ),
      'admin_setting_mobile' => 
      array (
        'name' => '移动端设置',
        'children' => 
        array (
          'admin_setting_mobile_settings' => 
          array (
            'name' => '移动端设置',
            'disable' => true,
            'router_name' => 'admin_setting_mobile',
          ),
        ),
      ),
      'admin_setting_mobile_iap_product' => 
      array (
        'name' => 'IOS内购商品设置',
        'disable' => true,
        'visable' => '(setting(\'magic.enable_mobile_iap\', \'0\'))',
        'children' => 
        array (
          'admin_setting_mobile_iap_product_list' => 
          array (
            'name' => 'IOS内购商品设置',
            'router_name' => 'admin_setting_mobile_iap_product',
          ),
        ),
      ),
      'admin_optimize' => 
      array (
        'name' => '系统优化',
        'group' => 2,
        'children' => 
        array (
          'admin_optimize_settings' => 
          array (
            'name' => '系统优化',
            'disable' => true,
            'router_name' => 'admin_optimize',
          ),
        ),
      ),
      'admin_jobs' => 
      array (
        'name' => '定时任务',
        'group' => 2,
        'children' => 
        array (
          'admin_jobs_manage' => 
          array (
            'name' => '定时任务',
            'disable' => true,
            'router_name' => 'admin_jobs',
          ),
        ),
      ),
      'admin_setting_ip_blacklist' => 
      array (
        'name' => 'IP黑名单',
        'group' => 2,
        'children' => 
        array (
          'admin_setting_ip_blacklist_manage' => 
          array (
            'name' => 'IP黑名单',
            'disable' => true,
            'router_name' => 'admin_setting_ip_blacklist',
          ),
        ),
      ),
      'admin_setting_post_num_rules' => 
      array (
        'name' => '发帖限制设置',
        'group' => 2,
        'children' => 
        array (
          'admin_setting_post_num_rules_settings' => 
          array (
            'name' => '发帖限制设置',
            'disable' => true,
            'router_name' => 'admin_setting_post_num_rules',
          ),
        ),
      ),
      'admin_report_status' => 
      array (
        'name' => '系统自检',
        'group' => 2,
        'children' => 
        array (
          'admin_report_status_list' => 
          array (
            'name' => '系统自检',
            'disable' => true,
            'router_name' => 'admin_report_status',
          ),
        ),
      ),
      'admin_logs' => 
      array (
        'name' => '系统日志',
        'group' => 2,
        'children' => 
        array (
          'admin_logs_query' => 
          array (
            'name' => '系统操作日志',
            'disable' => true,
            'router_name' => 'admin_logs',
          ),
          'admin_logs_prod' => 
          array (
            'name' => '程序运行日志',
            'disable' => true,
          ),
        ),
      ),
      'admin_org_manage' => 
      array (
        'name' => '组织机构管理',
        'parent' => 'admin_system',
        'group' => 2,
        'disable' => true,
        'visable' => false,
        'children' => 
        array (
          'admin_org' => 
          array (
            'name' => '组织机构',
            'disable' => true,
          ),
        ),
      ),
    ),
    'parent' => 'admin',
    'code' => 'admin_system',
  ),
  'admin_setting' => 
  array (
    'name' => '站点设置',
    'router_name' => 'admin_setting_site',
    'children' => 
    array (
      'admin_setting_message' => 
      array (
        'name' => '基础信息',
        'router_name' => 'admin_setting_site',
        'disable' => true,
      ),
      'admin_setting_theme' => 
      array (
        'name' => '主题',
        'disable' => true,
      ),
      'admin_setting_mailer' => 
      array (
        'name' => '邮件服务器设置',
        'disable' => true,
      ),
      'admin_top_navigation' => 
      array (
        'name' => '顶部导航',
        'router_name' => 'admin_navigation',
        'disable' => true,
        'router_params' => 
        array (
          'type' => 'top',
        ),
      ),
      'admin_foot_navigation' => 
      array (
        'name' => '底部导航',
        'router_name' => 'admin_navigation',
        'disable' => true,
        'router_params' => 
        array (
          'type' => 'foot',
        ),
      ),
      'admin_friendlyLink_navigation' => 
      array (
        'name' => '友情链接',
        'router_name' => 'admin_navigation',
        'disable' => true,
        'router_params' => 
        array (
          'type' => 'friendlyLink',
        ),
      ),
      'admin_setting_consult_setting' => 
      array (
        'name' => '客服',
        'disable' => true,
      ),
      'admin_setting_es_bar' => 
      array (
        'name' => '侧边栏',
        'disable' => true,
      ),
      'admin_setting_share' => 
      array (
        'name' => '分享',
        'disable' => true,
      ),
      'admin_setting_security' => 
      array (
        'name' => '安全',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting',
  ),
  'admin_setting_message' => 
  array (
    'name' => '基础信息',
    'router_name' => 'admin_setting_site',
    'disable' => true,
    'parent' => 'admin_setting',
    'code' => 'admin_setting_message',
  ),
  'admin_setting_theme' => 
  array (
    'name' => '主题',
    'disable' => true,
    'parent' => 'admin_setting',
    'code' => 'admin_setting_theme',
  ),
  'admin_setting_mailer' => 
  array (
    'name' => '邮件服务器设置',
    'disable' => true,
    'parent' => 'admin_setting',
    'code' => 'admin_setting_mailer',
  ),
  'admin_top_navigation' => 
  array (
    'name' => '顶部导航',
    'router_name' => 'admin_navigation',
    'disable' => true,
    'router_params' => 
    array (
      'type' => 'top',
    ),
    'parent' => 'admin_setting',
    'code' => 'admin_top_navigation',
  ),
  'admin_foot_navigation' => 
  array (
    'name' => '底部导航',
    'router_name' => 'admin_navigation',
    'disable' => true,
    'router_params' => 
    array (
      'type' => 'foot',
    ),
    'parent' => 'admin_setting',
    'code' => 'admin_foot_navigation',
  ),
  'admin_friendlyLink_navigation' => 
  array (
    'name' => '友情链接',
    'router_name' => 'admin_navigation',
    'disable' => true,
    'router_params' => 
    array (
      'type' => 'friendlyLink',
    ),
    'parent' => 'admin_setting',
    'code' => 'admin_friendlyLink_navigation',
  ),
  'admin_setting_consult_setting' => 
  array (
    'name' => '客服',
    'disable' => true,
    'parent' => 'admin_setting',
    'code' => 'admin_setting_consult_setting',
  ),
  'admin_setting_es_bar' => 
  array (
    'name' => '侧边栏',
    'disable' => true,
    'parent' => 'admin_setting',
    'code' => 'admin_setting_es_bar',
  ),
  'admin_setting_share' => 
  array (
    'name' => '分享',
    'disable' => true,
    'parent' => 'admin_setting',
    'code' => 'admin_setting_share',
  ),
  'admin_setting_security' => 
  array (
    'name' => '安全',
    'disable' => true,
    'parent' => 'admin_setting',
    'code' => 'admin_setting_security',
  ),
  'admin_setting_user' => 
  array (
    'name' => '用户设置',
    'children' => 
    array (
      'admin_user_auth' => 
      array (
        'name' => '注册',
        'disable' => true,
        'router_name' => 'admin_setting_auth',
      ),
      'admin_setting_login_bind' => 
      array (
        'name' => '登录',
        'disable' => true,
      ),
      'admin_setting_user_center' => 
      array (
        'name' => '用户中心',
        'disable' => true,
      ),
      'admin_setting_user_fields' => 
      array (
        'name' => '用户信息设置',
        'disable' => true,
      ),
      'admin_setting_avatar' => 
      array (
        'name' => '默认头像',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_user',
  ),
  'admin_user_auth' => 
  array (
    'name' => '注册',
    'disable' => true,
    'router_name' => 'admin_setting_auth',
    'parent' => 'admin_setting_user',
    'code' => 'admin_user_auth',
  ),
  'admin_setting_login_bind' => 
  array (
    'name' => '登录',
    'disable' => true,
    'parent' => 'admin_setting_user',
    'code' => 'admin_setting_login_bind',
  ),
  'admin_setting_user_center' => 
  array (
    'name' => '用户中心',
    'disable' => true,
    'parent' => 'admin_setting_user',
    'code' => 'admin_setting_user_center',
  ),
  'admin_setting_user_fields' => 
  array (
    'name' => '用户信息设置',
    'disable' => true,
    'parent' => 'admin_setting_user',
    'code' => 'admin_setting_user_fields',
  ),
  'admin_setting_avatar' => 
  array (
    'name' => '默认头像',
    'disable' => true,
    'parent' => 'admin_setting_user',
    'code' => 'admin_setting_avatar',
  ),
  'admin_roles' => 
  array (
    'name' => '角色管理',
    'children' => 
    array (
      'admin_role_manage' => 
      array (
        'name' => '角色管理',
        'disable' => true,
        'router_name' => 'admin_roles',
        'children' => 
        array (
          'admin_role_create' => 
          array (
            'name' => '新增角色',
            'mode' => 'modal',
            'group' => 'topBtn',
          ),
          'admin_role_edit' => 
          array (
            'name' => '编辑角色',
            'mode' => 'modal',
            'group' => 'groupBtn',
            'router_params' => 
            array (
              'id' => '(role.id)',
            ),
          ),
          'admin_role_delete' => 
          array (
            'name' => '删除角色',
            'class' => 'role-delete js-delete-role',
            'group' => 'groupBtn',
            'mode' => 'none',
            'router_params' => 
            array (
              'id' => '(role.id)',
            ),
          ),
        ),
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_roles',
  ),
  'admin_role_manage' => 
  array (
    'name' => '角色管理',
    'disable' => true,
    'router_name' => 'admin_roles',
    'children' => 
    array (
      'admin_role_create' => 
      array (
        'name' => '新增角色',
        'mode' => 'modal',
        'group' => 'topBtn',
      ),
      'admin_role_edit' => 
      array (
        'name' => '编辑角色',
        'mode' => 'modal',
        'group' => 'groupBtn',
        'router_params' => 
        array (
          'id' => '(role.id)',
        ),
      ),
      'admin_role_delete' => 
      array (
        'name' => '删除角色',
        'class' => 'role-delete js-delete-role',
        'group' => 'groupBtn',
        'mode' => 'none',
        'router_params' => 
        array (
          'id' => '(role.id)',
        ),
      ),
    ),
    'parent' => 'admin_roles',
    'code' => 'admin_role_manage',
  ),
  'admin_role_create' => 
  array (
    'name' => '新增角色',
    'mode' => 'modal',
    'group' => 'topBtn',
    'parent' => 'admin_role_manage',
    'code' => 'admin_role_create',
  ),
  'admin_role_edit' => 
  array (
    'name' => '编辑角色',
    'mode' => 'modal',
    'group' => 'groupBtn',
    'router_params' => 
    array (
      'id' => '(role.id)',
    ),
    'parent' => 'admin_role_manage',
    'code' => 'admin_role_edit',
  ),
  'admin_role_delete' => 
  array (
    'name' => '删除角色',
    'class' => 'role-delete js-delete-role',
    'group' => 'groupBtn',
    'mode' => 'none',
    'router_params' => 
    array (
      'id' => '(role.id)',
    ),
    'parent' => 'admin_role_manage',
    'code' => 'admin_role_delete',
  ),
  'admin_setting_course_setting' => 
  array (
    'name' => '课程设置',
    'children' => 
    array (
      'admin_setting_course' => 
      array (
        'name' => '课程',
        'disable' => true,
        'router_name' => 'admin_setting_course_setting',
      ),
      'admin_setting_questions_setting' => 
      array (
        'name' => '题库',
        'disable' => true,
      ),
      'admin_setting_course_avatar' => 
      array (
        'name' => '默认图片',
        'disable' => true,
      ),
      'admin_classroom_setting' => 
      array (
        'name' => '班级',
        'disable' => true,
        'parent' => 'admin_setting_course_setting',
        'after' => 'admin_setting_live_course',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_course_setting',
  ),
  'admin_setting_course' => 
  array (
    'name' => '课程',
    'disable' => true,
    'router_name' => 'admin_setting_course_setting',
    'parent' => 'admin_setting_course_setting',
    'code' => 'admin_setting_course',
  ),
  'admin_setting_questions_setting' => 
  array (
    'name' => '题库',
    'disable' => true,
    'parent' => 'admin_setting_course_setting',
    'code' => 'admin_setting_questions_setting',
  ),
  'admin_setting_course_avatar' => 
  array (
    'name' => '默认图片',
    'disable' => true,
    'parent' => 'admin_setting_course_setting',
    'code' => 'admin_setting_course_avatar',
  ),
  'admin_classroom_setting' => 
  array (
    'name' => '班级',
    'disable' => true,
    'parent' => 'admin_setting_course_setting',
    'after' => 'admin_setting_live_course',
    'code' => 'admin_classroom_setting',
  ),
  'admin_setting_operation' => 
  array (
    'name' => '运营设置',
    'children' => 
    array (
      'admin_article_setting' => 
      array (
        'name' => '资讯',
        'disable' => true,
      ),
      'admin_group_set' => 
      array (
        'name' => '小组',
        'disable' => true,
      ),
      'admin_invite_set' => 
      array (
        'name' => '邀请注册设置',
        'disable' => true,
      ),
      'admin_wap_set' => 
      array (
        'name' => '手机微网校',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_operation',
  ),
  'admin_article_setting' => 
  array (
    'name' => '资讯',
    'disable' => true,
    'parent' => 'admin_setting_operation',
    'code' => 'admin_article_setting',
  ),
  'admin_group_set' => 
  array (
    'name' => '小组',
    'disable' => true,
    'parent' => 'admin_setting_operation',
    'code' => 'admin_group_set',
  ),
  'admin_invite_set' => 
  array (
    'name' => '邀请注册设置',
    'disable' => true,
    'parent' => 'admin_setting_operation',
    'code' => 'admin_invite_set',
  ),
  'admin_wap_set' => 
  array (
    'name' => '手机微网校',
    'disable' => true,
    'parent' => 'admin_setting_operation',
    'code' => 'admin_wap_set',
  ),
  'admin_setting_finance' => 
  array (
    'name' => '账务设置',
    'children' => 
    array (
      'admin_payment' => 
      array (
        'name' => '支付',
        'disable' => true,
        'router_name' => 'admin_setting_payment',
      ),
      'admin_coin_settings' => 
      array (
        'name' => '虚拟币',
        'disable' => true,
        'router_name' => 'admin_coin_settings',
      ),
      'admin_setting_refund' => 
      array (
        'name' => '退款',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_finance',
  ),
  'admin_payment' => 
  array (
    'name' => '支付',
    'disable' => true,
    'router_name' => 'admin_setting_payment',
    'parent' => 'admin_setting_finance',
    'code' => 'admin_payment',
  ),
  'admin_coin_settings' => 
  array (
    'name' => '虚拟币',
    'disable' => true,
    'router_name' => 'admin_coin_settings',
    'parent' => 'admin_setting_finance',
    'code' => 'admin_coin_settings',
  ),
  'admin_setting_refund' => 
  array (
    'name' => '退款',
    'disable' => true,
    'parent' => 'admin_setting_finance',
    'code' => 'admin_setting_refund',
  ),
  'admin_setting_mobile' => 
  array (
    'name' => '移动端设置',
    'children' => 
    array (
      'admin_setting_mobile_settings' => 
      array (
        'name' => '移动端设置',
        'disable' => true,
        'router_name' => 'admin_setting_mobile',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_mobile',
  ),
  'admin_setting_mobile_settings' => 
  array (
    'name' => '移动端设置',
    'disable' => true,
    'router_name' => 'admin_setting_mobile',
    'parent' => 'admin_setting_mobile',
    'code' => 'admin_setting_mobile_settings',
  ),
  'admin_setting_mobile_iap_product' => 
  array (
    'name' => 'IOS内购商品设置',
    'disable' => true,
    'visable' => '(setting(\'magic.enable_mobile_iap\', \'0\'))',
    'children' => 
    array (
      'admin_setting_mobile_iap_product_list' => 
      array (
        'name' => 'IOS内购商品设置',
        'router_name' => 'admin_setting_mobile_iap_product',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_mobile_iap_product',
  ),
  'admin_setting_mobile_iap_product_list' => 
  array (
    'name' => 'IOS内购商品设置',
    'router_name' => 'admin_setting_mobile_iap_product',
    'parent' => 'admin_setting_mobile_iap_product',
    'code' => 'admin_setting_mobile_iap_product_list',
  ),
  'admin_optimize' => 
  array (
    'name' => '系统优化',
    'group' => 2,
    'children' => 
    array (
      'admin_optimize_settings' => 
      array (
        'name' => '系统优化',
        'disable' => true,
        'router_name' => 'admin_optimize',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_optimize',
  ),
  'admin_optimize_settings' => 
  array (
    'name' => '系统优化',
    'disable' => true,
    'router_name' => 'admin_optimize',
    'parent' => 'admin_optimize',
    'code' => 'admin_optimize_settings',
  ),
  'admin_jobs' => 
  array (
    'name' => '定时任务',
    'group' => 2,
    'children' => 
    array (
      'admin_jobs_manage' => 
      array (
        'name' => '定时任务',
        'disable' => true,
        'router_name' => 'admin_jobs',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_jobs',
  ),
  'admin_jobs_manage' => 
  array (
    'name' => '定时任务',
    'disable' => true,
    'router_name' => 'admin_jobs',
    'parent' => 'admin_jobs',
    'code' => 'admin_jobs_manage',
  ),
  'admin_setting_ip_blacklist' => 
  array (
    'name' => 'IP黑名单',
    'group' => 2,
    'children' => 
    array (
      'admin_setting_ip_blacklist_manage' => 
      array (
        'name' => 'IP黑名单',
        'disable' => true,
        'router_name' => 'admin_setting_ip_blacklist',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_ip_blacklist',
  ),
  'admin_setting_ip_blacklist_manage' => 
  array (
    'name' => 'IP黑名单',
    'disable' => true,
    'router_name' => 'admin_setting_ip_blacklist',
    'parent' => 'admin_setting_ip_blacklist',
    'code' => 'admin_setting_ip_blacklist_manage',
  ),
  'admin_setting_post_num_rules' => 
  array (
    'name' => '发帖限制设置',
    'group' => 2,
    'children' => 
    array (
      'admin_setting_post_num_rules_settings' => 
      array (
        'name' => '发帖限制设置',
        'disable' => true,
        'router_name' => 'admin_setting_post_num_rules',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_setting_post_num_rules',
  ),
  'admin_setting_post_num_rules_settings' => 
  array (
    'name' => '发帖限制设置',
    'disable' => true,
    'router_name' => 'admin_setting_post_num_rules',
    'parent' => 'admin_setting_post_num_rules',
    'code' => 'admin_setting_post_num_rules_settings',
  ),
  'admin_report_status' => 
  array (
    'name' => '系统自检',
    'group' => 2,
    'children' => 
    array (
      'admin_report_status_list' => 
      array (
        'name' => '系统自检',
        'disable' => true,
        'router_name' => 'admin_report_status',
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_report_status',
  ),
  'admin_report_status_list' => 
  array (
    'name' => '系统自检',
    'disable' => true,
    'router_name' => 'admin_report_status',
    'parent' => 'admin_report_status',
    'code' => 'admin_report_status_list',
  ),
  'admin_logs' => 
  array (
    'name' => '系统日志',
    'group' => 2,
    'children' => 
    array (
      'admin_logs_query' => 
      array (
        'name' => '系统操作日志',
        'disable' => true,
        'router_name' => 'admin_logs',
      ),
      'admin_logs_prod' => 
      array (
        'name' => '程序运行日志',
        'disable' => true,
      ),
    ),
    'parent' => 'admin_system',
    'code' => 'admin_logs',
  ),
  'admin_logs_query' => 
  array (
    'name' => '系统操作日志',
    'disable' => true,
    'router_name' => 'admin_logs',
    'parent' => 'admin_logs',
    'code' => 'admin_logs_query',
  ),
  'admin_logs_prod' => 
  array (
    'name' => '程序运行日志',
    'disable' => true,
    'parent' => 'admin_logs',
    'code' => 'admin_logs_prod',
  ),
  'admin_org_manage' => 
  array (
    'name' => '组织机构管理',
    'parent' => 'admin_system',
    'group' => 2,
    'disable' => true,
    'visable' => false,
    'children' => 
    array (
      'admin_org' => 
      array (
        'name' => '组织机构',
        'disable' => true,
      ),
    ),
    'code' => 'admin_org_manage',
  ),
  'admin_org' => 
  array (
    'name' => '组织机构',
    'disable' => true,
    'parent' => 'admin_org_manage',
    'code' => 'admin_org',
  ),
  'web' => 
  array (
    'name' => '资源管理',
    'parent' => NULL,
    'disable' => true,
    'children' => 
    array (
      'course_manage' => 
      array (
        'name' => '课程管理',
        'children' => 
        array (
          'course_manage_info' => 
          array (
            'name' => '课程信息',
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
            'children' => 
            array (
              'course_manage_base' => 
              array (
                'name' => '基本信息',
                'data' => 
                array (
                  'side_nav' => 'base',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'course_manage_detail' => 
              array (
                'name' => '详细信息',
                'data' => 
                array (
                  'side_nav' => 'detail',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'course_manage_picture' => 
              array (
                'name' => '课程图片',
                'data' => 
                array (
                  'side_nav' => 'picture',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'course_manage_lesson' => 
              array (
                'name' => '课时管理',
                'data' => 
                array (
                  'side_nav' => 'lesson',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'live_course_manage_replay' => 
              array (
                'name' => '录播管理',
                'data' => 
                array (
                  'side_nav' => 'replay',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'course_manage_files' => 
              array (
                'name' => '文件管理',
                'data' => 
                array (
                  'side_nav' => 'files',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
            ),
          ),
          'course_manage_setting' => 
          array (
            'name' => '课程设置',
            'children' => 
            array (
              'course_manage_price' => 
              array (
                'name' => '价格设置',
                'data' => 
                array (
                  'side_nav' => 'price',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'course_manage_teachers' => 
              array (
                'name' => '教师设置',
                'data' => 
                array (
                  'side_nav' => 'teachers',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'course_manage_students' => 
              array (
                'name' => '学员设置',
                'data' => 
                array (
                  'side_nav' => 'students',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
                'children' => 
                array (
                  'course_manage_student_create' => 
                  array (
                    'name' => '添加学员',
                  ),
                ),
              ),
            ),
          ),
          'course_manage_questions' => 
          array (
            'name' => '题库',
            'children' => 
            array (
              'course_manage_question' => 
              array (
                'name' => '题目设置',
                'data' => 
                array (
                  'side_nav' => 'question',
                ),
                'router_params' => 
                array (
                  'courseId' => '(course.id)',
                ),
              ),
              'course_manage_testpaper' => 
              array (
                'name' => '试卷管理',
                'data' => 
                array (
                  'side_nav' => 'testpaper',
                ),
                'router_params' => 
                array (
                  'courseId' => '(course.id)',
                ),
              ),
            ),
          ),
          'course_manange_operate' => 
          array (
            'name' => '课程运营',
            'children' => 
            array (
              'course_manage_data' => 
              array (
                'name' => '课程学习数据',
                'data' => 
                array (
                  'side_nav' => 'course_manage_data',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
              'course_manage_order' => 
              array (
                'name' => '课程订单管理',
                'data' => 
                array (
                  'side_nav' => 'course_manage_order',
                ),
                'router_params' => 
                array (
                  'id' => '(course.id)',
                ),
              ),
            ),
          ),
        ),
      ),
      'classroom_manage' => 
      array (
        'name' => '班级管理',
        'children' => 
        array (
          'classroom_manage_settings' => 
          array (
            'name' => '班级设置',
            'children' => 
            array (
              'classroom_manage_set_info' => 
              array (
                'name' => '基本信息',
                'data' => 
                array (
                  'side_nav' => 'base',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_set_price' => 
              array (
                'name' => '价格设置',
                'data' => 
                array (
                  'side_nav' => 'price',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_set_picture' => 
              array (
                'name' => '封面设置',
                'data' => 
                array (
                  'side_nav' => 'picture',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_service' => 
              array (
                'name' => '服务设置',
                'data' => 
                array (
                  'side_nav' => 'service',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_headteacher' => 
              array (
                'name' => '班主任设置',
                'data' => 
                array (
                  'side_nav' => 'headTeacher',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_teachers' => 
              array (
                'name' => '教师设置',
                'data' => 
                array (
                  'side_nav' => 'teachers',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_assistants' => 
              array (
                'name' => '助教设置',
                'data' => 
                array (
                  'side_nav' => 'assistants',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
            ),
          ),
          'classroom_manage_content' => 
          array (
            'name' => '班级管理',
            'children' => 
            array (
              'classroom_manage_courses' => 
              array (
                'name' => '课程管理',
                'visable' => '(canManage)',
                'data' => 
                array (
                  'side_nav' => 'courses',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_students' => 
              array (
                'name' => '学员管理',
                'visable' => '(canManage)',
                'data' => 
                array (
                  'side_nav' => 'students',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                ),
              ),
              'classroom_manage_testpaper' => 
              array (
                'name' => '试卷批阅',
                'visable' => '(canHandle)',
                'data' => 
                array (
                  'side_nav' => 'testpaper-check',
                ),
                'router_params' => 
                array (
                  'id' => '(classroom.id)',
                  'status' => 'reviewing',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'code' => 'web',
  ),
  'course_manage' => 
  array (
    'name' => '课程管理',
    'children' => 
    array (
      'course_manage_info' => 
      array (
        'name' => '课程信息',
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
        'children' => 
        array (
          'course_manage_base' => 
          array (
            'name' => '基本信息',
            'data' => 
            array (
              'side_nav' => 'base',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'course_manage_detail' => 
          array (
            'name' => '详细信息',
            'data' => 
            array (
              'side_nav' => 'detail',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'course_manage_picture' => 
          array (
            'name' => '课程图片',
            'data' => 
            array (
              'side_nav' => 'picture',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'course_manage_lesson' => 
          array (
            'name' => '课时管理',
            'data' => 
            array (
              'side_nav' => 'lesson',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'live_course_manage_replay' => 
          array (
            'name' => '录播管理',
            'data' => 
            array (
              'side_nav' => 'replay',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'course_manage_files' => 
          array (
            'name' => '文件管理',
            'data' => 
            array (
              'side_nav' => 'files',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
        ),
      ),
      'course_manage_setting' => 
      array (
        'name' => '课程设置',
        'children' => 
        array (
          'course_manage_price' => 
          array (
            'name' => '价格设置',
            'data' => 
            array (
              'side_nav' => 'price',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'course_manage_teachers' => 
          array (
            'name' => '教师设置',
            'data' => 
            array (
              'side_nav' => 'teachers',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'course_manage_students' => 
          array (
            'name' => '学员设置',
            'data' => 
            array (
              'side_nav' => 'students',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
            'children' => 
            array (
              'course_manage_student_create' => 
              array (
                'name' => '添加学员',
              ),
            ),
          ),
        ),
      ),
      'course_manage_questions' => 
      array (
        'name' => '题库',
        'children' => 
        array (
          'course_manage_question' => 
          array (
            'name' => '题目设置',
            'data' => 
            array (
              'side_nav' => 'question',
            ),
            'router_params' => 
            array (
              'courseId' => '(course.id)',
            ),
          ),
          'course_manage_testpaper' => 
          array (
            'name' => '试卷管理',
            'data' => 
            array (
              'side_nav' => 'testpaper',
            ),
            'router_params' => 
            array (
              'courseId' => '(course.id)',
            ),
          ),
        ),
      ),
      'course_manange_operate' => 
      array (
        'name' => '课程运营',
        'children' => 
        array (
          'course_manage_data' => 
          array (
            'name' => '课程学习数据',
            'data' => 
            array (
              'side_nav' => 'course_manage_data',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
          'course_manage_order' => 
          array (
            'name' => '课程订单管理',
            'data' => 
            array (
              'side_nav' => 'course_manage_order',
            ),
            'router_params' => 
            array (
              'id' => '(course.id)',
            ),
          ),
        ),
      ),
    ),
    'parent' => 'web',
    'code' => 'course_manage',
  ),
  'course_manage_info' => 
  array (
    'name' => '课程信息',
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'children' => 
    array (
      'course_manage_base' => 
      array (
        'name' => '基本信息',
        'data' => 
        array (
          'side_nav' => 'base',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'course_manage_detail' => 
      array (
        'name' => '详细信息',
        'data' => 
        array (
          'side_nav' => 'detail',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'course_manage_picture' => 
      array (
        'name' => '课程图片',
        'data' => 
        array (
          'side_nav' => 'picture',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'course_manage_lesson' => 
      array (
        'name' => '课时管理',
        'data' => 
        array (
          'side_nav' => 'lesson',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'live_course_manage_replay' => 
      array (
        'name' => '录播管理',
        'data' => 
        array (
          'side_nav' => 'replay',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'course_manage_files' => 
      array (
        'name' => '文件管理',
        'data' => 
        array (
          'side_nav' => 'files',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
    ),
    'parent' => 'course_manage',
    'code' => 'course_manage_info',
  ),
  'course_manage_base' => 
  array (
    'name' => '基本信息',
    'data' => 
    array (
      'side_nav' => 'base',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_info',
    'code' => 'course_manage_base',
  ),
  'course_manage_detail' => 
  array (
    'name' => '详细信息',
    'data' => 
    array (
      'side_nav' => 'detail',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_info',
    'code' => 'course_manage_detail',
  ),
  'course_manage_picture' => 
  array (
    'name' => '课程图片',
    'data' => 
    array (
      'side_nav' => 'picture',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_info',
    'code' => 'course_manage_picture',
  ),
  'course_manage_lesson' => 
  array (
    'name' => '课时管理',
    'data' => 
    array (
      'side_nav' => 'lesson',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_info',
    'code' => 'course_manage_lesson',
  ),
  'live_course_manage_replay' => 
  array (
    'name' => '录播管理',
    'data' => 
    array (
      'side_nav' => 'replay',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_info',
    'code' => 'live_course_manage_replay',
  ),
  'course_manage_files' => 
  array (
    'name' => '文件管理',
    'data' => 
    array (
      'side_nav' => 'files',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_info',
    'code' => 'course_manage_files',
  ),
  'course_manage_setting' => 
  array (
    'name' => '课程设置',
    'children' => 
    array (
      'course_manage_price' => 
      array (
        'name' => '价格设置',
        'data' => 
        array (
          'side_nav' => 'price',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'course_manage_teachers' => 
      array (
        'name' => '教师设置',
        'data' => 
        array (
          'side_nav' => 'teachers',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'course_manage_students' => 
      array (
        'name' => '学员设置',
        'data' => 
        array (
          'side_nav' => 'students',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
        'children' => 
        array (
          'course_manage_student_create' => 
          array (
            'name' => '添加学员',
          ),
        ),
      ),
    ),
    'parent' => 'course_manage',
    'code' => 'course_manage_setting',
  ),
  'course_manage_price' => 
  array (
    'name' => '价格设置',
    'data' => 
    array (
      'side_nav' => 'price',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_setting',
    'code' => 'course_manage_price',
  ),
  'course_manage_teachers' => 
  array (
    'name' => '教师设置',
    'data' => 
    array (
      'side_nav' => 'teachers',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manage_setting',
    'code' => 'course_manage_teachers',
  ),
  'course_manage_students' => 
  array (
    'name' => '学员设置',
    'data' => 
    array (
      'side_nav' => 'students',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'children' => 
    array (
      'course_manage_student_create' => 
      array (
        'name' => '添加学员',
      ),
    ),
    'parent' => 'course_manage_setting',
    'code' => 'course_manage_students',
  ),
  'course_manage_student_create' => 
  array (
    'name' => '添加学员',
    'parent' => 'course_manage_students',
    'code' => 'course_manage_student_create',
  ),
  'course_manage_questions' => 
  array (
    'name' => '题库',
    'children' => 
    array (
      'course_manage_question' => 
      array (
        'name' => '题目设置',
        'data' => 
        array (
          'side_nav' => 'question',
        ),
        'router_params' => 
        array (
          'courseId' => '(course.id)',
        ),
      ),
      'course_manage_testpaper' => 
      array (
        'name' => '试卷管理',
        'data' => 
        array (
          'side_nav' => 'testpaper',
        ),
        'router_params' => 
        array (
          'courseId' => '(course.id)',
        ),
      ),
    ),
    'parent' => 'course_manage',
    'code' => 'course_manage_questions',
  ),
  'course_manage_question' => 
  array (
    'name' => '题目设置',
    'data' => 
    array (
      'side_nav' => 'question',
    ),
    'router_params' => 
    array (
      'courseId' => '(course.id)',
    ),
    'parent' => 'course_manage_questions',
    'code' => 'course_manage_question',
  ),
  'course_manage_testpaper' => 
  array (
    'name' => '试卷管理',
    'data' => 
    array (
      'side_nav' => 'testpaper',
    ),
    'router_params' => 
    array (
      'courseId' => '(course.id)',
    ),
    'parent' => 'course_manage_questions',
    'code' => 'course_manage_testpaper',
  ),
  'course_manange_operate' => 
  array (
    'name' => '课程运营',
    'children' => 
    array (
      'course_manage_data' => 
      array (
        'name' => '课程学习数据',
        'data' => 
        array (
          'side_nav' => 'course_manage_data',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
      'course_manage_order' => 
      array (
        'name' => '课程订单管理',
        'data' => 
        array (
          'side_nav' => 'course_manage_order',
        ),
        'router_params' => 
        array (
          'id' => '(course.id)',
        ),
      ),
    ),
    'parent' => 'course_manage',
    'code' => 'course_manange_operate',
  ),
  'course_manage_data' => 
  array (
    'name' => '课程学习数据',
    'data' => 
    array (
      'side_nav' => 'course_manage_data',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manange_operate',
    'code' => 'course_manage_data',
  ),
  'course_manage_order' => 
  array (
    'name' => '课程订单管理',
    'data' => 
    array (
      'side_nav' => 'course_manage_order',
    ),
    'router_params' => 
    array (
      'id' => '(course.id)',
    ),
    'parent' => 'course_manange_operate',
    'code' => 'course_manage_order',
  ),
  'classroom_manage' => 
  array (
    'name' => '班级管理',
    'children' => 
    array (
      'classroom_manage_settings' => 
      array (
        'name' => '班级设置',
        'children' => 
        array (
          'classroom_manage_set_info' => 
          array (
            'name' => '基本信息',
            'data' => 
            array (
              'side_nav' => 'base',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_set_price' => 
          array (
            'name' => '价格设置',
            'data' => 
            array (
              'side_nav' => 'price',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_set_picture' => 
          array (
            'name' => '封面设置',
            'data' => 
            array (
              'side_nav' => 'picture',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_service' => 
          array (
            'name' => '服务设置',
            'data' => 
            array (
              'side_nav' => 'service',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_headteacher' => 
          array (
            'name' => '班主任设置',
            'data' => 
            array (
              'side_nav' => 'headTeacher',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_teachers' => 
          array (
            'name' => '教师设置',
            'data' => 
            array (
              'side_nav' => 'teachers',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_assistants' => 
          array (
            'name' => '助教设置',
            'data' => 
            array (
              'side_nav' => 'assistants',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
        ),
      ),
      'classroom_manage_content' => 
      array (
        'name' => '班级管理',
        'children' => 
        array (
          'classroom_manage_courses' => 
          array (
            'name' => '课程管理',
            'visable' => '(canManage)',
            'data' => 
            array (
              'side_nav' => 'courses',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_students' => 
          array (
            'name' => '学员管理',
            'visable' => '(canManage)',
            'data' => 
            array (
              'side_nav' => 'students',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
            ),
          ),
          'classroom_manage_testpaper' => 
          array (
            'name' => '试卷批阅',
            'visable' => '(canHandle)',
            'data' => 
            array (
              'side_nav' => 'testpaper-check',
            ),
            'router_params' => 
            array (
              'id' => '(classroom.id)',
              'status' => 'reviewing',
            ),
          ),
        ),
      ),
    ),
    'parent' => 'web',
    'code' => 'classroom_manage',
  ),
  'classroom_manage_settings' => 
  array (
    'name' => '班级设置',
    'children' => 
    array (
      'classroom_manage_set_info' => 
      array (
        'name' => '基本信息',
        'data' => 
        array (
          'side_nav' => 'base',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_set_price' => 
      array (
        'name' => '价格设置',
        'data' => 
        array (
          'side_nav' => 'price',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_set_picture' => 
      array (
        'name' => '封面设置',
        'data' => 
        array (
          'side_nav' => 'picture',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_service' => 
      array (
        'name' => '服务设置',
        'data' => 
        array (
          'side_nav' => 'service',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_headteacher' => 
      array (
        'name' => '班主任设置',
        'data' => 
        array (
          'side_nav' => 'headTeacher',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_teachers' => 
      array (
        'name' => '教师设置',
        'data' => 
        array (
          'side_nav' => 'teachers',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_assistants' => 
      array (
        'name' => '助教设置',
        'data' => 
        array (
          'side_nav' => 'assistants',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
    ),
    'parent' => 'classroom_manage',
    'code' => 'classroom_manage_settings',
  ),
  'classroom_manage_set_info' => 
  array (
    'name' => '基本信息',
    'data' => 
    array (
      'side_nav' => 'base',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_settings',
    'code' => 'classroom_manage_set_info',
  ),
  'classroom_manage_set_price' => 
  array (
    'name' => '价格设置',
    'data' => 
    array (
      'side_nav' => 'price',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_settings',
    'code' => 'classroom_manage_set_price',
  ),
  'classroom_manage_set_picture' => 
  array (
    'name' => '封面设置',
    'data' => 
    array (
      'side_nav' => 'picture',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_settings',
    'code' => 'classroom_manage_set_picture',
  ),
  'classroom_manage_service' => 
  array (
    'name' => '服务设置',
    'data' => 
    array (
      'side_nav' => 'service',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_settings',
    'code' => 'classroom_manage_service',
  ),
  'classroom_manage_headteacher' => 
  array (
    'name' => '班主任设置',
    'data' => 
    array (
      'side_nav' => 'headTeacher',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_settings',
    'code' => 'classroom_manage_headteacher',
  ),
  'classroom_manage_teachers' => 
  array (
    'name' => '教师设置',
    'data' => 
    array (
      'side_nav' => 'teachers',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_settings',
    'code' => 'classroom_manage_teachers',
  ),
  'classroom_manage_assistants' => 
  array (
    'name' => '助教设置',
    'data' => 
    array (
      'side_nav' => 'assistants',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_settings',
    'code' => 'classroom_manage_assistants',
  ),
  'classroom_manage_content' => 
  array (
    'name' => '班级管理',
    'children' => 
    array (
      'classroom_manage_courses' => 
      array (
        'name' => '课程管理',
        'visable' => '(canManage)',
        'data' => 
        array (
          'side_nav' => 'courses',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_students' => 
      array (
        'name' => '学员管理',
        'visable' => '(canManage)',
        'data' => 
        array (
          'side_nav' => 'students',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
        ),
      ),
      'classroom_manage_testpaper' => 
      array (
        'name' => '试卷批阅',
        'visable' => '(canHandle)',
        'data' => 
        array (
          'side_nav' => 'testpaper-check',
        ),
        'router_params' => 
        array (
          'id' => '(classroom.id)',
          'status' => 'reviewing',
        ),
      ),
    ),
    'parent' => 'classroom_manage',
    'code' => 'classroom_manage_content',
  ),
  'classroom_manage_courses' => 
  array (
    'name' => '课程管理',
    'visable' => '(canManage)',
    'data' => 
    array (
      'side_nav' => 'courses',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_content',
    'code' => 'classroom_manage_courses',
  ),
  'classroom_manage_students' => 
  array (
    'name' => '学员管理',
    'visable' => '(canManage)',
    'data' => 
    array (
      'side_nav' => 'students',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
    ),
    'parent' => 'classroom_manage_content',
    'code' => 'classroom_manage_students',
  ),
  'classroom_manage_testpaper' => 
  array (
    'name' => '试卷批阅',
    'visable' => '(canHandle)',
    'data' => 
    array (
      'side_nav' => 'testpaper-check',
    ),
    'router_params' => 
    array (
      'id' => '(classroom.id)',
      'status' => 'reviewing',
    ),
    'parent' => 'classroom_manage_content',
    'code' => 'classroom_manage_testpaper',
  ),
);