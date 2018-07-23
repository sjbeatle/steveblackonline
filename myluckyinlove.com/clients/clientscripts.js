var xmlHttp;

function showHideInput(id, show, confirm)
{
	var objLabel = document.getElementById("contact_" + id);
	var objDiv = document.getElementById(id);
	var objInput = document.getElementById(id).getElementsByTagName('input')[0];
	if (show)
	{
		objLabel.style.display = 'none';
		objDiv.style.display = '';
		objInput.value = objLabel.innerHTML;
		objInput.focus();
		objInput.select();
	}
	else
	{
		objLabel.style.display = '';
		objDiv.style.display = 'none';
		if (confirm)
		{
			if (objInput.value)
			{
				objLabel.innerHTML = objInput.value;
				objLabel.style.color = '';
			}
			else
			{
				objLabel.innerHTML = 'click here to add';
				objLabel.style.color = '#666666';
			}
		}
	}
}

function updateField(strValue, strTable, strField, intClienID, blnPrimary)
{ 
	xmlHttp=GetXmlHttpObject();
	var url="updateField.php";
	//strValue = strValue.replace("+", "%2B");
	url=url+"?value="+escape(encodeURIComponent(strValue));
	url=url+"&table="+strTable;
	url=url+"&field="+strField;
	url=url+"&clientid="+intClienID;
	url=url+"&primary="+blnPrimary;
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("get",url,true);
	xmlHttp.send(null);
}

function updatePlaylist(strSong, strArtist, intClienID)
{ 
	xmlHttp=GetXmlHttpObject();
	var url="updatePlaylist.php";
	//strValue = strValue.replace("+", "%2B");
	url=url+"?strSong="+escape(encodeURIComponent(strSong));
	url=url+"&strArtist="+escape(encodeURIComponent(strArtist));
	url=url+"&clientid="+intClienID;
	xmlHttp.onreadystatechange=doPlayAdded;
	xmlHttp.open("get",url,true);
	xmlHttp.send(null);
}

function updateDNPlaylist(strSong, strArtist, intClienID)
{ 
	xmlHttp=GetXmlHttpObject();
	var url="updateDNPlaylist.php";
	//strValue = strValue.replace("+", "%2B");
	url=url+"?strSong="+escape(encodeURIComponent(strSong));
	url=url+"&strArtist="+escape(encodeURIComponent(strArtist));
	url=url+"&clientid="+intClienID;
	xmlHttp.onreadystatechange=doPlayAdded;
	xmlHttp.open("get",url,true);
	xmlHttp.send(null);
}

function deletePlaylist(intID)
{ 
	xmlHttp=GetXmlHttpObject();
	var url="deletePlaylist.php";
	//strValue = strValue.replace("+", "%2B");
	url=url+"?id="+intID;
	xmlHttp.onreadystatechange=doPlayDeleted;
	xmlHttp.open("get",url,true);
	xmlHttp.send(null);
}

function deleteDNPlaylist(intID)
{ 
	xmlHttp=GetXmlHttpObject();
	var url="deleteDNPlaylist.php";
	//strValue = strValue.replace("+", "%2B");
	url=url+"?id="+intID;
	xmlHttp.onreadystatechange=doPlayDeleted;
	xmlHttp.open("get",url,true);
	xmlHttp.send(null);
}

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

function stateChanged() 
{ 
	if (xmlHttp.readyState==4)
	{
		switch (xmlHttp.responseText)
		{
			case "Success1":
				fireMyPopup("success_popup_1");
				break;
			case "Success0":
				fireMyPopup("success_popup_2");
				break;
			case "Failure1":
				fireMyPopup("error_popup_1");
				break;
			case "Failure0":
				fireMyPopup("error_popup_2");
				break;
		}
	}
}

function doPlayAdded() 
{ 
	if (xmlHttp.readyState==4)
	{
		switch (xmlHttp.responseText)
		{
			case "Failure":
				alert("An unknown error has occured.\nPlease try again, later, or contact the webmaster.");
				break;
			default:
				addSong(xmlHttp.responseText);
				break;
		}
	}
}

function doPlayDeleted() 
{ 
	if (xmlHttp.readyState==4)
	{
	}
}

////////////////////////////////////////////
// Browser safe opacity handling function //
////////////////////////////////////////////
function setOpacity( value, strDiv ) {
 document.getElementById(strDiv).style.opacity = value / 10;
 document.getElementById(strDiv).style.filter = 'alpha(opacity=' + value * 10 + ')';
}
function fadeInMyPopup(strDiv) {
 for( var i = 0 ; i <= 100 ; i++ )
	 setTimeout( 'setOpacity(' + (i / 10) + ',"' + strDiv + '")' , 4 * i );
 setTimeout('fadeOutMyPopup("' + strDiv + '")', 2000 );
}
function fadeOutMyPopup(strDiv) {
 for( var i = 0 ; i <= 100 ; i++ ) {
	 setTimeout( 'setOpacity(' + (10 - i / 10) + ',"' + strDiv + '")' , 15 * i );
 }

 setTimeout('closeMyPopup("' + strDiv + '")', 1500 );
}
function closeMyPopup(strDiv) {
 document.getElementById(strDiv).style.display = "none"
}
function fireMyPopup(strDiv) {
 setOpacity( 0, strDiv );
 document.getElementById(strDiv).style.display = "block";
 fadeInMyPopup(strDiv);
}