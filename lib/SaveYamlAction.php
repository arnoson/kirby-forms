<?php

namespace Uniform\Actions;
use Kirby\Toolkit\I18n;

class SaveYamlAction extends Action {
  public function perform() {
    try {
      $data = $this->form->data();
      $formPage = page($data['form_slug']);

      // We don't need `form_slug` and `form_name` (used for email subject)
      // anymore.
      unset($data['form_name']);
      unset($data['form_slug']);

      $entries = $formPage->form_entries()->toData('yaml');
      $entries[] = $data;

      kirby()->impersonate(
        'kirby',
        fn() => $formPage->update([
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