// Here we get input file and span with profImgName references
// then we assign them to variables
let input = document.getElementById("profImg");
let imageName = document.getElementById("profImgName")

// So as we have our customized input['file'] button 
// that's why we should get uploaded file name and then
// add it into span with id='profImgName'
input.addEventListener("change", ()=>{
    let inputImage = input.files[0];

    profImgName.innerText = inputImage.name;
})