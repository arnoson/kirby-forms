# Kirby Forms

A flexible form builder and handler based on Kirby's layout und block fields and [Kirby Uniform](https://github.com/mzur/kirby-uniform/).

## Features

- 🎨 Form builder using Kirby's built-in layout and blocks fields
- 🔒 Form handling using [Kirby Uniform](https://github.com/mzur/kirby-uniform/)
- ✔️ Client-side and server-side validation
- 📋 View entries directly in the panel
- 📬 Send confirmation and notification emails
- 🔗 Use Post/Redirect/Get pattern to avoid multiple submission

## Demo

https://user-images.githubusercontent.com/15122993/122928073-cd0adc80-d369-11eb-8a02-4d5275cc5da9.mp4

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

Most options can be configured per form in the Panel:

These global options can only be set in the plugin's config:

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

  // Wether ot not to render the previous values in the form (e.g.: in the case
  // a form submit wasn't successful and the form is shown again to the user)
  'showOldValues' => true,
]
```

## Entries

Form entries will be saved directly in the form page and can be viewed/deleted/edited in the panel:
