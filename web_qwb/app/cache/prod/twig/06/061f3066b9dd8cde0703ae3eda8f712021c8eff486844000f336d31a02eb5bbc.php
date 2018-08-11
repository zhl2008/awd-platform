<?php

/* default/stylesheet-webpack.html.twig */
class __TwigTemplate_6f164268a9f79c2510e2cf1d5f27af10fb7f830151885399482182734788eb7d extends Twig_Template
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
        if (((array_key_exists("isEditColor", $context)) ? (_twig_default_filter((isset($context["isEditColor"]) ? $context["isEditColor"] : null), 0)) : (0))) {
            // line 2
            echo "  ";
            $context["maincolor"] = (($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "config", array(), "any", false, true), "maincolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "config", array(), "any", false, true), "maincolor", array()), "default")) : ("default"));
            // line 3
            echo "  ";
            $context["navigationcolor"] = (($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "config", array(), "any", false, true), "navigationcolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "config", array(), "any", false, true), "navigationcolor", array()), "default")) : ("default"));
        } else {
            // line 5
            echo "  ";
            $context["maincolor"] = (($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "confirmConfig", array(), "any", false, true), "maincolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "confirmConfig", array(), "any", false, true), "maincolor", array()), "default")) : ("default"));
            // line 6
            echo "  ";
            $context["navigationcolor"] = (($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "confirmConfig", array(), "any", false, true), "navigationcolor", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "confirmConfig", array(), "any", false, true), "navigationcolor", array()), "default")) : ("default"));
        }
        // line 8
        echo "
<link href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("static-dist/libs/vendor.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
<link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("static-dist/libs/app-bootstrap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
<link href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("static-dist/app/css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />";
    }

    public function getTemplateName()
    {
        return "default/stylesheet-webpack.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 11,  42 => 10,  38 => 9,  35 => 8,  31 => 6,  28 => 5,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/stylesheet-webpack.html.twig", "/app/app/Resources/views/default/stylesheet-webpack.html.twig");
    }
}
