<?php

use Kirby\Cms\Page;
use Uniform\Actions\Action;

class WaitListAction extends Action {
  public function perform() {
    $page = $this->option('page');
    $form = $this->form;

    if ($page->confirmationEmailWorkshop_enabled()->toBool()) {
      $toEmailName = $page->confirmationEmailWorkshop_to()->value();
      $toEmail = $form->data($toEmailName);
      if ($toEmail) {
        $participants = count($page->form_entries()->yaml());
        $maxParticipants = $page->max_participants()->toInt();
        $isWaitList = $participants >= $maxParticipants;
        $body = $isWaitList
          ? $page->confirmationEmailWorkshop_body_waitlist()->value()
          : $page->confirmationEmailWorkshop_body()->value();

        $form->emailAction([
          'to' => $toEmail,
          'from' => $page->confirmationEmail_from()->value(),
          'subject' => $page->confirmationEmail_subject()->value(),
          'body' => $body,
        ]);
      }
    }
  }
}

class FormWorkshopPage extends Page {
  public function actions() {
    return [WaitListAction::class];
  }
}
