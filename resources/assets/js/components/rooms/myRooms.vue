<template lang="html">
    <div class="row">
        <div v-if="!loading" class="col-md-12">

            <h1><i class="fa fa-comments"></i> My Rooms ({{ rooms.length }})</h1>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Created on</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="room in rooms" track-by="$index">
                            <td>
                                <a v-link="{name: '/chatBox', params: {room_id: room.id, room_name: room.name}}">
                                    {{ room.name }}
                                </a>
                            </td>
                            <td>
                                {{ room.created_at | moment "calendar" }}
                            </td>
                            <td>
                                <button @click="deleteThisRoom($index, room.id)" class="btn btn-danger btn-block">
                                    <i class="fa fa-trash"></i> Delete Room
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            loading: true,
            rooms: [],
        }
    },
    ready: function () {
        this.myRooms();
    },
    methods: {
        myRooms: function () {
            this.$http.get('/myRooms').then((response) => {
                this.rooms = response.body;
                this.loading = false;
            }, (response) => {
                this.loading = false;
                alertify.error('Error In The Server Try Again Later');
            });
        },
        deleteThisRoom: function (index, id) {
            this.loading = true;
            this.$http.get('/deleteMyRoom/' + id).then((response) => {
                this.loading = false;
                if (response.body == 'done') {
                    this.rooms.splice(index, 1);
                    alertify.success('The Room Deleted Succesfully');
                } else if(response.body == 'error') {
                    alertify.error('Error The Room Didn\'t Deleted');
                } else if (response.body == 'notExist') {
                    alertify.error('Error The Room Doesn\'t Exist');
                }
            }, (response) => {
                this.loading = false;
                alertify.error('Error In The Server Try Again Later');
            });
        }
    }
}
</script>
