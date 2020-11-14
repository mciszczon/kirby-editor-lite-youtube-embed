# Kirby Editor Block: Lite YouTube Embed
> Kirby Editor custom block to render `lite-youtube-embed` custom element based on
> [Paul Irish's custom HTML element](https://github.com/paulirish/lite-youtube-embed).

## Installation

### Step 1: Plugin installation

You can either use `composer` automatic installation, which is the preferred way:

```
$ composer require mciszczon/kirby-editor-lite-youtube-embed
```

or you can simply clone this repository to your plugins folder inside the Kirby CMS installation folder
(that's `/your_project/site/plugins/`):

```
$ git clone git@github.com:mciszczon/kirby-editor-lite-youtube-embed.git
```

### Step 2: Setting up `lite-youtube-embed` assets

After that you will still need to include additional `lite-youtube-embed` assets in your templates,
otherwise the plugin will not work.

Again, you could go two ways here:

1. You might want to manually install the package and manually include its assets into your current
    css and js assets;
2. Or you can use assets that's already provided by this plugin.

If you choose to use the out-of-box-available assets provided by the plugin, call these in templates
where the plugin is used:

```php
<?= css('/media/plugins/mciszczon/kirby-editor-lite-youtube-embed/index.css') ?>
<?= js('/media/plugins/mciszczon/kirby-editor-lite-youtube-embed/index.js') ?>
```