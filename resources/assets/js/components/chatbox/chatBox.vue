<template lang="html">
    <div class="row">
        <div v-if="!loading" class="col-md-12">
            <div class="chat_window">
                <div class="top_menu">
                    <div class="buttons">
                        Online Users ({{ onlineUsersCount }})
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
            channel: '',
            room: this.$route.params.room_id,
            onlineUsersCount: '',
        }
    },
    created: function () {
        var self = this;
        this.loading = false;
        /**
         * [methods Bind The Pusher Events By pusher]
         * @type {Method}   {First_Method}  {BindEvents} {Bind_New_Message_Events}
         * @type {Method}   {Second_Method} {UpdateOnlineUsersCount}    {Bind_Update_Online_User_Events}
         */
         this.BindEvents(this.room + 'room', 'add_new_message', this.messages);
         this.UpdateOnlineUsersCount();
         this.UpdateOfflineUsersCount();
    },
    ready: function () {
        this.loading = false;
        /**
         * [methods Get User Where He Is Online]
         * @type {Method}
         */
        this.GetMeOnline();

    },
    methods: {
        /**
        * [methods Bind The Pusher Events By pusher]
        * @type {Method}
        * @param  {String} channelName [The Channel That WIll subscribe]
        * @param  {String} eventName   [The Event That Will Bind It]
        * @param  {Array} array       [The rray That Will Push In It]
        */
        BindEvents: function (channelName, eventName, array) {
            this.channel = window.pusher.subscribe(channelName);
            this.channel.bind(eventName, function(data) {
                array.push(data[0]);
            });
        },
        GetMeOnline: function () {
            this.$http.get('/getMeOnline/' + this.room);
        },
        UpdateOnlineUsersCount: function () {
            var self = this;
            this.channel = window.pusher.subscribe(this.room + 'online');
            this.channel.bind('online_user', function(data) {
                self.onlineUsersCount = data[0];
            });
        },
        UpdateOfflineUsersCount: function () {
            var self = this;
            this.channel = window.pusher.subscribe(this.room + 'offline');
            this.channel.bind('leave_user', function(data) {
                self.onlineUsersCount = data[0];
            });
        },
    }
}
</script>
