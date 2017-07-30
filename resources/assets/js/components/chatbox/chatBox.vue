<template lang="html">
    <div class="row">
        <div v-if="!loading" class="col-md-12">
            <div class="chat_window">
                <div class="top_menu">
                    <div class="buttons">
                        <div class="button close"></div>
                        <div class="button minimize"></div>
                        <div class="button maximize"></div>
                    </div>
                    <div class="title">
                        {{ $route.params.room_name }}
                    </div>
                    <div class="buttons" style="right: 30px; top: 17px;">
                         <a v-link="{path: '/allRooms'}" class="btn btn-primary btn-sm">All Rooms</a>
                         <a v-link="{path: '/myRooms'}" class="btn btn-success btn-sm">My Rooms</a>
                    </div>
                </div>
                <all_message :messages="messages"></all_message>

                <add_message></add_message>

            </div>
        </div>
        <div :class="['loading-area', 'col-md-12', {'hidden': !loading}]">
            <spinner :loading="loading" color="#16a085"></spinner>
        </div>
    </div>
</template>

<script>
import AllMessage from './allMessage.vue';
import AddMessage from './addMessage.vue';
export default {
    components: {
        all_message: AllMessage,
        add_message: AddMessage,
    },
    data () {
        return {
            loading: true,
            messages: [],
            channle: '',
            pusher: '',
            room: this.$route.params.room_id + 'room',
        }
    },
    created: function () {
        console.log('craeted ' + this.messages);
    },
    ready: function () {
        var self = this;
        console.log('ready' + this.messages);

        this.loading = false;
        /**
         * [pusher librabry instance]
         * NOTE This Is the pusher-js Library
         * @type {Pusher}
         */
        this.pusher = new Pusher('2f13ba6c99034dd7203c',{
            cluster: 'eu',
        });
        this.channle = this.pusher.subscribe(this.room);

        this.channle.bind('add_new_message', function(data) {
            console.log(data[0]);
            self.messages.push(data[0]);

        });
    },
}
</script>
