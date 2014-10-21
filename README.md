# Naguro connector for WooCommerce
Things to not forget, so I better write them down:

* Library needs to be installed via [Composer](https://getcomposer.org/) (currently on `dev-master`).
* Deployments and packaging also needs to load this library.

## Custom template for designer page
Should you want to use a custom template for the designer page (it defaults to using the `page.php` template from your theme), there are two options:

- Add a `naguro-editor.php` file in your (child) theme folder. This will then be used.
- Use the `naguro_editor_template_file` filter to return a path to a custom template file that will then be used.