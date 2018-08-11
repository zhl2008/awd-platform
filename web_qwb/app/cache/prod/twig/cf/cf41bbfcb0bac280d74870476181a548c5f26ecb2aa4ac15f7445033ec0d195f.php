<?php

/* BazingaJsTranslationBundle::getTranslations.js.twig */
class __TwigTemplate_140d9d67cfd2518b68b2a144189023dcc9ba0694946f479a32a9e4bced26cc2f extends Twig_Template
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
        echo "(function (Translator) {
";
        // line 2
        if ((isset($context["include_config"]) ? $context["include_config"] : null)) {
            // line 3
            echo "    Translator.fallback      = '";
            echo twig_escape_filter($this->env, (isset($context["fallback"]) ? $context["fallback"] : null), "js", null, true);
            echo "';
    Translator.defaultDomain = '";
            // line 4
            echo twig_escape_filter($this->env, (isset($context["defaultDomain"]) ? $context["defaultDomain"] : null), "js", null, true);
            echo "';
";
        }
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["translations"]) ? $context["translations"] : null));
        foreach ($context['_seq'] as $context["locale"] => $context["domains"]) {
            // line 7
            echo "    // ";
            echo twig_escape_filter($this->env, $context["locale"], "js", null, true);
            echo "
";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["domains"]);
            foreach ($context['_seq'] as $context["domain"] => $context["messages"]) {
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["key"] => $context["message"]) {
                    // line 10
                    echo "    Translator.add(";
                    echo twig_jsonencode_filter($context["key"]);
                    echo ", ";
                    echo twig_jsonencode_filter($context["message"]);
                    echo ", \"";
                    echo twig_escape_filter($this->env, $context["domain"], "js", null, true);
                    echo "\", \"";
                    echo twig_escape_filter($this->env, $context["locale"], "js", null, true);
                    echo "\");
";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['domain'], $context['messages'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['locale'], $context['domains'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "})(Translator);
";
    }

    public function getTemplateName()
    {
        return "BazingaJsTranslationBundle::getTranslations.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 14,  51 => 10,  47 => 9,  43 => 8,  38 => 7,  34 => 6,  29 => 4,  24 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "BazingaJsTranslationBundle::getTranslations.js.twig", "/app/vendor/willdurand/js-translation-bundle/Bazinga/Bundle/JsTranslationBundle/Resources/views/getTranslations.js.twig");
    }
}
