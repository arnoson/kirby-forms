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
          $pattern = $field->pattern()->value();
          $rules = [
            'required' => $field->required()->toBool(),
            'min' => $field->min()->value(),
            'max' => $field->max()->value(),
            'minLength' => $field->min_length()->value(),
            'maxLength' => $field->max_length()->value(),
            // Html's `pattern` attribute doesn't want the regexp's enclosing `/`
            // while uniform needs it.
            'match' => $pattern ? "/$pattern/" : null,
          ];

          // In the hidden `validators` field additional validators can be
          // stored as json. Example: ["email", "min" => 3]
          if ($field->validators()->isNotEmpty()) {
            $rules = array_merge($rules, $field->validators()->toData('json'));
          }

          $formRules[$field->name()->value()] = [
            'rules' => array_filter($rules),
            'message' => $field->error()->value(),
          ];
        }
      }
    }
    return $formRules;
  }

  function processRequest($formPage, $form) {
    $form->SaveYamlAction(['page' => $formPage]);

    if ($formPage->confirmationEmail_enabled()->toBool()) {
      $form->emailAction([
        'to' => $form->data('email'),
        'from' => $formPage->confirmationEmail_from()->value(),
        'subject' => $formPage->confirmationEmail_subject()->value(),
        'template' => $formPage
          ->confirmationEmail_template()
          ->or(null)
          ->value(),
        'body' => $formPage->confirmationEmail_body()->value(),
      ]);
    }

    if ($formPage->notificationEmail_enabled()->toBool()) {
      $form->emailAction([
        'to' => $formPage->notificationEmail_to()->value(),
        'from' => $formPage->notificationEmail_from()->value(),
        'subject' => $formPage->notificationEmail_subject()->value(),
        'template' => $formPage
          ->notificationEmail_template()
          ->or(null)
          ->value(),
        'body' => $formPage->notificationEmail_body()->value(),
      ]);
    }

    if ($formPage->sessionStore()->toBool()) {
      $form->sessionStoreAction(['name' => KirbyForms::getFormId($formPage)]);
    }

    if ($form->success()) {
      // If we use multiple forms on a single page, we have to be able to
      // distinguish which form was successful.
      flash('kirby-forms.success_form_id', get('form_id'));

      $successType = $formPage->success_type()->value();
      $successUrl = $formPage->success_page()->toPage()?->url();

      if ($successType === 'page' && $successUrl) {
        go($successUrl, 303);
      } else {
        $form->done();
      }
    }
  }
}
