var ITEMS_IN_CURRENT_ROW = 0;
var INPUT_BOX_WIDTH;
var INPUT_MIN_WIDTH;
var ALL_TAGS_TOGGLED = false;
var tagsArr = [];
var tagsDBArr;
var dataString;
var videoId;
var querying = false;
var page = 0;

//create a new Tag obj in TagsArr and adjust input size appropriately
function addTag(text){
    if(tagsDBArr.indexOf(text) != -1){
        if(!inTagsArr(text)){
            setTimeout(function(){$("#insertTags").val("");}, 1)
            $("#insertTags").val("");
            tagsArr.push(new Tag(text));
            ITEMS_IN_CURRENT_ROW++;
            resetInputSize();
        }
        else
            displayErrorMsg("Tag already applied.");
    }
    else{
        displayErrorMsg('Error: "' + text + '" is not an available tag.');
        var inputVal = $("#insertTags").val();
        $("#insertTags").val(  inputVal.substring(0, inputVal.length-1) );
    }
}

//reset the sizes of the input field elements
function resetInputSize(){
    var usedWidth = 0;
    var tags = $("#enteredTags").children();

    for (var i = 0; i < tags.length; i++) {
        usedWidth += $(tags[i]).outerWidth(true);
        if(usedWidth > INPUT_BOX_WIDTH){
            usedWidth = $(tags[i]).outerWidth(true);
        }
    };
    if(usedWidth > INPUT_BOX_WIDTH - INPUT_MIN_WIDTH){
        ITEMS_IN_CURRENT_ROW = 0;
    }

    usedWidth = 0;

    var tagsIndex = tags.length -1;

    for (var i = 0; i < ITEMS_IN_CURRENT_ROW; i++) {
        usedWidth += $(tags[tagsIndex]).outerWidth(true);
        tagsIndex--;
    }

    var padding = parseInt($("#inputField").css("padding").substring(0,$("#inputField").css("padding").indexOf("px")));
    var newWidth = $("#inputField").width() - usedWidth - padding;
    $("#insertTags").width(newWidth+"px");

    if(ITEMS_IN_CURRENT_ROW == 0)
        $("#inputField").height( $("#inputField").height() + 36 );
    else
        $("#inputField").css("height", "");

}

function toggleLookup(){
    if(page == 1){
        page = 0;
        $(".retrieve").toggleClass("hide");
        $(".insert").toggleClass("hide");
        $("#retrieveTab").toggleClass("selectedTab");
        $("#insertTab").toggleClass("selectedTab");
        $("#formResults").html("");
    }
}

function toggleArchive(){
    if(page == 0){
        page = 1;
        $(".retrieve").toggleClass("hide");
        $(".insert").toggleClass("hide");
        $("#retrieveTab").toggleClass("selectedTab");
        $("#insertTab").toggleClass("selectedTab");
        $("#formResults").html("");
    }
}

function displayAllTags(){
    if(!ALL_TAGS_TOGGLED){
        for (var i = 0; i < tagsDBArr.length; i++) {
            var tag = document.createElement("li");
            tag.className = "allTag";
            tag.innerHTML = tagsDBArr[i];
            $("#allTags").append(tag);
        };
        $(".allTag").on("click", function(){addTag($(this).html())})
        $("#allTags").removeClass("hide");
        ALL_TAGS_TOGGLED = true;
    }
}

//Prepare a datastring to send to DB request
function prepareToSend(){
    if(tagsArr[0] == null){
        displayErrorMsg("Error: Please apply at least one tag.");
        return false;
    }
    var output = "";
    for (var i = 0; i < tagsArr.length - 1; i++) {
        output += tagsArr[i].text + "|";
    };
    output += tagsArr[tagsArr.length-1].text;
    dataString = 'tags=' + output;
    return true;
}

function resetRequestForm(){
    $("#tags_Request").val("");
    $("#requestTagForm").removeClass("hide");
    $("#requestFormResult").addClass("hide");

}

