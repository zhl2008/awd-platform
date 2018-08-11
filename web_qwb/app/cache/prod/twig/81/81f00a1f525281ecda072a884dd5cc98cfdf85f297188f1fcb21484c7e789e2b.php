<?php

/* default/live-course.html.twig */
class __TwigTemplate_bec70ff3c666d0da2b444aa3209c6920ec042db32d3d1d6c4d6734800f33ea6b extends Twig_Template
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
        $context["RecentLiveCourseSets"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("RecentLiveCourseSets", array("count" => 4));
        // line 2
        if ((isset($context["RecentLiveCourseSets"]) ? $context["RecentLiveCourseSets"] : null)) {
            // line 3
            echo "  <section class=\"live-course-section ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array()), "")) : ("")), "html", null, true);
            echo "\">
    <div class=\"container\">
      <div class=\"text-line gray\">
        <h5><span>";
            // line 6
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))), "html", null, true);
            echo "</span><div class=\"line\"></div></h5>
        <div class=\"subtitle\">";
            // line 7
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))), "html", null, true);
            echo "</div>
      </div>
      <div class=\"course-list\"> 
        <div class=\"row\"> 
          ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["RecentLiveCourseSets"]) ? $context["RecentLiveCourseSets"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["courseSet"]) {
                // line 12
                echo "            <div class=\"col-lg-3 col-md-4 col-xs-6\">
              ";
                // line 13
                $this->loadTemplate("course/widgets/course-grid.html.twig", "default/live-course.html.twig", 13)->display(array_merge($context, array("courseSet" => $context["courseSet"])));
                // line 14
                echo "              ";
                $context["task"] = (($this->getAttribute($context["courseSet"], "task", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($context["courseSet"], "task", array(), "array"), null)) : (null));
                // line 15
                echo "              ";
                if ((((isset($context["task"]) ? $context["task"] : null) && (twig_date_format_filter($this->env, "now", "U") >= $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "startTime", array()))) && (twig_date_format_filter($this->env, "now", "U") <= $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "endTime", array())))) {
                    // line 16
                    echo "                <div class=\"course-date visible-lg\">
                  <div class=\"btn-circle btn-live  btn-circle-md\">
                    <i class=\"es-icon es-icon-videocam\"></i>
                  </div>
                  <div class=\"date\">
                    ";
                    // line 21
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("正在直播"), "html", null, true);
                    echo "
                  </div>
                </div>
              ";
                } else {
                    // line 25
                    echo "                <div class=\"course-date visible-lg\">
                  <div class=\"btn-circle btn-circle-md\">
                    <i class=\"es-icon es-icon-videocam\"></i>
                  </div>
                  <div class=\"date\">
                    ";
                    // line 30
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "startTime", array()), "n月j日 H:i"), "html", null, true);
                    echo "
                  </div>
                </div>
              ";
                }
                // line 34
                echo "
            </div>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['courseSet'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "
          ";
            // line 38
            $context["emptyCourseNum"] = (4 - twig_length_filter($this->env, (isset($context["RecentLiveCourseSets"]) ? $context["RecentLiveCourseSets"] : null)));
            // line 39
            echo "          ";
            if (((isset($context["emptyCourseNum"]) ? $context["emptyCourseNum"] : null) > 0)) {
                // line 40
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["emptyCourseNum"]) ? $context["emptyCourseNum"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 41
                    echo "              <div class=\"col-lg-3 col-md-4 col-sm-6 visible-lg\">
                <div class=\"course-item course-default\">
                  <i class=\"es-icon es-icon-videocam\"></i>
                  <br>
                  ";
                    // line 45
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("敬请期待"), "html", null, true);
                    echo "
                </div>
                <div class=\"course-date\">
                  <div class=\"btn-circle btn-circle-md\">
                    <i class=\"es-icon es-icon-accesstime\"></i>
                  </div>
                </div>
              </div>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 54
                echo "          ";
            }
            // line 55
            echo "        </div>
      </div>
      <div class=\"section-more-btn\">
        <a href=\"";
            // line 58
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("live_course_set_explore");
            echo "\" class=\"btn btn-default btn-lg\">
          ";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("更多直播"), "html", null, true);
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
        return "default/live-course.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 59,  155 => 58,  150 => 55,  147 => 54,  132 => 45,  126 => 41,  121 => 40,  118 => 39,  116 => 38,  113 => 37,  97 => 34,  90 => 30,  83 => 25,  76 => 21,  69 => 16,  66 => 15,  63 => 14,  61 => 13,  58 => 12,  41 => 11,  34 => 7,  30 => 6,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/live-course.html.twig", "/app/app/Resources/views/default/live-course.html.twig");
    }
}
