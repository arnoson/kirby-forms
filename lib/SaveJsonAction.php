<?php

namespace Uniform\Actions;
use Kirby\Toolkit\I18n;

class SaveJsonAction extends Action {
  public function perform() {
    try {
      $page = page();
      $entries = $page->form_entries()->toData('json');
      array_push($entries, $this->form->data());
      kirby()->impersonate(
        'kirby',
        fn() => $page->update([
          'form_entries' => \Kirby\Data\Json::encode($entries),
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
    $message = I18n::translate('forms-json-save-error');
    $message = option('debug') ? "$message: $error" : "$message.";
    $this->fail($message);
  }
}