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

https://user-images.githubusercontent.com/15122993/228290335-425006b7-7216-4f05-b670-73a78c5761ce.mp4

## Installation

Make sure you have [Kirby Uniform](https://github.com/mzur/kirby-uniform/) installed, then install the plugin using Composer:

```shell
composer require arnoson/kirby-forms
```

## Getting started

The quickest way to get started is creating a new page with the `form` blueprint provided by the plugin. Now you can build your form in the panel. To render the `form`, use the form snippet inside your template:

```php
snippet('form');
```

## Options

Most options can be configured per form in the Panel:

![Screenshot 2023-03-28 at 17-02-32 Contact Form Plugin](https://user-images.githubusercontent.com/15122993/228284465-fbe9b5c8-8710-484c-84b2-06f94c3a7e5f.png)

These global options can only be set in the plugin's config:

```php
'arnoson.kirby-forms' => [
  // A list of email addresses that can be selected in the panel as the sender
  // of confirmation and notification emails.
  'fromEmails' => [],

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

![Screenshot 2023-03-28 at 17-08-09 Contact Form Plugin](https://user-images.githubusercontent.com/15122993/228284748-7b3bfa28-2f87-486a-8e9a-005c42a5ff14.png)

## Using Different Layouts

By creating your own `fields/form-fields` blueprint, you can overwrite the possible layouts in the form builder. Use this [file](https://github.com/arnoson/kirby-forms/blob/master/blueprints/fields/form-fields.yml) as a starting point.

## Adding Custom Fields

The easiest way to add your own custom fields is to start with the [example](https://github.com/arnoson/kirby-forms/tree/master/example/site/plugins/custom-form-fields).

Custom fields consist of

- A block blueprint (defining the field settings like `required`, `min`, `max`, ...)
- A block snippet (to render the fields on the form)

The block name must follow the naming convention of `form-field-<panel-field-name>`, where `<panel-field-name>` is a [panel field](https://getkirby.com/docs/reference/panel/fields), used to render the field's value in the [Entries](#entries) view.

Ideally, a custom field should also have a [block preview](https://getkirby.com/docs/cookbook/panel/custom-block-type#simple-index-js).

To show your custom field as an option in the Kirby Forms form builder, you have to override the `fields/form-fields` blueprint, see the [example](https://github.com/arnoson/kirby-forms/tree/master/example/site/blueprints/fields/form-fields.yml).

## Contribute

Contributions to the plugin and it's documentation are welcome :~) Please make sure you:

- use prettier to format your code (should happen automatically if you work on this project in VSCode)
- use [conventional commits](https://www.conventionalcommits.or) (these are used to automatically generate release messages, including credits for your contributions)

To get started have a look at the `package.json`.
