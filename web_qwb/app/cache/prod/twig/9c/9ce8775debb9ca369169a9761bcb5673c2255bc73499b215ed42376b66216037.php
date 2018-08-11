<?php

/* default/recommend-teacher.html.twig */
class __TwigTemplate_77fdccf25855be164854130ad0381fff133b104c5f030137e1c6c6959ff05fdf extends Twig_Template
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
        $context["teachers"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("RecommendTeachers", array("count" => (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "count", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "count", array()), 4)) : (4))));
        // line 2
        if ((isset($context["teachers"]) ? $context["teachers"] : null)) {
            // line 3
            echo "  <section class=\"recommend-teacher ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array()), "")) : ("")), "html", null, true);
            echo "\">
    <div class=\"container\">
      <div class=\"text-line\">
        <h5><span>";
            // line 6
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))), "html", null, true);
            echo "</span><div class=\"line\"></div></h5>
        <div class=\"subtitle\">";
            // line 7
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))), "html", null, true);
            echo "</div>
      </div>
      <div class=\"row\">
        ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["teachers"]) ? $context["teachers"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["teacher"]) {
                // line 11
                echo "        ";
                $context["profile"] = $this->getAttribute($context["teacher"], "profile", array());
                // line 12
                echo "        ";
                $context["isFollowed"] = $this->getAttribute($context["teacher"], "isFollowed", array());
                // line 13
                echo "          <div class=\"col-md-3 col-xs-6\">
            ";
                // line 14
                $this->loadTemplate("teacher/teacher-item.html.twig", "default/recommend-teacher.html.twig", 14)->display($context);
                // line 15
                echo "          </div>
        ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['teacher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "      </div>
      <div class=\"section-more-btn\">
        <a href=\"";
            // line 19
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("teacher");
            echo "\" class=\"btn btn-default btn-lg\">
          ";
            // line 20
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("更多教师"), "html", null, true);
            echo " <i class=\"mrs-o es-icon es-icon-chevronright\"></i>
        </a>
      </div>
    </div>
  </section>
";
        }
    }

    public function getTemplateName()
    {
        return "default/recommend-teacher.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 20,  87 => 19,  83 => 17,  68 => 15,  66 => 14,  63 => 13,  60 => 12,  57 => 11,  40 => 10,  34 => 7,  30 => 6,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/recommend-teacher.html.twig", "/app/app/Resources/views/default/recommend-teacher.html.twig");
    }
}
