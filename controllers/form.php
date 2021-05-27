<?php use Uniform\Form;

return function ($kirby, $page) {
  $form = new Form(kirbyForms()->formRules($page));

  if ($kirby->request()->is('POST')) {
    $form->JsonPageAction();
  }

  return compact('form');
};