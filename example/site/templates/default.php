<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $site->title() ?></title>
  <?= css('assets/pico.classless.min.css') ?>
  <style>
    :root {
      --pico-font-size: 1rem;
    }

    html {
      scrollbar-gutter: stable;
    }

    .form-row {
      display: grid;
      gap: var(--pico-spacing);
      grid-template-columns: repeat(12, 1fr);
    }

    .form-column {
      grid-column: span var(--span);
    }

    .form-field {
      display: flex;
      flex-direction: column;
    }

    .form-errors {
      margin-bottom: var(--pico-spacing);
      padding: var(--pico-spacing);
      border-radius: var(--pico-border-radius);
      border: 1px solid var(--pico-del-color);
      background: #ffe9e9;

      & ul, & p {
        margin-bottom: 0;
        color: var(--pico-del-color);
      }
    }

    .uniform__potty {
      position: absolute;
      left: -9999px;
    }
  </style>  
</head>
<body>
  <main>
    <h1><?= $page->title() ?></h1>
    
    <section>
      <h2><?= page('forms/workshop')->title() ?></h2>
      <?php snippet('form', ['formPage' => page('forms/workshop')]); ?>
    </section>

    <hr>
    
    <section>
      <h2><?= page('forms/contact')->title() ?></h2>
      <p>To test multiple forms per page, we also add a little contact form which is independent of the workshop form above.</p>
      <?php snippet('form', ['formPage' => page('forms/contact')]); ?>
    </section>
  </main>
</body>
</html>





