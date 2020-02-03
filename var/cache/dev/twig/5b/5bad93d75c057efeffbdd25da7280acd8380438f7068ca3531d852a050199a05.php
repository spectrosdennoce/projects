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

/* Read.Formulaire.html.twig */
class __TwigTemplate_8ea80ac3fb8845dcc6e9c248225e3a5d84ae20bb1123c9b50590a00be38a8805 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'javascripts' => [$this, 'block_javascripts'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "Header-Footer.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Read.Formulaire.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Read.Formulaire.html.twig"));

        $this->parent = $this->loadTemplate("Header-Footer.html.twig", "Read.Formulaire.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 3
        echo "\$('#exampleModal').on('show.bs.modal', function (event) {
  var button = \$(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = \$(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
\$('#formulaire').submit(function(event) {

  // Stop la propagation par défaut
  event.preventDefault();

  // Récupération des valeurs
  var \$form = \$(this),
       term = \$form.find( \"input[name='text']\" ).val(),
       url = \$form.attr( \"action\" );

  // Envoie des données
  var posting = \$.ajax(  
  type: \"POST\",
  url: url,
  data: term
});

});
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 29
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 30
        echo "<div class=\"container\">
  <h2>Modal Example</h2>
  <button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\">Open Modal</button>

  <div class=\"modal fade\" id=\"myModal\" role=\"dialog\">
    <div class=\"modal-dialog\">
    
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">Modal Header</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
          <p>Some text in the modal.</p>
        </div>
        <div class=\"modal-footer\">
        <form action=\"/index.php/Formulaire/Read\" id='formulaire'>
        <input name=\"text\" type=\"text\" placeholder=\"text\" value=\"\"/>
        <input name=\"text3\" type=\"text\" placeholder=\"text\" value=\"\"/>
        <button  class=\"btn btn-dark\"> truc</button>
        </form>
          <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "Read.Formulaire.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 30,  104 => 29,  69 => 3,  59 => 2,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"Header-Footer.html.twig\" %}
{% block javascripts %}
\$('#exampleModal').on('show.bs.modal', function (event) {
  var button = \$(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = \$(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
\$('#formulaire').submit(function(event) {

  // Stop la propagation par défaut
  event.preventDefault();

  // Récupération des valeurs
  var \$form = \$(this),
       term = \$form.find( \"input[name='text']\" ).val(),
       url = \$form.attr( \"action\" );

  // Envoie des données
  var posting = \$.ajax(  
  type: \"POST\",
  url: url,
  data: term
});

});
{% endblock %}
{% block body %}
<div class=\"container\">
  <h2>Modal Example</h2>
  <button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\">Open Modal</button>

  <div class=\"modal fade\" id=\"myModal\" role=\"dialog\">
    <div class=\"modal-dialog\">
    
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">Modal Header</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
          <p>Some text in the modal.</p>
        </div>
        <div class=\"modal-footer\">
        <form action=\"/index.php/Formulaire/Read\" id='formulaire'>
        <input name=\"text\" type=\"text\" placeholder=\"text\" value=\"\"/>
        <input name=\"text3\" type=\"text\" placeholder=\"text\" value=\"\"/>
        <button  class=\"btn btn-dark\"> truc</button>
        </form>
          <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
{% endblock %}", "Read.Formulaire.html.twig", "/var/www/projects/templates/Read.Formulaire.html.twig");
    }
}