function displayErrorMsg(text){
    $("#errorAlert p").html(text);
    $("#errorAlert").removeClass("hideOpacity");
    $("#errorAlert").addClass("showOpacity");
    if(page == 0)
        $("#errorAlert").css("top", "258px");
    else if(page == 1)
        $("#errorAlert").css("top", "318px");
    setTimeout(function(){
        $("#errorAlert").addClass("hideOpacity");
        $("#errorAlert").removeClass("showOpacity");
    }, 5000);
}

function inTagsArr(text){
    for (var i = 0; i < tagsArr.length; i++) {
        if(tagsArr[i].text == text)
            return true;
    };
    return false;
}

$(document).ready(function() {
//input constants
INPUT_BOX_WIDTH = $("#inputField").width();
INPUT_MIN_WIDTH = parseInt($("#insertTags").css("min-width").substring(0,$("#insertTags").css("min-width").indexOf("px")));

//retrieve the id of the next video to insert
$.ajax({
        url:  "getLastVideoId.php",
        type: "POST",
        success: function(html) {
            videoId = parseInt(html) + 1;
            $("#videoId").html("File ID: " + videoId);
            $("#videoId_Request").val(videoId);
        },
        error: function (jqXHR, status, err) {
            alert("Error!");
        }
    });

//fill TagsDBArr with all available tags in the DB 
$.ajax({
        url:  "getAllTags.php",
        type: "POST",
        success: function(html) {
            tagsDBArr = JSON.parse(html);
            $("#displayAllTags").on("click", function(){displayAllTags()});
            $("#insertTags").autocomplete({
                source: tagsDBArr
            });
        },
        error: function (jqXHR, status, err) {
            alert("Error!");
        }
    });

//send retrieve request to the DB
$("#retrieveForm").on("submit", function(e) {
    e.preventDefault();
    if(prepareToSend()){
        $.ajax({
            url:  "retrieve.php",
            type: "POST",
            data: dataString,
            success: function(html) {
                $("#formResults").html(html);
                $(".tagResult").on("click", function(){addTag($(this).html())})
            },
            error: function (jqXHR, status, err) {
                alert("Error!");
            }
        });
    }

});

//send insert request to the DB
$("#insertForm").on("submit", function(e) {
    e.preventDefault();
    console.log("test");
    if(prepareToSend()){
        $.ajax({
            url:  "insert.php",
            type: "POST",
            data: dataString,
            success: function(html) {
                $("#formResults").html(html);
                $(".tagResult").on("click", function(){addTag($(this).html())})
            },
            error: function (jqXHR, status, err) {
                alert("Error!");
            }
        });
    }

});

//send request Tag request to the DB
$("#requestTagForm").on("submit", function(e) {
    e.preventDefault();
        $.ajax({
            url:  "request.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(html) {
                $("#requestTagForm").addClass("hide");
                $("#requestFormResult").html(html);
                $("#requestFormResult").removeClass("hide");
            },
            error: function (jqXHR, status, err) {
                alert("Error!");
            }
        });
});

//add event listeners to input field for comma and backspace
$("#insertTags").on("keydown", function(e){
    var key = e.charCode || e.keyCode;

    //add tag on comma
    if(key == 188 && $("#insertTags").val() != ""){
        var input = $("#insertTags").val();
        addTag(input);
    }

    //remove tag on backspace
    if((key == 8 || key == 46) && $("#insertTags").val() == "" )
        tagsArr[tagsArr.length -1].remove();
    
});

$("#retrieveTab").on("click", function(){
    toggleLookup();
});

$("#insertTab").on("click", function(){
    toggleArchive();
});

$("#requestTag").on("click", function(){
    $("#requestTagContainer").removeClass("hide");
});

$("#closeRequestTag").on("click", function(){
    $("#requestTagContainer").addClass("hide");
});

$("#adminLogin").on("click", function(){
    $("#adminLoginContainer").removeClass("hide");
});

$("#closeAdminLogin").on("click", function(){
    $("#adminLoginContainer").addClass("hide");
});

resetInputSize();
//add min-height attribute after initial resetInputSize
$("#inputField").css("min-height", "36px");

}); // close document ready