<?php

/* classroom/class-grid.html.twig */
class __TwigTemplate_ab302c8e7526a48f80289087ac1eb17756cc75bb95393c034e703f847389b8cc extends Twig_Template
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
        echo "<div class=\"class-item\">
  <div class=\"class-img-wrap\">
    <a class=\"class-img\" href=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("classroom_show", array("id" => $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "id", array()))), "html", null, true);
        echo "\">
      ";
        // line 4
        echo $this->env->getExtension('AppBundle\Twig\WebExtension')->makeLazyImg($this->env->getExtension('AppBundle\Twig\WebExtension')->getFpath($this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "middlePicture", array()), "classroom.png"), "img-responsive", $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "title", array()), "lazyload_class.png");
        echo "
    </a>
    <div class=\"mask\">
      ";
        // line 7
        $context["classroomMember"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("ClassroomMember", array("classroomId" => $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "id", array()), "userId" => (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "id", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "id", array()), 0)) : (0))));
        // line 8
        echo "
      ";
        // line 9
        if (((array_key_exists("classroomMember", $context)) ? (_twig_default_filter((isset($context["classroomMember"]) ? $context["classroomMember"] : null), false)) : (false))) {
            // line 10
            echo "        <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("classroom_show", array("id" => $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "id", array()))), "html", null, true);
            echo "\" class=\"btn btn-warning\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("继续学习"), "html", null, true);
            echo "</a>
      ";
        } else {
            // line 12
            echo "        <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("classroom_show", array("id" => $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "id", array()))), "html", null, true);
            echo "\" class=\"btn btn-warning\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("立即加入"), "html", null, true);
            echo "</a>
      ";
        }
        // line 14
        echo "    </div>
  </div>
  <h3><a class=\"link-dark\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("classroom_show", array("id" => $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "id", array()))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "title", array()), "html", null, true);
        echo "</a></h3>
  <div class=\"metas\">";
        // line 17
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("共有%courseNum%门课程", array("%courseNum%" => sprintf("<span>%d</span>", $this->getAttribute((isset($context["classroom"]) ? $context["classroom"] : null), "courseNum", array()))));
        echo "</div>
</div>";
    }

    public function getTemplateName()
    {
        return "classroom/class-grid.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 17,  60 => 16,  56 => 14,  48 => 12,  40 => 10,  38 => 9,  35 => 8,  33 => 7,  27 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "classroom/class-grid.html.twig", "/app/app/Resources/views/classroom/class-grid.html.twig");
    }
}
