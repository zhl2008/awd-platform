<?php

/* mobile/footer-tool-bar.html.twig */
class __TwigTemplate_f8702eb11f7660e06bc036f3b3d018f8fc7a274b4ebf52a768889d703c070104 extends Twig_Template
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
        echo "<div class=\"footer-tool-bar\">
  <div class=\"";
        // line 2
        if (((isset($context["mobile_tool_bar"]) ? $context["mobile_tool_bar"] : null) == "index")) {
            echo "active";
        }
        echo "\">
    <a href=\"";
        // line 3
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage");
        echo "\">
      <i class=\"es-icon es-icon-home1\"></i><br>
      首页
    </a>
  </div>
  <div class=\"";
        // line 8
        if (((isset($context["mobile_tool_bar"]) ? $context["mobile_tool_bar"] : null) == "course")) {
            echo "active";
        }
        echo "\">
    <a href=\"";
        // line 9
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("course_set_explore");
        echo "\">
      <i class=\"es-icon es-icon-newshot\"></i><br>
      课程
    </a>
  </div>
  <div class=\"";
        // line 14
        if (((isset($context["mobile_tool_bar"]) ? $context["mobile_tool_bar"] : null) == "learning")) {
            echo "active";
        }
        echo "\">
    <a href=\"";
        // line 15
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("my_courses_learning");
        echo "\">
      <i class=\"es-icon es-icon-write\"></i><br>
      学习
    </a>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "mobile/footer-tool-bar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 15,  50 => 14,  42 => 9,  36 => 8,  28 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "mobile/footer-tool-bar.html.twig", "/app/app/Resources/views/mobile/footer-tool-bar.html.twig");
    }
}
