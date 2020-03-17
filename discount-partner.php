<?php
/**
 * Plugin Name: Discount Partner
 * Description: Add partner registration for pages where visitors can apply for discounts
 * Version: 1.0.0
 * Author: Raphael Batagini
 * Author URI: https://www.linkedin.com/in/raphael-batagini/
 * Text Domain: discount-partner
 * Domain Path: /languages/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

define('TEXT_DOMAIN', 'discount-partner');

require __DIR__ . '/inc/cpts.php';
require __DIR__ . '/inc/filters.php';
require __DIR__ . '/inc/enqueue.php';