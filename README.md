# magento-bestseller-product-from-order# Magento Bestseller Product From Order

A Magento 2 module to display bestseller products based on customer orders. This module provides functionality to identify and showcase the most popular products on your e-commerce store based on actual sales data.

## Features

- Automatically calculates bestseller products based on order data.
- Configurable options for time range and product selection.
- Flexible integration with CMS pages, widgets, and blocks.
- Supports customization to match your store's design.

## Installation

Follow the steps below to install the module in your Magento 2 store:

### 1. Clone the Repository
```bash
cd <magento_root>/app/code
mkdir -p DarshilTech/BestsellerProduct
cd DarshilTech/BestsellerProduct
git clone <repository_url> .
```

### 2. Enable the Module
```bash
php bin/magento module:enable DarshilTech_BestsellerProduct
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

### 3. Deploy Static Content (if needed)
```bash
php bin/magento setup:static-content:deploy
```

## Configuration

1. Navigate to the Magento Admin Panel.
2. Go to **Stores > Configuration > DarshilTech > Bestseller Product**.
3. Configure the module settings, such as time range and display options.

## Usage

### Adding a Widget
1. Go to **Content > Widgets**.
2. Add a new widget with type `Bestseller Product`.
3. Configure widget options such as layout, time range, and category filter.

### CMS Block Integration
Use the following code snippet in your CMS block or page to display bestseller products:
```php
{{block class="DarshilTech\BestsellerProduct\Block\Bestseller" template="DarshilTech_BestsellerProduct::bestseller.phtml"}}
```

## Developer Notes

- **Namespace**: `DarshilTech`
- **Module Name**: `BestsellerProduct`
- Fully customizable via layout XML and templates.

## Contribution

Feel free to fork the repository and submit pull requests. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

If you encounter any issues or have questions, please reach out:

- **Email**: support@darshiltech.com
- **GitHub Issues**: [Submit an Issue](<repository_issues_url>)

---

Thank you for using **Magento Bestseller Product From Order**! If you find this module helpful, consider giving it a star on GitHub.

