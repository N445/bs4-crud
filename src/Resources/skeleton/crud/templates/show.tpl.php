<?= $helper->getHeadPrintCode($entity_class_name) ?>
{% block body %}
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><?= $entity_class_name ?></h1>
                <div class="top_btns mb-3">
                    <a class="btn btn-secondary" href="{{ path('<?= strtoupper($route_name)?>_INDEX') }}">
                        Retour
                    </a>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-hover table-sm">
                        <tbody>
<?php foreach ($entity_fields as $field): ?>
                        <tr>
                            <th><?= ucfirst($field['fieldName']) ?></th>
                            <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
                        </tr>
<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="bottom_btns mt-3">
                    <a class="btn btn-secondary" href="{{ path('<?= strtoupper($route_name)?>_INDEX') }}">
                        Retour
                    </a>
                    <a class="btn btn-success"
                       href="{{ path('<?= strtoupper($route_name)?>_EDIT', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">
                        Modifier
                    </a>
                </div>
                {{ include('<?= $route_name ?>/_delete_form.html.twig') }}
            </div>
        </div>
    </div>
{% endblock %}
