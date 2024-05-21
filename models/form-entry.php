<?php

use Kirby\Cms\Page;
use Kirby\Content\Field;

class FormEntryPage extends Page {
  public function title(): Field {
    $date = new DateTime($this->content()->get('form_submitted')->value());
    $format = IntlDateFormatter::RELATIVE_SHORT;
    $language = kirby()->user()->language();
    $displayDate = IntlDateFormatter::formatObject($date, $format, $language);
    return new Field($this, 'title', $displayDate);
  }
}
