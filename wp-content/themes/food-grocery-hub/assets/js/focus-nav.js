( function( window, document ) {
  function food_grocery_hub_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const food_grocery_hub_nav = document.querySelector( '.sidenav' );
      if ( ! food_grocery_hub_nav || ! food_grocery_hub_nav.classList.contains( 'open' ) ) {
        return;
      }
      const elements = [...food_grocery_hub_nav.querySelectorAll( 'input, a, button' )],
        food_grocery_hub_lastEl = elements[ elements.length - 1 ],
        food_grocery_hub_firstEl = elements[0],
        food_grocery_hub_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;
      if ( ! shiftKey && tabKey && food_grocery_hub_lastEl === food_grocery_hub_activeEl ) {
        e.preventDefault();
        food_grocery_hub_firstEl.focus();
      }
      if ( shiftKey && tabKey && food_grocery_hub_firstEl === food_grocery_hub_activeEl ) {
        e.preventDefault();
        food_grocery_hub_lastEl.focus();
      }
    } );
  }
  food_grocery_hub_keepFocusInMenu();
} )( window, document );