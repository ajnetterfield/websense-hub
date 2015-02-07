$(document).ready(function() {

  /* Scroll to top of page */
  $("a[href='#top']").click(function() {
    $("html, body").animate( { scrollTop: 0 }, { duration: 1500, easing: 'easeInOutCubic' } );
    return false;
  });

  /* Autofocus modal input fields */
  $('.modal').on('shown.bs.modal', function() {
    $(this).find('[autofocus]').focus();
  });

});

$(function(){
   function hideMessages(){
      $("#messages").slideUp();
   };
   window.setTimeout(hideMessages, 5000);
});

function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function getMessages() {
	$.ajax({
		type: 'POST',
		async: true,
			dataType: 'html',
			data: {},
			url: '/app/ajax/getmessages.php',
		success: function(data) {
			document.getElementById("messages").innerHTML += data;
		},
		statusCode: {
			204: function() {
				alert("Status 202");
			},
			404: function() {
				alert("Status 404");
			}
		}
	});
}
