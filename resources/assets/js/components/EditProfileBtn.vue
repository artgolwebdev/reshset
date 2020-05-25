<template>
        <div class="btn-wrp">
            <a href="#" class="btn btn-block btn-info" @click="showModal"><i class="glyphicon glyphicon-edit"></i>Edit</a>
            <modal name="hello-world" :adaptive="true" width="100%" height="100%">
                <div class="wrapa">
                    <div class="panel panel-default">
                        <div class="close">
                            <i class="glyphicon glyphicon-remove icon-to-close" @click="hideModal()"></i>
                        </div>
                        <div class="panel-header">
                            <h2>Update profile picture</h2>
                            <small>Choose file, cropp and upload</small>
                        </div>
                        <div class="panel-body">
                            <input type="file" name="image" accept="image/*" @change="setImage">
                                <!-- Cropper container -->
                                <div v-show="this.imageSrc">
                                    <vue-cropper v-show="!croppedImageSrc" class="" ref="cropper" :viewMode="2" :guides="true" :src="imageSrc" :aspectRatio="1/1" :initialAspectRatio="1/1"></vue-cropper>

                                    <!-- Cropped image previewer -->
                                    <img  :src="croppedImageSrc" class="avatar-medium"/>
                                </div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-lg-btn-block btn-warning" v-if="this.imageSrc && !this.croppedImageSrc" @click="cropImage">Crop</button>
                            <button class="btn btn-lg-btn-block btn-success" v-if="this.croppedImageSrc" @click="uploadImage">Upload</button>
                        </div>
                    </div>
                </div>
            </modal>
        </div>
</template>
<script>
import VueCropper from 'vue-cropperjs';
export default {
     data(){
        return {
            imageSrc: "",
            croppedImageSrc: ""
        }
    },
    components  :{
        VueCropper
    },
    mounted(){
        console.log("btn mounted");
    },
    methods : {
        showModal(){
            this.$modal.show('hello-world');
        },
        hideModal(){
            this.$modal.hide('hello-world');
        },
        setImage: function (e) {
            const file = e.target.files[0];
            if (!file.type.includes('image/')) {
                alert('Please select an image file');
                return;
            }
            if (typeof FileReader === 'function') {
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.imageSrc = event.target.result;

                    console.log(event.target.result);

                    console.log(this.$refs);

                    // Rebuild cropperjs with the updated source
                    this.$refs.cropper.replace(event.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                alert('Sorry, FileReader API not supported');
            }
        },
        cropImage() {

            // Get image data for post processing, e.g. upload or setting image src
            this.croppedImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL();
        },
        uploadImage() {
            var self = this;
            this.$refs.cropper.getCroppedCanvas({
                maxWidth:100,
                maxHeight:100,

            }).toBlob(function (blob) {
                let formData = new FormData();

                // Add name for our image
                formData.append('name', "image-name-"+(new Date()).getTime());

                // Append image file
                formData.append('file', blob);

                console.log(formData);

                self.$http.post('/profile/update/picture',formData)
                .then((response)=>{
                    console.log(response);
                    if(response.body=="ok"){
                        console.log("ok");
                        self.croppedImageSrc = "";
                        self.imageSrc = "";
                        self.hideModal();
                    }
                });
            });
        }
    }
}
</script>

<style scoped>
    .btn-wrp{
        margin-bottom:4px;
    }

    .wrapa{
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        height: 100vh;
    }
</style>