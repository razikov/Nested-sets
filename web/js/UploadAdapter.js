class UploadAdapter {
    constructor( loader ) {
        // Save Loader instance to update upload progress.
        this.loader = loader;
    }

    upload() {
        let _this = this;
        let formData = new FormData();
        formData.append("file", this.loader.file);
        console.log(this.loader.file);
        
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/site/upload',
                data: formData,
                config: {headers: {'Content-Type': 'multipart/form-data'}}
            }).then(data => {
                _this.loader.uploaded = data.uploaded;
                console.log(data, _this.loader);
            }).catch(error => {
                console.log(error);
                reject(error);
            });
        });
        
    }

    abort() {
    }
}        