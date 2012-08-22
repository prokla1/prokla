$(document).ready(function(){
	

	function IEHoverPseudo() {

		var navItems = $(".primary-nav li");
		
		for (var i=0; i<navItems.length; i++) {
			if(navItems[i].className == "menuparent") {
				navItems[i].onmouseover=function() { this.className += " over"; }
				navItems[i].onmouseout=function() { this.className = "menuparent"; }
			}
		}

	}
	IEHoverPseudo();
	
});