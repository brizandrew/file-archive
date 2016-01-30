var dataString;
var selected_id;
var tagsDBArr;

function getAllTags(){
	$.ajax({
        url:  "getAllTags.php",
        type: "POST",
        success: function(html) {
            tagsDBArr = JSON.parse(html);
            displayAllTags();
        },
        error: function (jqXHR, status, err) {
            alert("Error!");
        }
    });


}

function displayAllTags(){
	$("#allTags").html("");
	for (var i = 0; i < tagsDBArr.length; i++) {
        var tag = document.createElement("li");
        tag.className = "allTagAdmin";
        tag.innerHTML = tagsDBArr[i];
        $("#allTags").append(tag);
    };
}

$(document).ready(function() {

	$("#handleRequestForm").on("submit", function(e) {
	    e.preventDefault();
	        $.ajax({
	            url:  "handleRequest.php",
	            type: "POST",
	            data: dataString,
	            success: function(html) {
	            	$("#"+selected_id).remove();
	            	getAllTags();
	            },
	            error: function (jqXHR, status, err) {
	                alert("Error!");
	            }
	        });
	});

	$("#newTagForm").on("submit", function(e) {
	    e.preventDefault();
	        $.ajax({
	            url:  "newTag.php",
	            type: "POST",
            	data: $(this).serialize(),
	            success: function(html) {
	            	$("#newTagFormResult").html(html);
	            	$("#tagName").val("");
	            	getAllTags();
	            },
	            error: function (jqXHR, status, err) {
	                alert("Error!");
	            }
	        });
	});

	$("#handleRequestForm button").on("click", function(){
		dataString = "id=" + this.id + "&name=" + this.name + "&boolean=" + this.getAttribute("boolean") + "&videoId=" + this.getAttribute("videoId");
		selected_id = this.id;
		$("#handleRequestForm").submit();
	});

	getAllTags();


}); // close document ready