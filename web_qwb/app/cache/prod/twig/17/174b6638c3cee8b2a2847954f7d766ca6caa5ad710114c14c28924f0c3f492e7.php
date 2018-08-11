<?php

/* macro.html.twig */
class __TwigTemplate_60eb2f6f0cf1542c5e365a882bcb2a5bf4d5010308850b0f0994af36ea266376 extends Twig_Template
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
        // line 73
        echo "
";
        // line 96
        echo "
";
        // line 117
        echo "
";
        // line 139
        echo "
";
    }

    // line 2
    public function getuser_avatar($__user__ = null, $__class__ = null, $__imgClass__ = null, $__card__ = true)
    {
        $context = $this->env->mergeGlobals(array(
            "user" => $__user__,
            "class" => $__class__,
            "imgClass" => $__imgClass__,
            "card" => $__card__,
            "varargs" => func_num_args() > 4 ? array_slice(func_get_args(), 4) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 3
            if ((isset($context["user"]) ? $context["user"] : null)) {
                // line 4
                echo "  <a class=\"";
                echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
                echo " ";
                if ((isset($context["card"]) ? $context["card"] : null)) {
                    echo "js-user-card";
                }
                echo "\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_show", array("id" => $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()))), "html", null, true);
                echo "\" data-card-url=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_card_show", array("userId" => $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()))), "html", null, true);
                echo "\" data-user-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()), "html", null, true);
                echo "\">
    ";
                // line 5
                if (((isset($context["imgClass"]) ? $context["imgClass"] : null) == "avatar-md")) {
                    // line 6
                    echo "      ";
                    $context["avatarType"] = "medium";
                    // line 7
                    echo "    ";
                } elseif (((isset($context["imgClass"]) ? $context["imgClass"] : null) == "avatar-lg")) {
                    // line 8
                    echo "      ";
                    $context["avatarType"] = "large";
                    // line 9
                    echo "    ";
                } else {
                    // line 10
                    echo "      ";
                    $context["avatarType"] = "small";
                    // line 11
                    echo "    ";
                }
                // line 12
                echo "    <img class=\"";
                echo twig_escape_filter($this->env, ((array_key_exists("imgClass", $context)) ? (_twig_default_filter((isset($context["imgClass"]) ? $context["imgClass"] : null), "avatar-sm")) : ("avatar-sm")), "html", null, true);
                echo "\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->avatarPath((isset($context["user"]) ? $context["user"] : null), (isset($context["avatarType"]) ? $context["avatarType"] : null)), "html", null, true);
                echo "\">

  </a>
  ";
            } else {
                // line 16
                echo "    <a class=\"";
                echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
                echo "\" href=\"javascript:;\">
      <img class=\"";
                // line 17
                echo twig_escape_filter($this->env, ((array_key_exists("imgClass", $context)) ? (_twig_default_filter((isset($context["imgClass"]) ? $context["imgClass"] : null), "avatar-sm")) : ("avatar-sm")), "html", null, true);
                echo "\"  src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->avatarPath("", "small"), "html", null, true);
                echo "\">
    </a>
  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 23
    public function getuser_avatar_link($__user__ = null, $__size__ = null, $__options__ = array())
    {
        $context = $this->env->mergeGlobals(array(
            "user" => $__user__,
            "size" => $__size__,
            "options" => $__options__,
            "varargs" => func_num_args() > 3 ? array_slice(func_get_args(), 3) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 24
            $context["size"] = ((array_key_exists("size", $context)) ? (_twig_default_filter((isset($context["size"]) ? $context["size"] : null), "small")) : ("small"));
            // line 25
            echo "  ";
            if ((isset($context["user"]) ? $context["user"] : null)) {
                // line 26
                echo "    <a
      class=\"avatar-link-";
                // line 27
                echo twig_escape_filter($this->env, (isset($context["size"]) ? $context["size"] : null), "html", null, true);
                echo " ";
                if (twig_in_filter("card", (isset($context["options"]) ? $context["options"] : null))) {
                    echo "js-user-card";
                }
                echo "\"
      ";
                // line 28
                if (twig_in_filter("_blank", (isset($context["options"]) ? $context["options"] : null))) {
                    // line 29
                    echo "        target=\"_blank\"
      ";
                }
                // line 31
                echo "      href=\"";
                if (twig_in_filter("null_link", (isset($context["options"]) ? $context["options"] : null))) {
                    echo "javascript:;";
                } else {
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_show", array("id" => $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()))), "html", null, true);
                }
                echo "\"
      data-card-url=\"";
                // line 32
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_card_show", array("userId" => $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()))), "html", null, true);
                echo "\"
      data-user-id=\"";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()), "html", null, true);
                echo "\">
      ";
                // line 34
                echo $this->getAttribute($this, "user_avater_img", array(0 => (isset($context["user"]) ? $context["user"] : null), 1 => (isset($context["size"]) ? $context["size"] : null)), "method");
                echo "
    </a>
  ";
            } else {
                // line 37
                echo "    <a class=\"avatar-link-";
                echo twig_escape_filter($this->env, (isset($context["size"]) ? $context["size"] : null), "html", null, true);
                echo "\" href=\"javascript:;\">
      ";
                // line 38
                echo $this->getAttribute($this, "user_avater_img", array(0 => (isset($context["user"]) ? $context["user"] : null), 1 => (isset($context["size"]) ? $context["size"] : null)), "method");
                echo "
    </a>
  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 43
    public function getuser_avater_img($__user__ = null, $__size__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "user" => $__user__,
            "size" => $__size__,
            "varargs" => func_num_args() > 2 ? array_slice(func_get_args(), 2) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 44
            echo "<img class=\"avatar-";
            echo twig_escape_filter($this->env, (isset($context["size"]) ? $context["size"] : null), "html", null, true);
            echo "\"  src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('AppBundle\Twig\WebExtension')->avatarPath((isset($context["user"]) ? $context["user"] : null), (isset($context["size"]) ? $context["size"] : null)), "html", null, true);
            echo "\">";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 58
    public function getuser_link($__user__ = null, $__class__ = null, $__card__ = true)
    {
        $context = $this->env->mergeGlobals(array(
            "user" => $__user__,
            "class" => $__class__,
            "card" => $__card__,
            "varargs" => func_num_args() > 3 ? array_slice(func_get_args(), 3) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 59
            if ((isset($context["user"]) ? $context["user"] : null)) {
                // line 60
                echo "    <a class=\"link-dark ";
                echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
                echo "\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_show", array("id" => $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "id", array()))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "nickname", array()), "html", null, true);
                echo "</a>
  ";
            } else {
                // line 62
                echo "    <a class=\"link-dark ";
                echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
                echo "\" href=\"javascript:;\"><del>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("用户不存在"), "html", null, true);
                echo "</del></a>
  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 66
    public function getflash_messages()
    {
        $context = $this->env->mergeGlobals(array(
            "varargs" => func_num_args() > 0 ? array_slice(func_get_args(), 0) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 67
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "all", array(), "method"));
            foreach ($context['_seq'] as $context["type"] => $context["flashMessages"]) {
                // line 68
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["flashMessages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                    // line 69
                    echo "      <div class=\"alert alert-";
                    echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                    echo "\">";
                    echo $context["flashMessage"];
                    echo "</div>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 71
                echo "  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['flashMessages'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 74
    public function getbytesToSize($__bytes__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "bytes" => $__bytes__,
            "varargs" => func_num_args() > 1 ? array_slice(func_get_args(), 1) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 75
            echo "  ";
            ob_start();
            // line 76
            echo "      
      ";
            // line 77
            $context["kilobyte"] = 1024;
            // line 78
            echo "      ";
            $context["megabyte"] = ((isset($context["kilobyte"]) ? $context["kilobyte"] : null) * 1024);
            // line 79
            echo "      ";
            $context["gigabyte"] = ((isset($context["megabyte"]) ? $context["megabyte"] : null) * 1024);
            // line 80
            echo "      ";
            $context["terabyte"] = ((isset($context["gigabyte"]) ? $context["gigabyte"] : null) * 1024);
            // line 81
            echo "
      ";
            // line 82
            if (((isset($context["bytes"]) ? $context["bytes"] : null) < (isset($context["kilobyte"]) ? $context["kilobyte"] : null))) {
                // line 83
                echo "          ";
                echo twig_escape_filter($this->env, ((isset($context["bytes"]) ? $context["bytes"] : null) . " B"), "html", null, true);
                echo "
      ";
            } elseif ((            // line 84
(isset($context["bytes"]) ? $context["bytes"] : null) < (isset($context["megabyte"]) ? $context["megabyte"] : null))) {
                // line 85
                echo "          ";
                echo twig_escape_filter($this->env, (twig_number_format_filter($this->env, ((isset($context["bytes"]) ? $context["bytes"] : null) / (isset($context["kilobyte"]) ? $context["kilobyte"] : null)), 2, ".") . " KB"), "html", null, true);
                echo "
      ";
            } elseif ((            // line 86
(isset($context["bytes"]) ? $context["bytes"] : null) < (isset($context["gigabyte"]) ? $context["gigabyte"] : null))) {
                // line 87
                echo "          ";
                echo twig_escape_filter($this->env, (twig_number_format_filter($this->env, ((isset($context["bytes"]) ? $context["bytes"] : null) / (isset($context["megabyte"]) ? $context["megabyte"] : null)), 2, ".") . " MB"), "html", null, true);
                echo "
      ";
            } elseif ((            // line 88
(isset($context["bytes"]) ? $context["bytes"] : null) < (isset($context["terabyte"]) ? $context["terabyte"] : null))) {
                // line 89
                echo "          ";
                echo twig_escape_filter($this->env, (twig_number_format_filter($this->env, ((isset($context["bytes"]) ? $context["bytes"] : null) / (isset($context["gigabyte"]) ? $context["gigabyte"] : null)), 2, ".") . " GB"), "html", null, true);
                echo "
      ";
            } else {
                // line 91
                echo "          ";
                echo twig_escape_filter($this->env, (twig_number_format_filter($this->env, ((isset($context["bytes"]) ? $context["bytes"] : null) / (isset($context["terabyte"]) ? $context["terabyte"] : null)), 2, ".") . " TB"), "html", null, true);
                echo "
      ";
            }
            // line 93
            echo "
  ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 97
    public function getpaginator($__paginator__ = null, $__class__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "paginator" => $__paginator__,
            "class" => $__class__,
            "varargs" => func_num_args() > 2 ? array_slice(func_get_args(), 2) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 98
            echo "  ";
            if (($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "lastPage", array()) > 1)) {
                // line 99
                echo "    <nav class=\" ";
                echo twig_escape_filter($this->env, ((array_key_exists("class", $context)) ? (_twig_default_filter((isset($context["class"]) ? $context["class"] : null), "text-center")) : ("text-center")), "html", null, true);
                echo "\">
      <ul class=\"pagination\">
        ";
                // line 101
                if (($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array()) != $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "firstPage", array()))) {
                    // line 102
                    echo "          <li><a  href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "firstPage", array())), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("首页"), "html", null, true);
                    echo "</a></li>
          <li><a  href=\"";
                    // line 103
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "previousPage", array())), "method"), "html", null, true);
                    echo "\"><i class=\"es-icon es-icon-chevronleft\"></i></a></li>
        ";
                }
                // line 105
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "pages", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                    // line 106
                    echo "          <li ";
                    if (($context["page"] == $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array()))) {
                        echo "class=\"active\"";
                    }
                    echo "><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $context["page"]), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "</a></li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 108
                echo "
        ";
                // line 109
                if (($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array()) != $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "lastPage", array()))) {
                    // line 110
                    echo "          <li><a  href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "nextPage", array())), "method"), "html", null, true);
                    echo "\"><i class=\"es-icon es-icon-chevronright\"></i></a></li>
          <li><a  href=\"";
                    // line 111
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getLastPage", array(), "method")), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("尾页"), "html", null, true);
                    echo "</a></li>
        ";
                }
                // line 113
                echo "      </ul>
    </nav>
  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 118
    public function getstar($__score__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "score" => $__score__,
            "varargs" => func_num_args() > 1 ? array_slice(func_get_args(), 1) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 119
            echo "  ";
            $context["floorScore"] = twig_round((isset($context["score"]) ? $context["score"] : null), 0, "floor");
            // line 120
            echo "  ";
            $context["emptyNum"] = (5 - (isset($context["floorScore"]) ? $context["floorScore"] : null));
            // line 121
            echo "
  ";
            // line 122
            if (((isset($context["floorScore"]) ? $context["floorScore"] : null) > 0)) {
                // line 123
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["floorScore"]) ? $context["floorScore"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 124
                    echo "      <i class=\"es-icon es-icon-star color-warning\"></i>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 126
                echo "  ";
            }
            // line 127
            echo "
  ";
            // line 128
            if ((((isset($context["score"]) ? $context["score"] : null) - (isset($context["floorScore"]) ? $context["floorScore"] : null)) >= 0.5)) {
                // line 129
                echo "    ";
                $context["emptyNum"] = ((isset($context["emptyNum"]) ? $context["emptyNum"] : null) - 1);
                // line 130
                echo "    <i class=\"es-icon es-icon-starhalf color-warning\"></i>
  ";
            }
            // line 132
            echo "
  ";
            // line 133
            if (((isset($context["emptyNum"]) ? $context["emptyNum"] : null) > 0)) {
                // line 134
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["emptyNum"]) ? $context["emptyNum"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 135
                    echo "      <i class=\"es-icon es-icon-staroutline\"></i>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 137
                echo "  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 140
    public function getajax_paginator($__paginator__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "paginator" => $__paginator__,
            "varargs" => func_num_args() > 1 ? array_slice(func_get_args(), 1) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 141
            echo "  <input class=\"js-page\" type=\"hidden\" name=\"page\" value=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array()), 1)) : (1)), "html", null, true);
            echo "\">

  ";
            // line 143
            if (($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "lastPage", array()) > 1)) {
                // line 144
                echo "    <nav class=\" ";
                echo twig_escape_filter($this->env, ((array_key_exists("class", $context)) ? (_twig_default_filter((isset($context["class"]) ? $context["class"] : null), "text-center")) : ("text-center")), "html", null, true);
                echo "\">
      <ul class=\"pagination\">
        ";
                // line 146
                if (($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array()) != $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "firstPage", array()))) {
                    // line 147
                    echo "          <li data-url=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "firstPage", array())), "method"), "html", null, true);
                    echo "\"><a href=\"javascript:;\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("首页"), "html", null, true);
                    echo "</a></li>
          <li data-url=\"";
                    // line 148
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "previousPage", array())), "method"), "html", null, true);
                    echo "\"><a  href=\"javascript:;\"><i class=\"es-icon es-icon-chevronleft\"></i></a></li>
        ";
                }
                // line 150
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "pages", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                    // line 151
                    echo "          <li ";
                    if (($context["page"] == $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array()))) {
                        echo "class=\"active\"";
                    }
                    echo " data-url=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $context["page"]), "method"), "html", null, true);
                    echo "\"><a href=\"javascript:;\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "</a></li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 153
                echo "
        ";
                // line 154
                if (($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "currentPage", array()) != $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "lastPage", array()))) {
                    // line 155
                    echo "          <li data-url=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "nextPage", array())), "method"), "html", null, true);
                    echo "\"><a  href=\"javascript:;\"><i class=\"es-icon es-icon-chevronright\"></i></a></li>
          <li data-url=\"";
                    // line 156
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getPageUrl", array(0 => $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "getLastPage", array())), "method"), "html", null, true);
                    echo "\"><a  href=\"javascript:;\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("尾页"), "html", null, true);
                    echo "</a></li>
        ";
                }
                // line 158
                echo "      </ul>
    </nav>
  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "macro.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  669 => 158,  662 => 156,  657 => 155,  655 => 154,  652 => 153,  637 => 151,  632 => 150,  627 => 148,  620 => 147,  618 => 146,  612 => 144,  610 => 143,  604 => 141,  592 => 140,  576 => 137,  569 => 135,  564 => 134,  562 => 133,  559 => 132,  555 => 130,  552 => 129,  550 => 128,  547 => 127,  544 => 126,  537 => 124,  532 => 123,  530 => 122,  527 => 121,  524 => 120,  521 => 119,  509 => 118,  491 => 113,  484 => 111,  479 => 110,  477 => 109,  474 => 108,  459 => 106,  454 => 105,  449 => 103,  442 => 102,  440 => 101,  434 => 99,  431 => 98,  418 => 97,  401 => 93,  395 => 91,  389 => 89,  387 => 88,  382 => 87,  380 => 86,  375 => 85,  373 => 84,  368 => 83,  366 => 82,  363 => 81,  360 => 80,  357 => 79,  354 => 78,  352 => 77,  349 => 76,  346 => 75,  334 => 74,  315 => 71,  304 => 69,  299 => 68,  294 => 67,  283 => 66,  262 => 62,  252 => 60,  250 => 59,  236 => 58,  217 => 44,  204 => 43,  185 => 38,  180 => 37,  174 => 34,  170 => 33,  166 => 32,  157 => 31,  153 => 29,  151 => 28,  143 => 27,  140 => 26,  137 => 25,  135 => 24,  121 => 23,  100 => 17,  95 => 16,  85 => 12,  82 => 11,  79 => 10,  76 => 9,  73 => 8,  70 => 7,  67 => 6,  65 => 5,  50 => 4,  48 => 3,  33 => 2,  28 => 139,  25 => 117,  22 => 96,  19 => 73,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "macro.html.twig", "/app/app/Resources/views/macro.html.twig");
    }
}
