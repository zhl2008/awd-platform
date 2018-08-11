<?php

/* default/footer.html.twig */
class __TwigTemplate_3a54e9b81b1d01cf4fbf17619008e391643974e900c0f50cd354d21ad014effa extends Twig_Template
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
        $context["currentTheme"] = $this->env->getExtension('AppBundle\Twig\ThemeExtension')->getCurrentTheme();
        // line 2
        $context["themeConfig"] = ((((array_key_exists("isEditColor", $context)) ? (_twig_default_filter((isset($context["isEditColor"]) ? $context["isEditColor"] : null), false)) : (false))) ? ($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array())) : ($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array())));
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($this->getAttribute($this->getAttribute((isset($context["themeConfig"]) ? $context["themeConfig"] : null), "blocks", array(), "any", false, true), "left", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["themeConfig"]) ? $context["themeConfig"] : null), "blocks", array(), "any", false, true), "left", array()), array())) : (array())));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["config"]) {
            // line 4
            echo "    ";
            $context["code"] = $this->getAttribute($context["config"], "code", array());
            // line 5
            echo "    ";
            if (((isset($context["code"]) ? $context["code"] : null) == "footer-link")) {
                // line 6
                echo "      ";
                $context["category"] = (((($this->getAttribute($context["config"], "categoryId", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["config"], "categoryId", array()), 0)) : (0))) ? ($this->env->getExtension('AppBundle\Twig\DataExtension')->getData("Category", array("categoryId" => $this->getAttribute($context["config"], "categoryId", array())))) : (null));
                // line 7
                echo "      ";
                $this->loadTemplate((("default/" . (isset($context["code"]) ? $context["code"] : null)) . ".html.twig"), "default/footer.html.twig", 7)->display(array_merge($context, array("config" => $context["config"], "category" => (isset($context["category"]) ? $context["category"] : null))));
                // line 8
                echo "    ";
            }
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['config'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "
<footer class=\"es-footer\">
  <div class=\"copyright\">
    <div class=\"container\">
      ";
        // line 14
        $this->loadTemplate("powered-by.html.twig", "default/footer.html.twig", 14)->display($context);
        // line 15
        echo "      ";
        echo $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.analytics");
        echo "
      <a class=\"mlm\" href=\"";
        // line 16
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("course_set_archive");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("课程存档"), "html", null, true);
        echo "</a>
      <div class=\"mts\">
        ";
        // line 18
        if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.copyright")) {
            // line 19
            echo "          ";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("课程内容版权均归"), "html", null, true);
            echo "
          <a href=\"/\">
            ";
            // line 21
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.copyright"), "html", null, true);
            echo "
          </a>
          ";
            // line 23
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("所有"), "html", null, true);
            echo "
        ";
        }
        // line 25
        echo "        ";
        if ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.icp")) {
            // line 26
            echo "          <a class=\"mlm\" href=\"http://www.miibeian.gov.cn/\" target=\"_blank\">
            ";
            // line 27
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.icp"), "html", null, true);
            echo "
          </a>
        ";
        }
        // line 30
        echo "      </div>
    </div>
  </div>
</footer>";
    }

    public function getTemplateName()
    {
        return "default/footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 30,  111 => 27,  108 => 26,  105 => 25,  100 => 23,  95 => 21,  89 => 19,  87 => 18,  80 => 16,  75 => 15,  73 => 14,  67 => 10,  52 => 8,  49 => 7,  46 => 6,  43 => 5,  40 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/footer.html.twig", "/app/app/Resources/views/default/footer.html.twig");
    }
}
