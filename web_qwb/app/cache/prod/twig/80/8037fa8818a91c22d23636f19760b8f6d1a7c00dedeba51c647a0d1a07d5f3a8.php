<?php

/* js_loader.html.twig */
class __TwigTemplate_4f5d94c07d0d3c1103bef491a8c6ebb0fc656822d531ed262605de0385b26752 extends Twig_Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getExtension('Codeages\PluginBundle\Twig\HtmlExtension')->script());
        foreach ($context['_seq'] as $context["_key"] => $context["path"]) {
            // line 2
            echo "  ";
            if (twig_in_filter("//", $context["path"])) {
                // line 3
                echo "    ";
                if (twig_in_filter("js-sdk", $context["path"])) {
                    // line 4
                    echo "      <script src=\"";
                    echo twig_escape_filter($this->env, (($context["path"] . "?") . twig_round(($this->getAttribute(twig_date_converter($this->env), "timestamp", array()) / 100))), "html", null, true);
                    echo "\"></script>
    ";
                } else {
                    // line 6
                    echo "      <script src=\"";
                    echo twig_escape_filter($this->env, (($context["path"] . "?") . $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetVersion("")), "html", null, true);
                    echo "\"></script>
    ";
                }
                // line 8
                echo "  ";
            } else {
                // line 9
                echo "    <script src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl(("static-dist/" . $context["path"])), "html", null, true);
                echo "\"></script>
  ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['path'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "js_loader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 9,  41 => 8,  35 => 6,  29 => 4,  26 => 3,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "js_loader.html.twig", "/app/app/Resources/views/js_loader.html.twig");
    }
}
