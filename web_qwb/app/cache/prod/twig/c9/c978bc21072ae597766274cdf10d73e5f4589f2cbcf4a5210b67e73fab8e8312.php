<?php

/* default/course-grid-with-condition-index.html.twig */
class __TwigTemplate_6f91770e65a41409ff6b8bf5fede43b0089a98499e9c2ba06e1e5e42a48c744b extends Twig_Template
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
        echo "<section class=\"course-list-section ";
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array()), "")) : ("")), "html", null, true);
        echo "\" id=\"course-list-section\">

  ";
        // line 3
        $context["count"] = (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "count", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "count", array()), 12)) : (12));
        // line 4
        echo "  ";
        $context["categoryId"] = (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryId", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryId", array()), 0)) : (0));
        // line 5
        echo "  ";
        $context["orderBy"] = (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "orderBy", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "orderBy", array()), "latest")) : ("latest"));
        // line 6
        echo "  ";
        if (((isset($context["orderBy"]) ? $context["orderBy"] : null) == "latest")) {
            // line 7
            echo "    ";
            $context["courseSets"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("LatestCourseSets", array("count" => (isset($context["count"]) ? $context["count"] : null), "categoryId" => (isset($context["categoryId"]) ? $context["categoryId"] : null)));
            // line 8
            echo "  ";
        } elseif (((isset($context["orderBy"]) ? $context["orderBy"] : null) == "recommendedSeq")) {
            // line 9
            echo "    ";
            $context["courseSets"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("RecommendCourseSets", array("count" => (isset($context["count"]) ? $context["count"] : null), "categoryId" => (isset($context["categoryId"]) ? $context["categoryId"] : null)));
            // line 10
            echo "  ";
        } elseif (((isset($context["orderBy"]) ? $context["orderBy"] : null) == "studentNum")) {
            // line 11
            echo "    ";
            $context["courseSets"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("PopularCourseSets", array("count" => (isset($context["count"]) ? $context["count"] : null), "categoryId" => (isset($context["categoryId"]) ? $context["categoryId"] : null), "type" => "studentNum"));
            // line 12
            echo "  ";
        }
        // line 13
        echo "  ";
        $context["categoriesFirst"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("Categories", array("group" => "course", "parentId" => 0));
        // line 14
        echo "  ";
        $context["moreCategories"] = twig_slice($this->env, (isset($context["categoriesFirst"]) ? $context["categoriesFirst"] : null), (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryCount", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryCount", array()), 4)) : (4)), null);
        // line 15
        echo "  <div class=\"container\">
    <div class=\"text-line\">
      <h5><span>";
        // line 17
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))), "html", null, true);
        echo "</span>
        <div class=\"line\"></div>
      </h5>
      <div class=\"subtitle\">";
        // line 20
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))), "html", null, true);
        echo "</div>
    </div>
    <div class=\"course-filter\" id=\"course-filter\">
      <ul class=\"nav nav-pills hidden-xs\" role=\"tablist\">
        <li role=\"presentation\" class=\"";
        // line 24
        if ((((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)) == 0)) {
            echo "active ";
        }
        echo " js-course-filter\"
            data-url=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("orderBy" => ((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "latest")) : ("latest")))), "html", null, true);
        echo "\" data-type=\"course\"><a
              href=\"javascript:;\">";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("全部课程"), "html", null, true);
        echo "</a></li>
        ";
        // line 27
        if ((isset($context["categoriesFirst"]) ? $context["categoriesFirst"] : null)) {
            // line 28
            echo "          ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["categoriesFirst"]) ? $context["categoriesFirst"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 29
                echo "            ";
                if (($this->getAttribute($context["loop"], "index0", array()) < (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryCount", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryCount", array()), 4)) : (4)))) {
                    // line 30
                    echo "              <li role=\"presentation\"
                  class=\"";
                    // line 31
                    if ((((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)) == $this->getAttribute($context["category"], "id", array()))) {
                        echo "active ";
                    }
                    echo " js-course-filter\"
                  data-url=\"";
                    // line 32
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("categoryId" => $this->getAttribute($context["category"], "id", array()), "orderBy" => ((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "latest")) : ("latest")))), "html", null, true);
                    echo "\"
                  data-type=\"course\"><a href=\"javascript:;\">";
                    // line 33
                    echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
                    echo "</a></li>
            ";
                }
                // line 35
                echo "          ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "          ";
            if ((isset($context["moreCategories"]) ? $context["moreCategories"] : null)) {
                // line 37
                echo "            <li class=\"dropdown nav-hover\">
              <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:;\">
                <i class=\"es-icon es-icon-morehoriz\"></i>
              </a>
              <ul class=\"dropdown-menu\">
                ";
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["moreCategories"]) ? $context["moreCategories"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["moreCategory"]) {
                    // line 43
                    echo "                  <li role=\"presentation\"
                      class=\"";
                    // line 44
                    if ((((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)) == $this->getAttribute($context["moreCategory"], "id", array()))) {
                        echo "active ";
                    }
                    echo " js-course-filter\"
                      data-url=\"";
                    // line 45
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("categoryId" => $this->getAttribute($context["moreCategory"], "id", array()), "orderBy" => ((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "latest")) : ("latest")))), "html", null, true);
                    echo "\"
                      data-type=\"course\"><a href=\"javascript:;\">";
                    // line 46
                    echo twig_escape_filter($this->env, $this->getAttribute($context["moreCategory"], "name", array()), "html", null, true);
                    echo "</a></li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['moreCategory'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 48
                echo "              </ul>
            </li>
          ";
            }
            // line 51
            echo "        ";
        }
        // line 52
        echo "      </ul>
      <div class=\"btn-group visible-xs\">
        <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                aria-expanded=\"false\">";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("全部课程"), "html", null, true);
        echo " <span class=\"caret\"></span></button>
        <ul class=\"dropdown-menu\" role=\"menu\">
          <li role=\"presentation\" class=\"js-course-filter ";
        // line 57
        if ((((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)) == 0)) {
            echo "active ";
        }
        echo "\"
              data-url=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("orderBy" => ((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "latest")) : ("latest")))), "html", null, true);
        echo "\" data-type=\"course\"><a
                href=\"javascript:;\">";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("全部课程"), "html", null, true);
        echo "</a></li>
          ";
        // line 60
        if ((isset($context["categoriesFirst"]) ? $context["categoriesFirst"] : null)) {
            // line 61
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["categoriesFirst"]) ? $context["categoriesFirst"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                if (($this->getAttribute($context["category"], "parentId", array()) == 0)) {
                    // line 62
                    echo "              ";
                    if (($this->getAttribute($context["loop"], "index0", array()) < (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryCount", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "categoryCount", array()), 4)) : (4)))) {
                        // line 63
                        echo "                <li role=\"presentation\"
                    class=\"js-course-filter ";
                        // line 64
                        if ((((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)) == $this->getAttribute($context["category"], "id", array()))) {
                            echo "active ";
                        }
                        echo "\"
                    data-url=\"";
                        // line 65
                        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("categoryId" => $this->getAttribute($context["category"], "id", array()), "orderBy" => ((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "latest")) : ("latest")))), "html", null, true);
                        echo "\"
                    data-type=\"course\"><a href=\"javascript:;\">";
                        // line 66
                        echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
                        echo "</a></li>
              ";
                    }
                    // line 68
                    echo "            ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 69
            echo "            ";
            if ((isset($context["moreCategories"]) ? $context["moreCategories"] : null)) {
                // line 70
                echo "              <li role=\"presentation\" class=\"js-course-filteractive\" data-type=\"course\"><a
                    href=\"";
                // line 71
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("course_set_explore");
                echo "\">更多</a></li>
            ";
            }
            // line 73
            echo "          ";
        }
        // line 74
        echo "        </ul>
      </div>
      <div class=\"course-sort btn-group\">
        <a href=\"javascript:;\"
           class=\"btn btn-default ";
        // line 78
        if ((((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "recommendedSeq")) : ("recommendedSeq")) == "latest")) {
            echo " active ";
        }
        echo "js-course-filter\"
           data-url=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("categoryId" => ((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)), "orderBy" => "latest")), "html", null, true);
        echo "\"
           data-type='course'>
          ";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("最新"), "html", null, true);
        echo "
        </a>
        <a href=\"javascript:;\"
           class=\"btn btn-default ";
        // line 84
        if ((((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "recommendedSeq")) : ("recommendedSeq")) == "studentNum")) {
            echo " active ";
        }
        echo "js-course-filter\"
           data-url=\"";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("categoryId" => ((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)), "orderBy" => "studentNum")), "html", null, true);
        echo "\"
           data-type='course'>
          ";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("最热"), "html", null, true);
        echo "
        </a>
        <a href=\"javascript:;\"
           class=\"btn btn-default ";
        // line 90
        if ((((array_key_exists("orderBy", $context)) ? (_twig_default_filter((isset($context["orderBy"]) ? $context["orderBy"] : null), "recommendedSeq")) : ("recommendedSeq")) == "recommendedSeq")) {
            echo " active ";
        }
        echo "js-course-filter\"
           data-url=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage_category", array("categoryId" => ((array_key_exists("categoryId", $context)) ? (_twig_default_filter((isset($context["categoryId"]) ? $context["categoryId"] : null), 0)) : (0)), "orderBy" => "recommendedSeq")), "html", null, true);
        echo "\"
           data-type='course'>
          ";
        // line 93
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("推荐"), "html", null, true);
        echo "
        </a>
      </div>
    </div>
    <div class=\"course-list\">
      <div class=\"row\">
        ";
        // line 99
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["courseSets"]) ? $context["courseSets"] : null));
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
            // line 100
            echo "          <div class=\"col-lg-3 col-md-4 col-xs-6\">
            ";
            // line 101
            $this->loadTemplate("course/widgets/course-grid.html.twig", "default/course-grid-with-condition-index.html.twig", 101)->display(array_merge($context, array("courseSet" => $context["courseSet"])));
            // line 102
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['courseSet'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 104
        echo "      </div>
    </div>
    <div class=\"section-more-btn\">
      <a href=\"";
        // line 107
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("course_set_explore");
        echo "\" class=\"btn btn-default btn-lg\">
        ";
        // line 108
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("更多课程"), "html", null, true);
        echo " <i class=\"mrs-o es-icon es-icon-chevronright\"></i>
      </a>
    </div>
  </div>
