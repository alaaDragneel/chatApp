<template lang="html">
    <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
            <input class="message_input" v-model="body" @keyup.enter="addThisMessage" placeholder="Type your message here...">
        </div>
        <div class="send_message" @click="addThisMessage">
            <div class="icon"></div>
            <div class="text">
                Send
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            body: ''
        }
    },
    methods: {
        addThisMessage: function () {
            if (this.body != '') {
                if (this.body.length >  500) {
                    alertify.error('Error The Message Filed Must Be less Than 500 charecters');
                } else {
                    var formData = new FormData();
                    formData.append('body', this.body);
                    formData.append('room_id', this.$route.params.room_id);
                    this.sendRequest(formData);
                }
            } else {
                alertify.error('Error The Message Filed Is Empty');
            }
        },
        sendRequest: function (data) {
            this.$http.post('/addNewMessage', data).then((response) => {
                if (response.body != 'error') {
                    this.body = '';
                    this.$dispatch('addLastMessage', response.body);
                } else {
                    alertify.error('Error The Message Didn\'t saved Try Again Later');
                }
            }, (response) => {
                for (var key in response.body) {
                    alertify.error(response.body[key][0]);
                }
            });
        }
    }


}
</script>
