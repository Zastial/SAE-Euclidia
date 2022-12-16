function openTab(evt, tabName) {
  $('.content').css('display', 'none');
  $('#'+tabName).css('display', 'block');
  $('.table').removeClass('active');
  $(evt.currentTarget).addClass('active');
} 


/* Button to go to the top of the page instead of scrolling*/


// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
