<?php

/* site-hint.html.twig */
class __TwigTemplate_66cb8d53af54750a872862538424b7eb506852b8632a0119ae0128384ba2e0bc extends Twig_Template
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
        if (((($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()) && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "setup", array()) == 0)) && ( !array_key_exists("hideSetupHint", $context) || ((isset($context["hideSetupHint"]) ? $context["hideSetupHint"] : null) != true))) &&  !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "cookies", array()), "get", array(0 => "close_set_email_alert"), "method"))) {
            // line 2
            echo "\t";
            $this->loadTemplate("email-setting.html.twig", "site-hint.html.twig", 2)->display($context);
        } else {
            // line 4
            echo "\t";
            $asm89CacheStrategy3 = $this->env->getExtension('Asm89\Twig\CacheExtension\Extension')->getCacheStrategy();
            $asm89Key3 = $asm89CacheStrategy3->generateKey("layout/announcement", 600            );
            $asm89CacheBody3 = $asm89CacheStrategy3->fetchBlock($asm89Key3);
            if ($asm89CacheBody3 === false) {
                ob_start();
                    // line 5
                    echo "\t\t";
                    $this->loadTemplate("announcement/announcement.html.twig", "site-hint.html.twig", 5)->display($context);
                    // line 6
                    echo "\t";
                
                $asm89CacheBody3 = ob_get_clean();
                $asm89CacheStrategy3->saveBlock($asm89Key3, $asm89CacheBody3);
            }
            echo $asm89CacheBody3;
        }
    }

    public function getTemplateName()
    {
        return "site-hint.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 6,  32 => 5,  25 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "site-hint.html.twig", "/app/app/Resources/views/site-hint.html.twig");
    }
}
