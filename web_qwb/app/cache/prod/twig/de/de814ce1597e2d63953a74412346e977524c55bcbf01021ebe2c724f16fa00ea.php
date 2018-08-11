<?php

/* default/index.html.twig */
class __TwigTemplate_e58854cc96e448a824542eb7c99328cfcbcddbb54d737e69f8478b0cd321c9f2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "default/index.html.twig", 1);
        $this->blocks = array(
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'full_content' => array($this, 'block_full_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 6
        $context["appDownload"] = (( !((array_key_exists("custom", $context)) ? (_twig_default_filter((isset($context["custom"]) ? $context["custom"] : null), 0)) : (0)) && $this->env->getExtension('AppBundle\Twig\WebExtension')->isESCopyright()) && $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("mobile.enabled", null));
        // line 7
        if ((isset($context["appDownload"]) ? $context["appDownload"] : null)) {
            // line 8
            $context["bodyClass"] = "homepage has-app";
        } else {
            // line 10
            $context["bodyClass"] = "homepage";
        }
        // line 12
        $context["siteNav"] = "/";
        // line 13
        $this->env->getExtension('Codeages\PluginBundle\Twig\HtmlExtension')->script(array(0 => "libs/echo-js.js", 1 => "app/js/index/index.js"));
        // line 14
        $context["_target_path"] = $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage");
        // line 16
        $context["currentTheme"] = $this->env->getExtension('AppBundle\Twig\ThemeExtension')->getCurrentTheme();
        // line 17
        $context["themeConfig"] = ((((array_key_exists("isEditColor", $context)) ? (_twig_default_filter((isset($context["isEditColor"]) ? $context["isEditColor"] : null), false)) : (false))) ? ($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "config", array())) : ($this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "confirmConfig", array())));
        // line 18
        $context["allConfig"] = $this->getAttribute((isset($context["currentTheme"]) ? $context["currentTheme"] : null), "allConfig", array());
        // line 20
        $context["isIndex"] = true;
        // line 21
        $context["consultDisplay"] = true;
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_keywords($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.seo_keywords"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->getSetting("site.seo_description"), "html", null, true);
    }

    // line 23
    public function block_full_content($context, array $blocks = array())
    {
        // line 24
        echo "  ";
        if ((isset($context["appDownload"]) ? $context["appDownload"] : null)) {
            // line 25
            echo "    ";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->controller("AppBundle:Default:appDownload"));
            echo "
  ";
        }
        // line 27
        echo "
  ";
        // line 28
        $asm89CacheStrategy1 = $this->env->getExtension('Asm89\Twig\CacheExtension\Extension')->getCacheStrategy();
        $asm89Key1 = $asm89CacheStrategy1->generateKey("jianmo/home/top/banner", 600        );
        $asm89CacheBody1 = $asm89CacheStrategy1->fetchBlock($asm89Key1);
        if ($asm89CacheBody1 === false) {
            ob_start();
                // line 29
                echo "    ";
                echo $this->env->getExtension('AppBundle\Twig\BlockExtension')->showBlock("jianmo:home_top_banner");
                echo "
  ";
            
            $asm89CacheBody1 = ob_get_clean();
            $asm89CacheStrategy1->saveBlock($asm89Key1, $asm89CacheBody1);
        }
        echo $asm89CacheBody1;
        // line 31
        echo "  ";
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
            // line 32
            echo "
    ";
            // line 33
            $context["code"] = $this->getAttribute($context["config"], "code", array());
            // line 34
            echo "    ";
            if ((((($this->getAttribute($context["config"], "sortName", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["config"], "sortName", array()), "")) : ("")) == "recommended") && ((isset($context["code"]) ? $context["code"] : null) == "category-course"))) {
                // line 35
                echo "      ";
                $context["code"] = "recommend-course";
                // line 36
                echo "    ";
            }
            // line 37
            echo "
    ";
            // line 38
            $context["category"] = (((($this->getAttribute($context["config"], "categoryId", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["config"], "categoryId", array()), 0)) : (0))) ? ($this->env->getExtension('AppBundle\Twig\DataExtension')->getData("Category", array("categoryId" => $this->getAttribute($context["config"], "categoryId", array())))) : (null));
            // line 39
            echo "    ";
            if (((isset($context["code"]) ? $context["code"] : null) == "friend-link")) {
                // line 40
                echo "      ";
                $this->loadTemplate((("default/" . (isset($context["code"]) ? $context["code"] : null)) . ".html.twig"), "default/index.html.twig", 40)->display(array_merge($context, array("friendlyLinks" => (isset($context["friendlyLinks"]) ? $context["friendlyLinks"] : null))));
                // line 41
                echo "    ";
            } elseif (((isset($context["code"]) ? $context["code"] : null) != "footer-link")) {
                // line 42
                echo "      ";
                if (((isset($context["code"]) ? $context["code"] : null) != "course-grid-with-condition-index")) {
                    // line 43
                    echo "        ";
                    $asm89CacheStrategy2 = $this->env->getExtension('Asm89\Twig\CacheExtension\Extension')->getCacheStrategy();
                    $asm89Key2 = $asm89CacheStrategy2->generateKey(("jianmo/default/" . (isset($context["code"]) ? $context["code"] : null)), 600                    );
                    $asm89CacheBody2 = $asm89CacheStrategy2->fetchBlock($asm89Key2);
                    if ($asm89CacheBody2 === false) {
                        ob_start();
                            // line 44
                            echo "        ";
                            $this->loadTemplate((("default/" . (isset($context["code"]) ? $context["code"] : null)) . ".html.twig"), "default/index.html.twig", 44)->display(array_merge($context, array("config" => $context["config"], "category" => (isset($context["category"]) ? $context["category"] : null))));
                            // line 45
                            echo "        ";
                        
                        $asm89CacheBody2 = ob_get_clean();
                        $asm89CacheStrategy2->saveBlock($asm89Key2, $asm89CacheBody2);
                    }
                    echo $asm89CacheBody2;
                    // line 46
                    echo "      ";
                } else {
                    // line 47
                    echo "        ";
                    $this->loadTemplate((("default/" . (isset($context["code"]) ? $context["code"] : null)) . ".html.twig"), "default/index.html.twig", 47)->display(array_merge($context, array("config" => $context["config"], "category" => (isset($context["category"]) ? $context["category"] : null))));
                    // line 48
                    echo "      ";
                }
                // line 49
                echo "    ";
            }
            // line 50
            echo "  ";
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
        // line 51
        echo "
  ";
        // line 52
        $this->loadTemplate("mobile/footer-tool-bar.html.twig", "default/index.html.twig", 52)->display(array_merge($context, array("mobile_tool_bar" => "index")));
    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 52,  192 => 51,  178 => 50,  175 => 49,  172 => 48,  169 => 47,  166 => 46,  159 => 45,  156 => 44,  149 => 43,  146 => 42,  143 => 41,  140 => 40,  137 => 39,  135 => 38,  132 => 37,  129 => 36,  126 => 35,  123 => 34,  121 => 33,  118 => 32,  100 => 31,  90 => 29,  84 => 28,  81 => 27,  75 => 25,  72 => 24,  69 => 23,  63 => 4,  57 => 3,  53 => 1,  51 => 21,  49 => 20,  47 => 18,  45 => 17,  43 => 16,  41 => 14,  39 => 13,  37 => 12,  34 => 10,  31 => 8,  29 => 7,  27 => 6,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/index.html.twig", "/app/app/Resources/views/default/index.html.twig");
    }
}
