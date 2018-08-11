<?php

/* default/groups.html.twig */
class __TwigTemplate_fd6705c997068230d6601a4ebed003fd63ccada43a34064ac7dcca84691ff9b6 extends Twig_Template
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
        $context["web_macro"] = $this->loadTemplate("macro.html.twig", "default/groups.html.twig", 1);
        // line 2
        echo "<!-- 小组动态 -->
";
        // line 3
        $context["groups"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("HotGroup", array("count" => 6));
        // line 4
        $context["reviews"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("LatestCourseReviews", array("count" => 4));
        // line 5
        echo "<section class=\"dynamic-section ";
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "background", array()), "")) : ("")), "html", null, true);
        echo "\">
  <div class=\"container\">
    <div class=\"text-line gray\">
      <h5><span>";
        // line 8
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "title", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultTitle", array()))), "html", null, true);
        echo "</span><div class=\"line\"></div></h5>
      <div class=\"subtitle\">";
        // line 9
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "subTitle", array()), $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))) : ($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "defaultSubTitle", array()))), "html", null, true);
        echo "</div>
    </div>
    <div class=\"dynamic-section-main row\">
      ";
        // line 12
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "select1", array()) == "checked")) {
            // line 13
            echo "      <div class=\"col-md-6\">
        <div class=\"panel panel-default index-group\">
          <div class=\"panel-heading\">
            <a href=\"";
            // line 16
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("group");
            echo "\" class=\"more\"><i class=\"es-icon es-icon-morehoriz\"></i></a>
            <h3 class=\"panel-title\"><i class=\"es-icon es-icon-whatshot pull-left\"></i>";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("热门小组"), "html", null, true);
            echo "</h3>
          </div>
          <div class=\"panel-body row\">
            <div class=\"media-group-list\">
              ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["groups"]) ? $context["groups"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 22
                echo "                <div class=\"media media-group col-md-6 col-sm-4\">
                  <div class=\"media-left\">
                    <a href=\"";
                // line 24
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("group_show", array("id" => $this->getAttribute($context["group"], "id", array()))), "html", null, true);
                echo "\">
                      ";
                // line 25
                echo $this->env->getExtension('AppBundle\Twig\WebExtension')->makeLazyImg($this->env->getExtension('AppBundle\Twig\WebExtension')->getFpath($this->getAttribute($context["group"], "logo", array()), "group.png"), "avatar-square-md", $this->getAttribute($context["group"], "title", array()), "group.png");
                echo "
                    </a>
                  </div>
                  <div class=\"media-body\">
                    <div class=\"title\">
                      <a class=\"link-dark\" href=\"";
                // line 30
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("group_show", array("id" => $this->getAttribute($context["group"], "id", array()))), "html", null, true);
                echo "\">
                        ";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($context["group"], "title", array()), "html", null, true);
                echo "
                      </a>
                    </div>
                    <div class=\"metas\">
                      <span><i class=\"es-icon es-icon-people\"></i>";
                // line 35
                echo twig_escape_filter($this->env, $this->getAttribute($context["group"], "memberNum", array()), "html", null, true);
                echo "</span>
                      <span><i class=\"es-icon es-icon-textsms\"></i>";
                // line 36
                echo twig_escape_filter($this->env, $this->getAttribute($context["group"], "threadNum", array()), "html", null, true);
                echo "</span>
                    </div>
                  </div>
                </div>
              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "            </div>
          </div>
        </div>
      </div>
      ";
        }
        // line 46
        echo "      ";
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "select2", array()) == "checked")) {
            // line 47
            echo "      <div class=\"col-md-6\">
        <div class=\"panel panel-default index-article\">
          <div class=\"panel-heading\">
            <h3 class=\"panel-title\">
              ";
            // line 51
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("最新%article_name%", array("%article_name%" => _twig_default_filter($this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("article.name"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("资讯")))), "html", null, true);
            echo "
              <a class=\"more\" href=\"";
            // line 52
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("article_show");
            echo "\"><i class=\"es-icon es-icon-morehoriz\"></i></a>
            </h3>
          </div>
          <div class=\"panel-body clearfix\">
            ";
            // line 56
            $context["featuredArticles"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("LatestArticles", array("type" => "featured", "count" => 2));
            // line 57
            echo "            ";
            if ((isset($context["featuredArticles"]) ? $context["featuredArticles"] : null)) {
                // line 58
                echo "            <ul class=\"index-recommend-aricle clearfix\">
              ";
                // line 59
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["featuredArticles"]) ? $context["featuredArticles"] : null));
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
                foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
                    // line 60
                    echo "                <li class=\"";
                    if (($this->getAttribute($context["loop"], "index", array()) == 2)) {
                        echo "last";
                    }
                    echo "\">
                  <a href=\"";
                    // line 61
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("article_detail", array("id" => $this->getAttribute($context["article"], "id", array()))), "html", null, true);
                    echo "\">
                    ";
                    // line 62
                    $context["defaultImg"] = (("../../v2/img/article/article_banner_" . $this->getAttribute($context["loop"], "index", array())) . ".jpg");
                    // line 63
                    echo "                    ";
                    echo $this->env->getExtension('AppBundle\Twig\WebExtension')->makeLazyImg($this->env->getExtension('AppBundle\Twig\WebExtension')->getFpath($this->getAttribute($context["article"], "thumb", array()), (isset($context["defaultImg"]) ? $context["defaultImg"] : null)), "img-responsive", $this->getAttribute($context["article"], "title", array()), (isset($context["defaultImg"]) ? $context["defaultImg"] : null));
                    echo "
                    <div class=\"image-overlay\"></div>
                    <div class=\"title\">";
                    // line 65
                    echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "title", array()), "html", null, true);
                    echo "</div>
                  </a>
                </li>
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 69
                echo "            </ul>
            ";
            }
            // line 71
            echo "            <ul class=\"index-new-article ";
            if ( !((array_key_exists("featuredArticles", $context)) ? (_twig_default_filter((isset($context["featuredArticles"]) ? $context["featuredArticles"] : null), false)) : (false))) {
                echo "full";
            }
            echo "\">
              ";
            // line 72
            $context["articles"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("LatestArticles", array("count" => 5));
            // line 73
            echo "              ";
            if ((isset($context["articles"]) ? $context["articles"] : null)) {
                // line 74
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["articles"]) ? $context["articles"] : null));
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
                foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
                    // line 75
                    echo "                  <li class=\"";
                    if (($this->getAttribute($context["loop"], "index", array()) == 5)) {
                        echo "last";
                    }
                    echo " clearfix\"><i class=\"es-icon es-icon-dot color-primary mrs\"></i><a class=\"link-dark\" href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("article_detail", array("id" => $this->getAttribute($context["article"], "id", array()))), "html", null, true);
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "title", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "title", array()), "html", null, true);
                    echo "</a> <span class=\"date\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->smarttimeFilter($this->getAttribute($context["article"], "createdTime", array())), "html", null, true);
                    echo "</span></li>
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 77
                echo "              ";
            }
            // line 78
            echo "            </ul>
          </div>
        </div>
      </div>
      ";
        }
        // line 83
        echo "      ";
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "select3", array()) == "checked")) {
            // line 84
            echo "      <div class=\"col-md-6\">
        <div class=\"panel panel-default index-evaluate\">
          <div class=\"panel-heading\">
            <h3 class=\"panel-title\">
              ";
            // line 88
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("学员评价"), "html", null, true);
            echo "
            </h3>
          </div>
          <div class=\"panel-body\">
            ";
            // line 92
            if ((isset($context["reviews"]) ? $context["reviews"] : null)) {
                // line 93
                echo "              ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["reviews"]) ? $context["reviews"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
                    // line 94
                    echo "              ";
                    $context["author"] = (($this->getAttribute($context["review"], "User", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["review"], "User", array()), null)) : (null));
                    // line 95
                    echo "              ";
                    $context["course"] = (($this->getAttribute($context["review"], "course", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["review"], "course", array()), null)) : (null));
                    // line 96
                    echo "              ";
                    if (((isset($context["author"]) ? $context["author"] : null) && (isset($context["course"]) ? $context["course"] : null))) {
                        // line 97
                        echo "            <div class=\"media media-dynamic\">
              <div class=\"media-left\">
              ";
                        // line 99
                        echo $context["web_macro"]->getuser_avatar((isset($context["author"]) ? $context["author"] : null), "", "avatar-sm", true);
                        echo "
              </div>
              <div class=\"media-body\">
                <div class=\"title text-sm\">
                  ";
                        // line 103
                        echo $context["web_macro"]->getuser_link((isset($context["author"]) ? $context["author"] : null), "link-dark");
                        echo "
                  <span class=\"score\">";
                        // line 104
                        echo $context["web_macro"]->getstar($this->getAttribute($context["review"], "rating", array()));
                        echo "</span>
                  ";
                        // line 105
                        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("发布于"), "html", null, true);
                        echo " <a class=\"link-dark\" href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("course_show", array("id" => $this->getAttribute((isset($context["course"]) ? $context["course"] : null), "id", array()))), "html", null, true);
                        echo "\">《";
                        echo $this->env->getExtension('AppBundle\Twig\WebExtension')->plainTextFilter($this->getAttribute((isset($context["course"]) ? $context["course"] : null), "title", array()), 10);
                        echo "》</a>
                </div>
                <div class=\"content gray-darker\">
                  ";
                        // line 108
                        echo $this->env->getExtension('AppBundle\Twig\WebExtension')->plainTextFilter($this->getAttribute($context["review"], "content", array()), 30);
                        echo "
                </div>
                <span class=\"date\">";
                        // line 110
                        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->smarttimeFilter($this->getAttribute($context["review"], "createdTime", array())), "html", null, true);
                        echo "</span>
              </div>
            </div>
            ";
                    }
                    // line 114
                    echo "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['review'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 115
                echo "            ";
            } else {
                // line 116
                echo "              <div class=\"empty\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("还没有评价"), "html", null, true);
                echo "</div>
            ";
            }
            // line 118
            echo "          </div>
        </div>
      </div>
      ";
        }
        // line 122
        echo "      ";
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "select4", array()) == "checked")) {
            // line 123
            echo "      <div class=\"col-md-6\">
        <div class=\"panel panel-default index-dynamic\">
          <div class=\"panel-heading\">
            <h3 class=\"panel-title\">
              ";
            // line 127
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("学员动态"), "html", null, true);
            echo "
            </h3>
          </div>
          <div class=\"panel-body\">
            ";
            // line 131
            $context["statuses"] = $this->env->getExtension('AppBundle\Twig\DataExtension')->getData("LatestStatuses", array("mode" => "simple", "count" => 4, "private" => 0));
            // line 132
            echo "
            ";
            // line 133
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["statuses"]) ? $context["statuses"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["status"]) {
                // line 134
                echo "              <div class=\"media media-dynamic\">
                <div class=\"media-left\">
                  ";
                // line 136
                echo $context["web_macro"]->getuser_avatar($this->getAttribute($context["status"], "user", array()), "", "avatar-sm");
                echo "
                </div>
                <div class=\"media-body\">
                  <div class=\"title\">
                    ";
                // line 140
                echo $context["web_macro"]->getuser_link($this->getAttribute($context["status"], "user", array()));
                echo "
                  </div>
                  <div class=\"content\">
                    ";
                // line 143
                echo $this->getAttribute($context["status"], "message", array());
                echo "
                  </div>
                  <span class=\"date\">";
                // line 145
                echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->smarttimeFilter($this->getAttribute($context["status"], "createdTime", array())), "html", null, true);
                echo "</span>
                </div>
              </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['status'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 149
            echo "          </div>
        </div>
      </div>
      ";
        }
        // line 153
        echo "    </div>
  </div>
