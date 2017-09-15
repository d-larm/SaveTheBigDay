var tags = [];
var tagInput = document.getElementById("tagInput");
var tagContainer = document.getElementById("tagContainer");
var tagNo=0;




tagInput.addEventListener("keypress", function (e) {
	var key = e.keyCode;
	if ((key === 13)&&(tagInput.value!=="")) { // 13 is enter
		var isDuplicate = false;
 		for(i=0;i<tags.length;i++){
 			if(tags[i] == tagInput.value){ //Checks if a tag has the same value as the input
 				isDuplicate=true;
 			}
 		}
 		if(!isDuplicate){ //Creates new tag if tag of the input value does not exist
 			tagNo++;
 			tags.push(tagInput.value);
 
 			for (var i=0; i<tags.length; i++)
 	            console.log(tags[i]);
 	           
			addTag();
 		}else{
 			var tagMatch = $(".tags").filter(function(){ //Gets the tag with the same text as the input
 				return $(this).text() === tagInput.value;
 			});
 			tagMatch.fadeTo(200, 0.1); //Fades the tag out 300ms and in 300ms
 		    tagMatch.fadeTo(200, 1);
 		}
 		tagInput.value=""; //Empties the input
	}
});

function addTag() {
	var newTag = document.createElement("div");
	newTag.setAttribute("id","tag"+tagNo);
	newTag.setAttribute("class","tags");
	newTag.setAttribute("onclick","remove(this.id)");
	newTag.innerHTML = tags[tags.length-1];
	tagContainer.appendChild(newTag);

}

function remove(elemId) {
	var elem = document.getElementById(elemId);
	
	$("#"+elemId).fadeOut(150);
	
	for (var i=0; i<tags.length; i++) {
		if(elem.innerHTML===tags[i]) {
			tags.splice(i, 1);
		}
	}
	//elem.parentNode.removeChild(elem);
}

function getTags(){
	return tags;
}