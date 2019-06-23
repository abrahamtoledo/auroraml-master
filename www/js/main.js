
$(function(){
	$(window).on('scroll', function() {
	   var sections = ['#top', '#aurorasuite', '#nautafirewall', '#nautacleaner', '#contact'];
	   sections.forEach(function(section) {
		  var sectionObj = $(section);
		  if (!sectionObj.length)
		    // No se encontro un elemento con ese id
			return;
	   
		  if ($(window).scrollTop() + 100 >= sectionObj.position().top) {
			if (!$('.navbar .nav a[data-target="'+ section +'"]').hasClass('active')) {
			  $('.navbar a').removeClass('active'); // eliminamos la clase active del que la tenga
			  $('.navbar .nav a[data-target="'+ section +'"]').addClass('active');
			}
		  }
		});
	});
    
    $("#contact-form").submit(function(){
        var btn = $(this).find("button");
        btn.button('loading');
        
        $.ajax({
          data: { 
              contact_from: $('input#contact_from').val(),
              contact_name: $('input#contact_name').val(),
              contact_subject: $('input#contact_subject').val(),
              contact_text: $('textarea#contact_text').val()
          },
          dataType: "json",
          url: "contact.php",
          type: "post",
          
          success: function(res){
              btn.button('reset');
              onSubmitSuccess(res);
          }
           
       });
        
        
       return false; 
    });
});

function onSubmitSuccess(res){
    var alertObj = $("<div></div>")
            .addClass("alert")
            .addClass("alert-dismissible")
            .attr("role", "alert")
            .append('<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>')
            
    if (parseFloat(res['ok'])){
        alertObj
            .addClass("alert-success")
            .append("Hemos recibido su mensaje, el soporte se pondrá en contacto con usted lo antes posible");
    }else{
        alertObj
            .addClass("alert-danger")
            .append("<strong>Error :</strong> " + res['reason']);
    }
    
    $("#contact-form").prepend(alertObj);
}