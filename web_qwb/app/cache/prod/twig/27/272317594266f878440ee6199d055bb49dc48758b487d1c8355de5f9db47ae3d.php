<?php

/* layout.html.twig */
class __TwigTemplate_d2a1f6e5c8d82ec8adf61468874a537813f306fdb4484791d39dbc4686f76e63 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'head_scripts' => array($this, 'block_head_scripts'),
            'body' => array($this, 'block_body'),
            'header' => array($this, 'block_header'),
            'full_content' => array($this, 'block_full_content'),
            'top_content' => array($this, 'block_top_content'),
            'content' => array($this, 'block_content'),
            'bottom_content' => array($this, 'block_bottom_content'),
            'footer' => array($this, 'block_footer'),
            'footer_mobile' => array($this, 'block_footer_mobile'),
            'bottom' => array($this, 'block_bottom'),
            'esBar' => array($this, 'block_esBar'),
            'floatConsult' => array($this, 'block_floatConsult'),
            'footer_script' => array($this, 'block_footer_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["web_macro"] = $this->loadTemplate("macro.html.twig", "layout.html.twig", 1);
        // line 2
        echo "<!DOCTYPE html>
<!--[if lt IE 7]>
<html class=\"lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
<!--[if IE 7]>
<html class=\"lt-ie9 lt-ie8\"> <![endif]-->
<!--[if IE 8]>
<html class=\"lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!-->
<html> <!--<![endif]-->
";
        // line 12
        $context["mobile"] = $this->env->getExtension('AppBundle\Twig\WebExtension')->isShowMobilePage();
        // line 13
        echo "<html lang=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getLocale", array(), "method"), "html", null, true);
        echo "\" ";
        if (((isset($context["mobile"]) ? $context["mobile"] : null) && ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("theme.code", "jianmo") == "jianmo"))) {
            echo " class=\"es-mobile\"";
        }
        echo ">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,Chrome=1\">
  <meta name=\"renderer\" content=\"webkit\">
  <meta name=\"viewport\"
    content=\"width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no\">
  <title>";
        // line 21
        $this->displayBlock('title', $context, $blocks);
        // line 24
        echo "</title>
  <meta name=\"keywords\"
    content=\"
