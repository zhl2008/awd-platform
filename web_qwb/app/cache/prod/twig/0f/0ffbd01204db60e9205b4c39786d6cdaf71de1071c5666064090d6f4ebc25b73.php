<?php

/* course/widgets/course-grid.html.twig */
class __TwigTemplate_08576a6c6786d418db035c5375c96b69c670703ab7d4a434289ccb0cfec58d00 extends Twig_Template
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
        echo "<div class=\"course-item\">
  <div class=\"course-img\">
    ";
        // line 3
        if ($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "course", array(), "any", true, true)) {
            // line 4
            echo "      ";
            $context["course"] = $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "course", array());
            // line 5
            echo "    ";
        } else {
            // line 6
            echo "      ";
            $context["course"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("PublishedCourseByCourseSet", array("courseSetId" => $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "id", array())));
            // line 7
            echo "    ";
        }
        // line 8
        echo "
    <a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("course_show", array("id" => $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "defaultCourseId", array()))), "html", null, true);
        echo "\" target=\"_blank\">
      ";
        // line 10
        if (($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "discountId", array()) > 0)) {
            // line 11
            echo "        ";
            if (($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "discount", array()) == 0)) {
                // line 12
                echo "          <!-- 限免 -->
          <span class=\"tag-discount free\"></span>
        ";
            } else {
                // line 15
                echo "          <!-- 折扣 -->
          <span class=\"tag-discount\"></span>
        ";
            }
            // line 18
            echo "      ";
        }
        // line 19
        echo "      ";
        if (($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "serializeMode", array()) == "serialized")) {
            // line 20
            echo "        <span class=\"tags\"><span class=\"tag-serialing\"></span></span>
      ";
        } elseif (($this->getAttribute(        // line 21
(isset($context["courseSet"]) ? $context["courseSet"] : null), "serializeMode", array()) == "finished")) {
            // line 22
            echo "        <span class=\"tags\"><span class=\"tag-finished\"></span></span>
      ";
        }
        // line 24
        echo "      ";
        if (((($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "type", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "type", array()))) : ("")) == "live")) {
            // line 25
            echo "        <span class=\"tags\">
          <span class=\"tag-live\"></span>
        </span>
      ";
        }
        // line 29
        echo "      ";
        echo $this->env->getExtension('AppBundle\Twig\WebExtension')->makeLazyImg($this->env->getExtension('AppBundle\Twig\WebExtension')->getFpath($this->env->getExtension('AppBundle\Twig\AppExtension')->courseSetCover((isset($context["courseSet"]) ? $context["courseSet"] : null), "large"), "courseSet.png"), "img-responsive", $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "title", array()));
        echo "
    </a>
  </div>
  <div class=\"course-info\">
    <div class=\"title\">
      <a class=\"link-dark\" href=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("course_show", array("id" => $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "defaultCourseId", array()))), "html", null, true);
        echo "\" target=\"_blank\">
        ";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "title", array()), "html", null, true);
        echo "
      </a>
    </div>
    <div class=\"metas clearfix\">
      ";
        // line 39
        if (($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("course.show_student_num_enabled", "1") == 1)) {
            // line 40
            echo "        <span class=\"num\"><i class=\"es-icon es-icon-people\"></i>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "studentNum", array()), "html", null, true);
            echo "</span>
      ";
        }
        // line 42
        echo "      <span class=\"comment\"><i class=\"es-icon es-icon-textsms\"></i>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "ratingNum", array()), "html", null, true);
        echo "</span>
      ";
        // line 43
        if ((($this->getAttribute($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "course", array(), "any", false, true), "tryLookVideo", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "course", array(), "any", false, true), "tryLookVideo", array()), false)) : (false))) {
            // line 44
            echo "        <span class=\"comment\"><i class=\"es-icon es-icon-playcircleoutline\"></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("试看"), "html", null, true);
            echo "</span>
      ";
        }
        // line 46
        echo "      ";
        // line 47
        echo "        ";
        // line 48
        echo "      ";
        // line 49
        echo "        ";
        $this->loadTemplate("course/widgets/course-set-price.html.twig", "course/widgets/course-grid.html.twig", 49)->display(array_merge($context, array("shows" => "price")));
        // line 50
        echo "      ";
        // line 51
        echo "    </div>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "course/widgets/course-grid.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 51,  133 => 50,  130 => 49,  128 => 48,  126 => 47,  124 => 46,  118 => 44,  116 => 43,  111 => 42,  105 => 40,  103 => 39,  96 => 35,  92 => 34,  83 => 29,  77 => 25,  74 => 24,  70 => 22,  68 => 21,  65 => 20,  62 => 19,  59 => 18,  54 => 15,  49 => 12,  46 => 11,  44 => 10,  40 => 9,  37 => 8,  34 => 7,  31 => 6,  28 => 5,  25 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "course/widgets/course-grid.html.twig", "/app/app/Resources/views/course/widgets/course-grid.html.twig");
    }
}
