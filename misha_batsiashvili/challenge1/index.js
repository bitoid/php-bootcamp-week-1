window.addEventListener('load', () => {
    const profileImageInputDom = document.querySelector('#profile-input');
    const profileImageDom = document.querySelector('#profile-image');
    const DEFAULT_IMAGE_PATH = `${window.location.protocol + '//' + window.location.host}/default.png`;
    const ALLOWED_FORMATS = ['jpg', 'jpeg', 'png'];

    // on initial load
    if(!profileImageDom.src){
        profileImageDom.src = DEFAULT_IMAGE_PATH;
    }
    // /.

    profileImageInputDom.addEventListener('change', (evt) => {
        try{
            let files = evt.target.files;
            let f = files[0];
            let sFileName = f.name
            let sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
            if(ALLOWED_FORMATS.includes(sFileExtension)){
                profileImageDom.src = URL.createObjectURL(f);
            } else {
                throw new Error('Unsupported File Extension');
            }
        } catch (e) {
            console.error(e);
            profileImageDom.src = DEFAULT_IMAGE_PATH;
        }
    })
});