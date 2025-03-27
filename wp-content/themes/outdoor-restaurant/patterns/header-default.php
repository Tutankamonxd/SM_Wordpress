<?php
 /**
  * Title: Default Header
  * Slug: outdoor-restaurant/header-default
  * Categories: outdoor-restaurant
  */
?>

<!-- wp:group {"className":"top-header","style":{"spacing":{"padding":{"left":"0","right":"0","top":"10px","bottom":"10px"}}},"backgroundColor":"foreground","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group top-header has-foreground-background-color has-background" style="padding-top:10px;padding-right:0;padding-bottom:10px;padding-left:0"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"13px"},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontFamily":"montserrat"} -->
<p class="has-text-align-center has-background-color has-text-color has-link-color has-montserrat-font-family" style="font-size:13px"><?php esc_html_e('Unlock 30% OFF Now! Limited Time Offer!','outdoor-restaurant'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"lower-header","style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"var:preset|spacing|40"}}},"backgroundColor":"black","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group lower-header has-black-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--40);padding-left:0"><!-- wp:columns {"verticalAlignment":"center","className":"lower-header-inner"} -->
<div class="wp-block-columns are-vertically-aligned-center lower-header-inner"><!-- wp:column {"verticalAlignment":"center","width":"30%","className":"dummy-clumn"} -->
<div class="wp-block-column is-vertically-aligned-center dummy-clumn" style="flex-basis:30%"></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%","className":"header-logo","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}}} -->
<div class="wp-block-column is-vertically-aligned-center header-logo" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);flex-basis:40%"><!-- wp:site-title {"textAlign":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"400","fontSize":"25px"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontFamily":"bebas-neue"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"30%","className":"header-right-box"} -->
<div class="wp-block-column is-vertically-aligned-center header-right-box" style="flex-basis:30%"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:woocommerce/customer-account {"displayStyle":"icon_only","iconClass":"wc-block-customer-account__account-icon","textColor":"white","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontSize":"9px"}}} /-->

<!-- wp:woocommerce/mini-cart {"miniCartIcon":"bag","iconColor":{"slug":"white","color":"#ffffff","name":"white","class":"has-white-icon-color"},"productCountColor":{"slug":"foreground","color":"#1D1D1D","name":"Foreground","class":"has-foreground-product-count-color"},"style":{"typography":{"fontSize":"15px"}}} /-->

<!-- wp:image {"id":83,"sizeSlug":"full","linkDestination":"none","className":"wishlist-image","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full wishlist-image" style="margin-top:0;margin-bottom:0"><img src="<?php echo get_parent_theme_file_uri( '/images/wishlist.png' ); ?>" alt="" class="wp-image-83"/></figure>
<!-- /wp:image -->

<!-- wp:search {"label":"Search","showLabel":false,"buttonText":"Search","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"className":"header-search","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:navigation {"textColor":"white","overlayBackgroundColor":"background","overlayTextColor":"heading","className":"header-navigation","style":{"typography":{"fontStyle":"normal","fontWeight":"400","textTransform":"uppercase","fontSize":"14px"}},"fontFamily":"montserrat","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:navigation-link {"label":"HOME","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"MENU","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"EVENTS","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"RESERVATION","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"GALLERY","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->
<!-- /wp:navigation --></div>
<!-- /wp:group -->