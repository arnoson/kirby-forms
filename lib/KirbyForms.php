<?php

namespace arnoson\KirbyForms;

class KirbyForms {
  protected static $instance = null;

  public static function getInstance() {
    return self::$instance ??= new self();
  }

  /**
   * Generate the form rules for the specified form page for use with
   * Kirby Uniform.
   *
   * @param Kirby\Cms\Page $formPage
   */
  function formRules($formPage): array {
    $formRules = [
      // `form_name` is a hidden field we send with every form.
      'form_name' => [],
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

  /**
   * Send a notification email containing the registration data.
   * @param Uniform\Form $form
   */
  function sendNotificationEmail($form) {
    if (option('arnoson.kirby-forms.notificationEmail.active')) {
      $form->emailAction([
        'to' => option('arnoson.kirby-forms.notificationEmail.to'),
        'from' => option('arnoson.kirby-forms.notificationEmail.from'),
        'subject' => option('arnoson.kirby-forms.notificationEmail.subject'),
      ]);
    }
  }

  /**
   * Send a confirmation mail to the user. An email field has be present in the
   * form data!
   * @param Uniform\Form $form
   */
  function sendConfirmationEmail($form) {
    if (
      option('arnoson.kirby-forms.confirmationEmail.active') &&
      $form->data('email')
    ) {
      $from = option('arnoson.kirby-forms.confirmationEmail.from');
      $form->emailAction([
        'to' => $form->data('email'),
        'from' => $from,
        'replyTo' => option(
          'arnoson.kirby-forms.confirmationEmail.replyTo',
          $from,
        ),
        'subject' => option('arnoson.kirby-forms.confirmationEmail.subject'),
        'template' => 'form-registration-success',
      ]);
    }
  }

  /**
   * @param \Kirby\Cms\Page $formPage
   * @param \Uniform\Form $form
   */
  function processRequest($formPage, $form) {
    if (
      kirby()
        ->request()
        ->is('POST')
    ) {
      $form->SaveYamlAction();
      $this->sendNotificationEmail($form);
      $this->sendConfirmationEmail($form);

      if ($form->success()) {
        // Even if no success page is set, we have to do a redirect to prevent
        // another form submission on reload (Post/Redirect/Get pattern).
        $successUrl =
          fieldNotEmpty($formPage->form_success_page()->url()) ??
          url($formPage->url(), ['params' => ['submit' => 'success']]);

        go($successUrl);
      }
    }
  }
}