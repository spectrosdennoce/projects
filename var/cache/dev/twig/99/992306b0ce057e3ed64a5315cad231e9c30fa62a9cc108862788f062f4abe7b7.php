<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* Login.html.twig */
class __TwigTemplate_66fa9acfc567b8fa2e760343b428426baf8693450d84eb6e07e1a73f2d6e3e04 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Login.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Login.html.twig"));

        // line 1
        echo "
<button type=\"button\" class=\"btn btn-dark\" data-toggle=\"modal\" data-target=\"#Login\">Login</button>

  <div class=\"modal fade\" id=\"Login\" role=\"dialog\">
    <div class=\"modal-dialog\">
    
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">Login</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <form method=\"POST\">
                <div class=\"form-group\">
                    <label for=\"T_Pseudo\">Pseudonyme/Pseudo</label>
                    <input name=\"T_Pseudo\" class=\"form-control\" type=\"text\" placeholder=\"Email / Pseudo\" value=\"\"/>
                </div>
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"T_Mdp\">mot de passe</label>
                        <input name=\"T_Mdp\" class=\"form-control\" type=\"password\" placeholder=\"mot de passe\" value=\"\"/>
                    </div>
                </div>
                <div class=\"form-group\">
                    <button class=\"btn btn-info\"> Validate</button>
                </div>
            </form>
        </div>
        <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\">Close</button>
        </div>
      </div>
    </div>
  </div>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "Login.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<button type=\"button\" class=\"btn btn-dark\" data-toggle=\"modal\" data-target=\"#Login\">Login</button>

  <div class=\"modal fade\" id=\"Login\" role=\"dialog\">
    <div class=\"modal-dialog\">
    
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">Login</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <form method=\"POST\">
                <div class=\"form-group\">
                    <label for=\"T_Pseudo\">Pseudonyme/Pseudo</label>
                    <input name=\"T_Pseudo\" class=\"form-control\" type=\"text\" placeholder=\"Email / Pseudo\" value=\"\"/>
                </div>
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"T_Mdp\">mot de passe</label>
                        <input name=\"T_Mdp\" class=\"form-control\" type=\"password\" placeholder=\"mot de passe\" value=\"\"/>
                    </div>
                </div>
                <div class=\"form-group\">
                    <button class=\"btn btn-info\"> Validate</button>
                </div>
            </form>
        </div>
        <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\">Close</button>
        </div>
      </div>
    </div>
  </div>", "Login.html.twig", "/var/www/projects/templates/Login.html.twig");
    }
}
