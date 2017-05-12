<!-- Modal -->

<div class="modal fade" id="registerModal" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="backButton" class="close" style="float: left;">&laquo;</button><button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">Open Event Registrations</h4>
      </div>
      <div class="modal-body" id="registration-content">
        <div class="row" id="inner">
          <div id="event-list">
            <?php include_once ("./scripts/events.php"); 
			$rows = fetch_events();
			show_events($rows, 12);
			?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type='button' id='reRegisterButton' class='btn btn-arsenal' style="float: left;">Register for Another Event</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$( document ).ready(function() {
	$("#backButton").hide();
	$("#reRegisterButton").hide();
	$(".registerNowButton").click(function() {
		var in_data = {		
            'id'     : $(this).data("unique")
		}
		$.ajax({
			type     : 'POST',
			url      : '/scripts/eventgen.php',
			data     : in_data,
			dataType : 'text',
            encode   : true
		})
		.done(function(data) {
			$('#event-list').fadeOut("slow");
			var form = $(data).hide();
			if($("#event-form").length) {
				$("#event-form").replaceWith(form);
			} else {
				$("#inner").append(form);
			}
			$("#backButton").delay(500).fadeIn("slow");
			$("#event-form").delay(500).fadeIn("slow");
		});		
	});
	$("#backButton").click(function() {
		$("#event-form").fadeOut("slow");
		$("#backButton").fadeOut("slow");
		$("#success-note").fadeOut("slow");
		$("#event-list").delay(500).fadeIn("slow");
	});
	$("#reRegisterButton").click(function() {
		$("#success-note").fadeOut("slow");
		$("#event-form").fadeOut("slow");
		$("#reRegisterButton").fadeOut("fast");
		$("#event-list").delay(500).fadeIn("slow");
	});
});
</script>