<?php

namespace Uniform\Actions;

use DateTime;
use Error;
use Kirby\Toolkit\A;
use Kirby\Toolkit\I18n;
use Kirby\Uuid\Uuid;

class SaveEntryAction extends Action {
  public function perform() {
    try {
      $data = $this->form->data();
      /** @var \Kirby\Cms\Page */
      $page = $this->option('page');

      // We don't need `form_name` (used for email subject) and `form_id` (used
      // to differentiate multiple forms on a single page) anymore.
      unset($data['form_name']);
      unset($data['form_id']);

      $uuid = Uuid::generate();
      kirby()->impersonate(
        'kirby',
        fn() => $page->createChild([
          'slug' => $uuid,
          'template' => 'form-entry',
          'sortby' => date('c'),
          'draft' => false,
          'content' => array_merge($data, [
            'uuid' => $uuid,
            'form_submitted' => date('c'),
          ]),
        ])
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