</section>
";
    }

    public function getTemplateName()
    {
        return "default/course-grid-with-condition-index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  378 => 108,  374 => 107,  369 => 104,  354 => 102,  352 => 101,  349 => 100,  332 => 99,  323 => 93,  318 => 91,  312 => 90,  306 => 87,  301 => 85,  295 => 84,  289 => 81,  284 => 79,  278 => 78,  272 => 74,  269 => 73,  264 => 71,  261 => 70,  258 => 69,  248 => 68,  243 => 66,  239 => 65,  233 => 64,  230 => 63,  227 => 62,  215 => 61,  213 => 60,  209 => 59,  205 => 58,  199 => 57,  194 => 55,  189 => 52,  186 => 51,  181 => 48,  173 => 46,  169 => 45,  163 => 44,  160 => 43,  156 => 42,  149 => 37,  146 => 36,  132 => 35,  127 => 33,  123 => 32,  117 => 31,  114 => 30,  111 => 29,  93 => 28,  91 => 27,  87 => 26,  83 => 25,  77 => 24,  70 => 20,  64 => 17,  60 => 15,  57 => 14,  54 => 13,  51 => 12,  48 => 11,  45 => 10,  42 => 9,  39 => 8,  36 => 7,  33 => 6,  30 => 5,  27 => 4,  25 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/course-grid-with-condition-index.html.twig", "/app/app/Resources/views/default/course-grid-with-condition-index.html.twig");
    }
}
