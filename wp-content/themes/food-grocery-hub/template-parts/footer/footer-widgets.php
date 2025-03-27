<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Food Grocery Hub
 * @subpackage food_grocery_hub
 */
?>
<?php

// Determine the number of columns dynamically for the footer (you can replace this with your logic).
$food_grocery_hub_no_of_footer_col = get_theme_mod('food_grocery_hub_footer_columns', 4); // Change this value as needed.

// Calculate the Bootstrap class for large screens (col-lg-X) for footer.
$food_grocery_hub_col_lg_footer_class = 'col-lg-' . (12 / $food_grocery_hub_no_of_footer_col);

// Calculate the Bootstrap class for medium screens (col-md-X) for footer.
$food_grocery_hub_col_md_footer_class = 'col-md-' . (12 / $food_grocery_hub_no_of_footer_col);
?>
<div class="container">
    <aside class="widget-area row py-2 pt-3" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'food-grocery-hub' ); ?>">
        <div class="<?php echo esc_attr($food_grocery_hub_col_lg_footer_class); ?> <?php echo esc_attr($food_grocery_hub_col_md_footer_class); ?>">
            <?php dynamic_sidebar('footer-1'); ?>
        </div>
        <?php
        // Footer boxes 2 and onwards.
        for ($food_grocery_hub_i = 2; $food_grocery_hub_i <= $food_grocery_hub_no_of_footer_col; $food_grocery_hub_i++) :
            if ($food_grocery_hub_i <= $food_grocery_hub_no_of_footer_col) :
                ?>
               <div class="col-12 <?php echo esc_attr($food_grocery_hub_col_lg_footer_class); ?> <?php echo esc_attr($food_grocery_hub_col_md_footer_class); ?>">
                    <?php dynamic_sidebar('footer-' . $food_grocery_hub_i); ?>
                </div><!-- .footer-one-box -->
                <?php
            endif;
        endfor;
        ?>
    </aside>
</div>