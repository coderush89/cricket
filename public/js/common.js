$(document).ready(function() {

  //profile show form
  $(".showhide").click(function() { 
     $('#'+$(this).attr('data-show-id')).removeClass('d-none');
     $('#'+$(this).attr('data-hide-id')).addClass('d-none');
  });

  //publicinfo update
  $("#savepublicinfo").click(function() {
  	var public_name = $("#public_name_field").val();
  	var support_center_language = $("#support_center_language_field").val(); 
    
    $("#publicinfosuccessbox").html('').addClass('d-none');
    $("#publicinfofailurebox").html('').addClass('d-none');
    // $("#public_name_field").removeClass('is-invalid').attr('disabled',true);
    // $("#support_center_language_field").attr('disabled',true); 
    $('#publicinfoform .errortag').addClass('d-none');


 
    var savebtn = $(this); 
    savebtn.html(savebtn.attr('data-loading-text')).attr('disabled',true); 

    $.ajax({
        type: 'post', 
        url: $('#publicinfoform').attr('action'),
        data: {public_name:public_name,support_center_language:support_center_language,_token:$("#publicinfoform input[name='_token']").val()}, 
        success: function (result) {
          var response = JSON.parse(result); 
          if(response.status==true) {
          	$("#public_name_text").html(response.data.public_name);
          	$("#public_name_field").val(response.data.public_name);
          	$("#support_center_language_field").val(response.data.support_center_language);
          	$("#preffered_language_text").html(response.data.support_center_language_text);
            $("#publicinfosuccessbox").html(response.msg).removeClass('d-none');

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#publicinfotext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
			    $("#publicinfotext .msginfo").slideUp(500);
			    });
          } else if(response.status=='validationerror'){ 
          	if( response.errors ) {
                    var errors = response.errors;
                    $.each(errors, function (key, val) {
                    	$("input[name='"+key+"']").addClass('is-invalid');
                    	$("#" + key + "_error ").removeClass('d-none');
                        $("#" + key + "_error > strong").text(val[0]);
                    });
            }
          } else {
           $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#publicinfotext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
          $("#publicinfotext .msginfo").slideUp(500);
          });
          	$("#publicinfofailurebox").html(response.msg).removeClass('d-none');
          }

          savebtn.html(savebtn.attr('data-original-text')).attr('disabled',false); 
        }
      });  
  }); 
  
  //personalinfo update
  $("#country").change(function() { 
    var countryid = $(this).val();
    var url = $(this).attr('getstatesurl');
    
    $("#stateloader").removeClass('d-none');

    $.ajax({
        type: 'post', 
        url: url, 
        data:{country_id:countryid,_token:$("#personalinfoform input[name='_token']").val()},
        success: function (result) {
          var response = JSON.parse(result);  

          $("#state").html(response.states);
          $('.select-nice').niceSelect('update');
          $("#stateloader").addClass('d-none');
        }
      }); 	  
  });

    //personalinfo update
  $("#savepersonalinfo").click(function() {
 
    $("#personalinfosuccessbox").html('').addClass('d-none');
    $("#personalinfofailurebox").html('').addClass('d-none');
    // $("#public_name_field").removeClass('is-invalid').attr('disabled',true);
    // $("#support_center_language_field").attr('disabled',true); 
    $('#personalinfoform .errortag').addClass('d-none');

 
    var savebtn = $(this); 
    savebtn.html(savebtn.attr('data-loading-text')).attr('disabled',true); 
    var formData = new FormData($('#personalinfoform')[0]); 

    $.ajax({
        type: 'post', 
        processData: false,
        contentType: false,
        url: $('#personalinfoform').attr('action'),
        data:formData,
        success: function (result) {
          var response = JSON.parse(result); 
          if(response.status==true) {
          	$('#first_name').val(response.data.first_name);
	        $('#last_name').val(response.data.last_name);
	        $('#company').val(response.data.company);
	        $('#address1').val(response.data.address1); 
	        $('#address2').val(response.data.address2);
	        $('#city').val(response.data.city);
	        $('#state').val(response.data.state);
	        $('#postal_code').val(response.data.postal_code);
	        $('#country').val(response.data.country);
	        $('#mobile').val(response.data.phone_number);

	        $('#name_text').html(response.data.first_name+' '+response.data.last_name);
	        $('#company_text').html(response.data.company);
	        $('#address_text').html(response.data.address1+' '+response.data.city+' '+response.data.statename+' '+response.data.countryname);
	        $('#phone_number_text').html(response.data.phone_number); 

            $("#personalinfosuccessbox").html(response.msg).removeClass('d-none');

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#personalinfotext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
			    $("#personalinfotext .msginfo").slideUp(500);
			});
          } else if(response.status=='validationerror'){ 
          	if( response.errors ) {
                var errors = response.errors;
                $.each(errors, function (key, val) {
                	$("[name='"+key+"']").addClass('is-invalid');
                	$("#" + key + "_error ").removeClass('d-none');
                    $("#" + key + "_error > strong").text(val[0]);
                });
            }
          } else {

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#personalinfotext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
          $("#personalinfotext .msginfo").slideUp(500);
          });
          	$("#personalinfofailurebox").html(response.msg).removeClass('d-none');
          }

          savebtn.html(savebtn.attr('data-original-text')).attr('disabled',false); 
        }
      });  
  }); 

  //change password
  $('#changepasswordbtn').click(function() {
      
    $("#changepwdsuccessbox").html('').addClass('d-none');
    $("#changepwdfailurebox").html('').addClass('d-none'); 
    $('#frmchangepassword .errortag').addClass('d-none');
    $("#changepasswordtext .msginfo").html('').addClass('d-none');

    var savebtn = $(this); 
    savebtn.html(savebtn.attr('data-loading-text')).attr('disabled',true); 
    var formData = new FormData($('#frmchangepassword')[0]); 
    
    $.ajax({
        type: 'post', 
        processData: false,
        contentType: false,
        url: $('#frmchangepassword').attr('action'),
        data: formData,
        success: function (result) {
          var response = JSON.parse(result); 
          if(response.status==true) { 
            $("#changepwdsuccessbox").html(response.msg).removeClass('d-none');

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#changepasswordtext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
			    $("#changepasswordtext .msginfo").slideUp(500);
			    });
          } else if(response.status=='validationerror'){ 
          	if( response.errors ) {
                    var errors = response.errors;
                    $.each(errors, function (key, val) {
                    	$("input[name='"+key+"']").addClass('is-invalid');
                    	$("#" + key + "_error ").removeClass('d-none');
                        $("#" + key + "_error > strong").text(val[0]);
                    });
            }
          } else if(response.status=='currentpassworderror') {
          	$("#currentpassword").addClass('is-invalid');
          	$("#currentpassword_error").removeClass('d-none');
          	$("#currentpassword_error > strong").text(response.errors);
          } else {
                $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#changepasswordtext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
          $("#changepasswordtext .msginfo").slideUp(500);
          });
          	$("#changepwdfailurebox").html(response.msg).removeClass('d-none');
          }

          savebtn.html(savebtn.attr('data-original-text')).attr('disabled',false); 
        }
      });  
  });

  $("#changeemailbtn").click(function() {

    $("#changeemailsuccessbox").html('').addClass('d-none');
    $("#changeemailfailurebox").html('').addClass('d-none'); 
    $('#frmchangeemail .errortag').addClass('d-none');
    $("#changepasswordtext .msginfo").html('').addClass('d-none');
 
    var savebtn = $(this); 
    savebtn.html(savebtn.attr('data-loading-text')).attr('disabled',true); 
    var formData = new FormData($('#frmchangeemail')[0]); 
    
    $.ajax({
        type: 'post', 
        processData: false,
        contentType: false,
        url: $('#frmchangeemail').attr('action'),
        data: formData,
        success: function (result) {
          var response = JSON.parse(result); 
          if(response.status==true) { 
          	$("#newemail").val('');
          	$("#newemail_confirmation").val('');
          	$("#email_text").html(response.data.email);
            $("#changeemailsuccessbox").html(response.msg).removeClass('d-none');

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#changepasswordtext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
			    $("#changepasswordtext .msginfo").slideUp(500);
			});
          } else if(response.status=='validationerror'){ 
          	if( response.errors ) {
                    var errors = response.errors;
                    $.each(errors, function (key, val) {
                    	$("input[name='"+key+"']").addClass('is-invalid');
                    	$("#" + key + "_error ").removeClass('d-none');
                        $("#" + key + "_error > strong").text(val[0]);
                    });
            }
          } else {

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');

            $("#changepasswordtext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
          $("#changepasswordtext .msginfo").slideUp(500);
      });
          	$("#changeemailfailurebox").html(response.msg).removeClass('d-none');
          }

          savebtn.html(savebtn.attr('data-original-text')).attr('disabled',false); 
        }
      });  
  });

  
  $("#notificationsave").click(function() {

    $("#notificationsuccessbox").html('').addClass('d-none');
    $("#notificationfailurebox").html('').addClass('d-none'); 
    // $('#frmnotificationbulletin .errortag').addClass('d-none');
 
    var savebtn = $(this); 
    savebtn.html(savebtn.attr('data-loading-text')).attr('disabled',true); 
    var formData = new FormData($('#frmnotificationbulletin')[0]); 
    
    $.ajax({
        type: 'post', 
        processData: false,
        contentType: false,
        url: $('#frmnotificationbulletin').attr('action'),
        data: formData,
        success: function (result) {
          var response = JSON.parse(result); 
          if(response.status==true) {   
            
            //update notificatin details area
            $(".checkedtc").each(function() {
              var tickid = $(this).attr('data-id');
              if($(this).is(':checked')==true) {
                $("#tc_"+tickid).removeClass('fa-times cross');
                $("#tc_"+tickid).addClass('fa-check tick');
              } else {
                $("#tc_"+tickid).removeClass('fa-check tick');
                $("#tc_"+tickid).addClass('fa-times cross');
              }
            });

            $(".checkedtcb").each(function() {
              var tickid = $(this).attr('data-b-id');
              if($(this).is(':checked')==true) {
                $("#tcb_"+tickid).removeClass('fa-times cross');
                $("#tcb_"+tickid).addClass('fa-check tick');
              } else {
                $("#tcb_"+tickid).removeClass('fa-check tick');
                $("#tcb_"+tickid).addClass('fa-times cross');
              }
            });  


            $("#notificationsuccessbox").html(response.msg).removeClass('d-none');

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');


            $("#notificationbulletinstext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
              $("#notificationbulletinstext .msginfo").slideUp(500);
            });
 
          } else {
            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');


            $("#notificationbulletinstext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
              $("#notificationbulletinstext .msginfo").slideUp(500);
            });
            $("#notificationfailurebox").html(response.msg).removeClass('d-none');
          }

          savebtn.html(savebtn.attr('data-original-text')).attr('disabled',false); 
        }
      });  
  });

  //manage parent child checkbox click
  $(".checkedtcb").click(function () {
     var parentid = $(this).attr('data-b-id');

     if($(this).is(':checked')==true) {
      $(".child_"+parentid).prop('checked',true); 
     } else {
      $(".child_"+parentid).prop('checked',false); 
     }
     
  });

  var $checkboxes = $('.childchecks');

  $checkboxes.change(function(){
    var $checkedboxes = $(".child_"+$(this).attr('parent'));
    var countCheckedCheckboxes = $checkedboxes.filter(':checked').length;

    if(countCheckedCheckboxes==0) { 
      $("#customCheck05"+$(this).attr('parent')).prop('checked',false);
    } else {
      $("#customCheck05"+$(this).attr('parent')).prop('checked',true);
    } 
  });
   
    
    // $('.languageDropdown').on('mouseover', function (e) {
    //     e.stopPropagation();
    //     $('.lngdd').toggleClass('dropdownshow');
    // });
    // $(document).on('click', function (e) {
    //     $('.lngdd').removeClass('dropdownshow');
    // });

    $(".lngref").click(function() {
        window.location.href = $(this).attr('href');                  
    });


    //add more email
    $("#addMoreEmail").click(function() {
        var emaillabel=$(this).attr('data-email-label');
        var reemaillabel = emaillabel;
        var cclabel=$(this).attr('data-cc-label');
        var currentEmailLength = $(".alternateemailrow").length;
        var removetext = $(this).attr('data-remove-text'); 
        var nextEmail = parseInt(currentEmailLength)+1;
        var emaillabel = emaillabel+' '+nextEmail; 
        
        $("#alternateemailbox").append(`<div class="row alternateemailrow rowid`+nextEmail+`" id="`+nextEmail+`"><div class="col-sm-4"><div class="form-group"><label class="lbid" for="">`+emaillabel+`</label>
                          <input type="text" name="alternateemail[`+nextEmail+`]" class="form-control alternateemailbox">
                          <span id="alternateemail_error_`+nextEmail+`" class="invalid-feedback d-none errortag" role="alert">
                          <strong></strong>
                          </span>
                          <div class="custom-control custom-checkbox mt-2">
                              <input type="checkbox" class="custom-control-input cccheck" name="cc[`+nextEmail+`]" id="emailcustomCheck`+nextEmail+`">
                              <label class="custom-control-label cclabel" for="emailcustomCheck`+nextEmail+`">`+cclabel+`</label>
                           </div> 
                           <span class="add-remove remove-field" id="removeEmail" data-email-label="`+reemaillabel+`" data-remove-id="`+nextEmail+`"><i class="fas fa-times-circle"></i>&nbsp;`+removetext+`</span>
                        </div> 
                      </div>                    
                      </div>`);              
    });

    $(document).delegate('#removeEmail','click',function() {
        var removeid = $(this).attr('data-remove-id');
        var previousid = parseInt(removeid)-1;
        var allsiblings = $(".rowid"+removeid).nextAll('.alternateemailrow'); 
        var emaillabel = $(this).attr('data-email-label');
        // console.log(allsiblings);
        var nextid = previousid+1;
        allsiblings.each(function() {
          // console.log($(this).attr('class'));
          
          // $(this).removeClass('rowid'+nextid);
          var classes = $(this).attr('class');
          var newclasses = classes.replace(/rowid+/g, " ");
          $(this).attr('class',newclasses); 
          $(this).addClass('rowid'+nextid);
          $(this).attr('id',nextid);
          $(this).find('.lbid').html(emaillabel+' '+nextid);
          $(this).find('.alternateemailbox').attr('name','alternateemail['+nextid+']');
          $(this).find('.errortag').attr('id','alternateemail_error_'+nextid);
          $(this).find('.cccheck').attr('name','cc['+nextid+']');
          $(this).find('.cccheck').attr('id','emailcustomCheck'+nextid);
          $(this).find('.cclabel').attr('for','emailcustomCheck'+nextid);
          $(this).find('.remove-field').attr('data-remove-id',nextid);
          nextid = nextid+1;
        });
        $("#"+removeid).remove();

    });

    

  $("#alternateemailsave").click(function() {

    $("#alternateemailsuccessbox").html('').addClass('d-none');
    $("#alternateemailfailurebox").html('').addClass('d-none'); 
    $('#alternateemailfrm .errortag').addClass('d-none');
 
    var savebtn = $(this); 
    savebtn.html(savebtn.attr('data-loading-text')).attr('disabled',true); 
    var formData = new FormData($('#alternateemailfrm')[0]); 


    $.ajax({
        type: 'post', 
        processData: false,
        contentType: false,
        url: $('#alternateemailfrm').attr('action'),
        data: formData,
        success: function (result) {
          var response = JSON.parse(result); 
          if(response.status==true) {    
             
            $("#alternateemailsuccessbox").html(response.msg).removeClass('d-none');

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');
           
            $("#alternateemailaddedinfo").addClass('d-none');
            if(response.alternateemailcount==0) {
             $("#alternateemailaddedinfo").removeClass('d-none');

             $(".alteremailslist").remove(); 
            } else {
             $(".alteremailslist").remove(); 
             $("#alternateemailparent").append(response.listEmails);
             
            }
            
            $("#alternateemailtext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
              $("#alternateemailtext .msginfo").slideUp(500);
            }); 

          } else if(response.status=='validationerror'){ 
            if( response.errors ) {
                    var errors = response.errors;
                    $.each(errors, function (key, val) {
                      var ekey = key.split(".");   
                      $("input[name='"+ekey[0]+"["+ekey[1]+"]']").addClass('is-invalid');
                      $("#" + ekey[0]+"_error_"+ekey[1]).removeClass('d-none');
                        $("#" + ekey[0]+"_error_"+ekey[1] + " > strong").text(val[0]);
                    });
            }
          } else {

            $('#'+savebtn.attr('data-show-id')).removeClass('d-none');
            $('#'+savebtn.attr('data-hide-id')).addClass('d-none');
            $("#alternateemailtext .msginfo").fadeTo(2000, 500).slideUp(500, function(){
              $("#alternateemailtext .msginfo").slideUp(500);
            });
            $("#alternateemailfailurebox").html(response.msg).removeClass('d-none');
          }

          savebtn.html(savebtn.attr('data-original-text')).attr('disabled',false); 
        }
      });  
  });

});