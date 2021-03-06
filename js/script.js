function changeVisible(id){
	if (document.getElementById(id).style.display == 'block') {
		document.getElementById(id).style.display = 'none';
	} else {
		document.getElementById(id).style.display = 'block';
	}
}

function changeVisibleRow(id){
	if (document.getElementById(id).style.display == 'none') {
		document.getElementById(id).style.display = 'table-row';
	} else {
		document.getElementById(id).style.display = 'none';
	}
}

function selectAll(id){
	document.getElementById(id).select();
}

function changeValue(id,valueStandard,valueChanged){
	if (document.getElementById(id).value == valueStandard) {
		document.getElementById(id).value = valueChanged;
	} else {
		document.getElementById(id).value = valueStandard;
	}
}

function changeClass(id, index){
	document.getElementById(id).className = 'subject_' + index;
}

function changeText(id, index){
	document.getElementById(id).value = room[index];
}