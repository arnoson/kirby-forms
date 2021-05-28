<?php

use Uniform\Form;
use function arnoson\KirbyForms\fieldNotEmpty;

return function ($kirby, $page) {
  $form = new Form(kirbyForms()->formRules($page));

  if ($kirby->request()->is('POST')) {
    $form->JsonPageAction();
    // Even if no success page is set, we have to do a redirect to prevent
    // another form submission on reload (Post/Redirect/Get pattern).
    $successUrl =
      fieldNotEmpty($page->form_success_page()->url()) ??
      url($page->url(), ['params' => ['submit' => 'success']]);
    go($successUrl);
  }

  return compact('form');
};