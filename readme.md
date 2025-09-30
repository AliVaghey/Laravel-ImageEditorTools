# Laravel ImageEditorTools

A lightweight Laravel 12 package for image manipulation and optimization. Built for speed, simplicity, and developer happiness.

I'm building on top of it over time — no fixed roadmap, just creative evolution.

## 🚀 Features

- Resize images with custom dimensions
- Facade and helper support for clean usage
- Designed for Laravel 12+ with auto-discovery

## 📦 Installation

Install via Composer:

```bash
composer require vaghey/image-editor-tools
```

## ⚙️ Configuration

No manual provider registration needed — Laravel auto-discovers the service provider, facade, and helper.

## 🧩 Usage

### Using the Facade

```php
use Vaghey\ImageEditor\Facades\ImageEditor;

ImageEditor::make($sourcePath)->resizeToWidth();
```

### Using the Helper

```php
imageEditor($sourcePath)->resizeToWidth();
```

> The `imageEditor()` helper is autoloaded via Composer. Just be mindful of potential naming collisions if you already have a function with the same name 😁

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).
