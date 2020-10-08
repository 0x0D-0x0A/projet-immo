$( document ).ready(function() {

	// function handleFiles(files) {
	// 	for (let i = 0; i < files.length; i++) {
	// 		const file = files[i];
			
	// 		if (!file.type.startsWith('image/')){ continue }
				
	// 			const img = document.createElement("img");
	// 		img.classList.add("obj");
	// 		img.file = file;
 //    preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.
    
 //    const reader = new FileReader();
 //    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
 //    reader.readAsDataURL(file);
	// }

}

//-------------

// function filePreview(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#uploadForm + img').remove();
//             $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }

// $("#file").change(function () {
//     filePreview(this);
// });

});