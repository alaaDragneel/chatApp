<template lang="html">
    <div class="row">
        <div v-if="!loading" class="col-md-12">
            <h1><i class="fa fa-plus"></i> Add New Room</h1>
            <div class="form-group">
                <label for="room-name">Room Name</label>
                <input type="text" v-model="roomName" class="form-control" id="room-name" placeholder="Write Room Name">
            </div>

            <div class="form-group">
                <button type="button" @click="addNewRoom" v-bind:disabled="btnSubmit" name="button" class="btn btn-success">
                    <i class="fa fa-plus"></i> Add Room
                </button>
            </div>
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
            roomName: "",
            loading: true,
            btnSubmit: true,
        }
    },
    ready: function () {
        this.loading = false;
    },
    methods: {
        addNewRoom: function () {
            this.loading = true;
            var formData = new FormData();
            formData.append('name', this.roomName);
            this.sendRequest(formData);
        },
        sendRequest: function (data) {
            this.$http.post('/addNewRoom', data).then((response) => {
                this.loading = false;
                if (response.body == 'done') {
                    this.roomName = '';
                    alertify.success('The Room Created Succesfully');
                } else {
                    alertify.error('Error The Room Didn\'t saved');
                }
            }, (response) => {
                this.loading = false;
                for (var key in response.body) {
                    alertify.error(response.body[key][0]);
                }
            });
        }
    },
    computed: {
        btnSubmit: function () {
            if (this.roomName == '') {
                return true;
            } else if (this.roomName.length < 5) {
                return true;
            } else {
                return false;
            }
        }
    },
}
</script>
