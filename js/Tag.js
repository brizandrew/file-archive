function Tag(text){
	this.text = text;
	this.ele = null;

	this._init();
}

Tag.prototype._init = function(){
	var self = this;
	this.ele = document.createElement("span");
	this.ele.className = "tag";

	var name = document.createElement("span");
	name.innerHTML = this.text;

	var button = document.createElement("span");
	button.className = "X";
	button.innerHTML = " X";

	this.ele.appendChild(name);
	this.ele.appendChild(button);
	button.addEventListener("click", function(){self.remove()});

	document.getElementById("enteredTags").appendChild(this.ele);

	return this;
}

Tag.prototype.remove = function(){
	this.ele.remove();
	var selfIndex = window.tagsArr.indexOf(this);
	window.tagsArr.splice(selfIndex, 1);
	window.resetInputSize();
}