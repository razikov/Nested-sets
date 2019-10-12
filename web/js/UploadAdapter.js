class UploadAdapter {
    constructor( loader ) {
        // Save Loader instance to update upload progress.
        this.loader = loader;
    }

    upload() {
        // Update loader's progress.
//        server.onUploadProgress( data => {
//            loader.uploadTotal = data.total;
//            loader.uploaded = data.uploaded;
//        } ):

        // Return promise that will be resolved when file is uploaded.
//        return server.upload( loader.file );
        
//        console.log();
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
//                resolve(resData);
            }).catch(error => {
                console.log(error);
                reject(error);
            });
        });
        
    }

    abort() {
        // Reject promise returned from upload() method.
        // server.abortUpload();
    }
}        