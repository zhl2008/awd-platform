<?php

/* script_boot.html.twig */
class __TwigTemplate_4a53ac484152f0bd845e16366fd798430312dd3a312a8b2b39c5f7767a8a6f08 extends Twig_Template
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
        echo "<script>
  if (typeof app === 'undefined') {
      var app = {};
  }
  app.version = '";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetVersion("/"), "html", null, true);
        echo "';
  app.httpHost = '";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getSchemeAndHttpHost", array(), "method"), "html", null, true);
        echo "';
  app.basePath = '";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->basePath(), "html", null, true);
        echo "';
  app.theme = '";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting(_twig_default_filter("theme.uri", "default")), "html", null, true);
        echo "';

  ";
        // line 10
        $context["crontabNextExecutedTime"] = $this->env->getExtension('AppBundle\Twig\WebExtension')->getNextExecutedTime();
        // line 11
        echo "  ";
        if (( !$this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("magic.disable_web_crontab", 0) && ((isset($context["crontabNextExecutedTime"]) ? $context["crontabNextExecutedTime"] : null) > 0))) {
            // line 12
            echo "    ";
            if ((twig_date_converter($this->env, twig_date_format_filter($this->env, (isset($context["crontabNextExecutedTime"]) ? $context["crontabNextExecutedTime"] : null), "Y-m-d H:i:s")) < twig_date_converter($this->env))) {
                // line 13
                echo "      app.scheduleCrontab = '";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("crontab_web");
                echo "';
    ";
            }
            // line 15
            echo "  ";
        }
        // line 16
        echo "
  var CLOUD_FILE_SERVER = \"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("developer.cloud_file_server", ""), "html", null, true);
        echo "\"; 

  app.config = ";
        // line 19
        echo twig_jsonencode_filter(array("api" => array("weibo" => array("key" => $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("login_bind.weibo_key", "")), "qq" => array("key" => $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("login_bind.qq_key", "")), "douban" => array("key" => $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("login_bind.douban_key", "")), "renren" => array("key" => $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("login_bind.renren_key", ""))), "loading_img_path" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/img/default/loading.gif")));
        // line 29
        echo ";

  app.arguments = {};
  ";
        // line 32
        if (array_key_exists("script_controller", $context)) {
            // line 33
            echo "    app.controller = '";
            echo twig_escape_filter($this->env, (isset($context["script_controller"]) ? $context["script_controller"] : null), "html", null, true);
            echo "';
  ";
        }
        // line 35
        echo "  ";
        if (array_key_exists("script_arguments", $context)) {
            // line 36
            echo "    app.arguments = ";
            echo twig_jsonencode_filter((isset($context["script_arguments"]) ? $context["script_arguments"] : null));
            echo ";
  ";
        }
        // line 38
        echo "  
  app.scripts = ";
        // line 39
        echo twig_jsonencode_filter(_twig_default_filter($this->env->getExtension('AppBundle\Twig\WebExtension')->exportScripts(), null));
        echo ";

  app.uploadUrl = '";
        // line 41
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("file_upload");
        echo "';
  app.imgCropUrl = '";
        // line 42
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("file_img_crop");
        echo "';
  app.lessonCopyEnabled = '";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("course.copy_enabled", "0"), "html", null, true);
        echo "';
  app.cloudSdkCdn = '";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("developer.cloud_sdk_cdn"), "html", null, true);
        echo "';
  app.lang = '";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "locale", array()), "html", null, true);
        echo "';
</script>

<script src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/bazingajstranslation/js/translator.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 49
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("jstranslation_js", array("domain" => "js"));
        echo "\"></script>

";
        // line 51
        $this->loadTemplate("js_loader.html.twig", "script_boot.html.twig", 51)->display($context);
        // line 52
        echo "
<script type=\"text/javascript\">
  window.seajsBoot && window.seajsBoot();
</script>
";
    }

    public function getTemplateName()
    {
        return "script_boot.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 52,  130 => 51,  125 => 49,  121 => 48,  115 => 45,  111 => 44,  107 => 43,  103 => 42,  99 => 41,  94 => 39,  91 => 38,  85 => 36,  82 => 35,  76 => 33,  74 => 32,  69 => 29,  67 => 19,  62 => 17,  59 => 16,  56 => 15,  50 => 13,  47 => 12,  44 => 11,  42 => 10,  37 => 8,  33 => 7,  29 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "script_boot.html.twig", "/app/app/Resources/views/script_boot.html.twig");
    }
}
