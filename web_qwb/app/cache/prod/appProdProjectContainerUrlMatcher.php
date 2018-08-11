<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/api')) {
            // api_entrypoint_start
            if (preg_match('#^/api/(?P<res1>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

            // api_entrypoint_start_1
            if (preg_match('#^/api/(?P<res1>[^/]++)/(?P<slug1>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start_1')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

            // api_entrypoint_start_2
            if (preg_match('#^/api/(?P<res1>[^/]++)/(?P<slug1>[^/]++)/(?P<res2>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start_2')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

            // api_entrypoint_start_3
            if (preg_match('#^/api/(?P<res1>[^/]++)/(?P<slug1>[^/]++)/(?P<res2>[^/]++)/(?P<slug2>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start_3')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

            // api_entrypoint_start_4
            if (preg_match('#^/api/(?P<res1>[^/]++)/(?P<slug1>[^/]++)/(?P<res2>[^/]++)/(?P<slug2>[^/]++)/(?P<res3>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start_4')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

            // api_entrypoint_start_5
            if (preg_match('#^/api/(?P<res1>[^/]++)/(?P<slug1>[^/]++)/(?P<res2>[^/]++)/(?P<slug2>[^/]++)/(?P<res3>[^/]++)/(?P<slug3>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start_5')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

            // api_entrypoint_start_6
            if (preg_match('#^/api/(?P<res1>[^/]++)/(?P<slug1>[^/]++)/(?P<res2>[^/]++)/(?P<slug2>[^/]++)/(?P<res3>[^/]++)/(?P<slug3>[^/]++)/(?P<res4>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start_6')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

            // api_entrypoint_start_7
            if (preg_match('#^/api/(?P<res1>[^/]++)/(?P<slug1>[^/]++)/(?P<res2>[^/]++)/(?P<slug2>[^/]++)/(?P<res3>[^/]++)/(?P<slug3>[^/]++)/(?P<res4>[^/]++)/(?P<slug4>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_entrypoint_start_7')), array (  '_controller' => 'ApiBundle\\Controller\\EntryPointController::startAction',  '_permission' => '',));
            }

        }

        // bazinga_jstranslation_js
        if (0 === strpos($pathinfo, '/translations') && preg_match('#^/translations(?:/(?P<domain>[\\w]+)(?:\\.(?P<_format>js|json))?)?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_bazinga_jstranslation_js;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'bazinga_jstranslation_js')), array (  '_controller' => 'bazinga.jstranslation.controller:getTranslationsAction',  'domain' => 'messages',  '_format' => 'js',  '_permission' =>   array (  ),));
        }
        not_bazinga_jstranslation_js:

        if (0 === strpos($pathinfo, '/mapi_v2')) {
            // mapi_order_submit_pay_request
            if (0 === strpos($pathinfo, '/mapi_v2/order') && preg_match('#^/mapi_v2/order/(?P<id>[^/]++)/submit_pay_request$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_mapi_order_submit_pay_request;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'mapi_order_submit_pay_request')), array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileOrderController::submitPayRequestAction',  '_permission' =>   array (  ),));
            }
            not_mapi_order_submit_pay_request:

            // mapi_mobile_teacher_app
            if ($pathinfo === '/mapi_v2/teacherApp') {
                return array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\TeacherAppController::indexAction',  '_route' => 'mapi_mobile_teacher_app',  '_permission' =>   array (  ),);
            }

            // topxia_mobile_alipay_notify
            if (0 === strpos($pathinfo, '/mapi_v2/pay') && preg_match('#^/mapi_v2/pay/(?P<name>[^/]++)/alipay_notify$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'topxia_mobile_alipay_notify')), array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileAlipayController::payNotifyAction',  '_permission' =>   array (  ),));
            }

            // topxia_mobile_alipay_pay
            if ($pathinfo === '/mapi_v2/alipay_pay') {
                return array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileAlipayController::payAction',  '_route' => 'topxia_mobile_alipay_pay',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/mapi_v2/pay')) {
                // topxia_mobile_alipay_merchant
                if (preg_match('#^/mapi_v2/pay/(?P<name>[^/]++)/alipay_merchant$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'topxia_mobile_alipay_merchant')), array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileAlipayController::payMerchantAction',  '_permission' =>   array (  ),));
                }

                // topxia_mobile_alipay_callback
                if (preg_match('#^/mapi_v2/pay/(?P<name>[^/]++)/alipay_callback$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'topxia_mobile_alipay_callback')), array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileAlipayController::payCallBackAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/mapi_v2/mobile')) {
                if (0 === strpos($pathinfo, '/mapi_v2/mobile/main')) {
                    // mapi_mobile_esmobile_app
                    if ($pathinfo === '/mapi_v2/mobile/main') {
                        return array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileAppController::indexAction',  '_route' => 'mapi_mobile_esmobile_app',  '_permission' =>   array (  ),);
                    }

                    // mapi_mobile_esmobile_app_version
                    if ($pathinfo === '/mapi_v2/mobile/main/version') {
                        return array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileAppController::versionAction',  '_route' => 'mapi_mobile_esmobile_app_version',  '_permission' =>   array (  ),);
                    }

                }

                // mapi_mobile_esmobile_app_resource
                if (preg_match('#^/mapi_v2/mobile/(?P<code>[^/]++)/resource$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'mapi_mobile_esmobile_app_resource')), array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileAppController::resourceAction',  '_permission' =>   array (  ),));
                }

            }

            // mapi_mobile_api
            if (preg_match('#^/mapi_v2/(?P<service>[^/]++)/(?P<method>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_mapi_mobile_api;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'mapi_mobile_api')), array (  '_controller' => 'Topxia\\MobileBundleV2\\Controller\\MobileApiController::indexAction',  '_permission' =>   array (  ),));
            }
            not_mapi_mobile_api:

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'CustomBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/anon')) {
            // crontab_web
            if ($pathinfo === '/anon/crontab') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_crontab_web;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\CommonController::crontabAction',  '_route' => 'crontab_web',  '_permission' =>   array (  ),);
            }
            not_crontab_web:

            // jstranslation_js
            if (0 === strpos($pathinfo, '/anon/translations') && preg_match('#^/anon/translations(?:/(?P<domain>[\\w]+)(?:\\.(?P<_format>js|json))?)?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_jstranslation_js;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'jstranslation_js')), array (  '_controller' => 'bazinga.jstranslation.controller:getTranslationsAction',  'domain' => 'messages',  '_format' => 'js',  '_permission' =>   array (  ),));
            }
            not_jstranslation_js:

        }

        // switch_language
        if ($pathinfo === '/switch/language') {
            return array (  '_controller' => 'CustomBundle\\Controller\\DefaultController::translateAction',  '_route' => 'switch_language',  '_permission' =>   array (  ),);
        }

        // homepage_category
        if ($pathinfo === '/course/search') {
            return array (  '_controller' => 'CustomBundle\\Controller\\DefaultController::coursesCategoryAction',  '_route' => 'homepage_category',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/l')) {
            // live_jump
            if ($pathinfo === '/live/jump') {
                return array (  '_controller' => 'CustomBundle\\Controller\\DefaultController::jumpAction',  '_route' => 'live_jump',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/log')) {
                if (0 === strpos($pathinfo, '/login')) {
                    // login
                    if ($pathinfo === '/login') {
                        return array (  '_controller' => 'AppBundle\\Controller\\LoginController::indexAction',  '_route' => 'login',  '_permission' =>   array (  ),);
                    }

                    // login_check
                    if ($pathinfo === '/login_check') {
                        return array('_route' => 'login_check','_permission' => array (
            ));
                    }

                }

                // logout
                if ($pathinfo === '/logout') {
                    return array('_route' => 'logout','_permission' => array (
        ));
                }

                if (0 === strpos($pathinfo, '/login')) {
                    // login_ajax
                    if ($pathinfo === '/login/ajax') {
                        return array (  '_controller' => 'AppBundle\\Controller\\LoginController::ajaxAction',  '_route' => 'login_ajax',  '_permission' =>   array (  ),);
                    }

                    if (0 === strpos($pathinfo, '/login/bind')) {
                        // login_bind
                        if (preg_match('#^/login/bind/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_bind')), array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::indexAction',  '_permission' =>   array (  ),));
                        }

                        // login_bind_callback
                        if (preg_match('#^/login/bind/(?P<type>[^/]++)/callback$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_bind_callback')), array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::callbackAction',  '_permission' =>   array (  ),));
                        }

                        // login_bind_choose
                        if (preg_match('#^/login/bind/(?P<type>[^/]++)/choose$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_bind_choose')), array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::chooseAction',  '_permission' =>   array (  ),));
                        }

                        // login_bind_new
                        if (preg_match('#^/login/bind/(?P<type>[^/]++)/new$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_login_bind_new;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_bind_new')), array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::newAction',  '_permission' =>   array (  ),));
                        }
                        not_login_bind_new:

                        // login_bind_newset
                        if (preg_match('#^/login/bind/(?P<type>[^/]++)/newset$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_login_bind_newset;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_bind_newset')), array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::newSetAction',  '_permission' =>   array (  ),));
                        }
                        not_login_bind_newset:

                        // login_bind_exist
                        if (preg_match('#^/login/bind/(?P<type>[^/]++)/exist$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_login_bind_exist;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_bind_exist')), array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::existAction',  '_permission' =>   array (  ),));
                        }
                        not_login_bind_exist:

                        // login_bind_existbind
                        if ($pathinfo === '/login/bind/weixinmob/existbind') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_login_bind_existbind;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::existBindAction',  '_route' => 'login_bind_existbind',  '_permission' =>   array (  ),);
                        }
                        not_login_bind_existbind:

                    }

                    // login_bind_weixin
                    if ($pathinfo === '/login/weixinmob') {
                        return array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::weixinIndexAction',  '_route' => 'login_bind_weixin',  '_permission' =>   array (  ),);
                    }

                    // login_check_email
                    if ($pathinfo === '/login/check/email') {
                        return array (  '_controller' => 'AppBundle\\Controller\\LoginController::checkEmailAction',  '_route' => 'login_check_email',  '_permission' =>   array (  ),);
                    }

                    // login_bind_change
                    if (0 === strpos($pathinfo, '/login/bind') && preg_match('#^/login/bind/(?P<type>[^/]++)/changetoexist$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_bind_change')), array (  '_controller' => 'AppBundle\\Controller\\LoginBindController::changeToExistAction',  '_permission' =>   array (  ),));
                    }

                }

            }

        }

        // common_qrcode
        if ($pathinfo === '/common/qrcode') {
            return array (  '_controller' => 'AppBundle\\Controller\\CommonController::qrcodeAction',  '_route' => 'common_qrcode',  '_permission' =>   array (  ),);
        }

        // user_terms
        if ($pathinfo === '/userterms') {
            return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::userTermsAction',  '_route' => 'user_terms',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/register')) {
            // register
            if ($pathinfo === '/register') {
                return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::indexAction',  '_route' => 'register',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/register/su')) {
                // register_success
                if ($pathinfo === '/register/success') {
                    return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::successAction',  '_route' => 'register_success',  '_permission' =>   array (  ),);
                }

                // register_submited
                if (0 === strpos($pathinfo, '/register/submited') && preg_match('#^/register/submited/(?P<id>[^/]++)/(?P<hash>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'register_submited')), array (  '_controller' => 'AppBundle\\Controller\\RegisterController::submitedAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/register/email')) {
                if (0 === strpos($pathinfo, '/register/email/reset')) {
                    // register_reset_email
                    if (preg_match('#^/register/email/reset/(?P<id>[^/]++)/(?P<hash>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'register_reset_email')), array (  '_controller' => 'AppBundle\\Controller\\RegisterController::resetEmailAction',  '_permission' =>   array (  ),));
                    }

                    // register_reset_email_check
                    if ($pathinfo === '/register/email/reset/check') {
                        return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::resetEmailCheckAction',  '_route' => 'register_reset_email_check',  '_permission' =>   array (  ),);
                    }

                    // register_reset_email_verify
                    if ($pathinfo === '/register/email/reset/verify') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_register_reset_email_verify;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::resetEmailVerifyAction',  '_route' => 'register_reset_email_verify',  '_permission' =>   array (  ),);
                    }
                    not_register_reset_email_verify:

                }

                // register_email_send
                if (0 === strpos($pathinfo, '/register/email/send') && preg_match('#^/register/email/send/(?P<id>[^/]++)/(?P<hash>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_register_email_send;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'register_email_send')), array (  '_controller' => 'AppBundle\\Controller\\RegisterController::emailSendAction',  '_permission' =>   array (  ),));
                }
                not_register_email_send:

                // register_email_verify
                if (0 === strpos($pathinfo, '/register/email/verify') && preg_match('#^/register/email/verify/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'register_email_verify')), array (  '_controller' => 'AppBundle\\Controller\\RegisterController::emailVerifyAction',  '_permission' =>   array (  ),));
                }

                // register_email_check
                if ($pathinfo === '/register/email/check') {
                    return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::emailCheckAction',  '_route' => 'register_email_check',  '_permission' =>   array (  ),);
                }

            }

            // register_mobile_check
            if ($pathinfo === '/register/mobile/check') {
                return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::mobileCheckAction',  '_route' => 'register_mobile_check',  '_permission' =>   array (  ),);
            }

            // register_email_or_mobile_check
            if ($pathinfo === '/register/email_or_mobile/check') {
                return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::emailOrMobileCheckAction',  '_route' => 'register_email_or_mobile_check',  '_permission' =>   array (  ),);
            }

            // register_nickname_check
            if ($pathinfo === '/register/nickname/check') {
                return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::nicknameCheckAction',  '_route' => 'register_nickname_check',  '_permission' =>   array (  ),);
            }

            // invitecode_check
            if ($pathinfo === '/register/invitecode/check') {
                return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::invitecodeCheckAction',  '_route' => 'invitecode_check',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/register/captcha')) {
                // register_captcha_check
                if ($pathinfo === '/register/captcha/check') {
                    return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::captchaCheckAction',  '_route' => 'register_captcha_check',  '_permission' =>   array (  ),);
                }

                // register_captcha_modal
                if ($pathinfo === '/register/captcha/modal') {
                    return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::captchaModalAction',  '_route' => 'register_captcha_modal',  '_permission' =>   array (  ),);
                }

            }

            // register_analysis
            if ($pathinfo === '/register/analysis') {
                return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::analysisAction',  '_route' => 'register_analysis',  '_permission' =>   array (  ),);
            }

        }

        // register_captcha_num
        if ($pathinfo === '/captcha_num') {
            return array (  '_controller' => 'AppBundle\\Controller\\RegisterController::captchaAction',  '_route' => 'register_captcha_num',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/file')) {
            // file_upload
            if ($pathinfo === '/file/upload') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_file_upload;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\FileController::uploadAction',  '_route' => 'file_upload',  '_permission' =>   array (  ),);
            }
            not_file_upload:

            // file_img_crop
            if ($pathinfo === '/file/img/crop') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_file_img_crop;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\FileController::cropImgAction',  '_route' => 'file_img_crop',  '_permission' =>   array (  ),);
            }
            not_file_img_crop:

        }

        if (0 === strpos($pathinfo, '/attachment')) {
            // attachment_list
            if (0 === strpos($pathinfo, '/attachments') && preg_match('#^/attachments/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_attachment_list;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'attachment_list')), array (  '_controller' => 'AppBundle:Attachment:list',  '_permission' =>   array (  ),));
            }
            not_attachment_list:

            // attachment_form_fields
            if (preg_match('#^/attachment/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/formFields$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_attachment_form_fields;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'attachment_form_fields')), array (  '_controller' => 'AppBundle:Attachment:formFields',  'targetId' => 0,  '_permission' =>   array (  ),));
            }
            not_attachment_form_fields:

        }

        if (0 === strpos($pathinfo, '/upload')) {
            if (0 === strpos($pathinfo, '/uploader')) {
                // uploader_entry
                if ($pathinfo === '/uploader') {
                    return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::entryAction',  '_route' => 'uploader_entry',  '_permission' =>   array (  ),);
                }

                // uploader_init
                if ($pathinfo === '/uploader/init') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_uploader_init;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::initAction',  '_route' => 'uploader_init',  '_permission' =>   array (  ),);
                }
                not_uploader_init:

                // uploader_auth
                if ($pathinfo === '/uploader/auth') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'OPTIONS', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'OPTIONS', 'HEAD'));
                        goto not_uploader_auth;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::uploadAuthAction',  '_route' => 'uploader_auth',  '_permission' =>   array (  ),);
                }
                not_uploader_auth:

                // uploader_batch_upload
                if ($pathinfo === '/uploader/batch_upload') {
                    return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::batchUploadAction',  '_route' => 'uploader_batch_upload',  '_permission' =>   array (  ),);
                }

                // uploader_finished
                if ($pathinfo === '/uploader/finished') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_uploader_finished;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::finishedAction',  '_route' => 'uploader_finished',  '_permission' =>   array (  ),);
                }
                not_uploader_finished:

                // uploader_upload_callback
                if ($pathinfo === '/uploader/upload_callback') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_uploader_upload_callback;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::uploadCallbackAction',  '_route' => 'uploader_upload_callback',  '_permission' =>   array (  ),);
                }
                not_uploader_upload_callback:

                // uploader_process_callback
                if ($pathinfo === '/uploader/process_callback') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_uploader_process_callback;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::processCallbackAction',  '_route' => 'uploader_process_callback',  '_permission' =>   array (  ),);
                }
                not_uploader_process_callback:

                if (0 === strpos($pathinfo, '/uploader/chunks')) {
                    // uploader_chunks_start
                    if ($pathinfo === '/uploader/chunks/start') {
                        return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::chunksStartAction',  '_route' => 'uploader_chunks_start',  '_permission' =>   array (  ),);
                    }

                    // uploader_chunks_finish
                    if ($pathinfo === '/uploader/chunks/finish') {
                        return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::chunksFinishAction',  '_route' => 'uploader_chunks_finish',  '_permission' =>   array (  ),);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/uploadfile')) {
                // uploadfile_upload
                if ($pathinfo === '/uploadfile/upload') {
                    if (!in_array($this->context->getMethod(), array('POST', 'OPTIONS'))) {
                        $allow = array_merge($allow, array('POST', 'OPTIONS'));
                        goto not_uploadfile_upload;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\UploadFileController::uploadAction',  '_route' => 'uploadfile_upload',  '_permission' =>   array (  ),);
                }
                not_uploadfile_upload:

                // uploadfile_browser
                if ($pathinfo === '/uploadfile/browser') {
                    return array (  '_controller' => 'AppBundle\\Controller\\UploadFileController::browserAction',  '_route' => 'uploadfile_browser',  '_permission' =>   array (  ),);
                }

                // uploadfile_params
                if ($pathinfo === '/uploadfile/params') {
                    return array (  '_controller' => 'AppBundle\\Controller\\UploadFileController::paramsAction',  '_route' => 'uploadfile_params',  '_permission' =>   array (  ),);
                }

                // uploadfile_browsers
                if ($pathinfo === '/uploadfile/browsers') {
                    return array (  '_controller' => 'AppBundle\\Controller\\UploadFileController::browsersAction',  '_route' => 'uploadfile_browsers',  '_permission' =>   array (  ),);
                }

            }

        }

        // hls_playlist
        if (0 === strpos($pathinfo, '/hls') && preg_match('#^/hls/(?P<id>[^/]++)/playlist/(?P<token>[^/\\.]++)\\.m3u8$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'hls_playlist')), array (  '_controller' => 'AppBundle\\Controller\\HLSController::playlistAction',  '_permission' =>   array (  ),));
        }

        // player_local_media
        if (0 === strpos($pathinfo, '/player') && preg_match('#^/player/(?P<id>[^/]++)/file/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'player_local_media')), array (  '_controller' => 'AppBundle\\Controller\\PlayerController::localMediaAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/hls')) {
            // hls_stream
            if (preg_match('#^/hls/(?P<id>[^/]++)/stream/(?P<level>[^/]++)/(?P<token>[^/\\.]++)\\.m3u8$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'hls_stream')), array (  '_controller' => 'AppBundle\\Controller\\HLSController::streamAction',  '_permission' =>   array (  ),));
            }

            // hls_clef
            if (preg_match('#^/hls/(?P<id>[^/]++)/clef/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'hls_clef')), array (  '_controller' => 'AppBundle\\Controller\\HLSController::clefAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/editor')) {
            // editor_upload
            if ($pathinfo === '/editor/upload') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_editor_upload;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EditorController::uploadAction',  '_route' => 'editor_upload',  '_permission' =>   array (  ),);
            }
            not_editor_upload:

            // editor_download
            if ($pathinfo === '/editor/download') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_editor_download;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EditorController::downloadAction',  '_route' => 'editor_download',  '_permission' =>   array (  ),);
            }
            not_editor_download:

        }

        if (0 === strpos($pathinfo, '/live')) {
            // liveroom_ticket
            if (0 === strpos($pathinfo, '/liveroom') && preg_match('#^/liveroom/(?P<roomId>[^/]++)/ticket$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'liveroom_ticket')), array (  '_controller' => 'AppBundle\\Controller\\LiveroomController::ticketAction',  '_permission' =>   array (  ),));
            }

            // live_auth
            if ($pathinfo === '/live/auth') {
                return array (  '_controller' => 'AppBundle\\Controller\\LiveAuthController::indexAction',  '_route' => 'live_auth',  '_permission' =>   array (  ),);
            }

        }

        // course_order_detail
        if (0 === strpos($pathinfo, '/order') && preg_match('#^/order/(?P<id>[^/]++)/detail_course$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_order_detail')), array (  '_controller' => 'AppBundle\\Controller\\OrderController::detailAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/target')) {
            // order_refund
            if (preg_match('#^/target/(?P<id>[^/]++)/order/refund$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'order_refund')), array (  '_controller' => 'AppBundle\\Controller\\OrderRefundController::refundAction',  '_permission' =>   array (  ),));
            }

            // order_cancel_refund
            if (preg_match('#^/target/(?P<id>[^/]++)/order/cancel_refund$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_order_cancel_refund;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'order_cancel_refund')), array (  '_controller' => 'AppBundle\\Controller\\OrderRefundController::cancelRefundAction',  '_permission' =>   array (  ),));
            }
            not_order_cancel_refund:

        }

        if (0 === strpos($pathinfo, '/media')) {
            // media_play
            if (preg_match('#^/media/(?P<mediaId>[^/]++)/play$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_play')), array (  '_controller' => 'AppBundle\\Controller\\Media\\IndexController::playAction',  '_permission' =>   array (  ),));
            }

            // media_subtitle_preview
            if (preg_match('#^/media/(?P<mediaId>[^/]++)/subtitles/preview$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_subtitle_preview')), array (  '_controller' => 'AppBundle\\Controller\\SubtitleController::previewAction',  '_permission' =>   array (  ),));
            }

            // media_subtitle_manage
            if (preg_match('#^/media/(?P<mediaId>[^/]++)/subtitles/manage$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_subtitle_manage')), array (  '_controller' => 'AppBundle\\Controller\\SubtitleController::manageAction',  '_permission' =>   array (  ),));
            }

            // media_subtitle_list
            if (preg_match('#^/media/(?P<mediaId>[^/]++)/subtitles$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_subtitle_list')), array (  '_controller' => 'AppBundle\\Controller\\SubtitleController::listAction',  '_permission' =>   array (  ),));
            }

            // media_subtitle_create
            if (preg_match('#^/media/(?P<mediaId>[^/]++)/subtitle/create$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_media_subtitle_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_subtitle_create')), array (  '_controller' => 'AppBundle\\Controller\\SubtitleController::createAction',  '_permission' =>   array (  ),));
            }
            not_media_subtitle_create:

            // media_subtitle_delete
            if (preg_match('#^/media/(?P<mediaId>[^/]++)/subtitle/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_media_subtitle_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_subtitle_delete')), array (  '_controller' => 'AppBundle\\Controller\\SubtitleController::deleteAction',  '_permission' =>   array (  ),));
            }
            not_media_subtitle_delete:

            // media_subtitle_manage_dialog
            if ($pathinfo === '/media/subtitles/manage/dialog') {
                return array (  '_controller' => 'AppBundle\\Controller\\SubtitleController::manageDialogAction',  '_route' => 'media_subtitle_manage_dialog',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/announcement')) {
            // announcement_list
            if (preg_match('#^/announcement/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/list$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_list')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::listAction',  '_permission' =>   array (  ),));
            }

            // announcement_show_all
            if (preg_match('#^/announcement/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/all$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_show_all')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::showAllAction',  '_permission' =>   array (  ),));
            }

            // announcement_add
            if (preg_match('#^/announcement/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_add')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::createAction',  '_permission' =>   array (  ),));
            }

            // announcement_show
            if (preg_match('#^/announcement/(?P<id>[^/]++)/(?P<targetId>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_show')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::showAction',  '_permission' =>   array (  ),));
            }

            // announcement_manage
            if (preg_match('#^/announcement/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/manage$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_manage')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::manageAction',  '_permission' =>   array (  ),));
            }

            // announcement_update
            if (preg_match('#^/announcement/(?P<id>[^/]++)/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/update$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_update')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::updateAction',  '_permission' =>   array (  ),));
            }

            // announcement_delete
            if (preg_match('#^/announcement/(?P<id>[^/]++)/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_announcement_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_delete')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::deleteAction',  '_permission' =>   array (  ),));
            }
            not_announcement_delete:

        }

        // search
        if ($pathinfo === '/search') {
            return array (  '_controller' => 'AppBundle\\Controller\\SearchController::indexAction',  '_route' => 'search',  '_permission' =>   array (  ),);
        }

        // cloud_search
        if ($pathinfo === '/cloud/search') {
            return array (  '_controller' => 'AppBundle\\Controller\\SearchController::cloudSearchAction',  '_route' => 'cloud_search',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/settings')) {
            // settings
            if (rtrim($pathinfo, '/') === '/settings') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'settings');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::profileAction',  '_route' => 'settings',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/settings/avatar')) {
                // settings_avatar
                if ($pathinfo === '/settings/avatar') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::avatarAction',  '_route' => 'settings_avatar',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/settings/avatar/crop')) {
                    // settings_avatar_crop
                    if ($pathinfo === '/settings/avatar/crop') {
                        return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::avatarCropAction',  '_route' => 'settings_avatar_crop',  '_permission' =>   array (  ),);
                    }

                    // settings_avatar_crop_modal
                    if ($pathinfo === '/settings/avatar/crop/modal') {
                        return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::avatarCropModalAction',  '_route' => 'settings_avatar_crop_modal',  '_permission' =>   array (  ),);
                    }

                }

                // settings_avatar_fetch_partner
                if ($pathinfo === '/settings/avatar/fetch_partner') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_settings_avatar_fetch_partner;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::avatarFetchPartnerAction',  '_route' => 'settings_avatar_fetch_partner',  '_permission' =>   array (  ),);
                }
                not_settings_avatar_fetch_partner:

            }

            if (0 === strpos($pathinfo, '/settings/se')) {
                // settings_security
                if ($pathinfo === '/settings/security') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::securityAction',  '_route' => 'settings_security',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/settings/set_pa')) {
                    // settings_set_pay_password
                    if ($pathinfo === '/settings/set_pay_password') {
                        return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::setPayPasswordAction',  '_route' => 'settings_set_pay_password',  '_permission' =>   array (  ),);
                    }

                    // settings_set_password
                    if ($pathinfo === '/settings/set_password') {
                        return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::setPasswordAction',  '_route' => 'settings_set_password',  '_permission' =>   array (  ),);
                    }

                }

            }

            // settings_pay_password
            if ($pathinfo === '/settings/pay_password') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::payPasswordAction',  '_route' => 'settings_pay_password',  '_permission' =>   array (  ),);
            }

            // settings_reset_pay_password
            if ($pathinfo === '/settings/reset_pay_password') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::resetPayPasswordAction',  '_route' => 'settings_reset_pay_password',  '_permission' =>   array (  ),);
            }

            // settings_find_pay_password
            if ($pathinfo === '/settings/find_pay_password') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::findPayPasswordAction',  '_route' => 'settings_find_pay_password',  '_permission' =>   array (  ),);
            }

            // settings_update_pay_password
            if ($pathinfo === '/settings/update_pay_password') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::updatePayPasswordAction',  '_route' => 'settings_update_pay_password',  '_permission' =>   array (  ),);
            }

            // settings_security_questions
            if ($pathinfo === '/settings/security_questions') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::securityQuestionsAction',  '_route' => 'settings_security_questions',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/settings/nickname')) {
                // setting_nickname
                if ($pathinfo === '/settings/nickname') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::nicknameAction',  '_route' => 'setting_nickname',  '_permission' =>   array (  ),);
                }

                // update_nickname_check
                if ($pathinfo === '/settings/nickname/check') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::nicknameCheckAction',  '_route' => 'update_nickname_check',  '_permission' =>   array (  ),);
                }

            }

            // settings_password
            if ($pathinfo === '/settings/password') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::passwordAction',  '_route' => 'settings_password',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/settings/email')) {
                // settings_email
                if ($pathinfo === '/settings/email') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::emailAction',  '_route' => 'settings_email',  '_permission' =>   array (  ),);
                }

                // settings_email_verify
                if ($pathinfo === '/settings/email/verify') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_settings_email_verify;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::emailVerifyAction',  '_route' => 'settings_email_verify',  '_permission' =>   array (  ),);
                }
                not_settings_email_verify:

            }

            // settings_binds
            if ($pathinfo === '/settings/binds') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::bindsAction',  '_route' => 'settings_binds',  '_permission' =>   array (  ),);
            }

            // settings_binds_unbind
            if (0 === strpos($pathinfo, '/settings/unbind') && preg_match('#^/settings/unbind/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'settings_binds_unbind')), array (  '_controller' => 'AppBundle\\Controller\\SettingsController::unBindAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/settings/bind')) {
                // settings_binds_bind
                if (preg_match('#^/settings/bind/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'settings_binds_bind')), array (  '_controller' => 'AppBundle\\Controller\\SettingsController::bindAction',  '_permission' =>   array (  ),));
                }

                // settings_binds_bind_callback
                if (preg_match('#^/settings/bind/(?P<type>[^/]++)/callback$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'settings_binds_bind_callback')), array (  '_controller' => 'AppBundle\\Controller\\SettingsController::bindCallbackAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/settings/setup')) {
                // settings_setup
                if ($pathinfo === '/settings/setup') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::setupAction',  '_route' => 'settings_setup',  '_permission' =>   array (  ),);
                }

                // settings_setup_password
                if ($pathinfo === '/settings/setup_password') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::setupPasswordAction',  '_route' => 'settings_setup_password',  '_permission' =>   array (  ),);
                }

                // settings_setup_check_nickname
                if ($pathinfo === '/settings/setup/check_nickname') {
                    return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::setupCheckNicknameAction',  '_route' => 'settings_setup_check_nickname',  '_permission' =>   array (  ),);
                }

            }

        }

        // auth_email_confirm
        if ($pathinfo === '/auth/email/confirm') {
            return array (  '_controller' => 'AppBundle\\Controller\\AuthController::emailConfirmAction',  '_route' => 'auth_email_confirm',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/password/reset')) {
            // password_reset
            if ($pathinfo === '/password/reset') {
                return array (  '_controller' => 'AppBundle\\Controller\\PasswordResetController::indexAction',  '_route' => 'password_reset',  '_permission' =>   array (  ),);
            }

            // password_reset_update
            if ($pathinfo === '/password/reset/update') {
                return array (  '_controller' => 'AppBundle\\Controller\\PasswordResetController::updateAction',  '_route' => 'password_reset_update',  '_permission' =>   array (  ),);
            }

        }

        // raw_password_update
        if ($pathinfo === '/raw/password/update') {
            return array (  '_controller' => 'AppBundle\\Controller\\PasswordResetController::changeRawPasswordAction',  '_route' => 'raw_password_update',  '_permission' =>   array (  ),);
        }

        // password_reset_check_mobile
        if ($pathinfo === '/password/reset/check/mobile') {
            return array (  '_controller' => 'AppBundle\\Controller\\PasswordResetController::checkMobileExistsAction',  '_route' => 'password_reset_check_mobile',  '_permission' =>   array (  ),);
        }

        // browser_upgrade
        if ($pathinfo === '/browser/upgrade') {
            return array (  '_controller' => 'AppBundle\\Controller\\BrowserController::upgradeAction',  '_route' => 'browser_upgrade',  '_permission' =>   array (  ),);
        }

        // category_all
        if ($pathinfo === '/category/all') {
            return array (  '_controller' => 'AppBundle\\Controller\\CategoryController::allAction',  '_route' => 'category_all',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/tag')) {
            // tag
            if ($pathinfo === '/tag') {
                return array (  '_controller' => 'AppBundle\\Controller\\TagController::indexAction',  '_route' => 'tag',  '_permission' =>   array (  ),);
            }

            // tag_all
            if ($pathinfo === '/tag/all_jsonm') {
                return array (  '_controller' => 'AppBundle\\Controller\\TagController::allAction',  '_route' => 'tag_all',  '_permission' =>   array (  ),);
            }

            // tag_match
            if ($pathinfo === '/tag/match_jsonp') {
                return array (  '_controller' => 'AppBundle\\Controller\\TagController::matchAction',  '_route' => 'tag_match',  '_permission' =>   array (  ),);
            }

            // tag_show
            if (preg_match('#^/tag/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'tag_show')), array (  '_controller' => 'AppBundle\\Controller\\TagController::showAction',  '_permission' =>   array (  ),));
            }

        }

        // following_match_bynickname
        if ($pathinfo === '/following/bynickname/match_jsonp') {
            return array (  '_controller' => 'AppBundle\\Controller\\MessageController::matchAction',  '_route' => 'following_match_bynickname',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/comment-widget')) {
            // comment_widget_init
            if ($pathinfo === '/comment-widget/init') {
                return array (  '_controller' => 'AppBundle\\Controller\\CommentWidgetController::initAction',  '_route' => 'comment_widget_init',  '_permission' =>   array (  ),);
            }

            // comment_widget_create
            if ($pathinfo === '/comment-widget/create') {
                return array (  '_controller' => 'AppBundle\\Controller\\CommentWidgetController::createAction',  '_route' => 'comment_widget_create',  '_permission' =>   array (  ),);
            }

            // comment_widget_delete
            if ($pathinfo === '/comment-widget/delete') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_comment_widget_delete;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\CommentWidgetController::deleteAction',  '_route' => 'comment_widget_delete',  '_permission' =>   array (  ),);
            }
            not_comment_widget_delete:

        }

        if (0 === strpos($pathinfo, '/notification')) {
            // notification
            if ($pathinfo === '/notification') {
                return array (  '_controller' => 'AppBundle\\Controller\\NotificationController::indexAction',  '_route' => 'notification',  '_permission' =>   array (  ),);
            }

            // batch_notification_show
            if (preg_match('#^/notification/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'batch_notification_show')), array (  '_controller' => 'AppBundle\\Controller\\NotificationController::showAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/my')) {
            if (0 === strpos($pathinfo, '/my/teaching')) {
                // my_teaching_course_sets
                if (0 === strpos($pathinfo, '/my/teaching/course_sets') && preg_match('#^/my/teaching/course_sets(?:/(?P<filter>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_teaching_course_sets')), array (  '_controller' => 'AppBundle\\Controller\\My\\CourseSetController::teachingAction',  'filter' => 'normal',  '_permission' =>   array (  ),));
                }

                // my_teaching_open_courses
                if (0 === strpos($pathinfo, '/my/teaching/open/courses') && preg_match('#^/my/teaching/open/courses(?:/(?P<filter>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_teaching_open_courses')), array (  '_controller' => 'AppBundle\\Controller\\My\\OpenCourseController::teachingAction',  'filter' => 'open',  '_permission' =>   array (  ),));
                }

                // my_teaching_threads
                if (0 === strpos($pathinfo, '/my/teaching/threads') && preg_match('#^/my/teaching/threads/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_teaching_threads')), array (  '_controller' => 'AppBundle\\Controller\\My\\ThreadController::teachingAction',  '_permission' =>   array (  ),));
                }

                // my_teaching_classrooms
                if ($pathinfo === '/my/teaching/classrooms') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\ClassroomController::teachingAction',  '_route' => 'my_teaching_classrooms',  '_permission' =>   array (  ),);
                }

            }

            // my_live_courses_learning
            if ($pathinfo === '/my/learning/live') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\CourseSetController::livesAction',  '_route' => 'my_live_courses_learning',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/my/testpaper')) {
                // my_testpaper_check_list
                if (0 === strpos($pathinfo, '/my/testpaper/check') && preg_match('#^/my/testpaper/check(?:/(?P<status>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_testpaper_check_list')), array (  '_controller' => 'AppBundle\\Controller\\My\\TestpaperController::checkListAction',  'status' => 'reviewing',  '_permission' =>   array (  ),));
                }

                // my_testpaper_list
                if ($pathinfo === '/my/testpaper/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\TestpaperController::listAction',  '_route' => 'my_testpaper_list',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/my/question')) {
                // my_favorite_question_list
                if ($pathinfo === '/my/question/favorite/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\QuestionController::favoriteListAction',  '_route' => 'my_favorite_question_list',  '_permission' =>   array (  ),);
                }

                // my_favorite_question_preview
                if (preg_match('#^/my/question/(?P<id>[^/]++)/favorite/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_favorite_question_preview')), array (  '_controller' => 'AppBundle\\Controller\\My\\QuestionController::previewAction',  '_permission' =>   array (  ),));
                }

                // my_question_favorite
                if (preg_match('#^/my/question/(?P<questionId>[^/]++)/favorite$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_question_favorite')), array (  '_controller' => 'AppBundle\\Controller\\My\\QuestionController::favoriteAction',  '_permission' =>   array (  ),));
                }

                // my_question_unfavorite
                if (0 === strpos($pathinfo, '/my/question/unfavorite') && preg_match('#^/my/question/unfavorite/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_question_unfavorite')), array (  '_controller' => 'AppBundle\\Controller\\My\\QuestionController::unFavoriteAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/my/homework')) {
                // my_homework_check_list
                if (0 === strpos($pathinfo, '/my/homework/check') && preg_match('#^/my/homework/check(?:/(?P<status>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_homework_check_list')), array (  '_controller' => 'AppBundle\\Controller\\My\\HomeworkController::checkListAction',  'status' => 'reviewing',  '_permission' =>   array (  ),));
                }

                // my_homework_list
                if (preg_match('#^/my/homework/(?P<status>[^/]++)/list$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_homework_list')), array (  '_controller' => 'AppBundle\\Controller\\My\\HomeworkController::listAction',  'status' => 'finished',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/my/order')) {
                // my_orders
                if ($pathinfo === '/my/orders') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\OrderController::indexAction',  '_route' => 'my_orders',  '_permission' =>   array (  ),);
                }

                // my_order_cancel
                if (preg_match('#^/my/order/(?P<id>[^/]++)/cancel$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_my_order_cancel;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_order_cancel')), array (  '_controller' => 'AppBundle\\Controller\\My\\OrderController::cancelAction',  '_permission' =>   array (  ),));
                }
                not_my_order_cancel:

                // web_user_order_detail
                if (preg_match('#^/my/order/(?P<id>[^/]++)/detail$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'web_user_order_detail')), array (  '_controller' => 'AppBundle\\Controller\\My\\OrderController::detailAction',  '_permission' =>   array (  ),));
                }

                // my_order_cancel_refund
                if (preg_match('#^/my/order/(?P<id>[^/]++)/cancel_refund$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_my_order_cancel_refund;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_order_cancel_refund')), array (  '_controller' => 'AppBundle\\Controller\\My\\OrderController::cancelRefundAction',  '_permission' =>   array (  ),));
                }
                not_my_order_cancel_refund:

            }

            // my_refunds
            if ($pathinfo === '/my/refunds') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\OrderController::refundsAction',  '_route' => 'my_refunds',  '_permission' =>   array (  ),);
            }

            // income_records
            if ($pathinfo === '/my/income_records') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\MoneyRecordController::indexAction',  '_route' => 'income_records',  '_permission' =>   array (  ),);
            }

            // payout_records
            if ($pathinfo === '/my/payout_records') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\MoneyRecordController::payoutAction',  '_route' => 'payout_records',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/user')) {
            // user_show
            if (preg_match('#^/user/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_show')), array (  '_controller' => 'AppBundle\\Controller\\UserController::showAction',  '_permission' =>   array (  ),));
            }

            // user_info_fill
            if (preg_match('#^/user/(?P<id>[^/]++)/saveinfo$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_info_fill;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_info_fill')), array (  '_controller' => 'AppBundle\\Controller\\UserController::fillInfoWhenBuyAction',  '_permission' =>   array (  ),));
            }
            not_user_info_fill:

        }

        // my_page_show
        if ($pathinfo === '/my/page/show') {
            return array (  '_controller' => 'AppBundle\\Controller\\UserController::pageShowAction',  '_route' => 'my_page_show',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/user')) {
            // user_about
            if (preg_match('#^/user/(?P<id>[^/]++)/about$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_about')), array (  '_controller' => 'AppBundle\\Controller\\UserController::aboutAction',  '_permission' =>   array (  ),));
            }

            // user_teach
            if (preg_match('#^/user/(?P<id>[^/]++)/teach$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_teach')), array (  '_controller' => 'AppBundle\\Controller\\UserController::teachAction',  '_permission' =>   array (  ),));
            }

            // user_learn
            if (preg_match('#^/user/(?P<id>[^/]++)/learn$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_learn')), array (  '_controller' => 'AppBundle\\Controller\\UserController::learnAction',  '_permission' =>   array (  ),));
            }

            // user_favorited
            if (preg_match('#^/user/(?P<id>[^/]++)/favorited$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_favorited')), array (  '_controller' => 'AppBundle\\Controller\\UserController::favoritedAction',  '_permission' =>   array (  ),));
            }

            // user_group
            if (preg_match('#^/user/(?P<id>[^/]++)/group$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_group')), array (  '_controller' => 'AppBundle\\Controller\\UserController::groupAction',  '_permission' =>   array (  ),));
            }

            // user_following
            if (preg_match('#^/user/(?P<id>[^/]++)/following$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_following')), array (  '_controller' => 'AppBundle\\Controller\\UserController::followingAction',  '_permission' =>   array (  ),));
            }

            // user_follower
            if (preg_match('#^/user/(?P<id>[^/]++)/follower$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_follower')), array (  '_controller' => 'AppBundle\\Controller\\UserController::followerAction',  '_permission' =>   array (  ),));
            }

            // user_follow
            if (preg_match('#^/user/(?P<id>[^/]++)/follow$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_follow;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_follow')), array (  '_controller' => 'AppBundle\\Controller\\UserController::followAction',  '_permission' =>   array (  ),));
            }
            not_user_follow:

            // user_unfollow
            if (preg_match('#^/user/(?P<id>[^/]++)/unfollow$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_unfollow;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_unfollow')), array (  '_controller' => 'AppBundle\\Controller\\UserController::unfollowAction',  '_permission' =>   array (  ),));
            }
            not_user_unfollow:

            // user_remind_counter
            if ($pathinfo === '/user_remind_counter') {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::remindCounterAction',  '_route' => 'user_remind_counter',  '_permission' =>   array (  ),);
            }

            // user_teaching_classrooms
            if (preg_match('#^/user/(?P<id>[^/]++)/teaching/classrooms$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_teaching_classrooms')), array (  '_controller' => 'AppBundle\\Controller\\UserController::teachingAction',  '_permission' =>   array (  ),));
            }

            // user_learning_classrooms
            if (preg_match('#^/user/(?P<id>[^/]++)/learning/classrooms$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_learning_classrooms')), array (  '_controller' => 'AppBundle\\Controller\\UserController::learningAction',  '_permission' =>   array (  ),));
            }

            // user_card_show
            if (preg_match('#^/user/(?P<userId>[^/]++)/card/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_card_show')), array (  '_controller' => 'AppBundle\\Controller\\UserController::cardShowAction',  '_permission' =>   array (  ),));
            }

        }

        // login_after_fill_userinfo
        if ($pathinfo === '/fill/userinfo') {
            return array (  '_controller' => 'AppBundle\\Controller\\UserController::fillUserInfoAction',  '_route' => 'login_after_fill_userinfo',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/message')) {
            // message_create
            if (0 === strpos($pathinfo, '/message/create') && preg_match('#^/message/create/(?P<toId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_create')), array (  '_controller' => 'AppBundle\\Controller\\MessageController::createAction',  '_permission' =>   array (  ),));
            }

            // message
            if (rtrim($pathinfo, '/') === '/message') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'message');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\MessageController::indexAction',  '_route' => 'message',  '_permission' =>   array (  ),);
            }

            // message_check_receiver
            if ($pathinfo === '/message/check/receiver') {
                return array (  '_controller' => 'AppBundle\\Controller\\MessageController::checkReceiverAction',  '_route' => 'message_check_receiver',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/message/send')) {
                // message_send
                if (rtrim($pathinfo, '/') === '/message/send') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'message_send');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\MessageController::sendAction',  '_route' => 'message_send',  '_permission' =>   array (  ),);
                }

                // message_send_to_receiver
                if (preg_match('#^/message/send/(?P<receiverId>[^/]++)/to/receiver/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'message_send_to_receiver');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_send_to_receiver')), array (  '_controller' => 'AppBundle\\Controller\\MessageController::sendToAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/message/conversation')) {
                // message_conversation_show
                if (preg_match('#^/message/conversation/(?P<conversationId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_conversation_show')), array (  '_controller' => 'AppBundle\\Controller\\MessageController::showConversationAction',  '_permission' =>   array (  ),));
                }

                // message_conversation_delete
                if (preg_match('#^/message/conversation/(?P<conversationId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_message_conversation_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_conversation_delete')), array (  '_controller' => 'AppBundle\\Controller\\MessageController::deleteConversationAction',  '_permission' =>   array (  ),));
                }
                not_message_conversation_delete:

                // message_delete
                if (preg_match('#^/message/conversation/(?P<conversationId>[^/]++)/message/(?P<messageId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_message_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_delete')), array (  '_controller' => 'AppBundle\\Controller\\MessageController::deleteConversationMessageAction',  '_permission' =>   array (  ),));
                }
                not_message_delete:

            }

        }

        if (0 === strpos($pathinfo, '/carticle')) {
            // content_article_show
            if (preg_match('#^/carticle/(?P<alias>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'content_article_show')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::articleShowAction',  '_permission' =>   array (  ),));
            }

            // content_article_list
            if ($pathinfo === '/carticle') {
                return array (  '_controller' => 'AppBundle\\Controller\\ContentController::articleListAction',  '_route' => 'content_article_list',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/activity')) {
            // content_activity_show
            if (preg_match('#^/activity/(?P<alias>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'content_activity_show')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::activityShowAction',  '_permission' =>   array (  ),));
            }

            // content_activity_list
            if ($pathinfo === '/activity') {
                return array (  '_controller' => 'AppBundle\\Controller\\ContentController::activityListAction',  '_route' => 'content_activity_list',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/page')) {
            // content_page_show
            if (preg_match('#^/page/(?P<alias>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'content_page_show')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::pageShowAction',  '_permission' =>   array (  ),));
            }

            // content_page_list
            if ($pathinfo === '/page') {
                return array (  '_controller' => 'AppBundle\\Controller\\ContentController::pageListAction',  '_route' => 'content_page_list',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/course')) {
            // content_course_rule
            if ($pathinfo === '/courserule') {
                return array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::courseRuleAction',  '_route' => 'content_course_rule',  '_permission' =>   array (  ),);
            }

            // course_set_live_capacity
            if (0 === strpos($pathinfo, '/course_set') && preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/live_capacity$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_live_capacity')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::liveCapacityAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/teacher')) {
            // teacher
            if ($pathinfo === '/teacher') {
                return array (  '_controller' => 'AppBundle\\Controller\\TeacherController::indexAction',  '_route' => 'teacher',  '_permission' =>   array (  ),);
            }

            // teacher_search
            if ($pathinfo === '/teacher/search') {
                return array (  '_controller' => 'AppBundle\\Controller\\TeacherController::searchAction',  '_route' => 'teacher_search',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/partner')) {
            if (0 === strpos($pathinfo, '/partner/log')) {
                // partner_login
                if ($pathinfo === '/partner/login') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PartnerController::loginAction',  '_route' => 'partner_login',  '_permission' =>   array (  ),);
                }

                // partner_logout
                if ($pathinfo === '/partner/logout') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PartnerController::logoutAction',  '_route' => 'partner_logout',  '_permission' =>   array (  ),);
                }

            }

            // partner_discuz_notify
            if ($pathinfo === '/partner/discuz/api/notify') {
                return array (  '_controller' => 'AppBundle\\Controller\\PartnerDiscuzController::notifyAction',  '_route' => 'partner_discuz_notify',  '_permission' =>   array (  ),);
            }

            // partner_phpwind_notify
            if ($pathinfo === '/partner/phpwind/api/notify') {
                return array (  '_controller' => 'AppBundle:PartnerPhpwind:notify',  '_route' => 'partner_phpwind_notify',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/cloud')) {
            // cloud_set_server
            if ($pathinfo === '/cloud/set-server') {
                return array (  '_controller' => 'AppBundle\\Controller\\CloudController::setServerAction',  '_route' => 'cloud_set_server',  '_permission' =>   array (  ),);
            }

            // cloud_video_fingerprint
            if ($pathinfo === '/cloud/video_fingerprint') {
                return array (  '_controller' => 'AppBundle\\Controller\\CloudController::videoFingerprintAction',  '_route' => 'cloud_video_fingerprint',  '_permission' =>   array (  ),);
            }

            // cloud_ppt_watermark
            if ($pathinfo === '/cloud/ppt_watermark') {
                return array (  '_controller' => 'AppBundle\\Controller\\CloudController::pptWatermarkAction',  '_route' => 'cloud_ppt_watermark',  '_permission' =>   array (  ),);
            }

            // cloud_doc_watermark
            if ($pathinfo === '/cloud/doc_watermark') {
                return array (  '_controller' => 'AppBundle\\Controller\\CloudController::docWatermarkAction',  '_route' => 'cloud_doc_watermark',  '_permission' =>   array (  ),);
            }

            // cloud_testpaper_watermark
            if ($pathinfo === '/cloud/testpaper_watermark') {
                return array (  '_controller' => 'AppBundle\\Controller\\CloudController::testpaperWatermarkAction',  '_route' => 'cloud_testpaper_watermark',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/s')) {
            // systeminfo
            if ($pathinfo === '/systeminfo') {
                return array (  '_controller' => 'AppBundle\\Controller\\SysteminfoController::indexAction',  '_route' => 'systeminfo',  '_permission' =>   array (  ),);
            }

            // setting_approval_submit
            if ($pathinfo === '/settings/approval/submit') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::approvalSubmitAction',  '_route' => 'setting_approval_submit',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/article')) {
            // article_show
            if ($pathinfo === '/article') {
                return array (  '_controller' => 'AppBundle\\Controller\\ArticleController::indexAction',  '_route' => 'article_show',  '_permission' =>   array (  ),);
            }

            // article_detail
            if (preg_match('#^/article/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_detail')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::detailAction',  '_permission' =>   array (  ),));
            }

            // article_category
            if (0 === strpos($pathinfo, '/article/category') && preg_match('#^/article/category/(?P<categoryCode>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_category')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::categoryAction',  'category' => '',  '_permission' =>   array (  ),));
            }

            // article_post
            if (preg_match('#^/article/(?P<id>[^/]++)/post$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_post;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_post')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::postAction',  '_permission' =>   array (  ),));
            }
            not_article_post:

            // article_post_reply
            if (preg_match('#^/article/(?P<articleId>[^/]++)/post/(?P<postId>[^/]++)/$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_post_reply;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_post_reply')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::postReplyAction',  '_permission' =>   array (  ),));
            }
            not_article_post_reply:

            // article_like
            if (preg_match('#^/article/(?P<articleId>[^/]++)/like$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_like;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_like')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::likeAction',  '_permission' =>   array (  ),));
            }
            not_article_like:

            // article_cancel_like
            if (preg_match('#^/article/(?P<articleId>[^/]++)/canceLike$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_cancel_like;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_cancel_like')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::cancelLikeAction',  '_permission' =>   array (  ),));
            }
            not_article_cancel_like:

            // article_post_jump
            if (preg_match('#^/article/(?P<articleId>[^/]++)/post/(?P<postId>[^/]++)/jump$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_post_jump')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::postJumpAction',  '_permission' =>   array (  ),));
            }

            // article_tag_show
            if (0 === strpos($pathinfo, '/article/tag') && preg_match('#^/article/tag/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_tag_show')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::tagAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/mobile')) {
            // mobile
            if (rtrim($pathinfo, '/') === '/mobile') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'mobile');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\MobileController::indexAction',  '_route' => 'mobile',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/mobile/download')) {
                // mobile_download_qrcode
                if ($pathinfo === '/mobile/downloadQrcode') {
                    return array (  '_controller' => 'AppBundle\\Controller\\MobileController::downloadQrcodeAction',  '_route' => 'mobile_download_qrcode',  '_permission' =>   array (  ),);
                }

                // mobile_download
                if ($pathinfo === '/mobile/download') {
                    return array (  '_controller' => 'AppBundle\\Controller\\MobileController::downloadAction',  '_route' => 'mobile_download',  '_permission' =>   array (  ),);
                }

            }

        }

        if (0 === strpos($pathinfo, '/group')) {
            // group
            if ($pathinfo === '/group') {
                return array (  '_controller' => 'AppBundle\\Controller\\GroupController::indexAction',  '_route' => 'group',  '_permission' =>   array (  ),);
            }

            // group_search_group
            if ($pathinfo === '/group/search_group') {
                return array (  '_controller' => 'AppBundle\\Controller\\GroupController::searchAction',  '_route' => 'group_search_group',  '_permission' =>   array (  ),);
            }

            // group_add
            if ($pathinfo === '/group/add') {
                return array (  '_controller' => 'AppBundle\\Controller\\GroupController::addGroupAction',  '_route' => 'group_add',  '_permission' =>   array (  ),);
            }

            // group_show
            if (preg_match('#^/group/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_show')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::groupIndexAction',  '_permission' =>   array (  ),));
            }

            // group_join
            if (preg_match('#^/group/(?P<id>[^/]++)/join$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_group_join;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_join')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::groupJoinAction',  '_permission' =>   array (  ),));
            }
            not_group_join:

            // group_exit
            if (preg_match('#^/group/(?P<id>[^/]++)/exit$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_group_exit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_exit')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::groupExitAction',  '_permission' =>   array (  ),));
            }
            not_group_exit:

            if (0 === strpos($pathinfo, '/group/member')) {
                // group_member
                if (preg_match('#^/group/member/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_member')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::groupMemberAction',  '_permission' =>   array (  ),));
                }

                // group_member_delete
                if (0 === strpos($pathinfo, '/group/member/delete') && preg_match('#^/group/member/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_group_member_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_member_delete')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::deleteMembersAction',  '_permission' =>   array (  ),));
                }
                not_group_member_delete:

            }

            // group_set_admin
            if (0 === strpos($pathinfo, '/group/set/admin') && preg_match('#^/group/set/admin/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_set_admin')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::setAdminAction',  '_permission' =>   array (  ),));
            }

            // group_remove_admin
            if (0 === strpos($pathinfo, '/group/remove/admin') && preg_match('#^/group/remove/admin/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_remove_admin')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::removeAdminAction',  '_permission' =>   array (  ),));
            }

            // group_set
            if (preg_match('#^/group/(?P<id>[^/]++)/setting/info$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_set')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::groupSetAction',  '_permission' =>   array (  ),));
            }

            // group_setLogoCrop
            if (preg_match('#^/group/(?P<id>[^/]++)/setting/logoCrop$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_setLogoCrop')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::logoCropAction',  '_permission' =>   array (  ),));
            }

            // group_logo_set
            if (preg_match('#^/group/(?P<id>[^/]++)/setting/logo$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_logo_set')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::setGrouplogoAction',  '_permission' =>   array (  ),));
            }

            // group_edit
            if (0 === strpos($pathinfo, '/group/info/edit') && preg_match('#^/group/info/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_edit')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::groupEditAction',  '_permission' =>   array (  ),));
            }

            // group_backgroundlogo_set
            if (0 === strpos($pathinfo, '/group/set/backgroundlogo') && preg_match('#^/group/set/backgroundlogo/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_backgroundlogo_set')), array (  '_controller' => 'AppBundle\\Controller\\GroupController::setGroupBackgroundLogoAction',  '_permission' =>   array (  ),));
            }

            // group_search
            if (preg_match('#^/group/(?P<id>[^/]++)/serach$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_search')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::searchResultAction',  '_permission' =>   array (  ),));
            }

            // group_thread_post
            if (0 === strpos($pathinfo, '/group/thread') && preg_match('#^/group/thread/(?P<groupId>[^/]++)/(?P<threadId>[^/]++)/post$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_post')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::postThreadAction',  '_permission' =>   array (  ),));
            }

            // group_thread_add
            if (preg_match('#^/group/(?P<id>[^/]++)/thread/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_add')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::addThreadAction',  '_permission' =>   array (  ),));
            }

            // group_thread_update
            if (preg_match('#^/group/(?P<id>[^/]++)/thread/(?P<threadId>[^/]++)/update$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_update')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::updateThreadAction',  '_permission' =>   array (  ),));
            }

        }

        // group_thread_check_user
        if ($pathinfo === '/mygroup/checkuser') {
            return array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::checkUserAction',  '_route' => 'group_thread_check_user',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/group')) {
            // group_thread_show
            if (preg_match('#^/group/(?P<id>[^/]++)/thread/(?P<threadId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_show')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::groupThreadIndexAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/group/thread')) {
                // group_thread_collect
                if (preg_match('#^/group/thread/(?P<threadId>[^/]++)/collect$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_group_thread_collect;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_collect')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::collectAction',  '_permission' =>   array (  ),));
                }
                not_group_thread_collect:

                // group_thread_uncollect
                if (preg_match('#^/group/thread/(?P<threadId>[^/]++)/uncollect$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_group_thread_uncollect;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_uncollect')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::uncollectAction',  '_permission' =>   array (  ),));
                }
                not_group_thread_uncollect:

                // group_thread_setElite
                if (preg_match('#^/group/thread/(?P<threadId>[^/]++)/setElite$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_setElite')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::setEliteAction',  '_permission' =>   array (  ),));
                }

                // group_thread_removeElite
                if (preg_match('#^/group/thread/(?P<threadId>[^/]++)/removeElite$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_removeElite')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::removeEliteAction',  '_permission' =>   array (  ),));
                }

                // group_thread_setStick
                if (preg_match('#^/group/thread/(?P<threadId>[^/]++)/setStick$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_setStick')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::setStickAction',  '_permission' =>   array (  ),));
                }

                // group_thread_removeStick
                if (preg_match('#^/group/thread/(?P<threadId>[^/]++)/removeStick$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_removeStick')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::removeStickAction',  '_permission' =>   array (  ),));
                }

                // group_thread_closeThread
                if (preg_match('#^/group/thread/(?P<threadId>[^/]++)/closeThread/(?P<memberId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_closeThread')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::closeThreadAction',  '_permission' =>   array (  ),));
                }

                // group_thread_deletePost
                if (0 === strpos($pathinfo, '/group/thread/deletePost') && preg_match('#^/group/thread/deletePost/(?P<postId>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_group_thread_deletePost;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_deletePost')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::deletePostAction',  '_permission' =>   array (  ),));
                }
                not_group_thread_deletePost:

            }

            // group_thread_post_reply
            if (0 === strpos($pathinfo, '/group/post') && preg_match('#^/group/post/(?P<postId>[^/]++)/reply$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_post_reply')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::postReplyAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/thread')) {
            // group_thread_reward
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/reward$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_reward')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::rewardAction',  '_permission' =>   array (  ),));
            }

            // group_thread_cancel_reward
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/reward/cancel$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_cancel_reward')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::cancelRewardAction',  '_permission' =>   array (  ),));
            }

            // group_thread_adopt
            if (preg_match('#^/thread/(?P<postId>[^/]++)/adopt$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_adopt')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::adoptAction',  '_permission' =>   array (  ),));
            }

            // group_thread_hide
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/hide$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_hide')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::hideAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/group')) {
            // group_upload
            if ($pathinfo === '/group/thread/upload') {
                return array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::uploadAction',  '_route' => 'group_upload',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/group/attach')) {
                // group_attach_download
                if (0 === strpos($pathinfo, '/group/attach/download') && preg_match('#^/group/attach/download/(?P<fileId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_attach_download')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::downloadAction',  '_permission' =>   array (  ),));
                }

                // group_thread_buy_attach
                if (0 === strpos($pathinfo, '/group/attach/buy') && preg_match('#^/group/attach/buy/(?P<attachId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_buy_attach')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::buyAttachAction',  '_permission' =>   array (  ),));
                }

                // group_thread_delete_attach
                if (0 === strpos($pathinfo, '/group/attach/delete') && preg_match('#^/group/attach/delete/(?P<goodsId>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_group_thread_delete_attach;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'group_thread_delete_attach')), array (  '_controller' => 'AppBundle\\Controller\\GroupThreadController::deleteAttachAction',  '_permission' =>   array (  ),));
                }
                not_group_thread_delete_attach:

            }

        }

        if (0 === strpos($pathinfo, '/my')) {
            // my_bill
            if ($pathinfo === '/my/bill') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::cashBillAction',  '_route' => 'my_bill',  '_permission' =>   array (  ),);
            }

            // my_coin
            if ($pathinfo === '/my/coin') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::indexAction',  '_route' => 'my_coin',  '_permission' =>   array (  ),);
            }

            // my_invite_code
            if ($pathinfo === '/my/invitecode') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::inviteCodeAction',  '_route' => 'my_invite_code',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/note')) {
            // note_like
            if (preg_match('#^/note/(?P<id>[^/]++)/like$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_note_like;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'note_like')), array (  '_controller' => 'AppBundle\\Controller\\NoteController::likeAction',  '_permission' =>   array (  ),));
            }
            not_note_like:

            // note_cancel_like
            if (preg_match('#^/note/(?P<id>[^/]++)/cancel_like$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_note_cancel_like;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'note_cancel_like')), array (  '_controller' => 'AppBundle\\Controller\\NoteController::cancelLikeAction',  '_permission' =>   array (  ),));
            }
            not_note_cancel_like:

        }

        if (0 === strpos($pathinfo, '/my')) {
            if (0 === strpos($pathinfo, '/my/invitecode')) {
                // invite_promote_link
                if ($pathinfo === '/my/invitecode/promotelink') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::promoteLinkAction',  '_route' => 'invite_promote_link',  '_permission' =>   array (  ),);
                }

                // write_invitecode
                if ($pathinfo === '/my/invitecode/writeinvitecode') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::writeInvitecodeAction',  '_route' => 'write_invitecode',  '_permission' =>   array (  ),);
                }

                // receive_coupon
                if ($pathinfo === '/my/invitecode/receivecoupon') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::receiveCouponAction',  '_route' => 'receive_coupon',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/my/coin')) {
                // coin_pay
                if ($pathinfo === '/my/coin/pay') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::payAction',  '_route' => 'coin_pay',  '_permission' =>   array (  ),);
                }

                // coin_show
                if ($pathinfo === '/my/coin/show') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\CoinController::showAction',  '_route' => 'coin_show',  '_permission' =>   array (  ),);
                }

            }

        }

        // user_password_check
        if ($pathinfo === '/user/password/check') {
            return array (  '_controller' => 'AppBundle\\Controller\\UserController::checkPasswordAction',  '_route' => 'user_password_check',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/pay')) {
            if (0 === strpos($pathinfo, '/pay/center')) {
                // pay_center_show
                if ($pathinfo === '/pay/center') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::showAction',  '_route' => 'pay_center_show',  '_permission' =>   array (  ),);
                }

                // pay_center_pay
                if ($pathinfo === '/pay/center/pay') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_pay_center_pay;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::payAction',  '_route' => 'pay_center_pay',  '_permission' =>   array (  ),);
                }
                not_pay_center_pay:

                // pay_center_auth_unbind
                if ($pathinfo === '/pay/center/auth_unbind') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_pay_center_auth_unbind;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::unbindAuthAction',  '_route' => 'pay_center_auth_unbind',  '_permission' =>   array (  ),);
                }
                not_pay_center_auth_unbind:

                // auth_unbind_mobile_show
                if ($pathinfo === '/pay/center/mobile_show') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::showMobileAction',  '_route' => 'auth_unbind_mobile_show',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/pay/center/pay')) {
                    // pay_return
                    if (preg_match('#^/pay/center/pay/(?P<name>[^/]++)/return$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'pay_return')), array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::payReturnAction',  '_permission' =>   array (  ),));
                    }

                    // pay_return_for_app
                    if (preg_match('#^/pay/center/pay/(?P<name>[^/]++)/return_for_app$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'pay_return_for_app')), array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::payReturnForAppAction',  '_permission' =>   array (  ),));
                    }

                    // pay_notify
                    if (preg_match('#^/pay/center/pay/(?P<name>[^/]++)/notify$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'pay_notify')), array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::payNotifyAction',  '_permission' =>   array (  ),));
                    }

                }

                // pay_success_show
                if ($pathinfo === '/pay/center/success/show') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::showTargetAction',  '_route' => 'pay_success_show',  '_permission' =>   array (  ),);
                }

            }

            // pay_password_check
            if ($pathinfo === '/pay/password/check') {
                return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::payPasswordCheckAction',  '_route' => 'pay_password_check',  '_permission' =>   array (  ),);
            }

            // pay_error
            if ($pathinfo === '/pay/error') {
                return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::payErrorAction',  '_route' => 'pay_error',  '_permission' =>   array (  ),);
            }

            // pay_result_notice
            if ($pathinfo === '/pay/result/notice') {
                return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::resultNoticeAction',  '_route' => 'pay_result_notice',  '_permission' =>   array (  ),);
            }

            // wxpay_roll
            if ($pathinfo === '/pay/wxpay/roll') {
                return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::wxpayRollAction',  '_route' => 'wxpay_roll',  '_permission' =>   array (  ),);
            }

            // pay_center_wxpay
            if ($pathinfo === '/pay/center/wxpay') {
                return array (  '_controller' => 'AppBundle\\Controller\\PayCenterController::wxpayAction',  '_route' => 'pay_center_wxpay',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/order')) {
            // order_show
            if ($pathinfo === '/order/show') {
                return array (  '_controller' => 'AppBundle\\Controller\\OrderController::showAction',  '_route' => 'order_show',  '_permission' =>   array (  ),);
            }

            // order_create
            if ($pathinfo === '/order/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_order_create;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\OrderController::createAction',  '_route' => 'order_create',  '_permission' =>   array (  ),);
            }
            not_order_create:

        }

        if (0 === strpos($pathinfo, '/thread')) {
            // thread_jump
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/jump$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_jump')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::jumpAction',  '_permission' =>   array (  ),));
            }

            // thread_post_jump
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/post/(?P<postId>[^/]++)/jump$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_post_jump')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::postJumpAction',  '_permission' =>   array (  ),));
            }

            // thread_post
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/post$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_post')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::postAction',  '_permission' =>   array (  ),));
            }

            // thread_post_reply
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/post/(?P<postId>[^/]++)/$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_post_reply;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_post_reply')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::postReplyAction',  '_permission' =>   array (  ),));
            }
            not_thread_post_reply:

            // thread_post_subposts
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/post/(?P<postId>[^/]++)/subposts$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_post_subposts')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::subpostsAction',  'threadId' => 0,  '_permission' =>   array (  ),));
            }

        }

        // article_post_subposts
        if (0 === strpos($pathinfo, '/article') && preg_match('#^/article/(?P<targetId>[^/]++)/post/(?P<postId>[^/]++)/subposts$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_post_subposts')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::subpostsAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/thread')) {
            // thread_post_delete
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/post/(?P<postId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_post_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_post_delete')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::postDeleteAction',  '_permission' =>   array (  ),));
            }
            not_thread_post_delete:

            // thread_post_up
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/post/(?P<postId>[^/]++)/up$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_post_up;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_post_up')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::postUpAction',  '_permission' =>   array (  ),));
            }
            not_thread_post_up:

            // thread_delete
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_delete')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::deleteAction',  '_permission' =>   array (  ),));
            }
            not_thread_delete:

            // thread_set_sticky
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/set_sticky$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_set_sticky;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_set_sticky')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::setStickyAction',  '_permission' =>   array (  ),));
            }
            not_thread_set_sticky:

            // thread_cancel_sticky
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/cancel_sticky$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_cancel_sticky;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_cancel_sticky')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::cancelStickyAction',  '_permission' =>   array (  ),));
            }
            not_thread_cancel_sticky:

            // thread_set_nice
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/set_nice$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_set_nice;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_set_nice')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::setNiceAction',  '_permission' =>   array (  ),));
            }
            not_thread_set_nice:

            // thread_cancel_nice
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/cancel_nice$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_thread_cancel_nice;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_cancel_nice')), array (  '_controller' => 'AppBundle\\Controller\\ThreadController::cancelNiceAction',  '_permission' =>   array (  ),));
            }
            not_thread_cancel_nice:

            // thread_export_members
            if (preg_match('#^/thread/(?P<threadId>[^/]++)/export/members$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'thread_export_members')), array (  '_controller' => 'AppBundle\\Controller\\Thread\\MemberController::exportAction',  '_permission' =>   array (  ),));
            }

        }

        // ajax_thread_member_show
        if (0 === strpos($pathinfo, '/ajax/thread') && preg_match('#^/ajax/thread/(?P<threadId>[^/]++)/members$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_ajax_thread_member_show;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ajax_thread_member_show')), array (  '_controller' => 'AppBundle\\Controller\\Thread\\MemberController::ajaxFindMembersAction',  '_permission' =>   array (  ),));
        }
        not_ajax_thread_member_show:

        if (0 === strpos($pathinfo, '/vip')) {
            // vip
            if (rtrim($pathinfo, '/') === '/vip') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'vip');
                }

                return array('_route' => 'vip','_permission' => array (
    ));
            }

            // vip_buy
            if ($pathinfo === '/vip/buy') {
                return array('_route' => 'vip_buy','_permission' => array (
    ));
            }

            // vip_renew
            if ($pathinfo === '/vip/renew') {
                return array('_route' => 'vip_renew','_permission' => array (
    ));
            }

            // vip_upgrade
            if ($pathinfo === '/vip/upgrade') {
                return array('_route' => 'vip_upgrade','_permission' => array (
    ));
            }

        }

        if (0 === strpos($pathinfo, '/edu_cloud/s')) {
            if (0 === strpos($pathinfo, '/edu_cloud/sms')) {
                if (0 === strpos($pathinfo, '/edu_cloud/sms_')) {
                    // edu_cloud_sms_send
                    if ($pathinfo === '/edu_cloud/sms_send') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_edu_cloud_sms_send;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\EduCloudController::smsSendAction',  '_route' => 'edu_cloud_sms_send',  '_permission' =>   array (  ),);
                    }
                    not_edu_cloud_sms_send:

                    // edu_cloud_sms_check
                    if (0 === strpos($pathinfo, '/edu_cloud/sms_check') && preg_match('#^/edu_cloud/sms_check/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'edu_cloud_sms_check')), array (  '_controller' => 'AppBundle\\Controller\\EduCloudController::smsCheckAction',  '_permission' =>   array (  ),));
                    }

                }

                // edu_cloud_sms_send_callback
                if (0 === strpos($pathinfo, '/edu_cloud/sms/callback') && preg_match('#^/edu_cloud/sms/callback/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'edu_cloud_sms_send_callback')), array (  '_controller' => 'AppBundle\\Controller\\EduCloudController::smsCallBackAction',  '_permission' =>   array (  ),));
                }

            }

            // edu_cloud_search_callback
            if ($pathinfo === '/edu_cloud/search/callback') {
                return array (  '_controller' => 'AppBundle\\Controller\\EduCloudController::searchCallBackAction',  '_route' => 'edu_cloud_search_callback',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/settings')) {
            // settings_bind_mobile
            if ($pathinfo === '/settings/bind_mobile') {
                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::bindMobileAction',  '_route' => 'settings_bind_mobile',  '_permission' =>   array (  ),);
            }

            // settings_check_login_password
            if ($pathinfo === '/settings/check_login_password') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_settings_check_login_password;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::passwordCheckAction',  '_route' => 'settings_check_login_password',  '_permission' =>   array (  ),);
            }
            not_settings_check_login_password:

        }

        // password_reset_by_sms
        if ($pathinfo === '/password/reset/by_sms') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_password_reset_by_sms;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\PasswordResetController::resetBySmsAction',  '_route' => 'password_reset_by_sms',  '_permission' =>   array (  ),);
        }
        not_password_reset_by_sms:

        // settings_find_pay_password_by_sms
        if ($pathinfo === '/settings/find_pay_password_by_sms') {
            return array (  '_controller' => 'AppBundle\\Controller\\SettingsController::findPayPasswordBySmsAction',  '_route' => 'settings_find_pay_password_by_sms',  '_permission' =>   array (  ),);
        }

        // order_pay_sms_verification
        if ($pathinfo === '/order/sms_verification') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::smsVerificationAction',  '_route' => 'order_pay_sms_verification',  '_permission' =>   array (  ),);
        }

        // edu_cloud_sms_callback
        if ($pathinfo === '/edu_cloud/sms_callback') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_edu_cloud_sms_callback;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\EduCloudController::cloudCallBackAction',  '_route' => 'edu_cloud_sms_callback',  '_permission' =>   array (  ),);
        }
        not_edu_cloud_sms_callback:

        // common_parse_qrcode
        if (0 === strpos($pathinfo, '/qrcode/parse') && preg_match('#^/qrcode/parse/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'common_parse_qrcode')), array (  '_controller' => 'AppBundle\\Controller\\CommonController::parseQrcodeAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/esbar/my')) {
            if (0 === strpos($pathinfo, '/esbar/my/c')) {
                // esbar_my_classroom
                if ($pathinfo === '/esbar/my/classroom') {
                    return array (  '_controller' => 'AppBundle\\Controller\\EsBar\\EsBarController::classroomAction',  '_route' => 'esbar_my_classroom',  '_permission' =>   array (  ),);
                }

                // esbar_my_course
                if ($pathinfo === '/esbar/my/course') {
                    return array (  '_controller' => 'AppBundle\\Controller\\EsBar\\EsBarController::courseAction',  '_route' => 'esbar_my_course',  '_permission' =>   array (  ),);
                }

            }

            // esbar_my_notify
            if ($pathinfo === '/esbar/my/notify') {
                return array (  '_controller' => 'AppBundle\\Controller\\EsBar\\EsBarController::notifyAction',  '_route' => 'esbar_my_notify',  '_permission' =>   array (  ),);
            }

            // esbar_my_practice
            if (0 === strpos($pathinfo, '/esbar/my/practice') && preg_match('#^/esbar/my/practice/(?P<status>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'esbar_my_practice')), array (  '_controller' => 'AppBundle\\Controller\\EsBar\\EsBarController::practiceAction',  '_permission' =>   array (  ),));
            }

            // esbar_my_study_center
            if ($pathinfo === '/esbar/my/study_center') {
                return array (  '_controller' => 'AppBundle\\Controller\\EsBar\\EsBarController::studyCenterAction',  '_route' => 'esbar_my_study_center',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/my')) {
            // my
            if ($pathinfo === '/my') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\CourseController::indexAction',  '_route' => 'my',  '_permission' =>   array (  ),);
            }

            // my_cards
            if ($pathinfo === '/my/cards') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\CardController::indexAction',  '_route' => 'my_cards',  '_permission' =>   array (  ),);
            }

        }

        // card_info
        if ($pathinfo === '/card/info') {
            return array (  '_controller' => 'AppBundle\\Controller\\My\\CardController::cardInfoAction',  '_route' => 'card_info',  '_permission' =>   array (  ),);
        }

        // sms_prepare
        if (0 === strpos($pathinfo, '/sms/prepare') && preg_match('#^/sms/prepare/(?P<targetType>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sms_prepare')), array (  '_controller' => 'AppBundle\\Controller\\SmsController::prepareAction',  '_permission' =>   array (  ),));
        }

        // publish_sms_send
        if (0 === strpos($pathinfo, '/publish/sms_send') && preg_match('#^/publish/sms_send/(?P<targetType>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'publish_sms_send')), array (  '_controller' => 'AppBundle\\Controller\\SmsController::sendAction',  '_permission' =>   array (  ),));
        }

        // generate_short_link
        if ($pathinfo === '/generate/short/link') {
            return array (  '_controller' => 'AppBundle\\Controller\\SmsController::changeLinkAction',  '_route' => 'generate_short_link',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/open/course')) {
            // open_course_explore
            if ($pathinfo === '/open/course/explore') {
                return array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::exploreAction',  '_route' => 'open_course_explore',  '_permission' =>   array (  ),);
            }

            // open_course_manage
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::indexAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_publish
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/publish$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_publish')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::publishAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_base
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/base$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_base')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::baseAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_lesson
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/lesson$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::lessonAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_lesson_create
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/lesson/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson_create')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::createAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_lesson_edit
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson_edit')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::editAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_lesson_publish
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/publish$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson_publish')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::publishAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_lesson_delete
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson_delete')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::deleteAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_lesson_unpublish
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/unpublish$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson_unpublish')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::unpublishAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_lesson_sort
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/lesson/sort$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_lesson_sort;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson_sort')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::sortAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_lesson_sort:

            // open_course_draft_create
            if ($pathinfo === '/open/course/draft/create') {
                return array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::draftCreateAction',  '_route' => 'open_course_draft_create',  '_permission' =>   array (  ),);
            }

            // open_course_manage_picture
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/picture$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_picture')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::pictureAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_picture_crop
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/picture/crop$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_picture_crop')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::pictureCropAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_teachers
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/teachers$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_teachers')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::teachersAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_teachers_match
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/teachers/match$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_teachers_match')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::teachersMatchAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_live_time_set
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/live/time$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_live_time_set')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::liveOpenTimeSetAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_marketing
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/marketing$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_marketing')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::marketingAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_students
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/students$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_students')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::studentsAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_students_show
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/students/(?P<userId>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_students_show')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::studentDetailAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_files
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/files$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_files')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::indexAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_file_show
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/file/(?P<fileId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_file_show')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::showAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_file_convert
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/file/(?P<fileId>[^/]++)/convert$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_file_convert;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_file_convert')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::convertAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_file_convert:

            // open_course_manage_file_status
            if ($pathinfo === '/open/course/manage/file/status') {
                return array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::fileStatusAction',  '_route' => 'open_course_manage_file_status',  '_permission' =>   array (  ),);
            }

            // open_course_manage_files_batch_upload
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/files/batch/upload/(?P<targetType>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_files_batch_upload')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::batchUploadCourseFilesAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_files_upload
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/files/upload/(?P<targetType>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_files_upload')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::uploadCourseFilesAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_delete_materials_show
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/show/delete/materials$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_delete_materials_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_delete_materials_show')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::deleteMaterialShowAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_delete_materials_show:

            // open_course_manage_files_delete
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/materials/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_files_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_files_delete')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseFileManageController::deleteCourseFilesAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_files_delete:

            // open_course_manage_course_pick
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/recommend/pick(?:/(?P<filter>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_course_pick')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::pickAction',  'filter' => 'openCourse',  '_permission' =>   array (  ),));
            }

            // open_course_manage_recommend_course_delete
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/recommend/(?P<recommendId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_recommend_course_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_recommend_course_delete')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::deleteRecommendCourseAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_recommend_course_delete:

            // open_course_manage_lesson_replays_edit
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/replays/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_lesson_replays_edit')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::editLessonReplayAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_replay_title_update
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/replay/(?P<replayId>[^/]++)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_replay_title_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_replay_title_update')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::updateReplayTitleAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_replay_title_update:

            // open_course_manage_student_export_csv
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/student/export$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_student_export_csv')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::studentsExportAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_student_export_datas
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/student/export/datas$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_student_export_datas')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::studentsExportDatasAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_material
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/material$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_material')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::materialModalAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_material_upload
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/lesson/(?P<lessonId>[^/]++)/material/upload$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_material_upload;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_material_upload')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::materialUploadAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_material_upload:

            // open_course_manage_material_delete
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/material/(?P<materialId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_manage_material_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_material_delete')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::materialDeleteAction',  '_permission' =>   array (  ),));
            }
            not_open_course_manage_material_delete:

            // open_course_material_download
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/material/(?P<materialId>[^/]++)/download$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_material_download')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::materialDownloadAction',  '_permission' =>   array (  ),));
            }

            // open_course_manage_material_browser
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/material/browser$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_manage_material_browser')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseLessonManageController::materialBrowserAction',  '_permission' =>   array (  ),));
            }

            // open_course_course_search
            if (preg_match('#^/open/course/(?P<id>[^/]++)/recommended/search/(?P<filter>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_course_search')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::searchAction',  '_permission' =>   array (  ),));
            }

            // open_course_recommended_course_select
            if (preg_match('#^/open/course/(?P<id>[^/]++)/recommended/select$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_recommended_course_select')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::recommendedCoursesSelectAction',  '_permission' =>   array (  ),));
            }

            // open_course_show
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_show')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::showAction',  'lessonId' => NULL,  '_permission' =>   array (  ),));
            }

            // open_course_lesson_learn
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/learn$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_lesson_learn')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::showAction',  'lessonId' => NULL,  '_permission' =>   array (  ),));
            }

            // open_course_lesson_show
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_lesson_show')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::lessonShowAction',  '_permission' =>   array (  ),));
            }

            // open_course_favorite
            if (preg_match('#^/open/course/(?P<id>[^/]++)/favorite$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_favorite;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_favorite')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::favoriteAction',  '_permission' =>   array (  ),));
            }
            not_open_course_favorite:

            // open_course_unfavorite
            if (preg_match('#^/open/course/(?P<id>[^/]++)/unfavorite$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_unfavorite;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_unfavorite')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::unfavoriteAction',  '_permission' =>   array (  ),));
            }
            not_open_course_unfavorite:

            // open_course_like
            if (preg_match('#^/open/course/(?P<id>[^/]++)/like$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_like;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_like')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::likeAction',  '_permission' =>   array (  ),));
            }
            not_open_course_like:

            // open_course_unlike
            if (preg_match('#^/open/course/(?P<id>[^/]++)/unlike$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_unlike;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_unlike')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::unlikeAction',  '_permission' =>   array (  ),));
            }
            not_open_course_unlike:

            // open_course_post
            if (preg_match('#^/open/course/(?P<id>[^/]++)/post$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_post')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::postAction',  '_permission' =>   array (  ),));
            }

            // open_course_post_reply
            if (preg_match('#^/open/course/(?P<id>[^/]++)/post/(?P<postId>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_open_course_post_reply;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_post_reply')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::postReplyAction',  '_permission' =>   array (  ),));
            }
            not_open_course_post_reply:

            // live_open_course_play
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/live_entry$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_open_course_play')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::entryAction',  '_permission' =>   array (  ),));
            }

            // live_open_course_manage_replay
            if (preg_match('#^/open/course/(?P<id>[^/]++)/manage/replay$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_open_course_manage_replay')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::replayManageAction',  '_permission' =>   array (  ),));
            }

            // live_open_course_lesson_replay_create
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/live/replay/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_open_course_lesson_replay_create')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::createLessonReplayAction',  '_permission' =>   array (  ),));
            }

            // live_open_course_lesson_replay_upload
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/replay/upload$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_open_course_lesson_replay_upload')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::uploadModalAction',  '_permission' =>   array (  ),));
            }

            // live_open_course_live_replay_entry
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/live/replay/(?P<replayId>[^/]++)/entry$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_open_course_live_replay_entry')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::entryReplayAction',  '_permission' =>   array (  ),));
            }

            // live_open_course_live_replay_url
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/live/replay/(?P<replayId>[^/]++)/url$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_open_course_live_replay_url')), array (  '_controller' => 'AppBundle\\Controller\\LiveOpenCourseController::getReplayUrlAction',  '_permission' =>   array (  ),));
            }

            // live_open_lesson_time_check
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/manage/live/time/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_open_lesson_time_check')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseManageController::lessonTimeCheckAction',  '_permission' =>   array (  ),));
            }

        }

        // es_live_room_replay_show
        if (0 === strpos($pathinfo, '/es_live') && preg_match('#^/es_live/(?P<targetType>[^/]++)/(?P<targetId>[^/]++)/lesson/(?P<lessonId>[^/]++)/replay/(?P<replayId>[^/]++)/show$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'es_live_room_replay_show')), array (  '_controller' => 'AppBundle\\Controller\\LiveroomController::playESLiveReplayAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/open/course')) {
            // open_course_member_sms
            if (preg_match('#^/open/course/(?P<id>[^/]++)/member/sms$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_member_sms')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::memberSmsAction',  '_permission' =>   array (  ),));
            }

            // open_course_member_create
            if (preg_match('#^/open/course/(?P<id>[^/]++)/member/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_member_create')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::createMemberAction',  '_permission' =>   array (  ),));
            }

            // open_course_lesson_player
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/lesson/(?P<lessonId>[^/]++)/player$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_lesson_player')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::playerAction',  '_permission' =>   array (  ),));
            }

            // open_course_mobile_check
            if (preg_match('#^/open/course/(?P<courseId>[^/]++)/mobile/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_mobile_check')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::mobileCheckAction',  '_permission' =>   array (  ),));
            }

            // open_course_ad_modal_recommend_course
            if (preg_match('#^/open/course/(?P<id>[^/]++)/ad\\-modal/recommend/course$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_open_course_ad_modal_recommend_course;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'open_course_ad_modal_recommend_course')), array (  '_controller' => 'AppBundle\\Controller\\OpenCourseController::adModalRecommendCourseAction',  '_permission' =>   array (  ),));
            }
            not_open_course_ad_modal_recommend_course:

        }

        if (0 === strpos($pathinfo, '/importer')) {
            // importer_check
            if (preg_match('#^/importer/(?P<type>[^/]++)/check$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_importer_check;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'importer_check')), array (  '_controller' => 'AppBundle\\Controller\\ImporterController::checkAction',  '_permission' =>   array (  ),));
            }
            not_importer_check:

            // importer_import
            if (preg_match('#^/importer/(?P<type>[^/]++)/import$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_importer_import;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'importer_import')), array (  '_controller' => 'AppBundle\\Controller\\ImporterController::importAction',  '_permission' =>   array (  ),));
            }
            not_importer_import:

            // importer_index
            if (preg_match('#^/importer/(?P<type>[^/]++)/index$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'importer_index')), array (  '_controller' => 'AppBundle\\Controller\\ImporterController::templateAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/course')) {
            // course_activity_trigger
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<activityId>[^/]++)/trigger$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_activity_trigger;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_activity_trigger')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\ActivityController::triggerAction',  '_permission' =>   array (  ),));
            }
            not_course_activity_trigger:

            // course_acitvity_watch
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<id>[^/]++)/watch$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_acitvity_watch')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\VideoController::watchAction',  '_permission' =>   array (  ),));
            }

            // course_activity_download
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activiy/(?P<activityId>[^/]++)/download$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_activity_download')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\DownloadController::downloadFileAction',  '_permission' =>   array (  ),));
            }

            // course_text_activity_auto_save
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<activityId>[^/]++)/text/auto_save$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_text_activity_auto_save;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_text_activity_auto_save')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\TextController::autoSaveAction',  '_permission' =>   array (  ),));
            }
            not_course_text_activity_auto_save:

            // course_task_show
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_show')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::showAction',  '_permission' =>   array (  ),));
            }

            // course_task_preview
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/preview$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_preview')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::previewAction',  '_permission' =>   array (  ),));
            }

            // course_task_content_preview
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/content/preview$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_content_preview')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::contentPreviewAction',  '_permission' =>   array (  ),));
            }

            // course_task_activity_show
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/activity_show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_activity_show')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::taskActivityAction',  '_permission' =>   array (  ),));
            }

            // course_task_trigger
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/trigger$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_trigger')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::triggerAction',  '_permission' =>   array (  ),));
            }

            // course_task_finish
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/finish$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_finish')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::finishAction',  '_permission' =>   array (  ),));
            }

            // course_task_qrcode
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/qrcode$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_qrcode')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::qrcodeAction',  '_permission' =>   array (  ),));
            }

            // course_task_finished_prompt
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/finished_prompt$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_finished_prompt')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::taskFinishedPromptAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_pre_create_check
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/pre_create_check$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_manage_task_pre_create_check;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_pre_create_check')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::preCreateCheckAction',  '_permission' =>   array (  ),));
            }
            not_course_manage_task_pre_create_check:

            // course_manage_task_pre_update_check
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/pre_update_check$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_manage_task_pre_update_check;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_pre_update_check')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::preUpdateCheckAction',  '_permission' =>   array (  ),));
            }
            not_course_manage_task_pre_update_check:

            // course_manage_task_create
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_create')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::createAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_batch_create
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/batch/modal$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_batch_create')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::batchCreateTasksAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_publish
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/publish$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_publish')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::publishAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_unpublish
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/unpublish$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_unpublish')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::unPublishAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_fields
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task_fields/(?P<mode>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_fields')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::taskFieldsAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_update
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_update')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::updateAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_delete
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_delete')), array (  '_controller' => 'AppBundle\\Controller\\TaskManageController::deleteAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_replay_edit
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/replay/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_replay_edit')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::editTaskReplayAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_replay_title_update
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/replay/(?P<replayId>[^/]++)/update_title$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_manage_task_replay_title_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_replay_title_update')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::updateTaskReplayTitleAction',  '_permission' =>   array (  ),));
            }
            not_course_manage_task_replay_title_update:

            // course_manage_task_replay_upload
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/replay/upload$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_replay_upload')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::uploadReplayAction',  '_permission' =>   array (  ),));
            }

            // course_manage_task_replay_create
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/replay/create$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_manage_task_replay_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_task_replay_create')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::createReplayAction',  '_permission' =>   array (  ),));
            }
            not_course_manage_task_replay_create:

            // task_live_entry
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<activityId>[^/]++)/live_entry$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'task_live_entry')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\LiveController::liveEntryAction',  '_permission' =>   array (  ),));
            }

            // live_activity_replay_entry
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<activityId>[^/]++)/replay/(?P<replayId>[^/]++)/entry$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_activity_replay_entry')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\LiveController::replayEntryAction',  '_permission' =>   array (  ),));
            }

            // live_activity_replay_url
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<activityId>[^/]++)/replay/(?P<replayId>[^/]++)/play$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'live_activity_replay_url')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\LiveController::replayUrlAction',  '_permission' =>   array (  ),));
            }

            // task_live_replay_player
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<activityId>[^/]++)/replay$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'task_live_replay_player')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\LiveController::liveReplayAction',  '_permission' =>   array (  ),));
            }

            // task_live_trigger
            if (preg_match('#^/course/(?P<courseId>[^/]++)/activity/(?P<activityId>[^/]++)/live_trigger$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'task_live_trigger')), array (  '_controller' => 'AppBundle\\Controller\\Activity\\LiveController::triggerAction',  '_permission' =>   array (  ),));
            }

            // course_task_note_save
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/note/save$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_note_save')), array (  '_controller' => 'AppBundle\\Controller\\NoteController::saveCourseNoteAction',  '_permission' =>   array (  ),));
            }

            // course_task_show_plugins
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/show/plugins$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_show_plugins')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::taskPluginsAction',  '_permission' =>   array (  ),));
            }

            // course_task_show_plugin_task_list
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/plugin/task_list$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_show_plugin_task_list')), array (  '_controller' => 'AppBundle\\Controller\\TaskPluginController::taskListAction',  '_permission' =>   array (  ),));
            }

            // course_task_plugin_note
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/plugin/note$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_plugin_note')), array (  '_controller' => 'AppBundle\\Controller\\TaskPluginController::noteAction',  '_permission' =>   array (  ),));
            }

            // course_task_plugin_threads
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/plugin/threads$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_plugin_threads')), array (  '_controller' => 'AppBundle\\Controller\\TaskPluginController::threadsAction',  '_permission' =>   array (  ),));
            }

            // course_task_plugin_thread_create
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/plugin/thread/create$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_task_plugin_thread_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_plugin_thread_create')), array (  '_controller' => 'AppBundle\\Controller\\TaskPluginController::createThreadAction',  '_permission' =>   array (  ),));
            }
            not_course_task_plugin_thread_create:

            // course_task_plugin_thread_show
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/plugin/thread/(?P<threadId>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_course_task_plugin_thread_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_plugin_thread_show')), array (  '_controller' => 'AppBundle\\Controller\\TaskPluginController::threadAction',  '_permission' =>   array (  ),));
            }
            not_course_task_plugin_thread_show:

            // course_task_plugin_thread_answer
            if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/plugin/thread/(?P<threadId>[^/]++)/answer$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_task_plugin_thread_answer;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_plugin_thread_answer')), array (  '_controller' => 'AppBundle\\Controller\\TaskPluginController::answerQuestionAction',  '_permission' =>   array (  ),));
            }
            not_course_task_plugin_thread_answer:

            // course_manage_chapter_create
            if (preg_match('#^/course/(?P<id>[^/]++)/manage/chapter/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_chapter_create')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ChapterManageController::createAction',  '_permission' =>   array (  ),));
            }

            // course_manage_chapter_edit
            if (preg_match('#^/course/(?P<courseId>[^/]++)/manage/chapter/(?P<chapterId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_chapter_edit')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ChapterManageController::editAction',  '_permission' =>   array (  ),));
            }

            // course_manage_chapter_delete
            if (preg_match('#^/course/(?P<courseId>[^/]++)/manage/chapter/(?P<chapterId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_manage_chapter_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_chapter_delete')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ChapterManageController::deleteAction',  '_permission' =>   array (  ),));
            }
            not_course_manage_chapter_delete:

            // course_set_explore
            if (0 === strpos($pathinfo, '/course/explore') && preg_match('#^/course/explore(?:/(?P<category>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_explore')), array (  '_controller' => 'AppBundle\\Controller\\ExploreController::courseSetsAction',  'category' => '',  '_permission' =>   array (  ),));
            }

        }

        // live_course_set_explore
        if ($pathinfo === '/live') {
            return array (  '_controller' => 'AppBundle\\Controller\\Course\\LiveCourseSetController::exploreAction',  '_route' => 'live_course_set_explore',  '_permission' =>   array (  ),);
        }

        if (0 === strpos($pathinfo, '/course')) {
            if (0 === strpos($pathinfo, '/course_set')) {
                // course_set_manage_sync
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/sync$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_sync')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::syncInfoAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_unlock
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/unlock$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_unlock')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::unlockAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_unlock_confirm
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/unlock_confirm$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_unlock_confirm')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::unlockConfirmAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_courses
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/courses$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_courses')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::listAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_create
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/create$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_create')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::createAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_copy
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/copy$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_copy')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::copyAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_info
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/info$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_info')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::infoAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_tasks
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/tasks$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_tasks')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::tasksAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_replay
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/replay$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_replay')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::replayAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_marketing
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/marketing$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_marketing')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::marketingAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_teachers
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/teachers$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_teachers')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::teachersAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_teachers_match
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/teachers_match$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_teachers_match')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::teachersMatchAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/students$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::studentsAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_quit_records
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/quit_records$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_quit_records')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::studentQuitRecordsAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students_add
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/students/add$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_add')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::createCourseStudentAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students_remove
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/students/(?P<userId>[^/]++)/remove$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_course_students_remove;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_remove')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::removeCourseStudentAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_course_students_remove:

                // course_set_manage_course_students_remark
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/student/(?P<userId>[^/]++)/remark$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_remark')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::remarkAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students_expiryday
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/student/(?P<userId>[^/]++)/expiryday$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_expiryday')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::addMemberExpiryDaysAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_student_export_csv
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/student/export$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_student_export_csv')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::exportCsvAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_student_export_datas
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/manage/student/export/datas$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_student_export_datas')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::exportDatasAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students_process
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/students/(?P<userId>[^/]++)/process$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_process')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::studyProcessAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students_check
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/students/check$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_check')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::checkStudentAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students_show
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/students/(?P<userId>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::showAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_students_defined_show
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/students/(?P<userId>[^/]++)/defined_show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_students_defined_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\StudentManageController::definedShowAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_orders
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/orders$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_orders')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::ordersAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_orders_export_csv
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/orders/export$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_orders_export_csv')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::ordersExportCsvAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_dashboard
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/dashboard$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_dashboard')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::dashboardAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_dashboard_task_detail
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/dashboard/detail/(?P<taskId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_dashboard_task_detail')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::taskLearnDetailAction',  '_permission' =>   array (  ),));
                }

                // course_manage_question_marker
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/questionmarker$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_question_marker')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::questionMarkerStatsAction',  '_permission' =>   array (  ),));
                }

                // course_manage_question_marker_analysis
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/course/(?P<courseId>[^/]++)/questionmarker/(?P<questionMarkerId>[^/]++)/analysis$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_question_marker_analysis')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::questionMarkerAnalysisAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_course_close_check
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/course/(?P<courseId>[^/]++)/close_check$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_course_close_check;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_close_check')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::closeCheckAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_course_close_check:

                // course_set_manage_course_close
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/course/(?P<courseId>[^/]++)/close$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_course_close;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_close')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::closeAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_course_close:

                // course_set_manage_course_delete
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/course/(?P<courseId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_course_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_delete')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_course_delete:

                // course_set_manage_course_publish
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/course/(?P<courseId>[^/]++)/publish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_course_publish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_course_publish')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::publishAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_course_publish:

            }

            // course_manage_items_sort
            if (preg_match('#^/course/(?P<courseId>[^/]++)/manage/items/sort$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_manage_items_sort;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_items_sort')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseManageController::courseItemsSortAction',  '_permission' =>   array (  ),));
            }
            not_course_manage_items_sort:

        }

        if (0 === strpos($pathinfo, '/my')) {
            if (0 === strpos($pathinfo, '/my/c')) {
                if (0 === strpos($pathinfo, '/my/courses')) {
                    if (0 === strpos($pathinfo, '/my/courses/learn')) {
                        // my_courses_learning
                        if ($pathinfo === '/my/courses/learning') {
                            return array (  '_controller' => 'AppBundle\\Controller\\My\\CourseController::learningAction',  '_route' => 'my_courses_learning',  '_permission' =>   array (  ),);
                        }

                        // my_courses_learned
                        if ($pathinfo === '/my/courses/learned') {
                            return array (  '_controller' => 'AppBundle\\Controller\\My\\CourseController::learnedAction',  '_route' => 'my_courses_learned',  '_permission' =>   array (  ),);
                        }

                    }

                    // my_course_sets_favorite
                    if ($pathinfo === '/my/courses/favorite') {
                        return array (  '_controller' => 'AppBundle\\Controller\\My\\CourseSetController::favoriteAction',  '_route' => 'my_course_sets_favorite',  '_permission' =>   array (  ),);
                    }

                }

                if (0 === strpos($pathinfo, '/my/classroom')) {
                    // my_classrooms
                    if ($pathinfo === '/my/classrooms') {
                        return array (  '_controller' => 'AppBundle\\Controller\\My\\ClassroomController::classroomAction',  '_route' => 'my_classrooms',  '_permission' =>   array (  ),);
                    }

                    // my_classroom_discussions
                    if ($pathinfo === '/my/classroom/discussions') {
                        return array (  '_controller' => 'AppBundle\\Controller\\My\\ClassroomController::classroomDiscussionsAction',  '_route' => 'my_classroom_discussions',  '_permission' =>   array (  ),);
                    }

                }

            }

            // my_questions
            if ($pathinfo === '/my/questions') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\ThreadController::questionsAction',  '_route' => 'my_questions',  '_permission' =>   array (  ),);
            }

            // my_discussions
            if ($pathinfo === '/my/discussions') {
                return array (  '_controller' => 'AppBundle\\Controller\\My\\ThreadController::discussionsAction',  '_route' => 'my_discussions',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/my/note')) {
                if (0 === strpos($pathinfo, '/my/notebook')) {
                    // my_notebooks
                    if ($pathinfo === '/my/notebooks') {
                        return array (  '_controller' => 'AppBundle\\Controller\\My\\NotebookController::indexAction',  '_route' => 'my_notebooks',  '_permission' =>   array (  ),);
                    }

                    // my_notebook_show
                    if (preg_match('#^/my/notebook/(?P<courseId>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_notebook_show')), array (  '_controller' => 'AppBundle\\Controller\\My\\NotebookController::showAction',  '_permission' =>   array (  ),));
                    }

                }

                // my_note_delete
                if (preg_match('#^/my/note/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_my_note_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_note_delete')), array (  '_controller' => 'AppBundle\\Controller\\My\\NotebookController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_my_note_delete:

            }

            if (0 === strpos($pathinfo, '/my/group')) {
                // my_group_member_center
                if ($pathinfo === '/my/group') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\GroupController::memberCenterAction',  '_route' => 'my_group_member_center',  '_permission' =>   array (  ),);
                }

                // my_group_member_join
                if ($pathinfo === '/my/group/join') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\GroupController::memberJoinAction',  '_route' => 'my_group_member_join',  '_permission' =>   array (  ),);
                }

                // my_group_member_threads
                if ($pathinfo === '/my/group/threads') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\GroupController::memberThreadsAction',  '_route' => 'my_group_member_threads',  '_permission' =>   array (  ),);
                }

                // my_group_member_posts
                if ($pathinfo === '/my/group/posts') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\GroupController::memberPostsAction',  '_route' => 'my_group_member_posts',  '_permission' =>   array (  ),);
                }

                // my_group_thread_collecting
                if ($pathinfo === '/my/group/collecting') {
                    return array (  '_controller' => 'AppBundle\\Controller\\My\\GroupController::collectingAction',  '_route' => 'my_group_thread_collecting',  '_permission' =>   array (  ),);
                }

            }

        }

        if (0 === strpos($pathinfo, '/course')) {
            if (0 === strpos($pathinfo, '/course_set')) {
                // course_set_manage_create
                if ($pathinfo === '/course_set/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::createAction',  '_route' => 'course_set_manage_create',  '_permission' =>   array (  ),);
                }

                // course_set_show
                if (preg_match('#^/course_set/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetController::showAction',  '_permission' =>   array (  ),));
                }

            }

            // course_qrcode
            if (preg_match('#^/course/(?P<id>[^/]++)/qrcode$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_qrcode;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_qrcode')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseController::qrcodeAction',  '_permission' =>   array (  ),));
            }
            not_course_qrcode:

            if (0 === strpos($pathinfo, '/course_set')) {
                // course_set_favorite
                if (preg_match('#^/course_set/(?P<id>[^/]++)/favorite$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_favorite;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_favorite')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetController::favoriteAction',  '_permission' =>   array (  ),));
                }
                not_course_set_favorite:

                // course_set_unfavorite
                if (preg_match('#^/course_set/(?P<id>[^/]++)/unfavorite$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_unfavorite;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_unfavorite')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetController::unfavoriteAction',  '_permission' =>   array (  ),));
                }
                not_course_set_unfavorite:

            }

            // course_exit
            if (preg_match('#^/course/(?P<id>[^/]++)/exit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_exit')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseController::exitAction',  '_permission' =>   array (  ),));
            }

            // course_thread_create
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_create')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::createAction',  '_permission' =>   array (  ),));
            }

            // course_thread_show
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::showAction',  '_permission' =>   array (  ),));
            }

            // course_thread_post
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/post$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_post')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::postAction',  '_permission' =>   array (  ),));
            }

            // course_thread_edit
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_edit')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::editAction',  '_permission' =>   array (  ),));
            }

            // course_thread_post_delete
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/post/(?P<postId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_thread_post_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_post_delete')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::deletePostAction',  '_permission' =>   array (  ),));
            }
            not_course_thread_post_delete:

            // course_thread_post_edit
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/post/(?P<postId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_post_edit')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::editPostAction',  '_permission' =>   array (  ),));
            }

            // course_thread_stick
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/stick$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_thread_stick;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_stick')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::stickAction',  '_permission' =>   array (  ),));
            }
            not_course_thread_stick:

            // course_thread_unstick
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/unstick$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_thread_unstick;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_unstick')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::unstickAction',  '_permission' =>   array (  ),));
            }
            not_course_thread_unstick:

            // course_thread_elite
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/elite$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_thread_elite;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_elite')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::eliteAction',  '_permission' =>   array (  ),));
            }
            not_course_thread_elite:

            // course_thread_unelite
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/unelite$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_thread_unelite;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_unelite')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::uneliteAction',  '_permission' =>   array (  ),));
            }
            not_course_thread_unelite:

            // course_thread_delete
            if (preg_match('#^/course/(?P<courseId>[^/]++)/thread/(?P<threadId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_thread_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_thread_delete')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ThreadController::deleteAction',  '_permission' =>   array (  ),));
            }
            not_course_thread_delete:

            if (0 === strpos($pathinfo, '/course_set')) {
                // course_set_manage
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::indexAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_base
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/base$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_base')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::baseAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_detail
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/detail$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_detail')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::detailAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_cover
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/cover$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_cover')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::coverAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_cover_crop
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/cover_crop$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_cover_crop')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::coverCropAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_files
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/files$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_files')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetFileManageController::indexAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_file_show
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/file/(?P<fileId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_file_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetFileManageController::showAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_file_convert
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/file/(?P<fileId>[^/]++)/convert$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_file_convert;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_file_convert')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetFileManageController::convertAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_file_convert:

                // course_set_manage_file_status
                if ($pathinfo === '/course_set/manage/file/status') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetFileManageController::fileStatusAction',  '_route' => 'course_set_manage_file_status',  '_permission' =>   array (  ),);
                }

                // course_set_manage_delete_materials_show
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/show/delete/materials$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_delete_materials_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_delete_materials_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetFileManageController::deleteMaterialsAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_delete_materials_show:

                // course_set_manage_delete_materials
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/delete/materials$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_delete_materials;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_delete_materials')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetFileManageController::deleteCourseFilesAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_delete_materials:

                // course_set_manage_publish
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/publish$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_publish')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::publishAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_close
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/close$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_close')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetManageController::closeAction',  '_permission' =>   array (  ),));
                }

            }

            // course_review_create
            if (preg_match('#^/course/(?P<id>[^/]++)/review/create$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_review_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_review_create')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ReviewController::createAction',  '_permission' =>   array (  ),));
            }
            not_course_review_create:

            // course_review_post
            if (preg_match('#^/course/(?P<courseId>[^/]++)/review/(?P<reviewId>[^/]++)/post$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_review_post')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ReviewController::postAction',  '_permission' =>   array (  ),));
            }

            // course_review_delete
            if (preg_match('#^/course/(?P<courseId>[^/]++)/review/(?P<reviewId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_review_delete')), array (  '_controller' => 'AppBundle\\Controller\\Course\\ReviewController::deleteAction',  '_permission' =>   array (  ),));
            }

            // course_material_download
            if (preg_match('#^/course/(?P<courseId>[^/]++)/material/(?P<materialId>[^/]++)/download$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_material_download')), array (  '_controller' => 'AppBundle\\Controller\\Course\\MaterialController::downloadAction',  '_permission' =>   array (  ),));
            }

            // course_material_delete
            if (preg_match('#^/course/(?P<id>[^/]++)/material/(?P<materialId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_course_material_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_material_delete')), array (  '_controller' => 'AppBundle\\Controller\\Course\\MaterialController::deleteAction',  '_permission' =>   array (  ),));
            }
            not_course_material_delete:

        }

        if (0 === strpos($pathinfo, '/media')) {
            if (0 === strpos($pathinfo, '/media/materiallib/c')) {
                // media_materiallib_choose
                if ($pathinfo === '/media/materiallib/choose') {
                    return array (  '_controller' => 'AppBundle\\Controller\\FileChooserController::materialChooseAction',  '_route' => 'media_materiallib_choose',  '_permission' =>   array (  ),);
                }

                // media_materiallib_contacts
                if ($pathinfo === '/media/materiallib/contacts') {
                    return array (  '_controller' => 'AppBundle\\Controller\\FileChooserController::findMySharingContactsAction',  '_route' => 'media_materiallib_contacts',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/media/course')) {
                // media_course_file_choose
                if (0 === strpos($pathinfo, '/media/coursefile') && preg_match('#^/media/coursefile/(?P<courseId>[^/]++)/choose$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_course_file_choose')), array (  '_controller' => 'AppBundle\\Controller\\FileChooserController::courseFileChooseAction',  '_permission' =>   array (  ),));
                }

                // media_video_import
                if (preg_match('#^/media/course/(?P<courseId>[^/]++)/import$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_video_import')), array (  '_controller' => 'AppBundle\\Controller\\FileChooserController::importAction',  '_permission' =>   array (  ),));
                }

            }

        }

        if (0 === strpos($pathinfo, '/uploader/v2')) {
            // uploader_auth_v2
            if ($pathinfo === '/uploader/v2/auth') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_uploader_auth_v2;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::authAction',  '_route' => 'uploader_auth_v2',  '_permission' =>   array (  ),);
            }
            not_uploader_auth_v2:

            // uploader_init_v2
            if ($pathinfo === '/uploader/v2/init') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_uploader_init_v2;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::initAction',  '_route' => 'uploader_init_v2',  '_permission' =>   array (  ),);
            }
            not_uploader_init_v2:

            // uploader_finished_v2
            if ($pathinfo === '/uploader/v2/finished') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_uploader_finished_v2;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\UploaderController::finishedAction',  '_route' => 'uploader_finished_v2',  '_permission' =>   array (  ),);
            }
            not_uploader_finished_v2:

        }

        if (0 === strpos($pathinfo, '/course')) {
            if (0 === strpos($pathinfo, '/course_set')) {
                // course_set_manage_question
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/question$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::indexAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_question_create
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/question/(?P<type>[^/]++)/create$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_create')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::createAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_question_update
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/question/(?P<questionId>[^/]++)/update$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_update')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::updateAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_question_delete
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/question/delete/(?P<questionId>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_question_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_delete')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_question_delete:

                // course_set_manage_question_deletes
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/question/deletes$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_question_deletes;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_deletes')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::deletesAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_question_deletes:

                // course_set_manage_question_preview
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/question/(?P<questionId>[^/]++)/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_preview')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::previewAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_question_picker
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/question/picker$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_picker')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::questionPickerAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_question_picked
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/question/picked$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_picked')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::pickedQuestionAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_question_check
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/question/check$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_check')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::checkAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_show_tasks
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/show/tasks$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_show_tasks;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_show_tasks')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::showTasksAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_show_tasks:

                // course_set_manage_question_check_num
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/question/check/num$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_question_check_num;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_question_check_num')), array (  '_controller' => 'AppBundle\\Controller\\Question\\ManageController::showQuestionTypesNumAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_question_check_num:

                // course_set_manage_testpaper
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/testpaper$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::indexAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_testpaper_create
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/testpaper/create$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_create')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::createAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_testpaper_update
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/update$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_update')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::updateAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_testpaper_info
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/testpaper/info$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_testpaper_info;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_info')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::infoAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_testpaper_info:

                // course_set_manage_testpaper_publish
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/publish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_testpaper_publish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_publish')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::publishAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_testpaper_publish:

                // course_set_manage_testpaper_close
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/close$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_testpaper_close;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_close')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::closeAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_testpaper_close:

                // course_set_manage_testpaper_delete
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_testpaper_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_delete')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_testpaper_delete:

                // course_set_manage_testpaper_deletes
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/testpaper/deletes$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_set_manage_testpaper_deletes;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_deletes')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::deletesAction',  '_permission' =>   array (  ),));
                }
                not_course_set_manage_testpaper_deletes:

                // course_set_manage_testpaper_preivew
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_preivew')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::previewAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_testpaper_questions
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/questions$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_questions')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::questionsAction',  '_permission' =>   array (  ),));
                }

            }

            // course_manage_testpaper_check
            if (preg_match('#^/course/(?P<id>[^/]++)/manage/testpaper/(?P<resultId>[^/]++)/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_testpaper_check')), array (  '_controller' => 'AppBundle\\Controller\\Course\\TestpaperManageController::checkAction',  '_permission' =>   array (  ),));
            }

        }

        // testpaper_check
        if (0 === strpos($pathinfo, '/testpaper') && preg_match('#^/testpaper/(?P<resultId>[^/]++)/check$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'testpaper_check')), array (  '_controller' => 'AppBundle\\Controller\\Course\\TestpaperManageController::checkForwordAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/course')) {
            // course_manage_testpaper_check_list
            if (preg_match('#^/course/(?P<id>[^/]++)/manage/testpaper/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_testpaper_check_list')), array (  '_controller' => 'AppBundle\\Controller\\Course\\TestpaperManageController::checkListAction',  '_permission' =>   array (  ),));
            }

            // course_manage_testpaper_result_list
            if (preg_match('#^/course/(?P<id>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/result$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_testpaper_result_list')), array (  '_controller' => 'AppBundle\\Controller\\Course\\TestpaperManageController::resultListAction',  '_permission' =>   array (  ),));
            }

            // course_manage_testpaper_questions
            if (preg_match('#^/course/(?P<courseId>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/items$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_testpaper_questions')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::questionsAction',  '_permission' =>   array (  ),));
            }

            // course_set_manage_testpaper_build_check
            if (0 === strpos($pathinfo, '/course_set') && preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/(?P<type>[^/]++)/build/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_testpaper_build_check')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\ManageController::buildCheckAction',  '_permission' =>   array (  ),));
            }

        }

        // testpaper_do
        if (0 === strpos($pathinfo, '/lesson') && preg_match('#^/lesson/(?P<lessonId>[^/]++)/testpaper/(?P<testId>[^/]++)/do$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'testpaper_do')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\TestpaperController::doTestpaperAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/testpaper')) {
            // testpaper_show
            if (preg_match('#^/testpaper/(?P<resultId>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'testpaper_show')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\TestpaperController::doTestAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/testpaper/result')) {
                // testpaper_result_show
                if (preg_match('#^/testpaper/result/(?P<resultId>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'testpaper_result_show')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\TestpaperController::showResultAction',  '_permission' =>   array (  ),));
                }

                // testpaper_result_submit
                if (preg_match('#^/testpaper/result/(?P<resultId>[^/]++)/submit$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_testpaper_result_submit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'testpaper_result_submit')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\TestpaperController::submitTestAction',  '_permission' =>   array (  ),));
                }
                not_testpaper_result_submit:

                // testpaper_finish
                if (preg_match('#^/testpaper/result/(?P<resultId>[^/]++)/finish$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'testpaper_finish')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\TestpaperController::finishTestAction',  '_permission' =>   array (  ),));
                }

                // testpaper_do_suspend
                if (preg_match('#^/testpaper/result/(?P<resultId>[^/]++)/suspend$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_testpaper_do_suspend;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'testpaper_do_suspend')), array (  '_controller' => 'AppBundle\\Controller\\Testpaper\\TestpaperController::testSuspendAction',  '_permission' =>   array (  ),));
                }
                not_testpaper_do_suspend:

            }

        }

        if (0 === strpos($pathinfo, '/course')) {
            // course_manage_homework
            if (preg_match('#^/course/(?P<courseId>[^/]++)/manage/homework$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_homework')), array (  '_controller' => 'AppBundle\\Controller\\HomeworkManageController::indexAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/course_set')) {
                // course_set_manage_homework_question_picker
                if (preg_match('#^/course_set/(?P<id>[^/]++)/manage/homework/question/picker$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_homework_question_picker')), array (  '_controller' => 'AppBundle\\Controller\\HomeworkManageController::questionPickerAction',  '_permission' =>   array (  ),));
                }

                // course_set_manage_homework_question_picked
                if (preg_match('#^/course_set/(?P<courseSetId>[^/]++)/manage/homework/question/picked$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_manage_homework_question_picked')), array (  '_controller' => 'AppBundle\\Controller\\HomeworkManageController::pickedQuestionAction',  '_permission' =>   array (  ),));
                }

            }

            // course_manage_homework_check_list
            if (preg_match('#^/course/(?P<id>[^/]++)/manage/homework/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_homework_check_list')), array (  '_controller' => 'AppBundle\\Controller\\Course\\HomeworkManageController::checkListAction',  '_permission' =>   array (  ),));
            }

            // course_manage_homework_check
            if (preg_match('#^/course/(?P<id>[^/]++)/manage/homework/(?P<resultId>[^/]++)/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_homework_check')), array (  '_controller' => 'AppBundle\\Controller\\Course\\HomeworkManageController::checkAction',  '_permission' =>   array (  ),));
            }

        }

        // homework_start_do
        if (0 === strpos($pathinfo, '/lesson') && preg_match('#^/lesson/(?P<lessonId>[^/]++)/homework/(?P<homeworkId>[^/]++)/startDo$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'homework_start_do')), array (  '_controller' => 'AppBundle\\Controller\\HomeworkController::startDoAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/homework')) {
            // homework_show
            if (preg_match('#^/homework/(?P<resultId>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'homework_show')), array (  '_controller' => 'AppBundle\\Controller\\HomeworkController::doTestAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/homework/result')) {
                // homework_result_show
                if (preg_match('#^/homework/result/(?P<resultId>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'homework_result_show')), array (  '_controller' => 'AppBundle\\Controller\\HomeworkController::showResultAction',  '_permission' =>   array (  ),));
                }

                // homework_finish
                if (preg_match('#^/homework/result/(?P<resultId>[^/]++)/finish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_homework_finish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'homework_finish')), array (  '_controller' => 'AppBundle\\Controller\\HomeworkController::submitAction',  '_permission' =>   array (  ),));
                }
                not_homework_finish:

            }

        }

        // course_manage_exercise_check
        if (0 === strpos($pathinfo, '/course') && preg_match('#^/course/(?P<courseId>[^/]++)/manage/exercise/check$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_manage_exercise_check')), array (  '_controller' => 'AppBundle\\Controller\\ExerciseManageController::buildCheckAction',  '_permission' =>   array (  ),));
        }

        // exercise_start_do
        if (0 === strpos($pathinfo, '/lesson') && preg_match('#^/lesson/(?P<lessonId>[^/]++)/exercise/(?P<exerciseId>[^/]++)/startDo$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'exercise_start_do')), array (  '_controller' => 'AppBundle\\Controller\\ExerciseController::startDoAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/exercise')) {
            // exercise_show
            if (preg_match('#^/exercise/(?P<resultId>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'exercise_show')), array (  '_controller' => 'AppBundle\\Controller\\ExerciseController::doTestAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/exercise/result')) {
                // exercise_result_show
                if (preg_match('#^/exercise/result/(?P<resultId>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'exercise_result_show')), array (  '_controller' => 'AppBundle\\Controller\\ExerciseController::showResultAction',  '_permission' =>   array (  ),));
                }

                // exercise_finish
                if (preg_match('#^/exercise/result/(?P<resultId>[^/]++)/finish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_exercise_finish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'exercise_finish')), array (  '_controller' => 'AppBundle\\Controller\\ExerciseController::submitAction',  '_permission' =>   array (  ),));
                }
                not_exercise_finish:

            }

        }

        if (0 === strpos($pathinfo, '/attachment')) {
            // attachment_upload
            if ($pathinfo === '/attachment/upload') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_attachment_upload;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\File\\AttachmentController::uploadAction',  '_route' => 'attachment_upload',  '_permission' =>   array (  ),);
            }
            not_attachment_upload:

            // attachment_item_show
            if (0 === strpos($pathinfo, '/attachment/file') && preg_match('#^/attachment/file/(?P<fileId>[^/]++)/show$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_attachment_item_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'attachment_item_show')), array (  '_controller' => 'AppBundle\\Controller\\File\\AttachmentController::fileShowAction',  '_permission' =>   array (  ),));
            }
            not_attachment_item_show:

            // attachment_delete
            if (preg_match('#^/attachment/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_attachment_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'attachment_delete')), array (  '_controller' => 'AppBundle\\Controller\\File\\AttachmentController::deleteAction',  '_permission' =>   array (  ),));
            }
            not_attachment_delete:

            // attachment_preview
            if (preg_match('#^/attachment/(?P<id>[^/]++)/preview$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_attachment_preview;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'attachment_preview')), array (  '_controller' => 'AppBundle\\Controller\\File\\AttachmentController::previewAction',  '_permission' =>   array (  ),));
            }
            not_attachment_preview:

            // attachment_player
            if (preg_match('#^/attachment/(?P<id>[^/]++)/player$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_attachment_player;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'attachment_player')), array (  '_controller' => 'AppBundle\\Controller\\File\\AttachmentController::playerAction',  '_permission' =>   array (  ),));
            }
            not_attachment_player:

            // attachment_download
            if (preg_match('#^/attachment/(?P<id>[^/]++)/download$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_attachment_download;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'attachment_download')), array (  '_controller' => 'AppBundle\\Controller\\File\\AttachmentController::downloadAction',  '_permission' =>   array (  ),));
            }
            not_attachment_download:

        }

        if (0 === strpos($pathinfo, '/classroom')) {
            // classroom_manage
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::indexAction',  '_permission' =>   array (    0 => 'classroom_manage',  ),));
            }

            // classroom_manage_courses
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/courses$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_courses')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::coursesAction',  '_permission' =>   array (    0 => 'classroom_manage_courses',  ),));
            }

            // classroom_manage_course_remove
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/course/(?P<courseId>[^/]++)/remove$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_course_remove')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::removeCourseAction',  '_permission' =>   array (  ),));
            }

            // classroom_courses_select
            if (preg_match('#^/classroom/(?P<id>[^/]++)/courses/select$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_courses_select')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::coursesSelectAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_set_info
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/set_info$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_set_info')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::setInfoAction',  '_permission' =>   array (    0 => 'classroom_manage_set_info',  ),));
            }

            // classroom_manage_set_picture
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/set_picture$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_set_picture')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::setPictureAction',  '_permission' =>   array (    0 => 'classroom_manage_set_picture',  ),));
            }

            // classroom_manage_picture_crop
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/picture_crop$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_picture_crop')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::pictureCropAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_set_price
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/price/set$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_set_price')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::setPriceAction',  '_permission' =>   array (    0 => 'classroom_manage_set_price',  ),));
            }

            // classroom_manage_students
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/students$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_students')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::studentsAction',  '_permission' =>   array (    0 => 'classroom_manage_students',  ),));
            }

            // classroom_manage_aduitor
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/aduitor$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_aduitor')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::aduitorAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_record
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/refund_record$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_record')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::refundRecordAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_service
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/service$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_service')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::serviceAction',  '_permission' =>   array (    0 => 'classroom_manage_service',  ),));
            }

            // classroom_manage_teachers
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/teachers$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_teachers')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::teachersAction',  '_permission' =>   array (    0 => 'classroom_manage_teachers',  ),));
            }

            // classroom_manage_headteacher
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/headteacher$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_headteacher')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::headteacherAction',  '_permission' =>   array (    0 => 'classroom_manage_headteacher',  ),));
            }

            // classroom_manage_assistants
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/assistants$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_assistants')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::assistantsAction',  '_permission' =>   array (    0 => 'classroom_manage_assistants',  ),));
            }

            // classroom_manage_publish
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/publish$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_classroom_manage_publish;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_publish')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::publishAction',  '_permission' =>   array (  ),));
            }
            not_classroom_manage_publish:

            // classroom_manage_close
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/close$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_classroom_manage_close;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_close')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::closeAction',  '_permission' =>   array (  ),));
            }
            not_classroom_manage_close:

            // classroom_manage_checkName
            if ($pathinfo === '/classroom/manage/checkName') {
                return array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::checkNameAction',  '_route' => 'classroom_manage_checkName',  '_permission' =>   array (  ),);
            }

            // classroom_manage_student_remark
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/manage/student/(?P<userId>[^/]++)/remark$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_remark')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::remarkAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_student_remove
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/manage/student/(?P<userId>[^/]++)/remove$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_classroom_manage_student_remove;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_remove')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::removeAction',  '_permission' =>   array (  ),));
            }
            not_classroom_manage_student_remove:

            // classroom_manage_student_create
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/student/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_create')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::createAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_student_check
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/student_check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_check')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::checkStudentAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_student_export_datas
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/student/export/(?P<role>[^/]++)/datas$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_export_datas')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::exportDatasAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_student_export_csv
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/student/export$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_export_csv')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::exportCsvAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_student_import
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/student/import$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_import')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::importUsersAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_student_to_base
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/student/importing$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_classroom_manage_student_to_base;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_student_to_base')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::excelDataImportAction',  '_permission' =>   array (  ),));
            }
            not_classroom_manage_student_to_base:

            // classroom_manage_testpaper
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/testpaper/list$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_testpaper')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::testpaperAction',  '_permission' =>   array (    0 => 'classroom_manage_testpaper',  ),));
            }

            // classroom_manage_testpaper_result_list
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/testpaper/(?P<testpaperId>[^/]++)/result$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_testpaper_result_list')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::testpaperResultListAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_testpaper_check
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/testpaper/(?P<resultId>[^/]++)/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_testpaper_check')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::testpaperCheckAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_homework
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/homework/list$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_homework')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::homeworkAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_homework_check
            if (preg_match('#^/classroom/(?P<id>[^/]++)/manage/homework/(?P<resultId>[^/]++)/check$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_homework_check')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::homeworkCheckAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_students_defined_show
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/manage/students/(?P<userId>[^/]++)/defined_show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_students_defined_show')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::studentDefinedShowAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_students_show
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/manage/students/(?P<userId>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_students_show')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::studentShowAction',  '_permission' =>   array (  ),));
            }

            // classroom_manage_member_deadline
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/manage/member/(?P<userId>[^/]++)/deadline$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_manage_member_deadline')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::setClassroomMemberDeadlineAction',  '_permission' =>   array (  ),));
            }

            // classroom_member_deadline_reach
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/member/deadline/reach$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_member_deadline_reach')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::deadlineReachAction',  '_permission' =>   array (  ),));
            }

            // classroom_expiry_date_rule
            if ($pathinfo === '/classroom_expiry_date_rule') {
                return array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomManageController::expiryDateRuleAction',  '_route' => 'classroom_expiry_date_rule',  '_permission' =>   array (  ),);
            }

            // classroom_explore
            if (0 === strpos($pathinfo, '/classroom/explore') && preg_match('#^/classroom/explore(?:/(?P<category>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_explore')), array (  '_controller' => 'AppBundle\\Controller\\ExploreController::classroomAction',  'category' => '',  '_permission' =>   array (  ),));
            }

            // classroom_show
            if (preg_match('#^/classroom/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_show')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::showAction',  '_permission' =>   array (  ),));
            }

            // classroom_qrcode
            if (preg_match('#^/classroom/(?P<id>[^/]++)/qrcode$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_qrcode')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::qrcodeAction',  '_permission' =>   array (  ),));
            }

            // classroom_reviews
            if (preg_match('#^/classroom/(?P<id>[^/]++)/review$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_reviews')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ReviewController::listAction',  '_permission' =>   array (  ),));
            }

            // classroom_review_create
            if (preg_match('#^/classroom/(?P<id>[^/]++)/review/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_review_create')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ReviewController::createAction',  '_permission' =>   array (  ),));
            }

            // classroom_review_post
            if (preg_match('#^/classroom/(?P<id>[^/]++)/review/(?P<reviewId>[^/]++)/post$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_review_post')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ReviewController::postAction',  '_permission' =>   array (  ),));
            }

            // classroom_review_delete
            if (0 === strpos($pathinfo, '/classroom/review') && preg_match('#^/classroom/review/(?P<reviewId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_review_delete')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ReviewController::deleteAction',  '_permission' =>   array (  ),));
            }

            // classroom_introductions
            if (preg_match('#^/classroom/(?P<id>[^/]++)/introduction$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_introductions')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::introductionAction',  '_permission' =>   array (  ),));
            }

            // classroom_buy
            if (preg_match('#^/classroom/(?P<id>[^/]++)/buy$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_buy')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::buyAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/classroom/sign')) {
                // classroom_sign
                if (preg_match('#^/classroom/sign/(?P<classroomId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_sign')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::signAction',  '_permission' =>   array (  ),));
                }

                // classroom_signed_records
                if (preg_match('#^/classroom/sign/(?P<classroomId>[^/]++)/records$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_signed_records')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::getSignedRecordsByPeriodAction',  '_permission' =>   array (  ),));
                }

            }

            // classroom_become_auditor
            if (preg_match('#^/classroom/(?P<id>[^/]++)/becomeAuditor$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_become_auditor')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::becomeAuditorAction',  '_permission' =>   array (  ),));
            }

            // classroom_exit
            if (preg_match('#^/classroom/(?P<id>[^/]++)/exit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_exit')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::exitAction',  '_permission' =>   array (  ),));
            }

            // classroom_canview
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/canview$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_canview')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::canviewAction',  '_permission' =>   array (  ),));
            }

            // classroom_courses
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/courses$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_courses')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\CourseController::listAction',  '_permission' =>   array (  ),));
            }

            // classroom_threads
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/threads$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_threads')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomThreadController::listAction',  '_permission' =>   array (  ),));
            }

            // classroom_thread_create
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/thread/(?P<type>[^/]++)/create$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_thread_create')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomThreadController::createAction',  'type' => 'discussion',  '_permission' =>   array (  ),));
            }

            // classroom_thread_show
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/thread/(?P<threadId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_thread_show')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomThreadController::showAction',  '_permission' =>   array (  ),));
            }

            // classroom_thread_update
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/thread/(?P<threadId>[^/]++)/update$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_thread_update')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomThreadController::updateAction',  '_permission' =>   array (  ),));
            }

            // classroom_vip_buy
            if (preg_match('#^/classroom/(?P<id>[^/]++)/vip_buy$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_vip_buy')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::becomeStudentAction',  '_permission' =>   array (  ),));
            }

            // classroom_member_ids
            if (preg_match('#^/classroom/(?P<id>[^/]++)/member_ids$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_member_ids')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::memberIdsAction',  '_permission' =>   array (  ),));
            }

            // classroom_thread_members_become
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/thread/(?P<threadId>[^/]++)/members/become$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_thread_members_become')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ThreadMemberController::becomeAction',  '_permission' =>   array (  ),));
            }

            // classroom_thread_members_quit
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/thread/(?P<threadId>[^/]++)/member/(?P<memberId>[^/]++)/quit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_thread_members_quit')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ThreadMemberController::quitAction',  '_permission' =>   array (  ),));
            }

            // classroom_headteacher_match
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/headteacher/match$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_headteacher_match')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\UtilityController::headteacherMatchAction',  '_permission' =>   array (  ),));
            }

            // classroom_assistants_match
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/assistants/match$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_assistants_match')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\UtilityController::assistantsMatchAction',  '_permission' =>   array (  ),));
            }

            // classroom_courses_pick
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/course/pick$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_courses_pick')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\CourseController::pickAction',  '_permission' =>   array (  ),));
            }

            // classroom_course_search
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/course/search$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_course_search')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\CourseController::searchAction',  '_permission' =>   array (  ),));
            }

        }

        // my_teaching_classroom_threads
        if (0 === strpos($pathinfo, '/my/teaching/classroom/threads') && preg_match('#^/my/teaching/classroom/threads/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_teaching_classroom_threads')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\ClassroomController::classroomThreadsAction',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/classroom')) {
            // classroom_course_notes_list
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/courses/notes$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_course_notes_list')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\CourseNoteController::listAction',  '_permission' =>   array (  ),));
            }

            // classroom_teachers
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/teachers/list$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_teachers')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\TeacherController::listAction',  '_permission' =>   array (  ),));
            }

            // classroom_teacherIds_catch
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/teacherIds/catch$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_teacherIds_catch')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\TeacherController::catchIdsAction',  '_permission' =>   array (  ),));
            }

            // classroom_buy_hint
            if (0 === strpos($pathinfo, '/classroom/courses') && preg_match('#^/classroom/courses/(?P<courseId>[^/]++)/buy/hint$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classroom_buy_hint')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\CourseTaskController::buyHintAction',  '_permission' =>   array (  ),));
            }

            // classrom_course_tasks_list
            if (preg_match('#^/classroom/(?P<classroomId>[^/]++)/course/(?P<courseId>[^/]++)/tasks/list$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'classrom_course_tasks_list')), array (  '_controller' => 'AppBundle\\Controller\\Classroom\\CourseTaskController::listAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/material')) {
            if (0 === strpos($pathinfo, '/material/lib')) {
                // material_lib_browsing
                if ($pathinfo === '/material/lib/browse') {
                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::indexAction',  '_route' => 'material_lib_browsing',  '_permission' =>   array (  ),);
                }

                // material_lib_show_browsing
                if ($pathinfo === '/material/lib/show/browse') {
                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::showMyMaterialLibFormAction',  '_route' => 'material_lib_show_browsing',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/material/lib/my/sharing')) {
                    // material_lib_my_sharing
                    if ($pathinfo === '/material/lib/my/sharing/show') {
                        return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::showShareFormAction',  '_route' => 'material_lib_my_sharing',  '_permission' =>   array (  ),);
                    }

                    if (0 === strpos($pathinfo, '/material/lib/my/sharing_')) {
                        // material_lib_my_sharing_detail
                        if ($pathinfo === '/material/lib/my/sharing_detail/show') {
                            return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::historyDetailShowAction',  '_route' => 'material_lib_my_sharing_detail',  '_permission' =>   array (  ),);
                        }

                        // material_lib_my_sharing_users
                        if ($pathinfo === '/material/lib/my/sharing_users/show') {
                            return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::historyUserShowAction',  '_route' => 'material_lib_my_sharing_users',  '_permission' =>   array (  ),);
                        }

                    }

                }

                // material_lib_my_sharing_contacts
                if ($pathinfo === '/material/lib/recent/contacts') {
                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::findMySharingContactsAction',  '_route' => 'material_lib_my_sharing_contacts',  '_permission' =>   array (  ),);
                }

                // material_lib_save_sharing
                if ($pathinfo === '/material/lib/my/sharing/save') {
                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::saveShareAction',  '_route' => 'material_lib_save_sharing',  '_permission' =>   array (  ),);
                }

                // material_tag_show_match
                if ($pathinfo === '/material/lib/tag/match') {
                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::matchAction',  '_route' => 'material_tag_show_match',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/material/lib/my')) {
                    if (0 === strpos($pathinfo, '/material/lib/my/sharing')) {
                        // material_lib_show_sharing_history
                        if ($pathinfo === '/material/lib/my/sharing/history') {
                            return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::showShareHistoryAction',  '_route' => 'material_lib_show_sharing_history',  '_permission' =>   array (  ),);
                        }

                        // material_lib_cancel_sharing
                        if ($pathinfo === '/material/lib/my/sharing/cancel') {
                            return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::cancelShareAction',  '_route' => 'material_lib_cancel_sharing',  '_permission' =>   array (  ),);
                        }

                    }

                    // material_lib_save_collection
                    if ($pathinfo === '/material/lib/my/collection/save') {
                        return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::collectAction',  '_route' => 'material_lib_save_collection',  '_permission' =>   array (  ),);
                    }

                }

                // material_lib_file_preview
                if (0 === strpos($pathinfo, '/material/lib/file') && preg_match('#^/material/lib/file/(?P<fileId>[^/]++)/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_lib_file_preview')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::previewAction',  '_permission' =>   array (  ),));
                }

            }

            // material_edit
            if (0 === strpos($pathinfo, '/materiallib') && preg_match('#^/materiallib/(?P<fileId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_material_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_edit')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::editAction',  '_permission' =>   array (  ),));
            }
            not_material_edit:

            if (0 === strpos($pathinfo, '/material/lib')) {
                // material_lib_file_player
                if (preg_match('#^/material/lib/(?P<fileId>[^/]++)/player$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_lib_file_player')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::playerAction',  '_permission' =>   array (  ),));
                }

                // material_reconvert
                if (preg_match('#^/material/lib/(?P<globalId>[^/]++)/reconvert$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_reconvert')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::reconvertAction',  '_permission' =>   array (  ),));
                }

            }

        }

        if (0 === strpos($pathinfo, '/a')) {
            // app_download
            if ($pathinfo === '/app/download') {
                return array (  '_controller' => 'CustomBundle\\Controller\\DefaultController::appDownloadAction',  '_route' => 'app_download',  '_permission' =>   array (  ),);
            }

            // announcement_global_show
            if (0 === strpos($pathinfo, '/announcement') && preg_match('#^/announcement/(?P<id>[^/]++)/opreate/global/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'announcement_global_show')), array (  '_controller' => 'AppBundle\\Controller\\AnnouncementController::globalShowAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/material')) {
            if (0 === strpos($pathinfo, '/material/lib')) {
                // material_thumbnail_generate
                if (preg_match('#^/material/lib/(?P<globalId>[^/]++)/thumbnail/generate$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_thumbnail_generate')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::generateThumbnailAction',  '_permission' =>   array (  ),));
                }

                // material_lib_file_detail
                if (preg_match('#^/material/lib/(?P<fileId>[^/]++)/detail$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_lib_file_detail')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::detailAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/materiallib')) {
                // material_download
                if (preg_match('#^/materiallib/(?P<fileId>[^/]++)/download$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_download')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::downloadAction',  '_permission' =>   array (  ),));
                }

                // material_delete
                if (preg_match('#^/materiallib/(?P<fileId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_material_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_delete')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_material_delete:

            }

            if (0 === strpos($pathinfo, '/materials')) {
                // material_batch_delete
                if ($pathinfo === '/materials/batch/delete') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_material_batch_delete;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::batchDeleteAction',  '_route' => 'material_batch_delete',  '_permission' =>   array (  ),);
                }
                not_material_batch_delete:

                // material_delete_modal_show
                if ($pathinfo === '/materials/delete/show') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_material_delete_modal_show;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::deleteModalShowAction',  '_route' => 'material_delete_modal_show',  '_permission' =>   array (  ),);
                }
                not_material_delete_modal_show:

                // material_batch_share
                if ($pathinfo === '/materials/batch/share') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_material_batch_share;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::batchShareAction',  '_route' => 'material_batch_share',  '_permission' =>   array (  ),);
                }
                not_material_batch_share:

            }

            // material_unshare
            if (0 === strpos($pathinfo, '/materiallib') && preg_match('#^/materiallib/(?P<fileId>[^/]++)/unshare$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'material_unshare')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::unshareAction',  '_permission' =>   array (  ),));
            }

            // material_batch_tag_show
            if ($pathinfo === '/materials/batch/tag/show') {
                return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::batchTagShowAction',  '_route' => 'material_batch_tag_show',  '_permission' =>   array (  ),);
            }

        }

        if (0 === strpos($pathinfo, '/global_file')) {
            // global_file_hls_playlist
            if (preg_match('#^/global_file/(?P<globalId>[^/]++)/playlist/(?P<token>[^/\\.]++)\\.m3u8$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'global_file_hls_playlist')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\GlobalFilePlayerController::playlistAction',  '_permission' =>   array (  ),));
            }

            // global_file_hls_stream
            if (preg_match('#^/global_file/(?P<globalId>[^/]++)/stream/(?P<level>[^/]++)/(?P<token>[^/\\.]++)\\.m3u8$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'global_file_hls_stream')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\GlobalFilePlayerController::streamAction',  '_permission' =>   array (  ),));
            }

            // global_file_hls_clef
            if (preg_match('#^/global_file/(?P<globalId>[^/]++)/clef/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'global_file_hls_clef')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\GlobalFilePlayerController::clefAction',  '_permission' =>   array (  ),));
            }

            // global_file_ppt
            if (preg_match('#^/global_file/(?P<globalId>[^/]++)/ppt$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'global_file_ppt')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\GlobalFilePlayerController::pptAction',  '_permission' =>   array (  ),));
            }

            // global_file_document
            if (preg_match('#^/global_file/(?P<globalId>[^/]++)/document$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'global_file_document')), array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\GlobalFilePlayerController::documentAction',  '_permission' =>   array (  ),));
            }

        }

        // material_lib_choose
        if ($pathinfo === '/material/lib/choose') {
            return array (  '_controller' => 'AppBundle\\Controller\\MaterialLib\\MaterialLibController::materialChooseAction',  '_route' => 'material_lib_choose',  '_permission' =>   array (  ),);
        }

        // switch_org
        if (0 === strpos($pathinfo, '/swithOrg') && preg_match('#^/swithOrg/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'switch_org')), array (  '_controller' => 'AppBundle\\Controller\\OrgController::switchOrgAction',  '_permission' =>   array (  ),));
        }

        // org_tree
        if ($pathinfo === '/org-tree.json') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_org_tree;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\OrgController::orgTreeJsonAction',  '_route' => 'org_tree',  '_permission' =>   array (  ),);
        }
        not_org_tree:

        // coupon_check
        if (preg_match('#^/(?P<type>[^/]++)/(?P<id>[^/]++)/coupon/check$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'coupon_check')), array (  '_controller' => 'AppBundle\\Controller\\OrderController::couponCheckAction',  '_permission' =>   array (  ),));
        }

        // my_course_show
        if (0 === strpos($pathinfo, '/my/course') && preg_match('#^/my/course/(?P<id>[^/]++)(?:/(?P<tab>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'my_course_show')), array (  '_controller' => 'AppBundle\\Controller\\My\\CourseController::showAction',  'tab' => 'tasks',  '_permission' =>   array (  ),));
        }

        if (0 === strpos($pathinfo, '/course')) {
            // course_member_expired
            if (preg_match('#^/course/(?P<id>[^/]++)/member/expired$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_member_expired')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseController::memberExpiredAction',  '_permission' =>   array (  ),));
            }

            // course_member_deadline_reach
            if (preg_match('#^/course/(?P<id>[^/]++)/member/deadline/reach$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_member_deadline_reach')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseController::deadlineReachAction',  '_permission' =>   array (  ),));
            }

            // course_buy
            if (preg_match('#^/course/(?P<id>[^/]++)/buy$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_buy')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseOrderController::buyAction',  '_permission' =>   array (  ),));
            }

            // course_order_repay
            if ($pathinfo === '/course/order/repay') {
                return array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseOrderController::repayAction',  '_route' => 'course_order_repay',  '_permission' =>   array (  ),);
            }

            // course_show
            if (preg_match('#^/course/(?P<id>[^/]++)(?:/(?P<tab>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseController::showAction',  'tab' => 'summary',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/archive/course')) {
            // course_set_archive
            if ($pathinfo === '/archive/course') {
                return array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetController::archiveAction',  '_route' => 'course_set_archive',  '_permission' =>   array (  ),);
            }

            // course_set_archive_show
            if (preg_match('#^/archive/course/(?P<courseSetId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_archive_show')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetController::archiveDetailAction',  '_permission' =>   array (  ),));
            }

            // course_set_archive_task
            if (preg_match('#^/archive/course/(?P<courseSetId>[^/]++)/lesson/(?P<taskId>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_archive_task')), array (  '_controller' => 'AppBundle\\Controller\\Course\\CourseSetController::archiveTaskAction',  '_permission' =>   array (  ),));
            }

        }

        if (0 === strpos($pathinfo, '/c')) {
            // changelog_list
            if ($pathinfo === '/changelog/list') {
                return array (  '_controller' => 'AppBundle\\Controller\\ChangelogController::listAction',  '_route' => 'changelog_list',  '_permission' =>   array (  ),);
            }

            if (0 === strpos($pathinfo, '/course')) {
                // course_task_marker_manage
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/marker/manage$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_marker_manage')), array (  '_controller' => 'AppBundle\\Controller\\MarkerController::manageAction',  '_permission' =>   array (  ),));
                }

                // course_task_marker_manage_preview
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/marker/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_marker_manage_preview')), array (  '_controller' => 'AppBundle\\Controller\\MarkerController::previewAction',  '_permission' =>   array (  ),));
                }

                if (0 === strpos($pathinfo, '/course/task')) {
                    // course_task_marker_show
                    if (preg_match('#^/course/task/(?P<taskId>[^/]++)/marker/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_marker_show')), array (  '_controller' => 'AppBundle\\Controller\\MarkerController::showMarkersAction',  '_permission' =>   array (  ),));
                    }

                    // course_task_marker_metas
                    if (preg_match('#^/course/task/(?P<mediaId>[^/]++)/marker/metas$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_marker_metas')), array (  '_controller' => 'AppBundle\\Controller\\MarkerController::markerMetasAction',  '_permission' =>   array (  ),));
                    }

                }

                // course_task_marker_merge
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/marker/merge$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_task_marker_merge;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_marker_merge')), array (  '_controller' => 'AppBundle\\Controller\\MarkerController::mergeAction',  '_permission' =>   array (  ),));
                }
                not_course_task_marker_merge:

                // course_task_marker_update
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/marker/update$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_task_marker_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_marker_update')), array (  '_controller' => 'AppBundle\\Controller\\MarkerController::updateMarkerAction',  '_permission' =>   array (  ),));
                }
                not_course_task_marker_update:

                // course_question_marker_preview
                if (preg_match('#^/course/(?P<courseId>[^/]++)/question/(?P<id>[^/]++)/marker/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_question_marker_preview')), array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::questionMakerPreviewAction',  '_permission' =>   array (  ),));
                }

                if (0 === strpos($pathinfo, '/course/task/media')) {
                    // course_task_question_markers_show
                    if (preg_match('#^/course/task/media/(?P<mediaId>[^/]++)/question_markers/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_question_markers_show')), array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::showQuestionMakersAction',  '_permission' =>   array (  ),));
                    }

                    // course_task_question_marker_finish
                    if ($pathinfo === '/course/task/media/question_marker/finish') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_course_task_question_marker_finish;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::finishQuestionMarkerAction',  '_route' => 'course_task_question_marker_finish',  '_permission' =>   array (  ),);
                    }
                    not_course_task_question_marker_finish:

                }

                // course_task_question_marker_add
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/question_marker/add$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_task_question_marker_add;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_question_marker_add')), array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::addQuestionMarkerAction',  '_permission' =>   array (  ),));
                }
                not_course_task_question_marker_add:

                // course_task_question_marker_delete
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/question_marker/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_task_question_marker_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_question_marker_delete')), array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::deleteQuestionMarkerAction',  '_permission' =>   array (  ),));
                }
                not_course_task_question_marker_delete:

                // course_task_question_marker_sort
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/question_marker/sort$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_course_task_question_marker_sort;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_question_marker_sort')), array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::sortQuestionMarkerAction',  '_permission' =>   array (  ),));
                }
                not_course_task_question_marker_sort:

                // course_task_question_marker_list
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/question_marker/list$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_question_marker_list')), array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::questionAction',  '_permission' =>   array (  ),));
                }

                // course_task_question_marker_search
                if (preg_match('#^/course/(?P<courseId>[^/]++)/task/(?P<taskId>[^/]++)/question_marker/search$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_task_question_marker_search')), array (  '_controller' => 'AppBundle\\Controller\\QuestionMarkerController::searchAction',  '_permission' =>   array (  ),));
                }

            }

            // callback
            if (0 === strpos($pathinfo, '/callback') && preg_match('#^/callback/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'callback')), array (  '_controller' => 'AppBundle\\Controller\\Callback\\EndpointController::publishAction',  '_permission' =>   array (  ),));
            }

        }

        // mobile_qrcode
        if ($pathinfo === '/mobil/qrcode') {
            return array (  '_controller' => 'AppBundle\\Controller\\CommonController::mobileQrcodeAction',  '_route' => 'mobile_qrcode',  '_permission' =>   array (  ),);
        }

        // event_dispatch
        if ($pathinfo === '/event/dispatch') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_event_dispatch;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\EventController::dispatchAction',  '_route' => 'event_dispatch',  '_permission' =>   array (  ),);
        }
        not_event_dispatch:

        // _oauth2_token
        if ($pathinfo === '/login/oauth/access_token') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not__oauth2_token;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\OAuth2\\TokenController::tokenAction',  '_route' => '_oauth2_token',  '_permission' =>   array (  ),);
        }
        not__oauth2_token:

        if (0 === strpos($pathinfo, '/admin')) {
            // admin
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin');
                }

                return array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::indexAction',  '_route' => 'admin',  '_permission' =>   array (  ),);
            }

            // admin_discovery_column_category_tree
            if ($pathinfo === '/admin/discovery_column/category/tree') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DiscoveryColumnController::categoryTreeAction',  '_route' => 'admin_discovery_column_category_tree',  '_permission' =>   array (  ),);
            }

            // admin_setting_security
            if ($pathinfo === '/admin/setting/security') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SiteSettingController::securityAction',  '_route' => 'admin_setting_security',  '_permission' =>   array (    0 => 'admin_setting_security',  ),);
            }

            // admin_notice_modal
            if ($pathinfo === '/admin/notice/modal') {
                return array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::noticeAction',  '_route' => 'admin_notice_modal',  '_permission' =>   array (  ),);
            }

            // admin_question_remind_teachers
            if (0 === strpos($pathinfo, '/admin/course') && preg_match('#^/admin/course/(?P<courseId>[^/]++)/question/(?P<questionId>[^/]++)/remindTeachers$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_question_remind_teachers;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_question_remind_teachers')), array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::questionRemindTeachersAction',  '_permission' =>   array (    0 => 'admin',  ),));
            }
            not_admin_question_remind_teachers:

            // admin_operation_analysis
            if ($pathinfo === '/admin/operation/analysis') {
                return array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::operationAnalysisDashbordBlockAction',  '_route' => 'admin_operation_analysis',  '_permission' =>   array (    0 => 'admin',  ),);
            }

            // admin_user_statistic
            if (0 === strpos($pathinfo, '/admin/user/statistic') && preg_match('#^/admin/user/statistic/(?P<period>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_statistic')), array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::userStatisticAction',  '_permission' =>   array (    0 => 'admin',  ),));
            }

            // admin_task_learn_statistic
            if (0 === strpos($pathinfo, '/admin/task/learn/statistic') && preg_match('#^/admin/task/learn/statistic/(?P<period>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_task_learn_statistic')), array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::completedTaskStatisticAction',  '_permission' =>   array (    0 => 'admin',  ),));
            }

            // admin_study_statistic
            if (0 === strpos($pathinfo, '/admin/study/statistic') && preg_match('#^/admin/study/statistic/(?P<period>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_study_statistic')), array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::studyStatisticAction',  '_permission' =>   array (    0 => 'admin',  ),));
            }

            // admin_order_statistic
            if (0 === strpos($pathinfo, '/admin/order/statistic') && preg_match('#^/admin/order/statistic/(?P<period>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_order_statistic')), array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::orderStatisticAction',  '_permission' =>   array (    0 => 'admin',  ),));
            }

            // admin_course_explore
            if (0 === strpos($pathinfo, '/admin/course/explore') && preg_match('#^/admin/course/explore/(?P<period>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_explore')), array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::courseExploreAction',  '_permission' =>   array (    0 => 'admin',  ),));
            }

            // admin_dashboard
            if ($pathinfo === '/admin/dashboard') {
                return array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::dashboardAction',  '_route' => 'admin_dashboard',  '_permission' =>   array (    0 => 'admin',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/opencourse')) {
                if (0 === strpos($pathinfo, '/admin/opencourse/analysis')) {
                    // admin_opencourse_analysis
                    if ($pathinfo === '/admin/opencourse/analysis') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::indexAction',  '_route' => 'admin_opencourse_analysis',  '_permission' =>   array (    0 => 'admin_opencourse_analysis',  ),);
                    }

                    // admin_opencourse_analysis_referer_summary
                    if ($pathinfo === '/admin/opencourse/analysis/referer/summary') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::summaryAction',  '_route' => 'admin_opencourse_analysis_referer_summary',  '_permission' =>   array (  ),);
                    }

                    // admin_opencourse_analysis_referer_watch_statistics
                    if ($pathinfo === '/admin/opencourse/analysis/watch') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::watchAction',  '_route' => 'admin_opencourse_analysis_referer_watch_statistics',  '_permission' =>   array (  ),);
                    }

                    // admin_opencourse_analysis_referer_summary_list
                    if ($pathinfo === '/admin/opencourse/analysis/referer/list') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::summaryListAction',  '_route' => 'admin_opencourse_analysis_referer_summary_list',  '_permission' =>   array (  ),);
                    }

                }

                // admin_opencourse_analysis_referer_detail
                if (preg_match('#^/admin/opencourse/(?P<id>[^/]++)/analysis/referer/detail$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_opencourse_analysis_referer_detail')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::detailAction',  '_permission' =>   array (  ),));
                }

                // admin_opencourse_analysis_referer_detail_list
                if (preg_match('#^/admin/opencourse/(?P<id>[^/]++)/analysis/referer/detailList$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_opencourse_analysis_referer_detail_list')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::detailListAction',  '_permission' =>   array (  ),));
                }

                // admin_opencourse_analysis_conversion
                if ($pathinfo === '/admin/opencourse/analysis/conversion') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::conversionAction',  '_route' => 'admin_opencourse_analysis_conversion',  '_permission' =>   array (  ),);
                }

                // admin_opencourse_analysis_conversion_result
                if (preg_match('#^/admin/opencourse/(?P<courseId>[^/]++)/analysis/conversion/result$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_opencourse_analysis_conversion_result')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseAnalysisController::conversionResultAction',  '_permission' =>   array (  ),));
                }

            }

            // admin_content
            if ($pathinfo === '/admin/content') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ContentController::indexAction',  '_route' => 'admin_content',  '_permission' =>   array (    0 => 'admin_content',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/dictionary')) {
                // admin_dictionary
                if ($pathinfo === '/admin/dictionary') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DictionaryController::indexAction',  '_route' => 'admin_dictionary',  '_permission' =>   array (  ),);
                }

                // admin_dictionary_create
                if (0 === strpos($pathinfo, '/admin/dictionary/create') && preg_match('#^/admin/dictionary/create/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_dictionary_create')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\DictionaryController::createAction',  '_permission' =>   array (  ),));
                }

                // admin_dictionary_delete
                if (preg_match('#^/admin/dictionary/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_dictionary_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_dictionary_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\DictionaryController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_admin_dictionary_delete:

                // admin_dictionary_edit
                if (preg_match('#^/admin/dictionary/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_dictionary_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\DictionaryController::editAction',  '_permission' =>   array (  ),));
                }

                // admin_dictionary_name_check
                if (preg_match('#^/admin/dictionary/(?P<id>[^/]++)/name_check$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_dictionary_name_check')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\DictionaryController::checkNameAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/content')) {
                // admin_content_create
                if (0 === strpos($pathinfo, '/admin/content/create') && preg_match('#^/admin/content/create/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_create')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ContentController::createAction',  '_permission' =>   array (    0 => 'admin_content',  ),));
                }

                // admin_content_edit
                if (preg_match('#^/admin/content/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ContentController::editAction',  '_permission' =>   array (    0 => 'admin_content',  ),));
                }

                // admin_content_publish
                if (preg_match('#^/admin/content/(?P<id>[^/]++)/publish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_content_publish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_publish')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ContentController::publishAction',  '_permission' =>   array (    0 => 'admin_content',  ),));
                }
                not_admin_content_publish:

                // admin_content_trash
                if (preg_match('#^/admin/content/(?P<id>[^/]++)/trash$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_content_trash;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_trash')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ContentController::trashAction',  '_permission' =>   array (    0 => 'admin_content',  ),));
                }
                not_admin_content_trash:

                // admin_content_delete
                if (preg_match('#^/admin/content/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_content_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ContentController::deleteAction',  '_permission' =>   array (    0 => 'admin_content',  ),));
                }
                not_admin_content_delete:

                // admin_content_alias_check
                if ($pathinfo === '/admin/content/alias/check') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ContentController::aliasCheckAction',  '_route' => 'admin_content_alias_check',  '_permission' =>   array (    0 => 'admin_content',  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/block')) {
                if (0 === strpos($pathinfo, '/admin/block/list')) {
                    // admin_block
                    if (preg_match('#^/admin/block/list\\-(?P<category>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::indexAction',  '_permission' =>   array (    0 => 'admin_block',  ),));
                    }

                    // admin_block_match
                    if ($pathinfo === '/admin/block/list/quikSearch') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::blockMatchAction',  '_route' => 'admin_block_match',  '_permission' =>   array (  ),);
                    }

                }

                // admin_block_create
                if ($pathinfo === '/admin/block/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::createAction',  '_route' => 'admin_block_create',  '_permission' =>   array (  ),);
                }

                // admin_block_delete
                if (preg_match('#^/admin/block/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_block_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_admin_block_delete:

                if (0 === strpos($pathinfo, '/admin/block/code')) {
                    // admin_block_code_check_forcreate
                    if ($pathinfo === '/admin/block/code/check/forcreate') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::checkBlockCodeForCreateAction',  '_route' => 'admin_block_code_check_forcreate',  '_permission' =>   array (  ),);
                    }

                    // admin_block_code_check_foredit
                    if (preg_match('#^/admin/block/code/(?P<id>[^/]++)/check/foredit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_code_check_foredit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::checkBlockTemplateCodeForEditAction',  '_permission' =>   array (  ),));
                    }

                }

                // admin_block_update
                if (preg_match('#^/admin/block/(?P<blockTemplateId>[^/]++)/update$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_update')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::updateAction',  '_permission' =>   array (  ),));
                }

                // admin_block_edit
                if (preg_match('#^/admin/block/(?P<blockTemplateId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::editAction',  '_permission' =>   array (  ),));
                }

                // admin_block_visual_edit
                if (0 === strpos($pathinfo, '/admin/blockTemplate') && preg_match('#^/admin/blockTemplate/(?P<blockTemplateId>[^/]++)/visual/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_visual_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::visualEditAction',  '_permission' =>   array (    0 => 'admin_block_visual_edit',  ),));
                }

                // admin_block_visual_view_data
                if (preg_match('#^/admin/block/(?P<blockTemplateId>[^/]++)/data/view$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_visual_view_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::dataViewAction',  '_permission' =>   array (  ),));
                }

                // admin_block_visual_edit_history
                if (0 === strpos($pathinfo, '/admin/blockTemplate') && preg_match('#^/admin/blockTemplate/(?P<blockTemplateId>[^/]++)/visual/edit/history$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_visual_edit_history')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::visualHistoryAction',  '_permission' =>   array (  ),));
                }

                // admin_block_recovery
                if (preg_match('#^/admin/block/(?P<blockTemplateId>[^/]++)/history/(?P<historyId>[^/]++)/recovery$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_recovery')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::recoveryAction',  '_permission' =>   array (  ),));
                }

                // admin_block_history_data
                if (0 === strpos($pathinfo, '/admin/block/histroy') && preg_match('#^/admin/block/histroy/(?P<blockId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_history_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::blockHistoriesDataAction',  '_permission' =>   array (  ),));
                }

                // admin_block_picture_upload
                if (preg_match('#^/admin/block/(?P<blockId>[^/]++)/picture/upload$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_picture_upload')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::uploadAction',  '_permission' =>   array (  ),));
                }

                // admin_block_picture_preview
                if (preg_match('#^/admin/block/(?P<blockId>[^/]++)/picture/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_block_picture_preview')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::picPreviewAction',  '_permission' =>   array (  ),));
                }

                // admin_blockhistory_preview
                if (0 === strpos($pathinfo, '/admin/blockhistory') && preg_match('#^/admin/blockhistory/(?P<id>[^/]++)/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_blockhistory_preview')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BlockController::previewAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/tag')) {
                // admin_tag
                if ($pathinfo === '/admin/tag') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagController::indexAction',  '_route' => 'admin_tag',  '_permission' =>   array (    0 => 'admin_course_tag_manage',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/tag/c')) {
                    // admin_tag_create
                    if ($pathinfo === '/admin/tag/create') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagController::createAction',  '_route' => 'admin_tag_create',  '_permission' =>   array (    0 => 'admin_course_tag_add',  ),);
                    }

                    // admin_tag_checkname
                    if ($pathinfo === '/admin/tag/checkname') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagController::checkNameAction',  '_route' => 'admin_tag_checkname',  '_permission' =>   array (    0 => 'admin_course_tag_manage',  ),);
                    }

                }

                // admin_tag_update
                if (preg_match('#^/admin/tag/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_tag_update')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagController::updateAction',  '_permission' =>   array (    0 => 'admin_course_tag_manage',  ),));
                }

                // admin_tag_delete
                if (preg_match('#^/admin/tag/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_tag_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_tag_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagController::deleteAction',  '_permission' =>   array (    0 => 'admin_course_tag_manage',  ),));
                }
                not_admin_tag_delete:

                if (0 === strpos($pathinfo, '/admin/tag/group')) {
                    // admin_tag_group
                    if ($pathinfo === '/admin/tag/group') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagGroupController::indexAction',  '_route' => 'admin_tag_group',  '_permission' =>   array (  ),);
                    }

                    // admin_tag_group_create
                    if ($pathinfo === '/admin/tag/group/create') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagGroupController::createAction',  '_route' => 'admin_tag_group_create',  '_permission' =>   array (  ),);
                    }

                    // admin_tag_group_update
                    if (preg_match('#^/admin/tag/group/(?P<groupId>[^/]++)/update$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_tag_group_update')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagGroupController::updateAction',  '_permission' =>   array (  ),));
                    }

                    // admin_tag_group_checkname
                    if ($pathinfo === '/admin/tag/group/checkname') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagGroupController::checkNameAction',  '_route' => 'admin_tag_group_checkname',  '_permission' =>   array (  ),);
                    }

                    // admin_tag_group_delete
                    if (preg_match('#^/admin/tag/group/(?P<tagId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_tag_group_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TagGroupController::deleteAction',  '_permission' =>   array (  ),));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/user')) {
                // admin_user
                if ($pathinfo === '/admin/user') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::indexAction',  '_route' => 'admin_user',  '_permission' =>   array (    0 => 'admin_user_manage',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/user/create')) {
                    // admin_user_create
                    if ($pathinfo === '/admin/user/create') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::createAction',  '_route' => 'admin_user_create',  '_permission' =>   array (    0 => 'admin_user_create',  ),);
                    }

                    // admin_user_create_email_check
                    if ($pathinfo === '/admin/user/create/email/check') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::emailCheckAction',  '_route' => 'admin_user_create_email_check',  '_permission' =>   array (    0 => 'admin_user_manage',  ),);
                    }

                    // admin_user_create_mobile_check
                    if ($pathinfo === '/admin/user/create/mobile/check') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::mobileCheckAction',  '_route' => 'admin_user_create_mobile_check',  '_permission' =>   array (    0 => 'admin_user_manage',  ),);
                    }

                    // admin_user_create_email_or_mobile_check
                    if ($pathinfo === '/admin/user/create/email_or_mobile/check') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::emailOrMobileCheckAction',  '_route' => 'admin_user_create_email_or_mobile_check',  '_permission' =>   array (    0 => 'admin_user_manage',  ),);
                    }

                    // admin_user_create_nickname_check
                    if ($pathinfo === '/admin/user/create/nickname/check') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::nicknameCheckAction',  '_route' => 'admin_user_create_nickname_check',  '_permission' =>   array (    0 => 'admin_user_manage',  ),);
                    }

                }

                // admin_user_show
                if (preg_match('#^/admin/user/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::showAction',  '_permission' =>   array (    0 => 'admin',  ),));
                }

                // admin_user_edit
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::editAction',  '_permission' =>   array (    0 => 'admin_user_edit',  ),));
                }

                // admin_user_org_update
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/org/update$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_org_update')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::orgUpdateAction',  '_permission' =>   array (    0 => 'admin_user_org_update',  ),));
                }

                // admin_user_lock
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/lock$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_user_lock;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_lock')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::lockAction',  '_permission' =>   array (    0 => 'admin_user_lock',  ),));
                }
                not_admin_user_lock:

                // admin_user_unlock
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/unlock$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_user_unlock;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_unlock')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::unlockAction',  '_permission' =>   array (    0 => 'admin_user_unlock',  ),));
                }
                not_admin_user_unlock:

                // admin_user_roles
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/roles$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_roles')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::rolesAction',  '_permission' =>   array (    0 => 'admin_user_roles',  ),));
                }

                // admin_user_avatar
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/avatar$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_avatar')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::avatarAction',  '_permission' =>   array (    0 => 'admin_user_avatar',  ),));
                }

                // admin_user_avatar_crop
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/avatar/crop$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_avatar_crop')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::avatarCropAction',  '_permission' =>   array (    0 => 'admin_user_avatar',  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/teacher')) {
                // admin_teacher
                if ($pathinfo === '/admin/teacher') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TeacherController::indexAction',  '_route' => 'admin_teacher',  '_permission' =>   array (    0 => 'admin_teacher',  ),);
                }

                // admin_teacher_promote
                if (preg_match('#^/admin/teacher/(?P<id>[^/]++)/promote$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_teacher_promote')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TeacherController::promoteAction',  '_permission' =>   array (    0 => 'admin_teacher_promote',  ),));
                }

                // admin_teacher_promote_list
                if ($pathinfo === '/admin/teacher/promote/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TeacherController::promoteListAction',  '_route' => 'admin_teacher_promote_list',  '_permission' =>   array (    0 => 'admin_teacher_promote',  ),);
                }

                // admin_teacher_promote_cancel
                if (preg_match('#^/admin/teacher/(?P<id>[^/]++)/promote/cancel$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_teacher_promote_cancel;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_teacher_promote_cancel')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TeacherController::promoteCancelAction',  '_permission' =>   array (    0 => 'admin_teacher',    1 => 'admin_teacher_promote',  ),));
                }
                not_admin_teacher_promote_cancel:

            }

            if (0 === strpos($pathinfo, '/admin/user')) {
                // admin_user_change_password
                if (preg_match('#^/admin/user/(?P<userId>[^/]++)/change/password$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_change_password')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::changePasswordAction',  '_permission' =>   array (    0 => 'admin_user_change_password',  ),));
                }

                // admin_user_send_passwordreset_email
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/send_passwordreset_email$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_user_send_passwordreset_email;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_send_passwordreset_email')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::sendPasswordResetEmailAction',  '_permission' =>   array (    0 => 'admin_user_send_passwordreset_email',  ),));
                }
                not_admin_user_send_passwordreset_email:

                // admin_user_send_emailverify_email
                if (preg_match('#^/admin/user/(?P<id>[^/]++)/send_emailverify_email$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_user_send_emailverify_email;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_send_emailverify_email')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserController::sendEmailVerifyEmailAction',  '_permission' =>   array (    0 => 'admin_user_send_emailverify_email',  ),));
                }
                not_admin_user_send_emailverify_email:

            }

            if (0 === strpos($pathinfo, '/admin/setting/navigation')) {
                // admin_navigation
                if ($pathinfo === '/admin/setting/navigation') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\NavigationController::indexAction',  '_route' => 'admin_navigation',  '_permission' =>   array (    0 => 'admin_top_navigation',    1 => 'admin_foot_navigation',  ),);
                }

                // admin_navigation_seqs_update
                if ($pathinfo === '/admin/setting/navigation/seqs/update') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\NavigationController::updateSeqsAction',  '_route' => 'admin_navigation_seqs_update',  '_permission' =>   array (    0 => 'admin_top_navigation',    1 => 'admin_foot_navigation',  ),);
                }

                // admin_navigation_create
                if ($pathinfo === '/admin/setting/navigation/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\NavigationController::createAction',  '_route' => 'admin_navigation_create',  '_permission' =>   array (    0 => 'admin_top_navigation',    1 => 'admin_foot_navigation',  ),);
                }

                // admin_navigation_update
                if (preg_match('#^/admin/setting/navigation/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_navigation_update')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\NavigationController::updateAction',  '_permission' =>   array (    0 => 'admin_top_navigation',    1 => 'admin_foot_navigation',  ),));
                }

                // admin_navigation_delete
                if (preg_match('#^/admin/setting/navigation/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_navigation_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_navigation_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\NavigationController::deleteAction',  '_permission' =>   array (    0 => 'admin_top_navigation',    1 => 'admin_foot_navigation',  ),));
                }
                not_admin_navigation_delete:

            }

            if (0 === strpos($pathinfo, '/admin/review')) {
                // admin_review
                if ($pathinfo === '/admin/review') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseReviewController::indexAction',  '_route' => 'admin_review',  '_permission' =>   array (    0 => 'admin_course_review_tab',  ),);
                }

                // admin_review_delete
                if (preg_match('#^/admin/review/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_review_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_review_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseReviewController::deleteAction',  '_permission' =>   array (    0 => 'admin_course_review_tab',  ),));
                }
                not_admin_review_delete:

                // admin_review_batch_delete
                if ($pathinfo === '/admin/review/batch_delete') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_review_batch_delete;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseReviewController::batchDeleteAction',  '_route' => 'admin_review_batch_delete',  '_permission' =>   array (    0 => 'admin_course_review_tab',  ),);
                }
                not_admin_review_batch_delete:

            }

            if (0 === strpos($pathinfo, '/admin/note')) {
                // admin_course_note
                if ($pathinfo === '/admin/note') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseNoteController::indexAction',  '_route' => 'admin_course_note',  '_permission' =>   array (    0 => 'admin_course_note_manage',  ),);
                }

                // admin_note_delete
                if (preg_match('#^/admin/note/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_note_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_note_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseNoteController::deleteAction',  '_permission' =>   array (    0 => 'admin_course_note_manage',  ),));
                }
                not_admin_note_delete:

                // admin_note_batch_delete
                if ($pathinfo === '/admin/note/batch_delete') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_note_batch_delete;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseNoteController::batchDeleteAction',  '_route' => 'admin_note_batch_delete',  '_permission' =>   array (    0 => 'admin_course_note_manage',  ),);
                }
                not_admin_note_batch_delete:

            }

            if (0 === strpos($pathinfo, '/admin/course_set')) {
                // admin_course_set
                if (preg_match('#^/admin/course_set/(?P<filter>[^/]++)/index$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_set')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::indexAction',  'filter' => 'normal',  '_permission' =>   array (    0 => 'admin_course_manage',  ),));
                }

                // admin_course_set_delete
                if (preg_match('#^/admin/course_set/(?P<id>[^/]++)/delete(?:/(?P<type>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_set_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::deleteAction',  'type' => '',  '_permission' =>   array (    0 => 'admin_course_manage',  ),));
                }

            }

            // admin_open_course_delete
            if (0 === strpos($pathinfo, '/admin/open/course') && preg_match('#^/admin/open/course/(?P<courseId>[^/]++)/delete(?:/(?P<type>[^/]++))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_open_course_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_open_course_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseController::deleteAction',  'type' => '',  '_permission' =>   array (  ),));
            }
            not_admin_open_course_delete:

            if (0 === strpos($pathinfo, '/admin/c')) {
                // admin_check_password
                if ($pathinfo === '/admin/check/password') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseController::checkPasswordAction',  '_route' => 'admin_check_password',  '_permission' =>   array (    0 => 'admin_course_manage',  ),);
                }

                // admin_course_set_publish
                if (0 === strpos($pathinfo, '/admin/course_set') && preg_match('#^/admin/course_set/(?P<id>[^/]++)/publish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_course_set_publish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_set_publish')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::publishAction',  '_permission' =>   array (    0 => 'admin_course_manage',  ),));
                }
                not_admin_course_set_publish:

            }

            // admin_open_course_publish
            if (0 === strpos($pathinfo, '/admin/open/course') && preg_match('#^/admin/open/course/(?P<id>[^/]++)/publish$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_open_course_publish;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_open_course_publish')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseController::publishAction',  '_permission' =>   array (  ),));
            }
            not_admin_open_course_publish:

            // admin_course_set_close
            if (0 === strpos($pathinfo, '/admin/course_set') && preg_match('#^/admin/course_set/(?P<id>[^/]++)/close$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_course_set_close;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_set_close')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::closeAction',  '_permission' =>   array (    0 => 'admin_course_set_close',  ),));
            }
            not_admin_course_set_close:

            if (0 === strpos($pathinfo, '/admin/open/course')) {
                // admin_open_course_close
                if (preg_match('#^/admin/open/course/(?P<id>[^/]++)/close$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_open_course_close;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_open_course_close')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseController::closeAction',  '_permission' =>   array (  ),));
                }
                not_admin_open_course_close:

                // admin_open_course_recommend_list
                if ($pathinfo === '/admin/open/course/recommend/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseController::recommendListAction',  '_route' => 'admin_open_course_recommend_list',  '_permission' =>   array (    0 => 'admin_open_course_recommend_list',  ),);
                }

                // admin_open_course_recommend
                if (preg_match('#^/admin/open/course/(?P<id>[^/]++)/recommend$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_open_course_recommend')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseController::recommendAction',  '_permission' =>   array (  ),));
                }

                // admin_open_course_cancel_recommend
                if (preg_match('#^/admin/open/course/(?P<id>[^/]++)/recommend/cancel/(?P<target>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_open_course_cancel_recommend;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_open_course_cancel_recommend')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseController::cancelRecommendAction',  '_permission' =>   array (  ),));
                }
                not_admin_open_course_cancel_recommend:

            }

            if (0 === strpos($pathinfo, '/admin/course')) {
                if (0 === strpos($pathinfo, '/admin/course_set')) {
                    // admin_course_set_recommend
                    if (preg_match('#^/admin/course_set/(?P<id>[^/]++)/recommend$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_set_recommend')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::recommendAction',  '_permission' =>   array (    0 => 'admin_course_set_recommend_list',    1 => 'admin_course_set_recommend',  ),));
                    }

                    // admin_course_set_cancel_recommend
                    if (preg_match('#^/admin/course_set/(?P<id>[^/]++)/recommend/cancel/(?P<target>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_course_set_cancel_recommend;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_set_cancel_recommend')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::cancelRecommendAction',  '_permission' =>   array (    0 => 'admin_course_set_recommend_list',    1 => 'admin_course_set_cancel_recommend',  ),));
                    }
                    not_admin_course_set_cancel_recommend:

                    // admin_course_chooser
                    if ($pathinfo === '/admin/course_set/chooser') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::chooserAction',  '_route' => 'admin_course_chooser',  '_permission' =>   array (  ),);
                    }

                    // admin_course_set_recommend_list
                    if ($pathinfo === '/admin/course_set/recommend/list') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::recommendListAction',  '_route' => 'admin_course_set_recommend_list',  '_permission' =>   array (    0 => 'admin_course_set_recommend_list',  ),);
                    }

                }

                // admin_course_category
                if ($pathinfo === '/admin/course/category') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseController::categoryAction',  '_route' => 'admin_course_category',  '_permission' =>   array (    0 => 'admin_course_category_manage',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/course_set')) {
                    // admin_course_set_data
                    if (preg_match('#^/admin/course_set/(?P<filter>[^/]++)/data$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_course_set_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::dataAction',  'filter' => 'normal',  '_permission' =>   array (    0 => 'admin_course_set_data',  ),));
                    }

                    // course_set_detail_data
                    if (0 === strpos($pathinfo, '/admin/course_set/detail/data') && preg_match('#^/admin/course_set/detail/data/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'course_set_detail_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::detailDataAction',  '_permission' =>   array (  ),));
                    }

                }

                // admin_courses_data
                if (0 === strpos($pathinfo, '/admin/courses/data') && preg_match('#^/admin/courses/data/(?P<courseSetId>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_courses_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSetController::coursesDataAction',  '_permission' =>   array (    0 => 'admin_course_set_data',  ),));
                }

                // admin_course_order_manage
                if ($pathinfo === '/admin/course/order/manage') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseOrderController::manageAction',  '_route' => 'admin_course_order_manage',  '_permission' =>   array (    0 => 'admin_course_order_manage',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/course/search')) {
                    // admin_course_search
                    if ($pathinfo === '/admin/course/search') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseController::searchAction',  '_route' => 'admin_course_search',  '_permission' =>   array (    0 => 'admin_operation_mobile_select_manage',  ),);
                    }

                    // admin_course_search_to_fill_banner
                    if ($pathinfo === '/admin/course/search_to_fill_banner') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseController::searchToFillBannerAction',  '_route' => 'admin_course_search_to_fill_banner',  '_permission' =>   array (    0 => 'admin_operation_mobile_select_manage',  ),);
                    }

                }

            }

            // admin_live_course
            if (0 === strpos($pathinfo, '/admin/livecourse') && preg_match('#^/admin/livecourse/(?P<status>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_live_course')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\LiveCourseController::indexAction',  '_permission' =>   array (    0 => 'admin_live_course_manage',  ),));
            }

            // admin_open_course
            if (0 === strpos($pathinfo, '/admin/open/course') && preg_match('#^/admin/open/course(?:/(?P<filter>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_open_course')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OpenCourseController::indexAction',  'filter' => 'open',  '_permission' =>   array (    0 => 'admin_open_course',  ),));
            }

            // admin_live_get_max_online
            if ($pathinfo === '/admin/livecourse/get/maxOnline') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\LiveCourseController::getMaxOnlineAction',  '_route' => 'admin_live_get_max_online',  '_permission' =>   array (    0 => 'admin_live_course_manage',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/order')) {
                // admin_order_detail
                if (preg_match('#^/admin/order/(?P<id>[^/]++)/detail_admin$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_order_detail')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrderController::detailAction',  '_permission' =>   array (  ),));
                }

                // admin_order_refunds
                if (0 === strpos($pathinfo, '/admin/order/refunds') && preg_match('#^/admin/order/refunds/(?P<targetType>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_order_refunds')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrderRefundController::refundsAction',  '_permission' =>   array (    0 => 'admin_finance',  ),));
                }

                // admin_order_cancel_refund
                if (preg_match('#^/admin/order/(?P<id>[^/]++)/cancel_refund$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_order_cancel_refund;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_order_cancel_refund')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrderRefundController::cancelRefundAction',  '_permission' =>   array (    0 => 'admin_finance',  ),));
                }
                not_admin_order_cancel_refund:

                // admin_order_audit_refund
                if (preg_match('#^/admin/order/(?P<id>[^/]++)/audit_refund$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_order_audit_refund')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrderRefundController::auditRefundAction',  '_permission' =>   array (    0 => 'admin_finance',  ),));
                }

            }

            // admin_setting_site
            if ($pathinfo === '/admin/setting/site') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SiteSettingController::siteAction',  '_route' => 'admin_setting_site',  '_permission' =>   array (    0 => 'admin_setting_message',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/operation/mobile')) {
                // admin_operation_mobile
                if ($pathinfo === '/admin/operation/mobile') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\MobileController::mobileAction',  '_route' => 'admin_operation_mobile',  '_permission' =>   array (    0 => 'admin_operation_mobile_banner_manage',  ),);
                }

                // admin_operation_mobile_select
                if ($pathinfo === '/admin/operation/mobile/select') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\MobileController::mobileSelectAction',  '_route' => 'admin_operation_mobile_select',  '_permission' =>   array (    0 => 'admin_operation_mobile_select_manage',  ),);
                }

                // admin_operation_mobile_customization_upgrade
                if ($pathinfo === '/admin/operation/mobile/customization_upgrade') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_operation_mobile_customization_upgrade;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\MobileController::customizationUpgradeAction',  '_route' => 'admin_operation_mobile_customization_upgrade',  '_permission' =>   array (  ),);
                }
                not_admin_operation_mobile_customization_upgrade:

            }

            if (0 === strpos($pathinfo, '/admin/discovery_column')) {
                // admin_discovery_column_delete
                if (preg_match('#^/admin/discovery_column/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_discovery_column_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_discovery_column_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\DiscoveryColumnController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_admin_discovery_column_delete:

                // admin_discovery_column_edit
                if (preg_match('#^/admin/discovery_column/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_discovery_column_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\DiscoveryColumnController::editAction',  '_permission' =>   array (  ),));
                }

                // admin_discovery_column_title_check
                if (preg_match('#^/admin/discovery_column/(?P<id>[^/]++)/title_check$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_discovery_column_title_check')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\DiscoveryColumnController::checkTitleAction',  '_permission' =>   array (  ),));
                }

                // admin_discovery_column_sort
                if ($pathinfo === '/admin/discovery_column/sort') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DiscoveryColumnController::sortAction',  '_route' => 'admin_discovery_column_sort',  '_permission' =>   array (  ),);
                }

                // admin_discovery_column_index
                if ($pathinfo === '/admin/discovery_column/index') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DiscoveryColumnController::indexAction',  '_route' => 'admin_discovery_column_index',  '_permission' =>   array (    0 => 'admin_discovery_column_index',  ),);
                }

                // admin_discovery_column_create
                if ($pathinfo === '/admin/discovery_column/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DiscoveryColumnController::createAction',  '_route' => 'admin_discovery_column_create',  '_permission' =>   array (    0 => 'admin_discovery_column_create',  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/setting/mobile')) {
                // admin_setting_mobile
                if ($pathinfo === '/admin/setting/mobile') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::mobileAction',  '_route' => 'admin_setting_mobile',  '_permission' =>   array (    0 => 'admin_setting_mobile_settings',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/mobile_iap_product')) {
                    // admin_setting_mobile_iap_product
                    if ($pathinfo === '/admin/setting/mobile_iap_product') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::mobileIapProductAction',  '_route' => 'admin_setting_mobile_iap_product',  '_permission' =>   array (    0 => 'admin_setting_mobile_iap_product',  ),);
                    }

                    // admin_setting_mobile_iap_product_delete
                    if (0 === strpos($pathinfo, '/admin/setting/mobile_iap_product_delete') && preg_match('#^/admin/setting/mobile_iap_product_delete/(?P<productId>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_setting_mobile_iap_product_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_setting_mobile_iap_product_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::mobileIapProductDeleteAction',  '_permission' =>   array (  ),));
                    }
                    not_admin_setting_mobile_iap_product_delete:

                }

            }

            // admin_operation_mobile_picture_upload
            if (0 === strpos($pathinfo, '/admin/operation/mobile/picture/upload') && preg_match('#^/admin/operation/mobile/picture/upload/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_operation_mobile_picture_upload;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_mobile_picture_upload')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\MobileController::mobilePictureUploadAction',  '_permission' =>   array (    0 => 'admin_operation_mobile_banner_manage',  ),));
            }
            not_admin_operation_mobile_picture_upload:

            // admin_setting_mobile_picture_upload
            if (0 === strpos($pathinfo, '/admin/setting/mobile/picture/upload') && preg_match('#^/admin/setting/mobile/picture/upload/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_setting_mobile_picture_upload;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_setting_mobile_picture_upload')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::mobilePictureUploadAction',  '_permission' =>   array (    0 => 'admin_setting_mobile_settings',  ),));
            }
            not_admin_setting_mobile_picture_upload:

            // admin_operation_mobile_picture_remove
            if (0 === strpos($pathinfo, '/admin/operation/mobile/picture/remove') && preg_match('#^/admin/operation/mobile/picture/remove/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_operation_mobile_picture_remove;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_mobile_picture_remove')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\MobileController::mobilePictureRemoveAction',  '_permission' =>   array (    0 => 'admin_operation_mobile_banner_manage',  ),));
            }
            not_admin_operation_mobile_picture_remove:

            if (0 === strpos($pathinfo, '/admin/setting')) {
                // admin_setting_mobile_picture_remove
                if (0 === strpos($pathinfo, '/admin/setting/mobile/picture/remove') && preg_match('#^/admin/setting/mobile/picture/remove/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_setting_mobile_picture_remove;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_setting_mobile_picture_remove')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::mobilePictureRemoveAction',  '_permission' =>   array (    0 => 'admin_setting_mobile_settings',  ),));
                }
                not_admin_setting_mobile_picture_remove:

                if (0 === strpos($pathinfo, '/admin/setting/l')) {
                    if (0 === strpos($pathinfo, '/admin/setting/logo')) {
                        // admin_setting_logo_upload
                        if ($pathinfo === '/admin/setting/logo/upload') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_setting_logo_upload;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::logoUploadAction',  '_route' => 'admin_setting_logo_upload',  '_permission' =>   array (    0 => 'admin_setting_message',  ),);
                        }
                        not_admin_setting_logo_upload:

                        // admin_setting_logo_remove
                        if ($pathinfo === '/admin/setting/logo/remove') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_setting_logo_remove;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::logoRemoveAction',  '_route' => 'admin_setting_logo_remove',  '_permission' =>   array (    0 => 'admin_setting_message',  ),);
                        }
                        not_admin_setting_logo_remove:

                    }

                    if (0 === strpos($pathinfo, '/admin/setting/live/logo')) {
                        // admin_setting_live_logo_upload
                        if ($pathinfo === '/admin/setting/live/logo/upload') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_setting_live_logo_upload;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::liveLogoUploadAction',  '_route' => 'admin_setting_live_logo_upload',  '_permission' =>   array (    0 => 'admin_setting_live_course',  ),);
                        }
                        not_admin_setting_live_logo_upload:

                        // admin_setting_live_logo_remove
                        if ($pathinfo === '/admin/setting/live/logo/remove') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_setting_live_logo_remove;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::liveLogoRemoveAction',  '_route' => 'admin_setting_live_logo_remove',  '_permission' =>   array (    0 => 'admin_setting_live_course',  ),);
                        }
                        not_admin_setting_live_logo_remove:

                    }

                }

                if (0 === strpos($pathinfo, '/admin/setting/favicon')) {
                    // admin_setting_favicon_upload
                    if ($pathinfo === '/admin/setting/favicon/upload') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_setting_favicon_upload;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::faviconUploadAction',  '_route' => 'admin_setting_favicon_upload',  '_permission' =>   array (    0 => 'admin_setting_message',  ),);
                    }
                    not_admin_setting_favicon_upload:

                    // admin_setting_favicon_remove
                    if ($pathinfo === '/admin/setting/favicon/remove') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_setting_favicon_remove;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::faviconRemoveAction',  '_route' => 'admin_setting_favicon_remove',  '_permission' =>   array (    0 => 'admin_setting_message',  ),);
                    }
                    not_admin_setting_favicon_remove:

                }

                // admin_setting_auth
                if ($pathinfo === '/admin/setting/auth') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::authAction',  '_route' => 'admin_setting_auth',  '_permission' =>   array (    0 => 'admin_user_auth',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/mailer')) {
                    // admin_setting_mailer
                    if ($pathinfo === '/admin/setting/mailer') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::mailerAction',  '_route' => 'admin_setting_mailer',  '_permission' =>   array (    0 => 'admin_setting_mailer',  ),);
                    }

                    // admin_setting_mailer_test
                    if ($pathinfo === '/admin/setting/mailer/test') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_setting_mailer_test;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::mailerTestAction',  '_route' => 'admin_setting_mailer_test',  '_permission' =>   array (  ),);
                    }
                    not_admin_setting_mailer_test:

                }

                // admin_setting_login_bind
                if ($pathinfo === '/admin/setting/login-connect') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::loginConnectAction',  '_route' => 'admin_setting_login_bind',  '_permission' =>   array (    0 => 'admin_setting_login_bind',  ),);
                }

                // admin_setting_payment
                if ($pathinfo === '/admin/setting/payment') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\FinanceSettingController::paymentAction',  '_route' => 'admin_setting_payment',  '_permission' =>   array (    0 => 'admin_payment',  ),);
                }

            }

            // admin_cloud_video_overview
            if ($pathinfo === '/admin/cloud/video/overview') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::videoOverviewAction',  '_route' => 'admin_cloud_video_overview',  '_permission' =>   array (    0 => 'admin_cloud_video_overview',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/setting')) {
                if (0 === strpos($pathinfo, '/admin/setting/cloud')) {
                    // admin_cloud_setting_video
                    if ($pathinfo === '/admin/setting/cloud/video') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::videoSettingAction',  '_route' => 'admin_cloud_setting_video',  '_permission' =>   array (    0 => 'admin_cloud_setting_video',  ),);
                    }

                    // admin_setting_cloud
                    if ($pathinfo === '/admin/setting/cloud') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::keyAction',  '_route' => 'admin_setting_cloud',  '_permission' =>   array (    0 => 'admin_setting_my_cloud',  ),);
                    }

                    if (0 === strpos($pathinfo, '/admin/setting/cloud/key')) {
                        // admin_setting_cloud_key
                        if ($pathinfo === '/admin/setting/cloud/key') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::keyAction',  '_route' => 'admin_setting_cloud_key',  '_permission' =>   array (    0 => 'admin_setting_my_cloud',  ),);
                        }

                        // admin_setting_cloud_key_info
                        if ($pathinfo === '/admin/setting/cloud/key/info') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::keyInfoAction',  '_route' => 'admin_setting_cloud_key_info',  '_permission' =>   array (    0 => 'admin_setting_my_cloud',  ),);
                        }

                        // admin_setting_cloud_key_bind
                        if ($pathinfo === '/admin/setting/cloud/key/bind') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::keyBindAction',  '_route' => 'admin_setting_cloud_key_bind',  '_permission' =>   array (    0 => 'admin_setting_my_cloud',  ),);
                        }

                        // admin_setting_cloud_key_update
                        if ($pathinfo === '/admin/setting/cloud/key/update') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::keyUpdateAction',  '_route' => 'admin_setting_cloud_key_update',  '_permission' =>   array (    0 => 'admin_setting_my_cloud',  ),);
                        }

                        // admin_setting_cloud_key_apply
                        if ($pathinfo === '/admin/setting/cloud/key/apply') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_setting_cloud_key_apply;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::keyApplyAction',  '_route' => 'admin_setting_cloud_key_apply',  '_permission' =>   array (    0 => 'admin_setting_my_cloud',  ),);
                        }
                        not_admin_setting_cloud_key_apply:

                        // admin_setting_cloud_key_copyright
                        if ($pathinfo === '/admin/setting/cloud/key/copyright') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_setting_cloud_key_copyright;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::keyCopyrightAction',  '_route' => 'admin_setting_cloud_key_copyright',  '_permission' =>   array (    0 => 'admin_setting_my_cloud',  ),);
                        }
                        not_admin_setting_cloud_key_copyright:

                    }

                    if (0 === strpos($pathinfo, '/admin/setting/cloud/video_')) {
                        if (0 === strpos($pathinfo, '/admin/setting/cloud/video_watermark')) {
                            // admin_setting_cloud_video_watermark_upload
                            if ($pathinfo === '/admin/setting/cloud/video_watermark/upload') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_admin_setting_cloud_video_watermark_upload;
                                }

                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::videoWatermarkUploadAction',  '_route' => 'admin_setting_cloud_video_watermark_upload',  '_permission' =>   array (    0 => 'admin_cloud_video_overview',  ),);
                            }
                            not_admin_setting_cloud_video_watermark_upload:

                            // admin_setting_cloud_video_watermark_remove
                            if ($pathinfo === '/admin/setting/cloud/video_watermark/remove') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_admin_setting_cloud_video_watermark_remove;
                                }

                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::videoWatermarkRemoveAction',  '_route' => 'admin_setting_cloud_video_watermark_remove',  '_permission' =>   array (    0 => 'admin_cloud_video_overview',  ),);
                            }
                            not_admin_setting_cloud_video_watermark_remove:

                        }

                        if (0 === strpos($pathinfo, '/admin/setting/cloud/video_embed_watermark')) {
                            // admin_setting_cloud_video_embed_watermark_upload
                            if ($pathinfo === '/admin/setting/cloud/video_embed_watermark/upload') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_admin_setting_cloud_video_embed_watermark_upload;
                                }

                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::videoEmbedWatermarkUploadAction',  '_route' => 'admin_setting_cloud_video_embed_watermark_upload',  '_permission' =>   array (    0 => 'admin_cloud_video_overview',  ),);
                            }
                            not_admin_setting_cloud_video_embed_watermark_upload:

                            // admin_setting_cloud_video_embed_watermark_remove
                            if ($pathinfo === '/admin/setting/cloud/video_embed_watermark/remove') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_admin_setting_cloud_video_embed_watermark_remove;
                                }

                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::videoWatermarkRemoveAction',  '_route' => 'admin_setting_cloud_video_embed_watermark_remove',  '_permission' =>   array (    0 => 'admin_cloud_video_overview',  ),);
                            }
                            not_admin_setting_cloud_video_embed_watermark_remove:

                        }

                    }

                }

                // admin_setting_refund
                if ($pathinfo === '/admin/setting/refund') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\FinanceSettingController::refundAction',  '_route' => 'admin_setting_refund',  '_permission' =>   array (    0 => 'admin_setting_refund',  ),);
                }

                // admin_setting_share
                if ($pathinfo === '/admin/setting/share') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SiteSettingController::shareAction',  '_route' => 'admin_setting_share',  '_permission' =>   array (    0 => 'admin_setting_share',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/default')) {
                    // admin_setting_default_avatar_crop
                    if ($pathinfo === '/admin/setting/default/avatar/crop') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SystemDefaultSettingController::defaultAvatarCropAction',  '_route' => 'admin_setting_default_avatar_crop',  '_permission' =>   array (    0 => 'admin_setting_avatar',  ),);
                    }

                    // admin_setting_default_course_picture_crop
                    if ($pathinfo === '/admin/setting/default/course/picture/crop') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SystemDefaultSettingController::defaultCoursePictureCropAction',  '_route' => 'admin_setting_default_course_picture_crop',  '_permission' =>   array (    0 => 'admin_setting_avatar',    1 => 'course_manage_picture',  ),);
                    }

                }

                // admin_setting_ip_blacklist
                if ($pathinfo === '/admin/setting/ip-blacklist') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::ipBlacklistAction',  '_route' => 'admin_setting_ip_blacklist',  '_permission' =>   array (    0 => 'admin_setting_ip_blacklist_manage',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/theme')) {
                    // admin_setting_theme
                    if ($pathinfo === '/admin/setting/theme') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::indexAction',  '_route' => 'admin_setting_theme',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),);
                    }

                    // admin_setting_theme_change
                    if ($pathinfo === '/admin/setting/theme/change') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_setting_theme_change;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::changeAction',  '_route' => 'admin_setting_theme_change',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),);
                    }
                    not_admin_setting_theme_change:

                }

            }

            if (0 === strpos($pathinfo, '/admin/theme')) {
                // admin_theme_manage
                if (preg_match('#^/admin/theme/(?P<uri>[^/]++)/manage$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_theme_manage')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::manageIndexAction',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),));
                }

                // admin_reset_currentTheme_config
                if (preg_match('#^/admin/theme/(?P<uri>[^/]++)/config/reset$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_reset_currentTheme_config')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::resetConfigAction',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),));
                }

                // admin_save_themes_config
                if (preg_match('#^/admin/theme/(?P<uri>[^/]++)/config/save$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_save_themes_config;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_save_themes_config')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::saveConfigAction',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),));
                }
                not_admin_save_themes_config:

                // admin_confirm_themes_config
                if (preg_match('#^/admin/theme/(?P<uri>[^/]++)/config/confirm$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_confirm_themes_config')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::confirmConfigAction',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),));
                }

                // admin_themes_show
                if (preg_match('#^/admin/theme/(?P<uri>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_themes_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::showAction',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),));
                }

                // admin_themes_config_edit
                if (preg_match('#^/admin/theme/(?P<uri>[^/]++)/config/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_themes_config_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ThemeController::themeConfigEditAction',  '_permission' =>   array (    0 => 'admin_setting_theme',  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/setting')) {
                if (0 === strpos($pathinfo, '/admin/setting/user-')) {
                    // admin_setting_user_center
                    if ($pathinfo === '/admin/setting/user-center') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::userCenterAction',  '_route' => 'admin_setting_user_center',  '_permission' =>   array (    0 => 'admin_setting_user_center',  ),);
                    }

                    // admin_setting_avatar
                    if ($pathinfo === '/admin/setting/user-avatar') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::userAvatarAction',  '_route' => 'admin_setting_avatar',  '_permission' =>   array (    0 => 'admin_setting_avatar',  ),);
                    }

                    // admin_setting_user_fields
                    if ($pathinfo === '/admin/setting/user-fields') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::userFieldsAction',  '_route' => 'admin_setting_user_fields',  '_permission' =>   array (    0 => 'admin_setting_user_fields',  ),);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/setting/course-')) {
                    // admin_setting_course_setting
                    if ($pathinfo === '/admin/setting/course-setting') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSettingController::courseSettingAction',  '_route' => 'admin_setting_course_setting',  '_permission' =>   array (    0 => 'admin_setting_course',  ),);
                    }

                    // admin_setting_course_avatar
                    if ($pathinfo === '/admin/setting/course-avatar') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSettingController::courseAvatarAction',  '_route' => 'admin_setting_course_avatar',  '_permission' =>   array (    0 => 'admin_setting_course_avatar',  ),);
                    }

                }

                // admin_setting_live_course_setting
                if ($pathinfo === '/admin/setting/live-course-setting') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSettingController::liveCourseSettingAction',  '_route' => 'admin_setting_live_course_setting',  '_permission' =>   array (    0 => 'admin_setting_live_course',  ),);
                }

                // admin_setting_questions_setting
                if ($pathinfo === '/admin/setting/questions-setting') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseSettingController::questionsSettingAction',  '_route' => 'admin_setting_questions_setting',  '_permission' =>   array (    0 => 'admin_setting_questions_setting',  ),);
                }

                // admin_setting_consult_setting
                if ($pathinfo === '/admin/setting/consult-setting') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SiteSettingController::consultSettingAction',  '_route' => 'admin_setting_consult_setting',  '_permission' =>   array (    0 => 'admin_setting_consult_setting',  ),);
                }

                // admin_setting_es_bar
                if ($pathinfo === '/admin/setting/es-bar') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SiteSettingController::esBarSettingAction',  '_route' => 'admin_setting_es_bar',  '_permission' =>   array (    0 => 'admin_setting_es_bar',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/consult-')) {
                    // admin_setting_consult_upload
                    if ($pathinfo === '/admin/setting/consult-upload') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SiteSettingController::consultUploadAction',  '_route' => 'admin_setting_consult_upload',  '_permission' =>   array (    0 => 'admin_setting_consult_setting',  ),);
                    }

                    // admin_setting_consult_webchat_delete
                    if ($pathinfo === '/admin/setting/consult-webchat-delete') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_setting_consult_webchat_delete;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SiteSettingController::deleteWebchatAction',  '_route' => 'admin_setting_consult_webchat_delete',  '_permission' =>   array (    0 => 'admin_setting_consult_setting',  ),);
                    }
                    not_admin_setting_consult_webchat_delete:

                }

                // admin_setting_admin_sync
                if ($pathinfo === '/admin/setting/admin_sync') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::adminSyncAction',  '_route' => 'admin_setting_admin_sync',  '_permission' =>   array (    0 => 'admin_setting_user_center',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/developer')) {
                    // admin_setting_developer
                    if ($pathinfo === '/admin/setting/developer') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DeveloperSettingController::indexAction',  '_route' => 'admin_setting_developer',  '_permission' =>   array (    0 => 'admin',  ),);
                    }

                    // admin_setting_developer_version
                    if ($pathinfo === '/admin/setting/developer/version') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DeveloperSettingController::versionAction',  '_route' => 'admin_setting_developer_version',  '_permission' =>   array (  ),);
                    }

                    // admin_setting_developer_magic
                    if ($pathinfo === '/admin/setting/developer/magic') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\DeveloperSettingController::magicAction',  '_route' => 'admin_setting_developer_magic',  '_permission' =>   array (  ),);
                    }

                }

                // admin_setting_post_num_rules
                if ($pathinfo === '/admin/setting/post_num_rules') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::postNumRulesAction',  '_route' => 'admin_setting_post_num_rules',  '_permission' =>   array (    0 => 'admin_setting_post_num_rules_settings',  ),);
                }

                // admin_setting_cdn
                if ($pathinfo === '/admin/setting/cdn') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CdnSettingController::indexAction',  '_route' => 'admin_setting_cdn',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/optimize')) {
                    // admin_optimize
                    if ($pathinfo === '/admin/setting/optimize') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OptimizeController::indexAction',  '_route' => 'admin_optimize',  '_permission' =>   array (    0 => 'admin_optimize_settings',  ),);
                    }

                    // admin_optimize_remove_cache
                    if ($pathinfo === '/admin/setting/optimize/remove-cache') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_optimize_remove_cache;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OptimizeController::removeCacheAction',  '_route' => 'admin_optimize_remove_cache',  '_permission' =>   array (    0 => 'admin_optimize_settings',  ),);
                    }
                    not_admin_optimize_remove_cache:

                }

            }

            // admin_optimize_remove_tmp
            if ($pathinfo === '/admin/optimize/remove-tmp') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_optimize_remove_tmp;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OptimizeController::removeTempAction',  '_route' => 'admin_optimize_remove_tmp',  '_permission' =>   array (    0 => 'admin_optimize_settings',  ),);
            }
            not_admin_optimize_remove_tmp:

            if (0 === strpos($pathinfo, '/admin/setting')) {
                if (0 === strpos($pathinfo, '/admin/setting/optimize')) {
                    // admin_optimize_remove_backup
                    if ($pathinfo === '/admin/setting/optimize/remove-backup') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_optimize_remove_backup;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OptimizeController::removeBackupAction',  '_route' => 'admin_optimize_remove_backup',  '_permission' =>   array (    0 => 'admin_optimize_settings',  ),);
                    }
                    not_admin_optimize_remove_backup:

                    // admin_optimize_backupdb
                    if ($pathinfo === '/admin/setting/optimize/backupdb') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_optimize_backupdb;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OptimizeController::backupdbAction',  '_route' => 'admin_optimize_backupdb',  '_permission' =>   array (    0 => 'admin_optimize_settings',  ),);
                    }
                    not_admin_optimize_backupdb:

                    // admin_optimize_remove_upload_files
                    if ($pathinfo === '/admin/setting/optimize/remove-unusedfiles') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OptimizeController::removeUnusedFilesAction',  '_route' => 'admin_optimize_remove_upload_files',  '_permission' =>   array (    0 => 'admin_optimize_settings',  ),);
                    }

                    // admin_optimize_remove_show_progressbar
                    if ($pathinfo === '/admin/setting/optimize/show-progressbar') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OptimizeController::showProgressbarAction',  '_route' => 'admin_optimize_remove_show_progressbar',  '_permission' =>   array (    0 => 'admin_optimize_settings',  ),);
                    }

                }

                // admin_jobs
                if ($pathinfo === '/admin/setting/jobs') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\JobController::indexAction',  '_route' => 'admin_jobs',  '_permission' =>   array (    0 => 'admin_jobs_manage',  ),);
                }

                // admin_logs
                if ($pathinfo === '/admin/setting/logs') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\LogController::indexAction',  '_route' => 'admin_logs',  '_permission' =>   array (    0 => 'admin_logs',  ),);
                }

                // admin_performance
                if ($pathinfo === '/admin/setting/performance') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SettingController::performanceAction',  '_route' => 'admin_performance',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/admin/setting/logs')) {
                    // admin_logs_prod
                    if ($pathinfo === '/admin/setting/logs/prod') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\LogController::prodAction',  '_route' => 'admin_logs_prod',  '_permission' =>   array (    0 => 'admin_logs_prod',  ),);
                    }

                    // admin_logs_action_dicts
                    if ($pathinfo === '/admin/setting/logs/logActions') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\LogController::logActionsAction',  '_route' => 'admin_logs_action_dicts',  '_permission' =>   array (  ),);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/cloud')) {
                // admin_cloud_access
                if ($pathinfo === '/admin/cloud/access') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::accessAction',  '_route' => 'admin_cloud_access',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_recharge
                if ($pathinfo === '/admin/cloud/recharge') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::rechargeAction',  '_route' => 'admin_cloud_recharge',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_account_person
                if ($pathinfo === '/admin/cloud/account/person') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::accountPersonAction',  '_route' => 'admin_cloud_account_person',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_list_coupon
                if ($pathinfo === '/admin/cloud/list/coupon') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::listCouponAction',  '_route' => 'admin_cloud_list_coupon',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_service_overview
                if (0 === strpos($pathinfo, '/admin/cloud/service') && preg_match('#^/admin/cloud/service/(?P<type>[^/]++)/overview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_service_overview')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::serviceOverviewAction',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),));
                }

                // admin_cloud_detail
                if ($pathinfo === '/admin/cloud/detail') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::detailAction',  '_route' => 'admin_cloud_detail',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_buy
                if (preg_match('#^/admin/cloud/(?P<type>[^/]++)/buy$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_buy')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::buyAction',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),));
                }

                // admin_cloud_live_more
                if ($pathinfo === '/admin/cloud/live/more') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::liveMoreAction',  '_route' => 'admin_cloud_live_more',  '_permission' =>   array (  ),);
                }

                // admin_cloud_tlp
                if ($pathinfo === '/admin/cloud/tlp') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::tlpAction',  '_route' => 'admin_cloud_tlp',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/cloud/video')) {
                    // admin_cloud_video
                    if ($pathinfo === '/admin/cloud/video') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::videoAction',  '_route' => 'admin_cloud_video',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                    }

                    // admin_cloud_video_detail
                    if ($pathinfo === '/admin/cloud/video/detail') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::videoDetailAction',  '_route' => 'admin_cloud_video_detail',  '_permission' =>   array (  ),);
                    }

                    // admin_cloud_video_switch
                    if ($pathinfo === '/admin/cloud/video/switch') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::videoSwitchAction',  '_route' => 'admin_cloud_video_switch',  '_permission' =>   array (  ),);
                    }

                }

                // admin_cloud_show
                if (preg_match('#^/admin/cloud/(?P<type>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::cloudShowAction',  'type' => 'video',  '_permission' =>   array (  ),));
                }

                // admin_cloud_email_buy
                if (preg_match('#^/admin/cloud/(?P<type>[^/]++)/buy/custom$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_email_buy')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::emailBuyAction',  '_permission' =>   array (  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/setting')) {
                // admin_edu_cloud_search_result_type
                if ($pathinfo === '/admin/setting/edu_cloud/search_result/type') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::setSearchResultTypeAction',  '_route' => 'admin_edu_cloud_search_result_type',  '_permission' =>   array (  ),);
                }

                // admin_wap_set
                if ($pathinfo === '/admin/setting/wap') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OperationSettingController::wapSetAction',  '_route' => 'admin_wap_set',  '_permission' =>   array (    0 => 'admin_wap_set',  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/cloud')) {
                // admin_cloud_sms_sign
                if ($pathinfo === '/admin/cloud/sms/sign') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::smsSignAction',  '_route' => 'admin_cloud_sms_sign',  '_permission' =>   array (  ),);
                }

                if (0 === strpos($pathinfo, '/admin/cloud/email')) {
                    // admin_cloud_email_account
                    if ($pathinfo === '/admin/cloud/email/count') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::emailAccountAction',  '_route' => 'admin_cloud_email_account',  '_permission' =>   array (  ),);
                    }

                    // admin_cloud_email_list
                    if ($pathinfo === '/admin/cloud/email/list') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::emailListAction',  '_route' => 'admin_cloud_email_list',  '_permission' =>   array (  ),);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/cloud/live')) {
                    // admin_cloud_live_upgrade
                    if ($pathinfo === '/admin/cloud/live/upgrade') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::liveUpgradeAction',  '_route' => 'admin_cloud_live_upgrade',  '_permission' =>   array (  ),);
                    }

                    // admin_cloud_live_renew
                    if ($pathinfo === '/admin/cloud/live/renew') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::liveRenewAction',  '_route' => 'admin_cloud_live_renew',  '_permission' =>   array (  ),);
                    }

                }

                // admin_cloud_email_count
                if ($pathinfo === '/admin/cloud/email/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::emailCountAction',  '_route' => 'admin_cloud_email_count',  '_permission' =>   array (  ),);
                }

                // admin_cloud_search
                if ($pathinfo === '/admin/cloud/search') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::searchAction',  '_route' => 'admin_cloud_search',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_doc
                if ($pathinfo === '/admin/cloud/doc') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::docAction',  '_route' => 'admin_cloud_doc',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_live
                if ($pathinfo === '/admin/cloud/live') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::liveAction',  '_route' => 'admin_cloud_live',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_cloud_sms_account
                if ($pathinfo === '/admin/cloud/sms/account') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::smsAccountAction',  '_route' => 'admin_cloud_sms_account',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/cloud/video')) {
                    // admin_cloud_video_account
                    if ($pathinfo === '/admin/cloud/video/account') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::videoAccountAction',  '_route' => 'admin_cloud_video_account',  '_permission' =>   array (  ),);
                    }

                    // admin_cloud_video_upgrade
                    if ($pathinfo === '/admin/cloud/video/upgrade') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::videoUpgradeAction',  '_route' => 'admin_cloud_video_upgrade',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                    }

                    // admin_cloud_video_renew
                    if ($pathinfo === '/admin/cloud/video/renew') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::videoRenewAction',  '_route' => 'admin_cloud_video_renew',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/cloud/s')) {
                    // admin_cloud_search_detail
                    if ($pathinfo === '/admin/cloud/search/detail') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::searchDetailAction',  '_route' => 'admin_cloud_search_detail',  '_permission' =>   array (  ),);
                    }

                    if (0 === strpos($pathinfo, '/admin/cloud/sms')) {
                        // admin_cloud_sms_detail
                        if ($pathinfo === '/admin/cloud/sms/detail') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::smsDetailAction',  '_route' => 'admin_cloud_sms_detail',  '_permission' =>   array (  ),);
                        }

                        if (0 === strpos($pathinfo, '/admin/cloud/sms/s')) {
                            // admin_cloud_sms_statistics
                            if ($pathinfo === '/admin/cloud/sms/statistics') {
                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::smsStatisticsAction',  '_route' => 'admin_cloud_sms_statistics',  '_permission' =>   array (  ),);
                            }

                            // admin_cloud_sms_setting
                            if ($pathinfo === '/admin/cloud/sms/setting') {
                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudController::smsSettingAction',  '_route' => 'admin_cloud_sms_setting',  '_permission' =>   array (  ),);
                            }

                        }

                    }

                }

            }

            // admin_app_center
            if (0 === strpos($pathinfo, '/admin/app/center') && preg_match('#^/admin/app/center(?:/(?P<postStatus>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_center')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppController::centerAction',  'postStatus' => 'all',  '_permission' =>   array (    0 => 'admin_app_center',  ),));
            }

            if (0 === strpos($pathinfo, '/admin/setting/my/cloud')) {
                // admin_my_cloud
                if ($pathinfo === '/admin/setting/my/cloud') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::myCloudAction',  '_route' => 'admin_my_cloud',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

                // admin_my_cloud_overview
                if ($pathinfo === '/admin/setting/my/cloud/overview') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::myCloudOverviewAction',  '_route' => 'admin_my_cloud_overview',  '_permission' =>   array (    0 => 'admin_my_cloud_overview',  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/cloud_file')) {
                if (0 === strpos($pathinfo, '/admin/cloud_files')) {
                    // admin_cloud_file
                    if ($pathinfo === '/admin/cloud_files') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::indexAction',  '_route' => 'admin_cloud_file',  '_permission' =>   array (    0 => 'admin_cloud_file',  ),);
                    }

                    // admin_cloud_file_manage
                    if ($pathinfo === '/admin/cloud_files/manage') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::manageAction',  '_route' => 'admin_cloud_file_manage',  '_permission' =>   array (    0 => 'admin_cloud_file_manage',  ),);
                    }

                    // admin_cloud_file_render_table
                    if ($pathinfo === '/admin/cloud_files/table/render') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::renderAction',  '_route' => 'admin_cloud_file_render_table',  '_permission' =>   array (  ),);
                    }

                }

                // admin_cloud_file_detail
                if (preg_match('#^/admin/cloud_file/(?P<globalId>[^/]++)/detail$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_file_detail')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::detailAction',  '_permission' =>   array (  ),));
                }

                // admin_cloud_file_edit
                if (preg_match('#^/admin/cloud_file/(?P<globalId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_cloud_file_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_file_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::editAction',  'fields' => '',  '_permission' =>   array (  ),));
                }
                not_admin_cloud_file_edit:

                // admin_cloud_file_preview
                if (preg_match('#^/admin/cloud_file/(?P<globalId>[^/]++)/preview$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_file_preview')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::previewAction',  '_permission' =>   array (  ),));
                }

                // admin_cloud_file_reconvert
                if (preg_match('#^/admin/cloud_file/(?P<globalId>[^/]++)/reconvert$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_file_reconvert')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::reconvertAction',  '_permission' =>   array (  ),));
                }

                // admin_cloud_file_download
                if (preg_match('#^/admin/cloud_file/(?P<globalId>[^/]++)/download$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_file_download')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::downloadAction',  '_permission' =>   array (  ),));
                }

                // admin_cloud_file_delete
                if (preg_match('#^/admin/cloud_file/(?P<globalId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_cloud_file_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cloud_file_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_admin_cloud_file_delete:

                if (0 === strpos($pathinfo, '/admin/cloud_file/delete')) {
                    // admin_cloud_file_batch_delete
                    if ($pathinfo === '/admin/cloud_file/delete/batch') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_cloud_file_batch_delete;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::batchDeleteAction',  '_route' => 'admin_cloud_file_batch_delete',  '_permission' =>   array (  ),);
                    }
                    not_admin_cloud_file_batch_delete:

                    // admin_cloud_file_delete_modal_show
                    if ($pathinfo === '/admin/cloud_file/delete/show') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::deleteShowAction',  '_route' => 'admin_cloud_file_delete_modal_show',  '_permission' =>   array (  ),);
                    }

                }

                // admin_cloud_file_tag_show
                if ($pathinfo === '/admin/cloud_file/tag/show') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudFileController::batchTagShowAction',  '_route' => 'admin_cloud_file_tag_show',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/app')) {
                // admin_app_installed
                if (0 === strpos($pathinfo, '/admin/app/installed') && preg_match('#^/admin/app/installed/(?P<postStatus>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_installed')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppController::installedAction',  '_permission' =>   array (    0 => 'admin_app_installed',  ),));
                }

                if (0 === strpos($pathinfo, '/admin/app/u')) {
                    // admin_app_uninstall
                    if ($pathinfo === '/admin/app/uninstall') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppController::uninstallAction',  '_route' => 'admin_app_uninstall',  '_permission' =>   array (    0 => 'admin_app_installed',  ),);
                    }

                    if (0 === strpos($pathinfo, '/admin/app/upgrades')) {
                        // admin_app_upgrades
                        if ($pathinfo === '/admin/app/upgrades') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppController::upgradesAction',  '_route' => 'admin_app_upgrades',  '_permission' =>   array (    0 => 'admin_app_upgrades',  ),);
                        }

                        // admin_app_upgrades_count
                        if ($pathinfo === '/admin/app/upgrades_count') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppController::upgradesCountAction',  '_route' => 'admin_app_upgrades_count',  '_permission' =>   array (    0 => 'admin_app_upgrades',  ),);
                        }

                    }

                }

            }

            // admin_oldUpgradeCheck
            if ($pathinfo === '/admin/upgrade/check') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppController::oldUpgradeCheckAction',  '_route' => 'admin_oldUpgradeCheck',  '_permission' =>   array (    0 => 'admin_app_upgrades',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/app')) {
                // admin_app_logs
                if ($pathinfo === '/admin/app/logs') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppController::logsAction',  '_route' => 'admin_app_logs',  '_permission' =>   array (    0 => 'admin_app_logs',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/app/package_update')) {
                    // admin_app_package_update_modal
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/modal$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_modal')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::modalAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }

                    // admin_app_package_update_check_environment
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/check_environment$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_check_environment;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_check_environment')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::checkEnvironmentAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_check_environment:

                    // admin_app_package_update_check_depends
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/check_depends$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_check_depends;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_check_depends')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::checkDependsAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_check_depends:

                    // admin_app_package_update_check_last_error
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/check_lasterror$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_check_last_error;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_check_last_error')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::checklastErrorAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_check_last_error:

                    // admin_app_package_update_backup_file
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/backup_file$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_backup_file;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_backup_file')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::backupFileAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_backup_file:

                    // admin_app_package_update_backup_db
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/backup_db$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_backup_db;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_backup_db')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::backupDbAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_backup_db:

                    // admin_app_package_update_download_and_extract
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/download_extract$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_download_and_extract;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_download_and_extract')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::downloadAndExtractAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_download_and_extract:

                    // admin_app_package_update_check_download_and_extract
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/check_download_extract$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_check_download_and_extract;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_check_download_and_extract')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::checkDownloadAndExtractAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_check_download_and_extract:

                    // admin_app_package_update_begin_upgrade
                    if (preg_match('#^/admin/app/package_update/(?P<id>[^/]++)/begin_upgrade$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_begin_upgrade;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_begin_upgrade')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::beginUpgradeAction',  '_permission' =>   array (    0 => 'admin_app_center',    1 => 'admin_app_installed',    2 => 'admin_app_upgrades',  ),));
                    }
                    not_admin_app_package_update_begin_upgrade:

                    // admin_app_package_update_check_newest
                    if (0 === strpos($pathinfo, '/admin/app/package_update/check/newest/code') && preg_match('#^/admin/app/package_update/check/newest/code/(?P<code>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_package_update_check_newest;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_package_update_check_newest')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppPackageUpdateController::checkNewestAction',  '_permission' =>   array (  ),));
                    }
                    not_admin_app_package_update_check_newest:

                }

            }

            if (0 === strpos($pathinfo, '/admin/category')) {
                if (0 === strpos($pathinfo, '/admin/category/c')) {
                    // admin_category_create
                    if ($pathinfo === '/admin/category/create') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CategoryController::createAction',  '_route' => 'admin_category_create',  '_permission' =>   array (    0 => 'admin_category_create',  ),);
                    }

                    // admin_category_checkcode
                    if ($pathinfo === '/admin/category/checkcode') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CategoryController::checkCodeAction',  '_route' => 'admin_category_checkcode',  '_permission' =>   array (    0 => 'admin_course_category_manage',  ),);
                    }

                }

                // admin_category_edit
                if (preg_match('#^/admin/category/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_category_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CategoryController::editAction',  '_permission' =>   array (    0 => 'admin_course_category_manage',  ),));
                }

                // admin_category_delete
                if (preg_match('#^/admin/category/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_category_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_category_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CategoryController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_admin_category_delete:

                // admin_category_upload
                if ($pathinfo === '/admin/category/uploadfile') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_category_upload;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CategoryController::uploadFileAction',  '_route' => 'admin_category_upload',  '_permission' =>   array (    0 => 'admin_course_category_manage',  ),);
                }
                not_admin_category_upload:

                // admin_category_sort
                if ($pathinfo === '/admin/category/sort') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_category_sort;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CategoryController::sortAction',  '_route' => 'admin_category_sort',  '_permission' =>   array (  ),);
                }
                not_admin_category_sort:

            }

            // admin_message
            if ($pathinfo === '/admin/message') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\MessageController::indexAction',  '_route' => 'admin_message',  '_permission' =>   array (    0 => 'admin_message_manage',  ),);
            }

            // admin_message_delete_messages
            if ($pathinfo === '/admin/delete/choosed/messages') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_message_delete_messages;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\MessageController::deleteChoosedMessagesAction',  '_route' => 'admin_message_delete_messages',  '_permission' =>   array (    0 => 'admin_message_manage',  ),);
            }
            not_admin_message_delete_messages:

            if (0 === strpos($pathinfo, '/admin/login_record')) {
                // admin_login_record
                if ($pathinfo === '/admin/login_record') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\LoginRecordController::indexAction',  '_route' => 'admin_login_record',  '_permission' =>   array (    0 => 'admin_login_record',  ),);
                }

                // admin_login_record_details
                if (preg_match('#^/admin/login_record/(?P<id>[^/]++)/details$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_login_record_details')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\LoginRecordController::showUserLoginRecordAction',  '_permission' =>   array (    0 => 'admin_login_record',  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/thread')) {
                // admin_thread
                if ($pathinfo === '/admin/thread') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseThreadController::indexAction',  '_route' => 'admin_thread',  '_permission' =>   array (    0 => 'admin_course_thread',  ),);
                }

                // admin_thread_delete
                if (preg_match('#^/admin/thread/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_thread_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_thread_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseThreadController::deleteAction',  '_permission' =>   array (    0 => 'admin_course_thread',    1 => 'admin_course_question_manage',  ),));
                }
                not_admin_thread_delete:

                // admin_thread_batch_delete
                if ($pathinfo === '/admin/thread/batch_delete') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_thread_batch_delete;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseThreadController::batchDeleteAction',  '_route' => 'admin_thread_batch_delete',  '_permission' =>   array (    0 => 'admin_course_thread',  ),);
                }
                not_admin_thread_batch_delete:

            }

            // admin_question
            if (0 === strpos($pathinfo, '/admin/question') && preg_match('#^/admin/question/(?P<postStatus>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_question')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CourseQuestionController::indexAction',  '_permission' =>   array (    0 => 'admin_course_question_manage',  ),));
            }

            if (0 === strpos($pathinfo, '/admin/a')) {
                if (0 === strpos($pathinfo, '/admin/approvals')) {
                    // admin_approval_approvals
                    if (preg_match('#^/admin/approvals/(?P<approvalStatus>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_approval_approvals')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserApprovalController::approvalsAction',  '_permission' =>   array (    0 => 'admin_approval_approvals',  ),));
                    }

                    // admin_approval_approve
                    if (preg_match('#^/admin/approvals/(?P<id>[^/]++)/approve$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_approval_approve')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserApprovalController::approveAction',  '_permission' =>   array (    0 => 'admin_approval_approvals',  ),));
                    }

                    // admin_approval_info_view
                    if (preg_match('#^/admin/approvals/(?P<id>[^/]++)/view$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_approval_info_view')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserApprovalController::viewApprovalInfoAction',  '_permission' =>   array (    0 => 'admin_approval_approvals',  ),));
                    }

                    // admin_approval_cancel
                    if (preg_match('#^/admin/approvals/(?P<id>[^/]++)/cancel$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_approval_cancel;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_approval_cancel')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserApprovalController::cancelAction',  '_permission' =>   array (    0 => 'admin_approval_cancel',  ),));
                    }
                    not_admin_approval_cancel:

                    // show_idcard
                    if (0 === strpos($pathinfo, '/admin/approvals/idcard/show') && preg_match('#^/admin/approvals/idcard/show/(?P<userId>[^/]++)/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'show_idcard')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserApprovalController::showIdcardAction',  '_permission' =>   array (    0 => 'admin_approval_approvals',  ),));
                    }

                }

                if (0 === strpos($pathinfo, '/admin/article/category')) {
                    // admin_article_category
                    if ($pathinfo === '/admin/article/category') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleCategoryController::indexAction',  '_route' => 'admin_article_category',  '_permission' =>   array (    0 => 'admin_operation_article_category',  ),);
                    }

                    if (0 === strpos($pathinfo, '/admin/article/category/c')) {
                        // admin_article_category_create
                        if ($pathinfo === '/admin/article/category/create') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleCategoryController::createAction',  '_route' => 'admin_article_category_create',  '_permission' =>   array (    0 => 'admin_operation_article_category',  ),);
                        }

                        if (0 === strpos($pathinfo, '/admin/article/category/check')) {
                            // admin_article_category_checkparentid
                            if ($pathinfo === '/admin/article/category/checkparentid') {
                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleCategoryController::checkParentIdAction',  '_route' => 'admin_article_category_checkparentid',  '_permission' =>   array (    0 => 'admin_operation_article_category',  ),);
                            }

                            // admin_article_category_checkcode
                            if ($pathinfo === '/admin/article/category/checkcode') {
                                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleCategoryController::checkCodeAction',  '_route' => 'admin_article_category_checkcode',  '_permission' =>   array (    0 => 'admin_operation_article_category',  ),);
                            }

                        }

                    }

                    // admin_article_category_edit
                    if (preg_match('#^/admin/article/category/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_category_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleCategoryController::editAction',  '_permission' =>   array (    0 => 'admin_operation_article_category',  ),));
                    }

                    // admin_article_category_delete
                    if (preg_match('#^/admin/article/category/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_article_category_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_category_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleCategoryController::deleteAction',  '_permission' =>   array (  ),));
                    }
                    not_admin_article_category_delete:

                    // admin_article_category_sort
                    if ($pathinfo === '/admin/article/category/sort') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_article_category_sort;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleCategoryController::sortAction',  '_route' => 'admin_article_category_sort',  '_permission' =>   array (  ),);
                    }
                    not_admin_article_category_sort:

                }

            }

            // admin_article_setting
            if ($pathinfo === '/admin/setting/article') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OperationSettingController::articleSetAction',  '_route' => 'admin_article_setting',  '_permission' =>   array (    0 => 'admin_article_setting',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/article')) {
                // admin_article
                if ($pathinfo === '/admin/article') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::indexAction',  '_route' => 'admin_article',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),);
                }

                // admin_article_create
                if ($pathinfo === '/admin/article/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::createAction',  '_route' => 'admin_article_create',  '_permission' =>   array (    0 => 'admin_operation_article_create',  ),);
                }

                // admin_article_picture_crop
                if ($pathinfo === '/admin/article/picture/crop') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::pictureCropAction',  '_route' => 'admin_article_picture_crop',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/article/s')) {
                    // admin_article_show_upload
                    if ($pathinfo === '/admin/article/show/upload') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::showUploadAction',  '_route' => 'admin_article_show_upload',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),);
                    }

                    // admin_article_set_property
                    if (0 === strpos($pathinfo, '/admin/article/set/property') && preg_match('#^/admin/article/set/property/(?P<id>[^/]++)/(?P<property>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_set_property')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::setArticlePropertyAction',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),));
                    }

                }

                // admin_article_cancel_property
                if (0 === strpos($pathinfo, '/admin/article/cancel/property') && preg_match('#^/admin/article/cancel/property/(?P<id>[^/]++)/(?P<property>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_cancel_property')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::cancelArticlePropertyAction',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),));
                }

                // admin_article_edit
                if (preg_match('#^/admin/article/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::editAction',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),));
                }

                // admin_article_publish
                if (preg_match('#^/admin/article/(?P<id>[^/]++)/publish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_article_publish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_publish')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::publishAction',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),));
                }
                not_admin_article_publish:

                // admin_article_unpublish
                if (preg_match('#^/admin/article/(?P<id>[^/]++)/unpublish$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_article_unpublish;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_unpublish')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::unpublishAction',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),));
                }
                not_admin_article_unpublish:

                // admin_article_thumb_remove
                if (0 === strpos($pathinfo, '/admin/article/thumb') && preg_match('#^/admin/article/thumb/(?P<id>[^/]++)/remove$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_thumb_remove')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::thumbRemoveAction',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),));
                }

                // admin_article_trash
                if (preg_match('#^/admin/article/(?P<id>[^/]++)/trash$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_article_trash;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_trash')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::trashAction',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),));
                }
                not_admin_article_trash:

                // admin_article_delete
                if ($pathinfo === '/admin/article/delete') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_article_delete;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleController::deleteAction',  '_route' => 'admin_article_delete',  '_permission' =>   array (    0 => 'admin_operation_article_manage',  ),);
                }
                not_admin_article_delete:

            }

            if (0 === strpos($pathinfo, '/admin/invite')) {
                // admin_invite
                if ($pathinfo === '/admin/invite') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\InviteController::indexAction',  '_route' => 'admin_invite',  '_permission' =>   array (    0 => 'admin_operation_invite',  ),);
                }

                // admin_invite_detail
                if ($pathinfo === '/admin/invite/detail') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\InviteController::inviteDetailAction',  '_route' => 'admin_invite_detail',  '_permission' =>   array (    0 => 'admin_operation_invite',  ),);
                }

            }

            // admin_invite_set
            if ($pathinfo === '/admin/setting/invite') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OperationSettingController::inviteSetAction',  '_route' => 'admin_invite_set',  '_permission' =>   array (    0 => 'admin_invite_set',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/invite')) {
                // admin_invite_coupon
                if (preg_match('#^/admin/invite/(?P<filter>[^/]++)/coupon/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_invite_coupon');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_invite_coupon')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\InviteController::couponAction',  'filter' => 'invited',  '_permission' =>   array (  ),));
                }

                // admin_invite_coupon_query
                if (rtrim($pathinfo, '/') === '/admin/invite/coupon/query') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_invite_coupon_query');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\InviteController::queryInviteCouponAction',  '_route' => 'admin_invite_coupon_query',  '_permission' =>   array (  ),);
                }

            }

            // admin_group
            if (rtrim($pathinfo, '/') === '/admin/group') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_group');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::indexAction',  '_route' => 'admin_group',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),);
            }

            // admin_group_set
            if ($pathinfo === '/admin/setting/group') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OperationSettingController::groupSetAction',  '_route' => 'admin_group_set',  '_permission' =>   array (    0 => 'admin_group_set',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/group')) {
                // admin_groupThread
                if ($pathinfo === '/admin/group/thread') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::threadAction',  '_route' => 'admin_groupThread',  '_permission' =>   array (    0 => 'admin_operation_group_thread',  ),);
                }

                // admin_groupThread_batch_delete
                if ($pathinfo === '/admin/group/batchDeleteThread') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_groupThread_batch_delete;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::batchDeleteThreadAction',  '_route' => 'admin_groupThread_batch_delete',  '_permission' =>   array (    0 => 'admin_operation_group_thread',  ),);
                }
                not_admin_groupThread_batch_delete:

                // admin_group_close
                if (preg_match('#^/admin/group/(?P<id>[^/]++)/close$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_close')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::closeGroupAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                }

                // admin_group_open
                if (preg_match('#^/admin/group/(?P<id>[^/]++)/open$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_open')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::openGroupAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                }

                if (0 === strpos($pathinfo, '/admin/group/t')) {
                    if (0 === strpos($pathinfo, '/admin/group/thread')) {
                        // admin_group_thread_cancel_elite
                        if (preg_match('#^/admin/group/thread/(?P<threadId>[^/]++)/removeElite$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_thread_cancel_elite')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::removeEliteAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                        }

                        // admin_group_thread_set_elite
                        if (preg_match('#^/admin/group/thread/(?P<threadId>[^/]++)/setElite$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_thread_set_elite')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::setEliteAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                        }

                        // admin_group_thread_cancel_stick
                        if (preg_match('#^/admin/group/thread/(?P<threadId>[^/]++)/removeStick$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_thread_cancel_stick')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::removeStickAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                        }

                        // admin_group_thread_set_stick
                        if (preg_match('#^/admin/group/thread/(?P<threadId>[^/]++)/setStick$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_thread_set_stick')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::setStickAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                        }

                        // admin_group_thread_close
                        if (preg_match('#^/admin/group/thread/(?P<threadId>[^/]++)/closeThread$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_thread_close')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::closeThreadAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                        }

                        // admin_group_thread_open
                        if (preg_match('#^/admin/group/thread/(?P<threadId>[^/]++)/openThread$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_thread_open')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::openThreadAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                        }

                        // admin_group_thread_delete
                        if (preg_match('#^/admin/group/thread/(?P<threadId>[^/]++)/deleteThread$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_group_thread_delete;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_thread_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::deleteThreadAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                        }
                        not_admin_group_thread_delete:

                    }

                    // admin_group_transfer
                    if (0 === strpos($pathinfo, '/admin/group/transfer') && preg_match('#^/admin/group/transfer/(?P<groupId>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_group_transfer')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\GroupController::transferGroupAction',  '_permission' =>   array (    0 => 'admin_operation_group_manage',  ),));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/operation/analysis')) {
                // admin_operation_analysis_register
                if (0 === strpos($pathinfo, '/admin/operation/analysis/register') && preg_match('#^/admin/operation/analysis/register/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_register')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::registerAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_login
                if (0 === strpos($pathinfo, '/admin/operation/analysis/login') && preg_match('#^/admin/operation/analysis/login/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_login')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::loginAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_course_set
                if (0 === strpos($pathinfo, '/admin/operation/analysis/course_set') && preg_match('#^/admin/operation/analysis/course_set/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_course_set')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::courseSetAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_task
                if (0 === strpos($pathinfo, '/admin/operation/analysis/task') && preg_match('#^/admin/operation/analysis/task/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_task')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::taskAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_lesson_join
                if (0 === strpos($pathinfo, '/admin/operation/analysis/lesson/join') && preg_match('#^/admin/operation/analysis/lesson/join/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_lesson_join')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::joinLessonAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_course_paid
                if (0 === strpos($pathinfo, '/admin/operation/analysis/course/paid') && preg_match('#^/admin/operation/analysis/course/paid/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_course_paid')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::paidCourseAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_task_completed
                if (0 === strpos($pathinfo, '/admin/operation/analysis/task/completed') && preg_match('#^/admin/operation/analysis/task/completed/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_task_completed')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::completedTaskAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_classroom_paid
                if (0 === strpos($pathinfo, '/admin/operation/analysis/classroom/paid') && preg_match('#^/admin/operation/analysis/classroom/paid/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_classroom_paid')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::paidClassroomAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                if (0 === strpos($pathinfo, '/admin/operation/analysis/video')) {
                    // admin_operation_analysis_video_viewed
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/video/viewed') && preg_match('#^/admin/operation/analysis/video/viewed/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_video_viewed')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::videoViewedAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                    // admin_operation_analysis_video_cloud_viewed
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/video/cloud/viewed') && preg_match('#^/admin/operation/analysis/video/cloud/viewed/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_video_cloud_viewed')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::cloudVideoViewedAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                    // admin_operation_analysis_video_local_viewed
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/video/local/viewed') && preg_match('#^/admin/operation/analysis/video/local/viewed/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_video_local_viewed')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::localVideoViewedAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                    // admin_operation_analysis_video_net_viewed
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/video/net/viewed') && preg_match('#^/admin/operation/analysis/video/net/viewed/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_video_net_viewed')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::netVideoViewedAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                }

                // admin_operation_analysis_income
                if (0 === strpos($pathinfo, '/admin/operation/analysis/income') && preg_match('#^/admin/operation/analysis/income/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_income')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::incomeAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                if (0 === strpos($pathinfo, '/admin/operation/analysis/c')) {
                    // admin_operation_analysis_course_set_income
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/course_set/income') && preg_match('#^/admin/operation/analysis/course_set/income/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_course_set_income')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::courseSetIncomeAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                    // admin_operation_analysis_classroom_income
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/classroom/income') && preg_match('#^/admin/operation/analysis/classroom/income/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_classroom_income')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::classroomIncomeAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                }

                // admin_operation_analysis_vip_income
                if (0 === strpos($pathinfo, '/admin/operation/analysis/vip/income') && preg_match('#^/admin/operation/analysis/vip/income/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_vip_income')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::vipIncomeAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                if (0 === strpos($pathinfo, '/admin/operation/analysis/course')) {
                    // admin_operation_analysis_course_set_sum
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/course_set/sum') && preg_match('#^/admin/operation/analysis/course_set/sum/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_course_set_sum')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::courseSetSumAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                    // admin_operation_analysis_course_sum
                    if (0 === strpos($pathinfo, '/admin/operation/analysis/course/sum') && preg_match('#^/admin/operation/analysis/course/sum/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_course_sum')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::courseSumAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                    }

                }

                // admin_operation_analysis_user_sum
                if (0 === strpos($pathinfo, '/admin/operation/analysis/user/sum') && preg_match('#^/admin/operation/analysis/user/sum/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_user_sum')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::userSumAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_rount
                if (0 === strpos($pathinfo, '/admin/operation/analysis/route_analysis_data_type') && preg_match('#^/admin/operation/analysis/route_analysis_data_type/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_rount')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::routeAnalysisDataTypeAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

                // admin_operation_analysis_lesson_exit
                if (0 === strpos($pathinfo, '/admin/operation/analysis/lesson/exit') && preg_match('#^/admin/operation/analysis/lesson/exit/(?P<tab>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_operation_analysis_lesson_exit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnalysisController::exitLessonAction',  '_permission' =>   array (    0 => 'admin_operation_analysis',  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/user_fields')) {
                // admin_user_fields_add
                if ($pathinfo === '/admin/user_fields/add') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::addUserFieldsAction',  '_route' => 'admin_user_fields_add',  '_permission' =>   array (    0 => 'admin_setting_user_fields',  ),);
                }

                // admin_user_fields_edit
                if (0 === strpos($pathinfo, '/admin/user_fields/edit') && preg_match('#^/admin/user_fields/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_fields_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::editUserFieldsAction',  '_permission' =>   array (    0 => 'admin_setting_user_fields',  ),));
                }

                // admin_user_fields_delete
                if (0 === strpos($pathinfo, '/admin/user_fields/delete') && preg_match('#^/admin/user_fields/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_user_fields_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\UserSettingController::deleteUserFieldsAction',  '_permission' =>   array (    0 => 'admin_setting_user_fields',  ),));
                }

            }

            // admin_system_status
            if ($pathinfo === '/admin/system/status') {
                return array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::systemStatusAction',  '_route' => 'admin_system_status',  '_permission' =>   array (    0 => 'admin',  ),);
            }

            // admin_official_messages
            if ($pathinfo === '/admin/official/messages') {
                return array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::officialMessagesAction',  '_route' => 'admin_official_messages',  '_permission' =>   array (    0 => 'admin',  ),);
            }

            // admin_uploadfile_head_leader_params
            if ($pathinfo === '/admin/uploadfile/video/head/leader/params') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\UploadFileController::headLeaderParamsAction',  '_route' => 'admin_uploadfile_head_leader_params',  '_permission' =>   array (    0 => 'admin_setting_cloud_video',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/coin/picture')) {
                // admin_coin_picture
                if ($pathinfo === '/admin/coin/picture') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_coin_picture;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::pictureAction',  '_route' => 'admin_coin_picture',  '_permission' =>   array (    0 => 'admin_coin_settings',  ),);
                }
                not_admin_coin_picture:

                // admin_coin_picture_remove
                if ($pathinfo === '/admin/coin/picture/remove') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_coin_picture_remove;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::pictureRemoveAction',  '_route' => 'admin_coin_picture_remove',  '_permission' =>   array (    0 => 'admin_coin_settings',  ),);
                }
                not_admin_coin_picture_remove:

            }

            // admin_coin_settings
            if ($pathinfo === '/admin/setting/coin') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::settingsAction',  '_route' => 'admin_coin_settings',  '_permission' =>   array (    0 => 'admin_coin_settings',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/coin')) {
                // admin_coin_records
                if ($pathinfo === '/admin/coin/records') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::recordsAction',  '_route' => 'admin_coin_records',  '_permission' =>   array (    0 => 'admin_coin_records',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/coin/orders')) {
                    // admin_coin_orders
                    if ($pathinfo === '/admin/coin/orders') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinOrderController::ordersAction',  '_route' => 'admin_coin_orders',  '_permission' =>   array (    0 => 'admin_coin_orders',  ),);
                    }

                    // admin_coin_orders_log
                    if (0 === strpos($pathinfo, '/admin/coin/orders/log') && preg_match('#^/admin/coin/orders/log/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_coin_orders_log')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinOrderController::logsAction',  '_permission' =>   array (  ),));
                    }

                }

                if (0 === strpos($pathinfo, '/admin/coin/bill')) {
                    // admin_bill
                    if ($pathinfo === '/admin/coin/bill') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::cashBillAction',  '_route' => 'admin_bill',  '_permission' =>   array (    0 => 'admin_bill',  ),);
                    }

                    // admin_bill_export_csv
                    if (0 === strpos($pathinfo, '/admin/coin/bill/export') && preg_match('#^/admin/coin/bill/export/(?P<cashType>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_bill_export_csv')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::exportCsvAction',  '_permission' =>   array (    0 => 'admin_bill',    1 => 'admin_coin_records',  ),));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/order/manage')) {
                // admin_order_manage_export_csv
                if (0 === strpos($pathinfo, '/admin/order/manage/export') && preg_match('#^/admin/order/manage/export/(?P<targetType>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_order_manage_export_csv')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrderController::exportCsvAction',  '_permission' =>   array (  ),));
                }

                // admin_order_manage_export_coin_csv
                if ($pathinfo === '/admin/order/manage/coin') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinOrderController::exportCsvAction',  '_route' => 'admin_order_manage_export_coin_csv',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/coin')) {
                // admin_coin_user_records
                if ($pathinfo === '/admin/coin/records/user') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::userRecordsAction',  '_route' => 'admin_coin_user_records',  '_permission' =>   array (    0 => 'admin_coin_user_records',  ),);
                }

                // admin_coin_flow_detail
                if (rtrim($pathinfo, '/') === '/admin/coin/flow/detail') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_coin_flow_detail');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::flowDetailAction',  '_route' => 'admin_coin_flow_detail',  '_permission' =>   array (    0 => 'admin_coin_user_records',  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/setting/coin/model')) {
                // admin_coin_model
                if ($pathinfo === '/admin/setting/coin/model') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::modelAction',  '_route' => 'admin_coin_model',  '_permission' =>   array (    0 => 'admin_coin_settings',  ),);
                }

                // admin_coin_model_ajax
                if ($pathinfo === '/admin/setting/coin/model/ajax') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::tableAjaxAction',  '_route' => 'admin_coin_model_ajax',  '_permission' =>   array (    0 => 'admin_coin_user_records',  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/co')) {
                // admin_coin_model_save
                if ($pathinfo === '/admin/coin/model/save') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CoinController::modelSaveAction',  '_route' => 'admin_coin_model_save',  '_permission' =>   array (    0 => 'admin_coin_user_records',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/common')) {
                    if (0 === strpos($pathinfo, '/admin/common/ad')) {
                        // admin_common_add
                        if ($pathinfo === '/admin/common/add') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CommonAdminController::addCommonAdminAction',  '_route' => 'admin_common_add',  '_permission' =>   array (    0 => 'admin',  ),);
                        }

                        // admin_common_admin
                        if ($pathinfo === '/admin/common/admin') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CommonAdminController::commonAdminAction',  '_route' => 'admin_common_admin',  '_permission' =>   array (    0 => 'admin',  ),);
                        }

                    }

                    // admin_common_remove
                    if (0 === strpos($pathinfo, '/admin/common/remove') && preg_match('#^/admin/common/remove/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_common_remove')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\CommonAdminController::commonRemoveAction',  '_permission' =>   array (    0 => 'admin',  ),));
                    }

                }

            }

            // admin_edu_cloud_sms
            if ($pathinfo === '/admin/edu_cloud/sms/overview') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::smsOverviewAction',  '_route' => 'admin_edu_cloud_sms',  '_permission' =>   array (    0 => 'admin_edu_cloud_sms_overview',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/setting')) {
                // admin_edu_cloud_setting_sms
                if ($pathinfo === '/admin/setting/edu_cloud/sms') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::smsSettingAction',  '_route' => 'admin_edu_cloud_setting_sms',  '_permission' =>   array (    0 => 'admin_edu_cloud_setting_sms',  ),);
                }

                // admin_edu_cloud_sms_status
                if ($pathinfo === '/admin/setting/sms/status') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::smsStatusAction',  '_route' => 'admin_edu_cloud_sms_status',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/edu_cloud')) {
                if (0 === strpos($pathinfo, '/admin/edu_cloud/a')) {
                    // admin_edu_cloud_apply_for_sms
                    if ($pathinfo === '/admin/edu_cloud/apply_for_sms') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::applyForSmsAction',  '_route' => 'admin_edu_cloud_apply_for_sms',  '_permission' =>   array (    0 => 'admin_edu_cloud_sms_overview',  ),);
                    }

                    // admin_edu_cloud_sms_no_message
                    if ($pathinfo === '/admin/edu_cloud/admin_edu_cloud_sms_no_message') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::smsNoMessageAction',  '_route' => 'admin_edu_cloud_sms_no_message',  '_permission' =>   array (    0 => 'admin_edu_cloud_sms_overview',  ),);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/edu_cloud/email')) {
                    // admin_edu_cloud_email
                    if ($pathinfo === '/admin/edu_cloud/email/overview') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::emailOverviewAction',  '_route' => 'admin_edu_cloud_email',  '_permission' =>   array (    0 => 'admin_edu_cloud_email_overview',  ),);
                    }

                    if (0 === strpos($pathinfo, '/admin/edu_cloud/email/s')) {
                        // admin_edu_cloud_email_setting
                        if ($pathinfo === '/admin/edu_cloud/email/setting') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::emailSettingAction',  '_route' => 'admin_edu_cloud_email_setting',  '_permission' =>   array (    0 => 'admin_edu_cloud_email_overview',  ),);
                        }

                        // admin_edu_cloud_email_switch
                        if ($pathinfo === '/admin/edu_cloud/email/switch') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::emailSwitchAction',  '_route' => 'admin_edu_cloud_email_switch',  '_permission' =>   array (    0 => 'admin_edu_cloud_email_overview',  ),);
                        }

                    }

                }

                // admin_edu_cloud_search
                if ($pathinfo === '/admin/edu_cloud/search/overview') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::searchOverviewAction',  '_route' => 'admin_edu_cloud_search',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/setting')) {
                if (0 === strpos($pathinfo, '/admin/setting/edu_cloud')) {
                    // admin_edu_cloud_setting_search
                    if ($pathinfo === '/admin/setting/edu_cloud/search') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::searchSettingAction',  '_route' => 'admin_edu_cloud_setting_search',  '_permission' =>   array (    0 => 'admin_edu_cloud_setting_search',  ),);
                    }

                    // admin_edu_cloud_attachment
                    if ($pathinfo === '/admin/setting/edu_cloud/attachment') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::attachmentAction',  '_route' => 'admin_edu_cloud_attachment',  '_permission' =>   array (    0 => 'admin_edu_cloud_attachment',  ),);
                    }

                    if (0 === strpos($pathinfo, '/admin/setting/edu_cloud/search')) {
                        // admin_edu_cloud_search_clause
                        if ($pathinfo === '/admin/setting/edu_cloud/search/clause') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::searchClauseAction',  '_route' => 'admin_edu_cloud_search_clause',  '_permission' =>   array (    0 => 'admin_edu_cloud_search',  ),);
                        }

                        // admin_edu_cloud_search_reapply
                        if ($pathinfo === '/admin/setting/edu_cloud/search/reapply') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::searchReapplyAction',  '_route' => 'admin_edu_cloud_search_reapply',  '_permission' =>   array (  ),);
                        }

                        // admin_edu_cloud_search_open
                        if ($pathinfo === '/admin/setting/edu_cloud/search/open') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::searchOpenAction',  '_route' => 'admin_edu_cloud_search_open',  '_permission' =>   array (  ),);
                        }

                        // admin_edu_cloud_search_close
                        if ($pathinfo === '/admin/setting/edu_cloud/search/close') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::searchCloseAction',  '_route' => 'admin_edu_cloud_search_close',  '_permission' =>   array (    0 => 'admin_edu_cloud_search',  ),);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/setting/app/im')) {
                    // admin_app_im
                    if ($pathinfo === '/admin/setting/app/im') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::appImAction',  '_route' => 'admin_app_im',  '_permission' =>   array (    0 => 'admin_app_im',  ),);
                    }

                    // admin_app_im_update
                    if ($pathinfo === '/admin/setting/app/im/update') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_app_im_update;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::appImUpdateStatusAction',  '_route' => 'admin_app_im_update',  '_permission' =>   array (  ),);
                    }
                    not_admin_app_im_update:

                }

            }

            if (0 === strpos($pathinfo, '/admin/announcement')) {
                // admin_announcement
                if ($pathinfo === '/admin/announcement') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnnouncementController::indexAction',  '_route' => 'admin_announcement',  '_permission' =>   array (    0 => 'admin_announcement',  ),);
                }

                // admin_announcement_create
                if ($pathinfo === '/admin/announcement/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnnouncementController::createAction',  '_route' => 'admin_announcement_create',  '_permission' =>   array (    0 => 'admin_announcement_create',  ),);
                }

                // admin_announcement_delete
                if (0 === strpos($pathinfo, '/admin/announcement/delete') && preg_match('#^/admin/announcement/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_announcement_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_announcement_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnnouncementController::deleteAction',  '_permission' =>   array (    0 => 'admin_announcement',  ),));
                }
                not_admin_announcement_delete:

                // admin_announcement_edit
                if (0 === strpos($pathinfo, '/admin/announcement/edit') && preg_match('#^/admin/announcement/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_announcement_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AnnouncementController::editAction',  '_permission' =>   array (    0 => 'admin_announcement',  ),));
                }

            }

            if (0 === strpos($pathinfo, '/admin/batch_notification')) {
                // admin_batch_notification
                if ($pathinfo === '/admin/batch_notification') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\BatchNotificationController::indexAction',  '_route' => 'admin_batch_notification',  '_permission' =>   array (    0 => 'admin_batch_notification',  ),);
                }

                // admin_batch_notification_create
                if ($pathinfo === '/admin/batch_notification/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\BatchNotificationController::createAction',  '_route' => 'admin_batch_notification_create',  '_permission' =>   array (    0 => 'admin_batch_notification_create',  ),);
                }

                // admin_batch_notification_edit
                if (0 === strpos($pathinfo, '/admin/batch_notification/edit') && preg_match('#^/admin/batch_notification/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_batch_notification_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BatchNotificationController::editAction',  '_permission' =>   array (    0 => 'admin_batch_notification',  ),));
                }

                // admin_batch_notification_delete
                if (0 === strpos($pathinfo, '/admin/batch_notification/delete') && preg_match('#^/admin/batch_notification/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_batch_notification_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_batch_notification_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BatchNotificationController::deleteAction',  '_permission' =>   array (    0 => 'admin_batch_notification',  ),));
                }
                not_admin_batch_notification_delete:

                // admin_batch_notification_send
                if (0 === strpos($pathinfo, '/admin/batch_notification/send') && preg_match('#^/admin/batch_notification/send/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_batch_notification_send;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_batch_notification_send')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BatchNotificationController::sendAction',  '_permission' =>   array (    0 => 'admin_batch_notification',  ),));
                }
                not_admin_batch_notification_send:

            }

            // admin_feedback
            if ($pathinfo === '/admin/feedback') {
                return array (  '_controller' => 'CustomBundle\\Controller\\Admin\\DefaultController::feedbackAction',  '_route' => 'admin_feedback',  '_permission' =>   array (    0 => 'admin',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/reports/status')) {
                // admin_report_status
                if ($pathinfo === '/admin/reports/status') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SystemController::reportAction',  '_route' => 'admin_report_status',  '_permission' =>   array (    0 => 'admin_report_status_list',  ),);
                }

                // admin_report_status_php
                if ($pathinfo === '/admin/reports/status/php') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SystemController::phpAction',  '_route' => 'admin_report_status_php',  '_permission' =>   array (    0 => 'admin_report_status_list',  ),);
                }

                // admin_report_status_directory
                if ($pathinfo === '/admin/reports/status/directory') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SystemController::checkDirAction',  '_route' => 'admin_report_status_directory',  '_permission' =>   array (    0 => 'admin_report_status_list',  ),);
                }

                // admin_report_status_ucenter
                if ($pathinfo === '/admin/reports/status/ucenter') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SystemController::ucenterAction',  '_route' => 'admin_report_status_ucenter',  '_permission' =>   array (    0 => 'admin_report_status_list',  ),);
                }

                // admin_report_status_email_send
                if ($pathinfo === '/admin/reports/status/email/send') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SystemController::emailSendCheckAction',  '_route' => 'admin_report_status_email_send',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/cloud')) {
                // admin_cloud_attachment
                if ($pathinfo === '/admin/cloud_attachment') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\CloudAttachmentController::indexAction',  '_route' => 'admin_cloud_attachment',  '_permission' =>   array (    0 => 'admin_cloud_attachment_manage',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/cloud/edulive')) {
                    // admin_cloud_edulive_overview
                    if ($pathinfo === '/admin/cloud/edulive/overview') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::liveOverviewAction',  '_route' => 'admin_cloud_edulive_overview',  '_permission' =>   array (    0 => 'admin_cloud_edulive_overview',  ),);
                    }

                    // admin_cloud_upload_live_logo
                    if ($pathinfo === '/admin/cloud/edulive/upload') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_cloud_upload_live_logo;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::uploadLiveLogoAction',  '_route' => 'admin_cloud_upload_live_logo',  '_permission' =>   array (  ),);
                    }
                    not_admin_cloud_upload_live_logo:

                }

            }

            // admin_setting_cloud_edulive
            if ($pathinfo === '/admin/setting/cloud/edulive') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::liveSettingAction',  '_route' => 'admin_setting_cloud_edulive',  '_permission' =>   array (    0 => 'admin_setting_cloud_edulive',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/keyword')) {
                // admin_keyword
                if (rtrim($pathinfo, '/') === '/admin/keyword') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_keyword');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SensitiveController::indexAction',  '_route' => 'admin_keyword',  '_permission' =>   array (    0 => 'admin_keyword',  ),);
                }

                // admin_keyword_create
                if ($pathinfo === '/admin/keyword/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SensitiveController::createAction',  '_route' => 'admin_keyword_create',  '_permission' =>   array (    0 => 'admin_keyword_create',  ),);
                }

                // admin_keyword_delete
                if (preg_match('#^/admin/keyword/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_keyword_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_keyword_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\SensitiveController::deleteAction',  '_permission' =>   array (    0 => 'admin_keyword',  ),));
                }
                not_admin_keyword_delete:

                // admin_keyword_change
                if (preg_match('#^/admin/keyword/(?P<id>[^/]++)/change$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_keyword_change')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\SensitiveController::changeAction',  '_permission' =>   array (    0 => 'admin_keyword',  ),));
                }

                // admin_keyword_banlogs
                if ($pathinfo === '/admin/keyword/banlogs') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\SensitiveController::banlogsAction',  '_route' => 'admin_keyword_banlogs',  '_permission' =>   array (    0 => 'admin_keyword_banlogs',  ),);
                }

            }

            // admin_classroom
            if ($pathinfo === '/admin/classroom/index') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::indexAction',  '_route' => 'admin_classroom',  '_permission' =>   array (    0 => 'admin_classroom',  ),);
            }

            // admin_classroom_setting
            if ($pathinfo === '/admin/setting/classroom') {
                return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::setAction',  '_route' => 'admin_classroom_setting',  '_permission' =>   array (    0 => 'admin_classroom_setting',  ),);
            }

            if (0 === strpos($pathinfo, '/admin/classroom')) {
                // admin_classroom_create
                if ($pathinfo === '/admin/classroom/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::addClassroomAction',  '_route' => 'admin_classroom_create',  '_permission' =>   array (    0 => 'admin_classroom_create',  ),);
                }

                // admin_classroom_close
                if (preg_match('#^/admin/classroom/(?P<id>[^/]++)/close$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_classroom_close;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_classroom_close')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::closeClassroomAction',  '_permission' =>   array (    0 => 'admin_classroom_close',  ),));
                }
                not_admin_classroom_close:

                // admin_classroom_open
                if (preg_match('#^/admin/classroom/(?P<id>[^/]++)/open$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_classroom_open;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_classroom_open')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::openClassroomAction',  '_permission' =>   array (    0 => 'admin_classroom_open',  ),));
                }
                not_admin_classroom_open:

                // admin_classroom_delete
                if (preg_match('#^/admin/classroom/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_classroom_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_classroom_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::deleteClassroomAction',  '_permission' =>   array (    0 => 'admin_classroom_delete',  ),));
                }
                not_admin_classroom_delete:

                // admin_classroom_category
                if ($pathinfo === '/admin/classroom/category') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomCategoryController::indexAction',  '_route' => 'admin_classroom_category',  '_permission' =>   array (  ),);
                }

                // admin_classroom_order
                if ($pathinfo === '/admin/classroom/order') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomOrderAdminController::manageAction',  '_route' => 'admin_classroom_order',  '_permission' =>   array (    0 => 'admin_classroom_order',  ),);
                }

                if (0 === strpos($pathinfo, '/admin/classroom/thread')) {
                    // admin_classroom_thread
                    if ($pathinfo === '/admin/classroom/thread') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomThreadAdminController::indexAction',  '_route' => 'admin_classroom_thread',  '_permission' =>   array (  ),);
                    }

                    // admin_classroom_thread_delete
                    if (preg_match('#^/admin/classroom/thread/(?P<threadId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_classroom_thread_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_classroom_thread_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomThreadAdminController::deleteAction',  '_permission' =>   array (  ),));
                    }
                    not_admin_classroom_thread_delete:

                    // admin_classroom_thread_batch_delete
                    if ($pathinfo === '/admin/classroom/thread/batch_delete') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomThreadAdminController::batchDeleteAction',  '_route' => 'admin_classroom_thread_batch_delete',  '_permission' =>   array (  ),);
                    }

                }

                // admin_classroom_set_recommend
                if (preg_match('#^/admin/classroom/(?P<id>[^/]++)/recommend$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_classroom_set_recommend')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::recommendAction',  '_permission' =>   array (    0 => 'admin_classroom_manage',  ),));
                }

                // admin_classroom_cancel_recommend
                if (preg_match('#^/admin/classroom/(?P<id>[^/]++)/recommend/cancel$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_classroom_cancel_recommend')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::cancelRecommendAction',  '_permission' =>   array (    0 => 'admin_classroom_manage',  ),));
                }

                if (0 === strpos($pathinfo, '/admin/classroom/re')) {
                    // admin_classroom_recommend_list
                    if ($pathinfo === '/admin/classroom/recommend/list') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::recommendListAction',  '_route' => 'admin_classroom_recommend_list',  '_permission' =>   array (  ),);
                    }

                    if (0 === strpos($pathinfo, '/admin/classroom/review')) {
                        // admin_classroom_review
                        if ($pathinfo === '/admin/classroom/review') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomReviewController::indexAction',  '_route' => 'admin_classroom_review',  '_permission' =>   array (  ),);
                        }

                        // admin_classroom_review_delete
                        if (preg_match('#^/admin/classroom/review/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_classroom_review_delete;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_classroom_review_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomReviewController::deleteAction',  '_permission' =>   array (  ),));
                        }
                        not_admin_classroom_review_delete:

                        // admin_classroom_review_batch_delete
                        if ($pathinfo === '/admin/classroom/review/batch_delete') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_classroom_review_batch_delete;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomReviewController::batchDeleteAction',  '_route' => 'admin_classroom_review_batch_delete',  '_permission' =>   array (  ),);
                        }
                        not_admin_classroom_review_batch_delete:

                    }

                }

                // admin_classroom_chooser
                if ($pathinfo === '/admin/classroom/chooser') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ClassroomAdminController::chooserAction',  '_route' => 'admin_classroom_chooser',  '_permission' =>   array (  ),);
                }

            }

            if (0 === strpos($pathinfo, '/admin/org')) {
                // admin_org
                if ($pathinfo === '/admin/org') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::indexAction',  '_route' => 'admin_org',  '_permission' =>   array (    0 => 'admin_org',  ),);
                }

                // admin_org_create
                if ($pathinfo === '/admin/org/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::createAction',  '_route' => 'admin_org_create',  '_permission' =>   array (  ),);
                }

                // admin_org_update
                if (preg_match('#^/admin/org/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_org_update')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::updateAction',  '_permission' =>   array (  ),));
                }

                // admin_org_delete
                if (preg_match('#^/admin/org/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_org_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_org_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::deleteAction',  '_permission' =>   array (  ),));
                }
                not_admin_org_delete:

                if (0 === strpos($pathinfo, '/admin/org/check')) {
                    // admin_org_checkcode
                    if ($pathinfo === '/admin/org/checkcode') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::checkCodeAction',  '_route' => 'admin_org_checkcode',  '_permission' =>   array (  ),);
                    }

                    // admin_org_checkname
                    if ($pathinfo === '/admin/org/checkname') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::checkNameAction',  '_route' => 'admin_org_checkname',  '_permission' =>   array (  ),);
                    }

                }

                // admin_org_sort
                if ($pathinfo === '/admin/org/sort') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_org_sort;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::sortAction',  '_route' => 'admin_org_sort',  '_permission' =>   array (  ),);
                }
                not_admin_org_sort:

            }

            // admin_batch_update_org
            if (0 === strpos($pathinfo, '/admin/batch/update') && preg_match('#^/admin/batch/update/(?P<module>[^/]++)/org$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_batch_update_org')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\OrgManageController::batchUpdateAction',  '_permission' =>   array (  ),));
            }

            if (0 === strpos($pathinfo, '/admin/role')) {
                // admin_roles
                if ($pathinfo === '/admin/roles') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\RoleController::indexAction',  '_route' => 'admin_roles',  '_permission' =>   array (    0 => 'admin_role_manage',  ),);
                }

                // admin_role_create
                if ($pathinfo === '/admin/role/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\RoleController::createAction',  '_route' => 'admin_role_create',  '_permission' =>   array (    0 => 'admin_role_create',  ),);
                }

                // admin_role_edit
                if (preg_match('#^/admin/role/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_role_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\RoleController::editAction',  '_permission' =>   array (    0 => 'admin_role_edit',  ),));
                }

                // admin_role_delete
                if (preg_match('#^/admin/role/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_role_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_role_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\RoleController::deleteAction',  '_permission' =>   array (    0 => 'admin_role_delete',  ),));
                }
                not_admin_role_delete:

                // admin_role_show
                if (preg_match('#^/admin/role/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_role_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\RoleController::showAction',  '_permission' =>   array (    0 => 'admin_role_manage',  ),));
                }

                if (0 === strpos($pathinfo, '/admin/role/check')) {
                    // admin_role_check_name
                    if ($pathinfo === '/admin/role/checkName') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\RoleController::checkNameAction',  '_route' => 'admin_role_check_name',  '_permission' =>   array (    0 => 'admin_role_manage',  ),);
                    }

                    // admin_role_check_code
                    if ($pathinfo === '/admin/role/checkCode') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\RoleController::checkCodeAction',  '_route' => 'admin_role_check_code',  '_permission' =>   array (    0 => 'admin_role_manage',  ),);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/cloud')) {
                // admin_cloud_consult_setting
                if ($pathinfo === '/admin/cloud/consult/setting') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::consultSettingAction',  '_route' => 'admin_cloud_consult_setting',  '_permission' =>   array (    0 => 'admin_cloud_consult_setting',  ),);
                }

                // admin_cloud_ad
                if ($pathinfo === '/admin/cloud/ad') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\EduCloudController::getAdAction',  '_route' => 'admin_cloud_ad',  '_permission' =>   array (  ),);
                }

            }

        }

        // custom_homepage
        if ($pathinfo === '/hello') {
            return array (  '_controller' => 'CustomBundle\\Controller\\DefaultController::helloAction',  '_route' => 'custom_homepage',  '_permission' =>   array (  ),);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
