{{ form_start(form) }}
{{ form_widget(form) }}
<p class="my-2">
    <button class="btn btn-success">{{ button_label|default('Enregistrer') }}</button>
</p>
{{ form_end(form) }}
