// JavaScript Document

// AJAX NEEDED - START //
var xmlHttp;
function GetXmlHttpObject()
{
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}	
	}
	return xmlHttp;
}
// AJAX NEEDED - END //

// Update Details on Shows Tab
function updateDetails(strName,strStreet,strCity,strState,strZip,strUrl,strEmail,strPhone,strDate,strTimeStart,strTimeEnd,strCover,strInfo)
{
	strOutput = "<h1 style='margin-left:0px;'><strong>S</strong>how <strong>D</strong>etails</h1>";
	strOutput = strOutput + "<h2 style='color:#dee2d4'>"+strDate+"</h2>";
	strOutput = strOutput + "<p>"+strTimeStart;
	if (strTimeEnd != " ") { strOutput = strOutput + " - "+strTimeEnd; }
	strOutput = strOutput + "</p>";
	strOutput = strOutput + "<h2><strong>V</strong>enue</h2>";
	if (strUrl)
	{
		strOutput = strOutput + "<p><a href='"+strUrl+"'>"+decodeURIComponent(strName.replace(/\+/g,  " "))+"</a></p>";
	}
	else
	{
		strOutput = strOutput + "<p>"+decodeURIComponent(strName.replace(/\+/g,  " "))+"</p>";
	}
	strOutput = strOutput + "<p>"+decodeURIComponent(strStreet.replace(/\+/g,  " "))+"<br />";
	strOutput = strOutput + decodeURIComponent(strCity.replace(/\+/g,  " "))+", ";
	strOutput = strOutput + strState+" "+strZip+"</p>";
	if (!strEmail) {strOutput = strOutput + "<p>E-mail: none<br />";}else{strOutput = strOutput + "<p>E-mail: <a href='mailto:"+strEmail+"'>E-mail "+decodeURIComponent(strName.replace(/\+/g,  " "))+"</a><br />";}
	if (strPhone) {strOutput = strOutput + "Phone: "+strPhone+"<br />";}
	strOutput = strOutput + "Cover: "+strCover+"</p>";
	
	document.getElementById("showDetails").innerHTML = strOutput;
	fireMyError("showDetails");
	document.getElementById("extraInfo").innerHTML = decodeURIComponent(strInfo.replace(/\+/g,  " "));
	fireMyError("extraInfo");
}

// submitContact Form FUNCTIONS - START //
function submitContactForm()
{
	strName = document.forms[0].name.value;
	strEmail = document.forms[0].email.value;
	strMessage = document.forms[0].message.value;
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(strEmail))
	{
		if (!strName || (strName == "name"))
		{
			document.getElementById("errorMessage").innerHTML = "hey there, you forgot your name"
			fireMyError("error-box");
			document.forms[0].name.focus();
			return false;
		}
		else
		{
			if (!strMessage|| (strMessage == "message"))
			{
				document.getElementById("errorMessage").innerHTML = "you want to send me a blank message?"
				fireMyError("error-box");
				document.forms[0].message.focus();
				return false;
			}
			else
			{
				xmlHttp=GetXmlHttpObject();
				var url="contact_form_AJAX.php";
				url=url+"?email="+strEmail;
				url=url+"&name="+strName;
				url=url+"&message="+escape(encodeURIComponent(strMessage));;
				xmlHttp.onreadystatechange=sendContactForm;
				xmlHttp.open("get",url,true);
				xmlHttp.send(null);
			}
		}
	}
	else
	{
		document.getElementById("errorMessage").innerHTML = "hey, that e-mail address isn't valid"
		fireMyError("error-box");
		document.forms[0].email.focus();
		return false;
	}	
}

function sendContactForm() 
{
	if (xmlHttp.readyState==4)
	{
		switch (xmlHttp.responseText)
		{
			case "1":
				document.getElementById("contactForm").style.display = "none";
				document.getElementById("contactForm").innerHTML = "<h1><strong>C</strong>ontact</h1><img src=\"images/hide_behind_guitar.jpg\" alt=\"\" align=\"right\" /><p>Thanks for the message!</p>";
				fireMyError("contactForm");
				break;
			case "0":
				document.getElementById("errorMessage").innerHTML = "something went wrong<br />please try again later"
				fireMyError("error-box");
				break;
		}
	}
}
// submitContact Form FUNCTIONS - END //

// submitMailingList Form FUNCTIONS - START //
function submitMailingList()
{
	strName = document.forms[1].name.value;
	strEmail = document.forms[1].eMail.value;
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(strEmail))
	{
		if (!strName || (strName == "name"))
		{
			document.getElementById("errorMessage").innerHTML = "hey there, you forgot your name"
			fireMyError("error-box");
			document.forms[1].name.focus();
			return false;
		}
		else
		{
			xmlHttp=GetXmlHttpObject();
			var url="mailing_list_AJAX.php";
			url=url+"?email="+strEmail;
			url=url+"&name="+strName;
			xmlHttp.onreadystatechange=sendEmail;
			xmlHttp.open("get",url,true);
			xmlHttp.send(null);
		}
	}
	else
	{
		document.getElementById("errorMessage").innerHTML = "hey, that e-mail address isn't valid"
		fireMyError("error-box");
		document.forms[1].eMail.value = "";
		document.forms[1].eMail.focus();
		return false;
	}	
}

function sendEmail() 
{
	if (xmlHttp.readyState==4)
	{
		switch (xmlHttp.responseText)
		{
			case "1":
				document.getElementById("mailing-list-col").style.display = "none";
				document.getElementById("mailing-list-col").innerHTML = "<h1 style='margin-left: 0px;'><strong>M</strong>ailing <strong>L</strong>ist</h1><p>Thanks for signing up!</p>";
				fireMyError("mailing-list-col");
				break;
			case "0":
				document.getElementById("errorMessage").innerHTML = "something went wrong<br />please try again later"
				fireMyError("error-box");
				break;
		}
	}
}
// submitMailingList Form FUNCTIONS - END //
$( document ).ready(function() {
$('.navLink').click(function () {
  var $id=$(this).attr('data-nav-id');
  $('.navLink').removeClass('active');
  $i=$('.navLink').length;
  $('.navLink').each(function() {
    $(this).css('z-index',$i);
    $i--;
  });
  $(this).css('z-index',100);
  $(this).addClass('active');
  $('.tab_content_subDiv').hide();
  $('#content'+$id).fadeIn();
});
$('#showList #divText').slimScroll({
  height: '180px'
});
});


// Fade in / Make Visible FUNCTIONS - START //
function setOpacity( value, strDiv ) {
 document.getElementById(strDiv).style.opacity = value / 10;
 document.getElementById(strDiv).style.filter = 'alpha(opacity=' + value * 10 + ')';
}

function fadeInMyPopup(strDiv) {
 for( var i = 0 ; i <= 300 ; i++ )
	 setTimeout( 'setOpacity(' + (i / 10) + ',"' + strDiv + '")' , 3 * i );
}

function fireMyPopup(strDiv) {
 setOpacity( 0, strDiv );
 document.getElementById(strDiv).style.visibility = "visible";
 if (strDiv=="content2" && document.getElementById("divText")) document.getElementById("divText").style.visibility = "visible";
 fadeInMyPopup(strDiv);
}

function fireMyError(strDiv) {
 setOpacity( 0, strDiv );
 document.getElementById(strDiv).style.display = "block";
 fadeInMyPopup(strDiv);
}
// Fade in / Make Visible FUNCTIONS - END //