";
        // line 27
        ob_start();
        $this->displayBlock('keywords', $context, $blocks);
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "\"/>
  <meta name=\"description\"
    content=\"";
        // line 29
        ob_start();
        $this->displayBlock('description', $context, $blocks);
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "\"/>
  <meta content=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderCsrfToken("site"), "html", null, true);
        echo "\" name=\"csrf-token\"/>
  <meta content=\"";
        // line 31
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "isLogin", array(), "method", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "isLogin", array(), "method"), 0)) : (0)), "html", null, true);
        echo "\" name=\"is-login\"/>
  <meta content=\"";
        // line 32
        echo twig_escape_filter($this->env, _twig_default_filter($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("login_bind.weixinmob_enabled"), 0), "html", null, true);
        echo "\" name=\"is-open\"/>
  ";
        // line 33
        echo $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("login_bind.verify_code", "");
        echo "
  ";
        // line 34
        if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.favicon")) {
            // line 35
            echo "    <link rel=\"icon\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.favicon")), "html", null, true);
            echo "\" type=\"image/x-icon\"/>
    <link rel=\"shortcut icon\" href=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.favicon")), "html", null, true);
            echo "\" type=\"image/x-icon\" media=\"screen\"/>
  ";
        }
        // line 38
        echo "
  <!--[if lt IE 9]>
  <script src=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("static-dist/libs/html5shiv.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("static-dist/es5-shim/es5-shim.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("static-dist/es5-shim/es5-sham.js"), "html", null, true);
        echo "\"></script>
  <![endif]-->

  ";
        // line 45
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 50
        echo "
  ";
        // line 51
        $this->displayBlock('head_scripts', $context, $blocks);
        // line 52
        echo "
  ";
        // line 53
        $context["currentTheme"] = $this->env->getExtension('AppBundle\Twig\ThemeExtension')->getCurrentTheme();
        // line 54
        echo "  ";
        if (((array_key_exists("isEditColor", $context)) ? (_twig_default_filter((isset($context["isEditColor"]) ? $context["isEditColor"] : null), 0)) : (0))) {
            // line 55
            echo "    ";
            $context["maincolor"] = (($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "maincolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "maincolor", array()), (($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "color", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "color", array()), "default")) : ("default")))) : ((($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "color", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "color", array()), "default")) : ("default"))));
            // line 56
            echo "    ";
            $context["navigationcolor"] = (($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "navigationcolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array(), "any", false, true), "navigationcolor", array()), "default")) : ("default"));
            // line 57
            echo "  ";
        } else {
            // line 58
            echo "    ";
            $context["maincolor"] = (($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "maincolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "maincolor", array()), (($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "color", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "color", array()), "default")) : ("default")))) : ((($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "color", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "color", array()), "default")) : ("default"))));
            // line 59
            echo "    ";
            $context["navigationcolor"] = (($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "navigationcolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array(), "any", false, true), "navigationcolor", array()), "default")) : ("default"));
            // line 60
            echo "  ";
        }
        // line 61
        echo "
</head>
<body class=\"";
        // line 63
        echo twig_escape_filter($this->env, ("es-main-" . (isset($context["maincolor"]) ? $context["maincolor"] : null)), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ("es-nav-" . (isset($context["navigationcolor"]) ? $context["navigationcolor"] : null)), "html", null, true);
        echo " ";
        if (((array_key_exists("bodyClass", $context)) ? (_twig_default_filter((isset($context["bodyClass"]) ? $context["bodyClass"] : null), "")) : (""))) {
            echo twig_escape_filter($this->env, (isset($context["bodyClass"]) ? $context["bodyClass"] : null), "html", null, true);
        }
        echo "\">

<!--[if lt IE 9]>
<script src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("static-dist/libs/fix-ie.js"), "html", null, true);
        echo "\"></script>
";
        // line 67
        $this->loadTemplate("default/ie8-alert.html.twig", "layout.html.twig", 67)->display($context);
        // line 68
        echo "<![endif]-->

";
        // line 70
        $this->displayBlock('body', $context, $blocks);
        // line 128
        echo "
";
        // line 129
        $this->displayBlock('footer_script', $context, $blocks);
        // line 132
        echo "
";
        // line 133
        $this->loadTemplate("script_boot.html.twig", "layout.html.twig", 133)->display($context);
        // line 134
        echo "</body>
</html>";
    }

    // line 21
    public function block_title($context, array $blocks = array())
    {
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.name", "EduSoho"), "html", null, true);
        if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.slogan")) {
            echo " - ";
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.slogan"), "html", null, true);
        }
        if ((($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("copyright.owned", "0") != "1") || (_twig_default_filter($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("copyright.thirdCopyright"), 0) == 2))) {
            echo " - Powered By EduSoho";
        }
    }

    // line 27
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.seo_keywords"), "html", null, true);
    }

    // line 29
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.seo_description"), "html", null, true);
    }

    // line 45
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 46
        echo "    ";
        $context["currentTheme"] = $this->env->getExtension('AppBundle\Twig\ThemeExtension')->getCurrentTheme();
        // line 47
        echo "    ";
        $this->loadTemplate("css_loader.html.twig", "layout.html.twig", 47)->display($context);
        // line 48
        echo "    ";
        $this->loadTemplate("default/stylesheet-webpack.html.twig", "layout.html.twig", 48)->display(array_merge($context, array("config" => (isset($context["currentTheme"]) ? $context["currentTheme"] : null), "isEditColor" => ((array_key_exists("isEditColor", $context)) ? (_twig_default_filter((isset($context["isEditColor"]) ? $context["isEditColor"] : null), false)) : (false)))));
        // line 49
        echo "  ";
    }

    // line 51
    public function block_head_scripts($context, array $blocks = array())
    {
    }

    // line 70
    public function block_body($context, array $blocks = array())
    {
        // line 71
        echo "  <div class=\"es-wrap\">

    ";
        // line 73
        $this->displayBlock('header', $context, $blocks);
        // line 77
        echo "
    ";
        // line 78
        $this->displayBlock('full_content', $context, $blocks);
        // line 87
        echo "
    ";
        // line 88
        $this->displayBlock('footer', $context, $blocks);
        // line 91
        echo "
    ";
        // line 92
        $this->displayBlock('footer_mobile', $context, $blocks);
        // line 94
        echo "
    ";
        // line 95
        $this->displayBlock('bottom', $context, $blocks);
        // line 96
        echo "  </div>

  ";
        // line 98
        $this->displayBlock('esBar', $context, $blocks);
        // line 103
        echo "
  ";
        // line 104
        $this->displayBlock('floatConsult', $context, $blocks);
        // line 117
        echo "
  <div id=\"login-modal\" class=\"modal\" data-url=\"";
        // line 118
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("login_ajax");
        echo "\"></div>
  <div id=\"modal\" class=\"modal\"></div>
  <div id=\"attachment-modal\" class=\"modal\"></div>
  ";
        // line 121
        if (_twig_default_filter($this->env->getExtension('AppBundle\Twig\WebExtension')->getRewardPointNotify())) {
            // line 122
            echo "    <div id=\"rewardPointNotify\">
      ";
            // line 123
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getRewardPointNotify(), "html", null, true);
            echo "
    </div>
    ";
            // line 125
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->unsetRewardPointNotify(), "html", null, true);
            echo "
  ";
        }
    }

    // line 73
    public function block_header($context, array $blocks = array())
    {
        // line 74
        echo "      ";
        $this->loadTemplate("site-hint.html.twig", "layout.html.twig", 74)->display($context);
        // line 75
        echo "      ";
        $this->loadTemplate("default/header.html.twig", "layout.html.twig", 75)->display($context);
        // line 76
        echo "    ";
    }

    // line 78
    public function block_full_content($context, array $blocks = array())
    {
        // line 79
        echo "      ";
        $this->displayBlock('top_content', $context, $blocks);
        // line 80
        echo "
      <div id=\"content-container\" class=\"container\">
        ";
        // line 82
        $this->displayBlock('content', $context, $blocks);
        // line 83
        echo "      </div>

      ";
        // line 85
        $this->displayBlock('bottom_content', $context, $blocks);
        // line 86
        echo "    ";
    }

    // line 79
    public function block_top_content($context, array $blocks = array())
    {
    }

    // line 82
    public function block_content($context, array $blocks = array())
    {
    }

    // line 85
    public function block_bottom_content($context, array $blocks = array())
    {
    }

    // line 88
    public function block_footer($context, array $blocks = array())
    {
        // line 89
        echo "      ";
        $this->loadTemplate("default/footer.html.twig", "layout.html.twig", 89)->display($context);
        // line 90
        echo "    ";
    }

    // line 92
    public function block_footer_mobile($context, array $blocks = array())
    {
        // line 93
        echo "    ";
    }

    // line 95
    public function block_bottom($context, array $blocks = array())
    {
    }

    // line 98
    public function block_esBar($context, array $blocks = array())
    {
        // line 99
        echo "    ";
        if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("esBar.enabled", 0)) {
            // line 100
            echo "      ";
            $this->loadTemplate("es-bar/index.html.twig", "layout.html.twig", 100)->display($context);
            // line 101
            echo "    ";
        }
        // line 102
        echo "  ";
    }

    // line 104
    public function block_floatConsult($context, array $blocks = array())
    {
        // line 105
        echo "
    ";
        // line 106
        $context["cloud_consult"] = $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("cloud_consult", "");
        // line 107
        echo "    ";
        if (((((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null) && (($this->getAttribute((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null), "cloud_consult_setting_enabled", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null), "cloud_consult_setting_enabled", array()), 0)) : (0))) && (($this->getAttribute((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null), "cloud_consult_is_buy", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null), "cloud_consult_is_buy", array()), 0)) : (0))) && (($this->getAttribute((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null), "cloud_consult_js", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null), "cloud_consult_js", array()), "")) : ("")))) {
            // line 108
            echo "      ";
            echo $this->getAttribute((isset($context["cloud_consult"]) ? $context["cloud_consult"] : null), "cloud_consult_js", array());
            echo "
    ";
        }
        // line 110
        echo "
    ";
        // line 111
        if (($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("consult.enabled", 0) && (((array_key_exists("consultDisplay", $context)) ? (_twig_default_filter((isset($context["consultDisplay"]) ? $context["consultDisplay"] : null), false)) : (false)) || (((array_key_exists("siteNav", $context)) ? (_twig_default_filter((isset($context["siteNav"]) ? $context["siteNav"] : null))) : ("")) == "/")))) {
            // line 112
            echo "      ";
            if ( !$this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("esBar.enabled", 0)) {
                // line 113
                echo "        ";
                $this->loadTemplate("float-consult.html.twig", "layout.html.twig", 113)->display($context);
                // line 114
                echo "      ";
            }
            // line 115
            echo "    ";
        }
        // line 116
        echo "  ";
    }

    // line 129
    public function block_footer_script($context, array $blocks = array())
    {
        // line 130
        echo "  ";
        $this->loadTemplate("default/script-webpack.html.twig", "layout.html.twig", 130)->display($context);
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  450 => 130,  447 => 129,  443 => 116,  440 => 115,  437 => 114,  434 => 113,  431 => 112,  429 => 111,  426 => 110,  420 => 108,  417 => 107,  415 => 106,  412 => 105,  409 => 104,  405 => 102,  402 => 101,  399 => 100,  396 => 99,  393 => 98,  388 => 95,  384 => 93,  381 => 92,  377 => 90,  374 => 89,  371 => 88,  366 => 85,  361 => 82,  356 => 79,  352 => 86,  350 => 85,  346 => 83,  344 => 82,  340 => 80,  337 => 79,  334 => 78,  330 => 76,  327 => 75,  324 => 74,  321 => 73,  314 => 125,  309 => 123,  306 => 122,  304 => 121,  298 => 118,  295 => 117,  293 => 104,  290 => 103,  288 => 98,  284 => 96,  282 => 95,  279 => 94,  277 => 92,  274 => 91,  272 => 88,  269 => 87,  267 => 78,  264 => 77,  262 => 73,  258 => 71,  255 => 70,  250 => 51,  246 => 49,  243 => 48,  240 => 47,  237 => 46,  234 => 45,  228 => 29,  222 => 27,  211 => 22,  208 => 21,  203 => 134,  201 => 133,  198 => 132,  196 => 129,  193 => 128,  191 => 70,  187 => 68,  185 => 67,  181 => 66,  169 => 63,  165 => 61,  162 => 60,  159 => 59,  156 => 58,  153 => 57,  150 => 56,  147 => 55,  144 => 54,  142 => 53,  139 => 52,  137 => 51,  134 => 50,  132 => 45,  126 => 42,  122 => 41,  118 => 40,  114 => 38,  109 => 36,  104 => 35,  102 => 34,  98 => 33,  94 => 32,  90 => 31,  86 => 30,  80 => 29,  73 => 27,  68 => 24,  66 => 21,  51 => 13,  49 => 12,  38 => 2,  36 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.html.twig", "/app/app/Resources/views/layout.html.twig");
    }
}
