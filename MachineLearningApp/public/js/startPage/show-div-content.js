function showDiv() {
    document.getElementById('ToShow').style.display = "block";
    document.getElementById('overflow').style.overflow = "scroll";
}

function showBenefits() {
    document.getElementById('benefitsToShow').style.display = "block";
}

function showGame(){
	document.getElementById('showGame').style.display = "block";
	document.getElementById('game').style.display = "none";
}

function closeGame(){
	document.getElementById('showGame').style.display = "none";
}