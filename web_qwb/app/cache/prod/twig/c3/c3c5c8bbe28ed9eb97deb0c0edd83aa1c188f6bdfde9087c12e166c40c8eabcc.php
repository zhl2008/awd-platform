<?php

/* default/header.html.twig */
class __TwigTemplate_7df75ee8ca7f7fdc6c38a365ac00dcf4b0fa984fb744686ff9dc251e8c5819e5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->env->getExtension('Codeages\PluginBundle\Twig\HtmlExtension')->script(array(0 => "app/js/default/header/index.js"));
        // line 2
        echo "
<header class=\"es-header navbar\">
  <div class=\"navbar-header\">
    <div class=\"visible-xs  navbar-mobile\">
      <a href=\"javascript:;\" class=\"navbar-more js-navbar-more\">
        <i class=\"es-icon es-icon-menu\"></i>
      </a>
      <div class=\"html-mask\"></div>
      <div class=\"nav-mobile\">
        <form class=\"navbar-form\" action=\"";
        // line 11
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("search");
        echo "\" method=\"get\">
          <div class=\"form-group\">
            <input class=\"form-control\" placeholder=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("搜索"), "html", null, true);
        echo "\" name=\"q\">
            <button class=\"button es-icon es-icon-search\"></button>
          </div>
        </form>

        <ul class=\"nav navbar-nav\">
          ";
        // line 19
        $context["navigations"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("NavigationsTree", array());
        // line 20
        echo "          ";
        $this->loadTemplate("default/top-navigation.html.twig", "default/header.html.twig", 20)->display(array_merge($context, array("navigations" => (isset($context["navigations"]) ? $context["navigations"] : null), "siteNav" => ((array_key_exists("siteNav", $context)) ? (_twig_default_filter((isset($context["siteNav"]) ? $context["siteNav"] : null), null)) : (null)), "isMobile" => true)));
        // line 21
        echo "        </ul>
      </div>
    </div>
    <div class=\"M_header-back js-back\">
      <a><i class=\"es-icon es-icon-chevronleft\"></i></a>
    </div>
    <a href=\"";
        // line 27
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage");
        echo "\" class=\"navbar-brand\">
      ";
        // line 28
        if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.logo")) {
            // line 29
            echo "        <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getFpath(("../" . $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.logo")), ""), "html", null, true);
            echo "\">
      ";
        } else {
            // line 31
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.name", "EDUSOHO"), "html", null, true);
            echo "
      ";
        }
        // line 33
        echo "    </a>
  </div>
  <nav class=\"collapse navbar-collapse\">
    <ul class=\"nav navbar-nav clearfix hidden-xs \" id=\"nav\">
      ";
        // line 37
        $this->loadTemplate("default/top-navigation.html.twig", "default/header.html.twig", 37)->display(array_merge($context, array("navigations" => (isset($context["navigations"]) ? $context["navigations"] : null), "siteNav" => ((array_key_exists("siteNav", $context)) ? (_twig_default_filter((isset($context["siteNav"]) ? $context["siteNav"] : null), null)) : (null)), "isMobile" => false)));
        // line 38
        echo "    </ul>
    <div class=\"navbar-user ";
        // line 39
        if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("esBar.enabled", 0)) {
            echo " left ";
        }
        echo "\">
      <ul class=\"nav user-nav\">
        ";
        // line 41
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array())) {
            // line 42
            echo "          <li class=\"user-avatar-li nav-hover\">
            <a href=\"javascript:;\" class=\"dropdown-toggle\">
              <img class=\"avatar-xs\" src=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getFpath($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "smallAvatar", array()), "avatar.png"), "html", null, true);
            echo "\">
            </a>
            <ul class=\"dropdown-menu\" role=\"menu\">
              <li role=\"presentation\" class=\"dropdown-header\">";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "nickname", array()), "html", null, true);
            echo "</li>
              <li><a href=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_show", array("id" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "id", array()))), "html", null, true);
            echo "\"><i class=\"es-icon es-icon-person\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("个人主页"), "html", null, true);
            echo "</a></li>
              <li><a href=\"";
            // line 49
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("settings");
            echo "\"><i class=\"es-icon es-icon-setting\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("个人设置"), "html", null, true);
            echo "</a></li>
              <li class=\"hidden-lg user-nav-li-my\">
                <a href=\"";
            // line 51
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("my");
            echo "\">
                  <i class=\"es-icon es-icon-eventnote\"></i>";
            // line 52
            if (twig_in_filter("ROLE_TEACHER", $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "roles", array()))) {
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("我的教学"), "html", null, true);
            } else {
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("我的学习"), "html", null, true);
            }
            // line 53
            echo "                </a>
              </li>
              <li><a href=\"";
            // line 55
            if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.coin_enabled")) {
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("my_coin");
            } else {
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("my_bill");
            }
            echo "\"><i class=\"es-icon es-icon-accountwallet\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("账户中心"), "html", null, true);
            echo "</a></li>

              ";
            // line 57
            if ($this->env->getExtension('AppBundle\Twig\PermissionExtension')->hasPermission("admin")) {
                echo "<li><a href=\"";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin");
                echo "\"><i class=\"es-icon es-icon-dashboard\"></i>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("管理后台"), "html", null, true);
                echo "</a></li>
              ";
            }
            // line 59
            echo "
              <li class=\"hidden-lg\"><a href=\"";
            // line 60
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("notification");
            echo "\"><span class=\"pull-right num\">";
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newNotificationNum", array()) > 0)) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newNotificationNum", array()), "html", null, true);
            }
            echo "</span><i class=\"es-icon es-icon-notificationson\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("通知"), "html", null, true);
            echo "</a></li>
              <li class=\"hidden-lg\"><a href=\"";
            // line 61
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("message");
            echo "\"><span class=\"pull-right num\">";
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newMessageNum", array()) > 0)) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newMessageNum", array()), "html", null, true);
            }
            echo "</span><i class=\"es-icon es-icon-mail\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("私信"), "html", null, true);
            echo "</a></li>
              ";
            // line 62
            if ((isset($context["mobile"]) ? $context["mobile"] : null)) {
                // line 63
                echo "                <li class=\"mobile-switch js-switch-pc visible-xs\"><a href=\"javascript:;\">
                  <i class=\"es-icon es-icon-qiehuan\"></i>";
                // line 64
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("切换电脑版"), "html", null, true);
                echo "</a></li>
              ";
            } elseif (($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("wap.enabled") == 1)) {
                // line 66
                echo "                <li class=\"mobile-switch js-switch-mobile visible-xs\"><a href=\"javascript:;\">
                  <i class=\"es-icon es-icon-qiehuan\"></i>";
                // line 67
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("切换触屏版"), "html", null, true);
                echo "</a></li>
              ";
            }
            // line 69
            echo "              <li class=\"user-nav-li-logout\"><a href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("logout");
            echo "\"><i class=\"es-icon es-icon-power\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("退出登录"), "html", null, true);
            echo "</a></li>
            </ul>
          </li>
          <li class=\"visible-lg\">
            <a href=\"";
            // line 73
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("my");
            echo "\">
              ";
            // line 74
            if (twig_in_filter("ROLE_TEACHER", $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "roles", array()))) {
                // line 75
                echo "                ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("我的教学"), "html", null, true);
                echo "
              ";
            } else {
                // line 77
                echo "                ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("我的学习"), "html", null, true);
                echo "
              ";
            }
            // line 79
            echo "            </a>
          </li>
          <li class=\"visible-lg nav-hover\">

            ";
            // line 83
            if (($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("esBar.enabled", 0) && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newMessageNum", array()) > 0))) {
                // line 84
                echo "              <a class=\"hasmessage\"><i class=\"es-icon es-icon-mail\"></i><span class=\"dot\"></span></a>
            ";
            } elseif (( !$this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("esBar.enabled", 0) && (($this->getAttribute($this->getAttribute(            // line 85
(isset($context["app"]) ? $context["app"] : null), "user", array()), "newNotificationNum", array()) > 0) || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newMessageNum", array()) > 0)))) {
                // line 86
                echo "              <a class=\"hasmessage\"><i class=\"es-icon es-icon-mail\"></i><span class=\"dot\"></span></a>
            ";
            } else {
                // line 88
                echo "              <a><i class=\"es-icon es-icon-mail\"></i></a>
            ";
            }
            // line 90
            echo "
            <ul class=\"dropdown-menu\" role=\"menu\">
              ";
            // line 92
            if ( !$this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("esBar.enabled", 0)) {
                // line 93
                echo "                <li>
                  <a href=\"";
                // line 94
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("notification");
                echo "\">
                    <span class=\"pull-right num\">";
                // line 95
                if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newNotificationNum", array()) > 0)) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newNotificationNum", array()), "html", null, true);
                }
                echo "</span>
                    <i class=\"es-icon es-icon-notificationson\"></i>";
                // line 96
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("通知"), "html", null, true);
                echo "
                  </a>
                </li>
              ";
            }
            // line 100
            echo "              <li>
                <a href=\"";
            // line 101
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("message");
            echo "\">
                  <span class=\"pull-right num\">";
            // line 102
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newMessageNum", array()) > 0)) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "newMessageNum", array()), "html", null, true);
            }
            echo "</span>
                  <i class=\"es-icon es-icon-mail\"></i>";
            // line 103
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("私信"), "html", null, true);
            echo "
                </a>
              </li>
            </ul>
          </li>
        ";
        } else {
            // line 109
            echo "          <li class=\"user-avatar-li nav-hover visible-xs\">
            <a href=\"javascript:;\" class=\"dropdown-toggle\">
              <img class=\"avatar-xs\" src=\"";
            // line 111
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/img/default/avatar.png"), "html", null, true);
            echo "\">
            </a>
            <ul class=\"dropdown-menu\" role=\"menu\">
              <li class=\"user-nav-li-login\"><a href=\"";
            // line 114
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("login", array("goto" => ((array_key_exists("_target_path", $context)) ? (_twig_default_filter((isset($context["_target_path"]) ? $context["_target_path"] : null), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))) : ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))))), "html", null, true);
            echo "\">
                <i class=\"es-icon es-icon-denglu\"></i>
                ";
            // line 116
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("登录"), "html", null, true);
            echo "</a></li>
              <li class=\"user-nav-li-register\"><a href=\"";
            // line 117
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("register", array("goto" => ((array_key_exists("_target_path", $context)) ? (_twig_default_filter((isset($context["_target_path"]) ? $context["_target_path"] : null), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))) : ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))))), "html", null, true);
            echo "\">
                <i class=\"es-icon es-icon-zhuce\"></i>
                ";
            // line 119
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("注册"), "html", null, true);
            echo "</a></li>
              ";
            // line 120
            if ((isset($context["mobile"]) ? $context["mobile"] : null)) {
                // line 121
                echo "                <li class=\"mobile-switch js-switch-pc\"><a href=\"javascript:;\">
                  <i class=\"es-icon es-icon-qiehuan\"></i>
                  ";
                // line 123
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("切换电脑版"), "html", null, true);
                echo "</a></li>
              ";
            } elseif (($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("wap.enabled") == 1)) {
                // line 125
                echo "                <li class=\"mobile-switch js-switch-mobile\"><a href=\"javascript:;\">
                  <i class=\"es-icon es-icon-qiehuan\"></i>              
                  ";
                // line 127
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("切换触屏版"), "html", null, true);
                echo "</a></li>
              ";
            }
            // line 129
            echo "            </ul>
          </li>
          <li class=\"hidden-xs\"><a href=\"";
            // line 131
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("login", array("goto" => ((array_key_exists("_target_path", $context)) ? (_twig_default_filter((isset($context["_target_path"]) ? $context["_target_path"] : null), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))) : ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("登录"), "html", null, true);
            echo "</a></li>
          <li class=\"hidden-xs\"><a href=\"";
            // line 132
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("register", array("goto" => ((array_key_exists("_target_path", $context)) ? (_twig_default_filter((isset($context["_target_path"]) ? $context["_target_path"] : null), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))) : ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "server", array()), "get", array(0 => "REQUEST_URI"), "method"))))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("注册"), "html", null, true);
            echo "</a></li>
        ";
        }
        // line 134
        echo "        ";
        // line 135
        echo "      </ul>
      <form class=\"navbar-form navbar-right hidden-xs hidden-sm\" action=\"";
        // line 136
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("search");
        echo "\" method=\"get\">
        <div class=\"form-group\">
          <input class=\"form-control js-search\" name=\"q\" placeholder=\"";
        // line 138
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("搜索"), "html", null, true);
        echo "\">
          <button class=\"button es-icon es-icon-search\"></button>
        </div>
      </form>
    </div>
  </nav>
