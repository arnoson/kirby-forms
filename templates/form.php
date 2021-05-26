<?php

namespace Uniform\Actions;

class JsonAction extends Action {
  public function perform() {
    try {
      $page = page();
      $entries = $page->entries()->toData('json');
      array_push($entries, $this->form->data());
      kirby()->impersonate(
        'kirby',
        fn() => $page->update(['entries' => \Kirby\Data\Json::encode($entries)])
      );
    } catch (\Exception $error) {
      $this->fail($error->getMessage());
    }
  }
}


$formRules = [];
foreach ($page->fields()->toLayouts() as $layout) {
  foreach ($layout->columns() as $column) {
    foreach ($column->blocks() as $field) {
      $rules = [
        'required' => $field->required()->toBool(),
        'min' => $field->min()->isEmpty() ? null : $field->min()->value(),
        'max' => $field->max()->isEmpty() ? null : $field->max()->value(),
        'match' => $field->pattern()->isEmpty()
          ? null
          : $field->pattern()->value()
      ];

      dump($field->validators()->isEmpty());

      if ($field->validators()->isNotEmpty()) {
        $rules = array_merge($rules, $field->validators()->toData('json'));
      }

      $formRules[$field->name()->value()] = ['rules' => array_filter($rules)];
    }
  }
}

dump($formRules);

$form = new \Uniform\Form($formRules);

$form->withoutRedirect();

if ($kirby->request()->is('POST')) {
  $form->JsonAction();
}
