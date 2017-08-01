<template lang="html">
    <div class="row">
        <div v-if="!loading" class="col-md-12">

            <h1><i class="fa fa-comments"></i> All Rooms ({{ rooms.length }})</h1>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Owner</th>
                            <th>Created on</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="room in rooms">
                            <td>
                                <a v-link="{name: '/chatBox', params: {room_id: room.id, room_name: room.name}}">
                                    {{ room.name }}
                                </a>
                                <span class="label label-success">
                                    Online Users <i class="fa fa-users"></i> {{ room.online_count }}
                                </span>
                            </td>
                            <td>{{ room.user.name }}</td>
                            <td>
                                {{ room.created_at | moment "calendar" }}
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
            channel: '',
        }
    },
    created: function () {
        var self = this;

        this.channel = window.pusher.subscribe('room');
        this.channel.bind('room_status', function(data) {
            self.rooms = data;
        });
    },
    ready: function () {


        this.getAllRooms();
    },
    methods: {
        getAllRooms: function () {
            this.$http.get('/getAllRooms').then((response) => {
                this.rooms = response.body;
                this.loading = false;
            }, (response) => {
                alertify.error('Error In The Server Try Again Later');
            });
        },
    }
}
</script>