</header>";
    }

    public function getTemplateName()
    {
        return "default/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  371 => 138,  366 => 136,  363 => 135,  361 => 134,  354 => 132,  348 => 131,  344 => 129,  339 => 127,  335 => 125,  330 => 123,  326 => 121,  324 => 120,  320 => 119,  315 => 117,  311 => 116,  306 => 114,  300 => 111,  296 => 109,  287 => 103,  281 => 102,  277 => 101,  274 => 100,  267 => 96,  261 => 95,  257 => 94,  254 => 93,  252 => 92,  248 => 90,  244 => 88,  240 => 86,  238 => 85,  235 => 84,  233 => 83,  227 => 79,  221 => 77,  215 => 75,  213 => 74,  209 => 73,  199 => 69,  194 => 67,  191 => 66,  186 => 64,  183 => 63,  181 => 62,  171 => 61,  161 => 60,  158 => 59,  149 => 57,  138 => 55,  134 => 53,  128 => 52,  124 => 51,  117 => 49,  111 => 48,  107 => 47,  101 => 44,  97 => 42,  95 => 41,  88 => 39,  85 => 38,  83 => 37,  77 => 33,  71 => 31,  65 => 29,  63 => 28,  59 => 27,  51 => 21,  48 => 20,  46 => 19,  37 => 13,  32 => 11,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/header.html.twig", "/app/app/Resources/views/default/header.html.twig");
    }
}
