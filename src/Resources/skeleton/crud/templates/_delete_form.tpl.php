<div class="delete_area mt-2">
    <form method="post"
          action="{{ path('<?= strtoupper($route_name)?>_DELETE', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"
          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token"
               value="{{ csrf_token('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>) }}">
        <button class="btn btn-danger">Supprimer</button>
    </form>
</div>