</section>
";
    }

    public function getTemplateName()
    {
        return "default/groups.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  426 => 153,  420 => 149,  410 => 145,  405 => 143,  399 => 140,  392 => 136,  388 => 134,  384 => 133,  381 => 132,  379 => 131,  372 => 127,  366 => 123,  363 => 122,  357 => 118,  351 => 116,  348 => 115,  342 => 114,  335 => 110,  330 => 108,  320 => 105,  316 => 104,  312 => 103,  305 => 99,  301 => 97,  298 => 96,  295 => 95,  292 => 94,  287 => 93,  285 => 92,  278 => 88,  272 => 84,  269 => 83,  262 => 78,  259 => 77,  232 => 75,  214 => 74,  211 => 73,  209 => 72,  202 => 71,  198 => 69,  180 => 65,  174 => 63,  172 => 62,  168 => 61,  161 => 60,  144 => 59,  141 => 58,  138 => 57,  136 => 56,  129 => 52,  125 => 51,  119 => 47,  116 => 46,  109 => 41,  98 => 36,  94 => 35,  87 => 31,  83 => 30,  75 => 25,  71 => 24,  67 => 22,  63 => 21,  56 => 17,  52 => 16,  47 => 13,  45 => 12,  39 => 9,  35 => 8,  28 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/groups.html.twig", "/app/app/Resources/views/default/groups.html.twig");
    }
}
