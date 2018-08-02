// JavaScript Document by Richbox
function initTree(t) {
	var tree=document.getElementById(t);
	tree.style.display="none";
	var lis=tree.getElementsByTagName("li");
	//alert(lis.length);
	for(var i=0;i<lis.length;i++) {
		lis[i].id="li"+i;
		var uls=lis[i].getElementsByTagName("ul");
		if(uls.length!=0) {
			uls[0].id="ul"+i;
			uls[0].style.display="none";
			var as=lis[i].getElementsByTagName("a");
			as[0].id="a"+i;
			as[0].className="folder";
			as[0].href="#this";
			as[0].tget=uls[0];
			as[0].onclick=function() {
				openTag(this,this.tget);
			}
		}
	}
	tree.style.display="block";
}
function openTag(a,t) {
	if(t.style.display=="block") {
		t.style.display="none";
		a.className="folder";
	} else {
		t.style.display="block";
		a.className="";
	}
}
window.onload=function() {
	initTree("left");
}