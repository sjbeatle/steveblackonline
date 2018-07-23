/* Wait for the DOM to be available before doing any work */
window.addEvent('domready', function() {  
 
/* Find all elements in the DOM with a class of .slide
   they hold the content to show or hide. 
   $$('.class') returns an Array of found elements
*/
var sliders = $$(".slide");
 
/* Find all elements with a class of slide_trigger
   they will capture the click event.
*/
var triggers = $$(".slide_trigger") ;
 
/* sliders and triggers are arrays!! */
 
/* For each instance of .slide_trigger triggers[x] (note the anonymous function)*/ 
triggers.each(function( o, x ){ 	
 
	var sl = new Fx.Slide( sliders[x], { } );	/* Instantiate a new slider effect on the matching .slide element */
 
		$(triggers[x]).addEvent('click',function(e){  /* Add a click event to the [x]th trigger */
		e = new Event(e);			  /* the event */
		sl.toggle();				  /* Toggle the slider condition */
		e.stop(); 				  /* Stop the event from bubbling */
		})					  
		sl.hide(); 				  /* Hide the slider */
		});	// end of triggers.each
 
}  ) // end of window.addevent