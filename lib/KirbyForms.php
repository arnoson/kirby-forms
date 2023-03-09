<?php

namespace arnoson\KirbyForms;

use Kirby\Cms\Page;
use Kirby\Toolkit\Str;

class KirbyForms {
  protected static $instance = null;

  public static function getInstance() {
    return self::$instance ??= new self();
  }

  public static function getFormId($page) {
    return Str::slug($page->uuid());
  }

  /**
   * Generate the form rules for the specified form page for use with
   * Kirby Uniform.
   */
  function formRules(Page $formPage): array {
    $formRules = [
      // `form_name` and `form_id` are hidden fields we send with every form.
      'form_name' => [],
      'form_id' => [],
    ];
    foreach ($formPage->form_fields()->toLayouts() as $layout) {
      foreach ($layout->columns() as $column) {
        foreach ($column->blocks() as $field) {
          $rules = [
            'required' => $field->required()->toBool(),
            'min' => fieldNotEmpty($field->min()),
            'max' => fieldNotEmpty($field->max()),
            'match' => fieldNotEmpty($field->pattern()),
          ];

          // In the hidden `validators` field additional validators can be
          // stored as json. Example: ["email", "min" => 3]
          if ($field->validators()->isNotEmpty()) {
            $rules = array_merge($rules, $field->validators()->toData('json'));
          }

          $formRules[$field->name()->value()] = [
            'rules' => array_filter($rules),
          ];
        }
      }
    }
    return $formRules;
  }

  function processRequest($formPage, $form) {
    $form->SaveYamlAction(['page' => $formPage]);

    if (formOption($formPage, 'confirmationEmail.enabled')->toBool()) {
      $form->emailAction([
        'to' => $form->data('email'),
        'from' => formOption($formPage, 'confirmationEmail.from'),
        'subject' => formOption($formPage, 'confirmationEmail.subject'),
      ]);
    }

    if (formOption($formPage, 'notificationEmail.enabled')->toBool()) {
      $form->emailAction([
        'to' => formOption($formPage, 'notificationEmail.to'),
        'from' => formOption($formPage, 'notificationEmail.from'),
        'subject' => formOption($formPage, 'notificationEmail.subject'),
      ]);
    }

    if (formOption($formPage, 'sessionStore')->toBool()) {
      $form->sessionStoreAction(['name' => KirbyForms::getFormId($formPage)]);
    }

    if ($form->success()) {
      // If we use multiple forms on a single page, we have to be able to
      // distinguish which form was successful.
      flash('kirby-forms.success_form_id', get('form_id'));

      $successType = formOption($formPage, 'success.type')->value();
      $successUrl = formOption($formPage, 'success.page')
        ->toPage()
        ?->url();

      if ($successType === 'page' && $successUrl) {
        go($successUrl, 303);
      } else {
        $form->done();
      }
    }
  }
}
