# Kirby Monolithic Plugin

Plugin setup based on [this cookbook recipe](https://getkirby.com/docs/cookbook/setup/monolithic-plugin-setup).

## Usage

1. Create a repository using this template
1. Clone the resulting repository in your XAMPP/MAMP documents folder
1. `composer install` to install Kirby
1. `npm install -g parcel` to install the [Parcel bundler](https://parceljs.org/) globally
1. `npm run dev` to start Parcel in development mode
1. Open the project in your browser

There are two key files:

- `index.php` is your main plugin file
- `index.site.php` is the test site's index file

## Release

1. `npm run build` to run Parcel in production mode
1. Make sure all site files (like `index.site.php`) and other development-only files are listed in `.gitattributes` so that they're excluded from the release
1. Release on GitHub