<?php

/* css_loader.html.twig */
class __TwigTemplate_171462cb0359c1fcf006430265f2155c6ba2e8d69187971f84924b639d360dda extends Twig_Template
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
        $context['_seq'] = twig_ensure_traversable($this->env->getExtension('Codeages\PluginBundle\Twig\HtmlExtension')->css());
        foreach ($context['_seq'] as $context["_key"] => $context["path"]) {
            // line 2
            echo "  ";
            if ((is_string($__internal_6df4b05e2fe2c7b6d553317c17d8bbb8fdaeb4caf4306f1391fa562d2cb274a8 = $context["path"]) && is_string($__internal_251aa708d00b0ece49e54ab45b45ef9fe5a4350a50f05ddcd3f6a7ae31b12598 = "http://") && ('' === $__internal_251aa708d00b0ece49e54ab45b45ef9fe5a4350a50f05ddcd3f6a7ae31b12598 || 0 === strpos($__internal_6df4b05e2fe2c7b6d553317c17d8bbb8fdaeb4caf4306f1391fa562d2cb274a8, $__internal_251aa708d00b0ece49e54ab45b45ef9fe5a4350a50f05ddcd3f6a7ae31b12598)))) {
                // line 3
                echo "    <link href=\"";
                echo twig_escape_filter($this->env, $context["path"], "html", null, true);
                echo "\" rel=\"stylesheet\" />
  ";
            } else {
                // line 5
                echo "    <link href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl(("static-dist/" . $context["path"])), "html", null, true);
                echo "\" rel=\"stylesheet\" />
  ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['path'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "css_loader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 5,  26 => 3,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "css_loader.html.twig", "/app/app/Resources/views/css_loader.html.twig");
    }
}
