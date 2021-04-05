<?= $helper->getHeadPrintCode('Modifier ' . $entity_class_name) ?>
{% block body %}
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Modifier <?= $entity_class_name ?></h1>
                <div class="top_btns mb-3">
                    <a class="btn btn-secondary" href="{{ path('<?= strtoupper($route_name)?>_INDEX') }}">
                        Retour
                    </a>
                </div>
                {{ include('<?= $route_name ?>/_form.html.twig', {'button_label': 'Modifier'}) }}
                <div class="bottom_btns mt-3">
                    <a class="btn btn-secondary" href="{{ path('<?= strtoupper($route_name)?>_INDEX') }}">Retour</a>
                </div>
                {{ include('<?= $route_name ?>/_delete_form.html.twig') }}
            </div>
        </div>
    </div>
{% endblock %}
