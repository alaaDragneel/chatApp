<template lang="html">
    <div class="row">
        <div v-if="!loading" class="col-md-12">
            <form v-on:submit.prevent="UploadAvatar" enctype="multipart/form-data">
                <img v-bind:src="avatar" v-bind:alt="avatar" width="200" height="200" class="img-rounded center-block">
                <div class="form-group">
                    <label for="image">Upload Your Avatar</label>
                    <input type="file" class="form-control" v-el:avatar id="image" />
                    <p class="help-block">Help text here.</p>
                </div>

                <button type="submit" name="submit" class="btn btn-success">
                    <i class="fa fa-cloud-upload"></i>
                    Upload Avatar
                </button>
            </form>

        </div>
        <div :class="['loading-area', 'col-md-12', {'hidden': !loading}]">
            <spinner :loading="loading" color="#16a085"></spinner>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            loading: false,
            avatar: ''
        }
    },
    ready: function () {
        this.getAuthUserAvatar();
    },
    methods: {
        UploadAvatar: function () {
            this.loading = true;
            var formData = new FormData();
            formData.append('avatar', this.$els.avatar.files[0]);
            this.$http.post('/uploadAvatar', formData).then(function (res) {
                if (res.body['status'] == 'done') {
                    this.loading = false;
                    this.avatar = res.body['avatar'];
                    alertify.success('Your Avatar Uploaded Successfully');
                }
            }, function (res) {
                this.loading = false;
                for (var key in res.body) {
                    alertify.error(res.body[key][0]);
                }
            });
        },
        getAuthUserAvatar: function () {
            this.loading = true;
            this.$http.get('/getAuthUserAvatar').then(function (res) {
                this.avatar = res.body;
                this.loading = false;
            }, function (res) {
                this.loading = false;
                alertify.error(res.body);
            });
        },
    }

}
</script>
