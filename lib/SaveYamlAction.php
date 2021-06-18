<?php

namespace Uniform\Actions;
use Kirby\Toolkit\I18n;

class SaveYamlAction extends Action {
  public function perform() {
    try {
      $page = page();
      $entries = $page->form_entries()->toData('yaml');

      // `form_name` is only used as a template variable for the email subject
      // so we can omit it before saving the data.
      $data = $this->form->data();
      unset($data['form_name']);
      array_push($entries, $data);

      kirby()->impersonate(
        'kirby',
        fn() => $page->update([
          'form_entries' => \Kirby\Data\Yaml::encode($entries),
        ]),
      );
    } catch (\Exception $e) {
      $this->handleException($e);
    }
  }

  /**
   * @param Exception|Error $e
   */
  protected function handleException($e) {
    $error = $e->getMessage();
    $message = I18n::translate('arnoson.kirby-forms.save-error');
    $message = option('debug') ? "$message: $error" : "$message.";
    $this->fail($message);
  }
}