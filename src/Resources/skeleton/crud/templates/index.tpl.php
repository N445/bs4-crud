<?= $helper->getHeadPrintCode($entity_class_name . ' index'); ?>
{% block body %}
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><?= $entity_class_name ?> index</h1>
                <div class="add_new mb-3">
                    <a class="btn btn-success" href="{{ path('<?= strtoupper($route_name)?>_NEW') }}">Ajouter</a>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
<?php foreach ($entity_fields as $field): ?>
                            <th><?= ucfirst($field['fieldName']) ?></th>
<?php endforeach; ?>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        {% if (<?= $entity_twig_var_plural ?> is not null) %}
                            {% for <?= $entity_twig_var_singular ?> in <?= $entity_twig_var_plural ?> %}
                                <tr>
<?php foreach ($entity_fields as $field): ?>
                                    <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
<?php endforeach; ?>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                           href="{{ path('<?= strtoupper($route_name)?>_SHOW', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">
                                            Voir
                                        </a>
                                        <a class="btn btn-info btn-sm"
                                           href="{{ path('<?= strtoupper($route_name)?>_EDIT', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">
                                            Modifier
                                        </a>
                                    </td>
                                </tr>
                            {% endfor %}
                        {% else %}
                            <tr>
                                <td colspan="<?= (count($entity_fields) + 1) ?>">Aucun résultats.</td>
                            </tr>
                        {% endif %}
                        </tbody>
                    </table>
                </div>
                <div class="add_new mt-3">
                    <a class="btn btn-success" href="{{ path('<?= strtoupper($route_name)?>_NEW') }}">Ajouter</a>
                </div>
            </div>
        </div>
    </div>
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('bundles/fosjsrouting/js/router.min.js') }}"></script>
    <script src="{{ path('fos_js_routing_js', { callback: 'fos.Router.setData' }) }}"></script>
    <script>
        /**
         *  a utiliser avec la fonction Twig bs4_switch
         *  ex: bs4_switch('open',tutu.open ,tutu.id )
         */
        $(function () {
            $('.oz-bs4-crud-switch input').on('click', function (e) {
                $.post(Routing.generate('<?= strtoupper($route_name)?>_SWITCH_UPDATE', {id: $(this).data('entity')}), {
                    fieldname: $(this).data('fieldname'),
                    value: $(this).prop('checked')
                });
            })
        })
    </script>
{% endblock %}
