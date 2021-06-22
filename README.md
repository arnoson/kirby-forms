# Kirby Forms

A flexible form builder and handler based on Kirby's layout und block fields and [Kirby Uniform](https://github.com/mzur/kirby-uniform/).

## Features

- 🎨 Form builder using Kirby's built-in layout and blocks fields
- 🔒 Form handling using [Kirby Uniform](https://github.com/mzur/kirby-uniform/)
- ✔️ Client-side and server-side validation
- 📋 View entries directly in the panel
- 📬 Send confirmation and notification emails
- 🔗 Use Post/Redirect/Get pattern to avoid multiple submission

## Installation

Make sure you have [Kirby Uniform](https://github.com/mzur/kirby-uniform/) installed, then install the plugin using Composer:

```shell
composer require arnoson/kirby-forms
```

<details>
  <summary>Manual  installation</summary>
  Download and copy this repository to site/plugins/kirby-forms
</details>

## Getting started

The quickest way to get started is creating a new page with the `form` blueprint provided by the plugin. Now you can build your form in the panel. To render the `form`, use the form snippet inside your template:

```php
snippet('form');
```

## Options

```php
'arnoson.kirby-forms' => [
  // Wether or not to use client validation (in addition to server-side
  // validation done by Kirby Uniform).
  'clientValidation' => true,

  // How many columns to use for the grid that determines the layout of the
  // form. see: https://getkirby.com/docs/reference/panel/fields/layout#calculate-the-column-span-value
  'gridColumns' => 12,

  // Wether or not to use the `autocomplete` attribute for the form element.
  'autoComplete' => false,

  // The email sent to you when the form has received a new registration.
  'notificationEmail' => [
    'active' => false,
    'to' => null,
    'from' => null,
    'subject' => 'New registration in {{form_name}}',
  ],

  // The confirmation email that will be sent to the submitter.
  'confirmationEmail' => [
    'active' => false,
    'from' => null,
    'replyTo' => null, // Uses `from` if empty.
    'subject' => 'Thank you for your registration!',
  ],
]
```
