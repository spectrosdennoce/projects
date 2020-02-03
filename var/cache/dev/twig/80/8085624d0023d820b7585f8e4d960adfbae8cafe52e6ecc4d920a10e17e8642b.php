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

/* Register.html.twig */
class __TwigTemplate_80f9fc861b1dd7c1a3a99ca70155f308784639681855dc86fa438c19631602c3 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Register.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Register.html.twig"));

        // line 1
        echo "
<button type=\"button\" class=\"btn btn-dark\" data-toggle=\"modal\" data-target=\"#Register\">Register</button>

  <div class=\"modal fade\" id=\"Register\" role=\"dialog\">
    <div class=\"modal-dialog\">
    
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">Register</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <form method=\"POST\">
                <div class=\"form-group\">
                    <label for=\"T_Pseudo\">Pseudonyme</label>
                    <input name=\"T_Pseudo\" class=\"form-control\" type=\"text\" placeholder=\"Pseudonyme\" value=\"\"/>
                </div>
                <div class=\"form-row\">
                    <div class=\"form-group col-md-6\">
                        <label for=\"T_Nom\">Nom</label>
                        <input name=\"T_Nom\" class=\"form-control\" type=\"text\" placeholder=\"Nom\" value=\"\"/>
                    </div>
                    <div class=\"form-group col-md-6\">
                        <label for=\"T_Prenom\">Prenom</label>
                        <input name=\"T_Prenom\" class=\"form-control\" type=\"text\" placeholder=\"Prenom\" value=\"\"/>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"T_Email\">Email</label>
                    <input name=\"T_Email\" class=\"form-control\" type=\"EMAIL\" placeholder=\"Email\" value=\"\"/>
                </div>
                <div class=\"form-row\">
                    <div class=\"form-group col-md-6\">
                        <label for=\"inputT_MdpEmail4\">mot de passe</label>
                        <input name=\"T_Mdp\" class=\"form-control\" type=\"password\" placeholder=\"mot de passe\" value=\"\"/>
                    </div>
                    <div class=\"form-group col-md-6\">
                        <label for=\"T_Confirmed_Mdp\">Confirmation mot de passe</label>
                        <input name=\"T_Confirmed_Mdp\" class=\"form-control\"  type=\"password\" placeholder=\"Confirmation mot de passe\" value=\"\"/>
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
        return "Register.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<button type=\"button\" class=\"btn btn-dark\" data-toggle=\"modal\" data-target=\"#Register\">Register</button>

  <div class=\"modal fade\" id=\"Register\" role=\"dialog\">
    <div class=\"modal-dialog\">
    
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">Register</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <form method=\"POST\">
                <div class=\"form-group\">
                    <label for=\"T_Pseudo\">Pseudonyme</label>
                    <input name=\"T_Pseudo\" class=\"form-control\" type=\"text\" placeholder=\"Pseudonyme\" value=\"\"/>
                </div>
                <div class=\"form-row\">
                    <div class=\"form-group col-md-6\">
                        <label for=\"T_Nom\">Nom</label>
                        <input name=\"T_Nom\" class=\"form-control\" type=\"text\" placeholder=\"Nom\" value=\"\"/>
                    </div>
                    <div class=\"form-group col-md-6\">
                        <label for=\"T_Prenom\">Prenom</label>
                        <input name=\"T_Prenom\" class=\"form-control\" type=\"text\" placeholder=\"Prenom\" value=\"\"/>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"T_Email\">Email</label>
                    <input name=\"T_Email\" class=\"form-control\" type=\"EMAIL\" placeholder=\"Email\" value=\"\"/>
                </div>
                <div class=\"form-row\">
                    <div class=\"form-group col-md-6\">
                        <label for=\"inputT_MdpEmail4\">mot de passe</label>
                        <input name=\"T_Mdp\" class=\"form-control\" type=\"password\" placeholder=\"mot de passe\" value=\"\"/>
                    </div>
                    <div class=\"form-group col-md-6\">
                        <label for=\"T_Confirmed_Mdp\">Confirmation mot de passe</label>
                        <input name=\"T_Confirmed_Mdp\" class=\"form-control\"  type=\"password\" placeholder=\"Confirmation mot de passe\" value=\"\"/>
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
  </div>", "Register.html.twig", "/var/www/projects/templates/Register.html.twig");
    }
}
