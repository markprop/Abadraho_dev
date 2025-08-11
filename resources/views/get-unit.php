<script type="text/javascript">
    //---AJAX Call for staffs

$("#check_id").click(function() {
    getunits($("#check_id"));
});

function getunits(elem){
    var project_id = elem.val();
    console.log(project_id);
    if($('#units').length){
        var baseurl = "<?php echo url('/'); ?>"
	    
	    // $.get( baseurl + '/getunits?check_id='+project_id+'&format=array' , function(htmlCode){
	    //     $("#units > div").remove();
		//     $.each(htmlCode, function( index, value ){
		//        $('#units').append($('<div>').html(htmlCode[index]['FullName']).attr('value', htmlCode[index]['UserID']));
		//     });
		// });
    }
}
</script>