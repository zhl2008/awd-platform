<?php

/* course/widgets/course-set-price.html.twig */
class __TwigTemplate_b1c9b9167e7f0f0ab64f8da27d2424317b6cdea91bb8a85e671f30e9f923c694 extends Twig_Template
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
        $context["shows"] = ((array_key_exists("shows", $context)) ? (_twig_default_filter((isset($context["shows"]) ? $context["shows"] : null), array(0 => "full"))) : (array(0 => "full")));
        // line 2
        $context["priceType"] = ((($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.coin_enabled") && ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.price_type") == "Coin"))) ? ("coin") : ("default"));
        // line 3
        echo "
<span class=\"course-price-widget\">

  ";
        // line 6
        if ($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "discountId", array())) {
            // line 7
            echo "    ";
            if ((twig_in_filter("full", (isset($context["shows"]) ? $context["shows"] : null)) || twig_in_filter("price", (isset($context["shows"]) ? $context["shows"] : null)))) {
                // line 8
                echo "      ";
                if (((isset($context["priceType"]) ? $context["priceType"] : null) == "coin")) {
                    // line 9
                    echo "        <span class=\"price\">";
                    echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "minCoursePrice", array()) * $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.cash_rate")), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.coin_name", $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("虚拟币")), "html", null, true);
                    echo "</span>
      ";
                } else {
                    // line 11
                    echo "        <span class=\"price\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("%price%元", array("%price%" => $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "minCoursePrice", array()))), "html", null, true);
                    echo "</span>
      ";
                }
                // line 13
                echo "    ";
            }
            // line 14
            echo "
    ";
            // line 15
            if ((twig_in_filter("full", (isset($context["shows"]) ? $context["shows"] : null)) || twig_in_filter("discount", (isset($context["shows"]) ? $context["shows"] : null)))) {
                // line 16
                echo "      <span class=\"discount\">
        ";
                // line 17
                if (($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "discount", array()) == 0)) {
                    // line 18
                    echo "          ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("限免"), "html", null, true);
                    echo "
        ";
                } else {
                    // line 20
                    echo "          ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("%discount%折", array("%discount%" => twig_round($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "discount", array()), 2, "common"))), "html", null, true);
                    echo "
        ";
                }
                // line 22
                echo "      </span>
    ";
            }
            // line 24
            echo "    
  ";
        } else {
            // line 26
            echo "    ";
            if ((twig_in_filter("full", (isset($context["shows"]) ? $context["shows"] : null)) || twig_in_filter("price", (isset($context["shows"]) ? $context["shows"] : null)))) {
                // line 27
                echo "      ";
                if (($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.coin_enabled") && ($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.price_type") == "Coin"))) {
                    // line 28
                    echo "        ";
                    if (($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "minCoursePrice", array()) > 0)) {
                        echo " 
          <span class=\"price\">";
                        // line 29
                        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "minCoursePrice", array()) * $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.cash_rate")), "html", null, true);
                        echo "
          ";
                        // line 30
                        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("coin.coin_name", $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("虚拟币")), "html", null, true);
                        echo "</span>
        ";
                    } else {
                        // line 31
                        echo " 
          <span class=\"free\">";
                        // line 32
                        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("免费"), "html", null, true);
                        echo "</span> 
        ";
                    }
                    // line 34
                    echo "      ";
                } else {
                    // line 35
                    echo "        ";
                    if (($this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "minCoursePrice", array()) > 0)) {
                        // line 36
                        echo "          <span class=\"price\">";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("%price%元", array("%price%" => $this->getAttribute((isset($context["courseSet"]) ? $context["courseSet"] : null), "minCoursePrice", array()))), "html", null, true);
                        echo "</span>
        ";
                    } else {
                        // line 37
                        echo " 
          <span class=\"free\">";
                        // line 38
                        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("免费"), "html", null, true);
                        echo "</span> 
        ";
                    }
                    // line 39
                    echo " 
      ";
                }
                // line 41
                echo "    ";
            }
            // line 42
            echo "  ";
        }
        // line 43
        echo "</span>";
    }

    public function getTemplateName()
    {
        return "course/widgets/course-set-price.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 43,  138 => 42,  135 => 41,  131 => 39,  126 => 38,  123 => 37,  117 => 36,  114 => 35,  111 => 34,  106 => 32,  103 => 31,  98 => 30,  94 => 29,  89 => 28,  86 => 27,  83 => 26,  79 => 24,  75 => 22,  69 => 20,  63 => 18,  61 => 17,  58 => 16,  56 => 15,  53 => 14,  50 => 13,  44 => 11,  36 => 9,  33 => 8,  30 => 7,  28 => 6,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "course/widgets/course-set-price.html.twig", "/app/app/Resources/views/course/widgets/course-set-price.html.twig");
    }
}
