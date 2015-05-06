# Naguro connector for WooCommerce
This is the **development repository** of the Naguro connector for WooCommerce. If you are looking for the plug and play plugin, head over to the [plugin page on WordPress.org](https://wordpress.org/plugins/woocommerce-naguro-connect/) where you can download the latest stable.

## Branches and contributing
This repository uses [Semantic Versioning 2.0.0](http://semver.org/). We maintain separate branches for fix releases. At this moment, the following versions are still maintained:

* Version 1.1.x on branch [release-1.1](https://github.com/radishconcepts/woocommerce-naguro-connect/tree/release-1.1)

Please report the version you are working on in any issues you might report and target the correct branch for any pull requests. If you want to provide a bug fix, please target it to the lowest maintenance branch that is still maintained.

### Unmaintained versions
Version 1.0.x is no longer maintained and we recommend that you upgrade as soon as you can.

## Custom template for designer page
Should you want to use a custom template for the designer page (it defaults to using the `page.php` template from your theme), there are two options:

- Add a `naguro-editor.php` file in your (child) theme folder. This will then be used.
- Use the `naguro_editor_template_file` filter to return a path to a custom template file that will then be used.