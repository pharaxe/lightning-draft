CrossOutManager = new Class({
   initialize: function() {
      picks = $('picks');

      card_string = picks.get('data-cards');
      cards = JSON.decode(card_string);

      cube_links = $('cube').contentDocument.getElements('cardPreview');

      console.log(cube_links);
   }


});


window.origin="cubetutor.com";


function cubeLoaded() {
   console.log('here');
   cross_out = new CrossOutManager();
}

