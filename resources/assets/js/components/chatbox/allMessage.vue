<template lang="html">
    <ul class="messages" v-sticky-scroll:animate=500>
        <li v-bind:class="['message', 'appeared', {right: isRight(message.user.id), left: !isRight(message.user.id)}]" v-for="message in messages" track-by="$index">
            <div class="avatar">
                <span v-if="message.user.avatar != '' ">
                    <img v-bind:src="message.user.avatar" v-bind:alt="message.user.name" class="img-responsive img-circle">
                </span>
                <span v-else>
                    <img v-bind:src="'/images/default.png'" v-bind:alt="message.user.name" class="img-responsive img-circle">
                </span>
            </div>
            <div class="text_wrapper">
                <div class="text">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-6">
                                <i class="fa fa-user"></i> {{ message.user.name }}
                            </div>
                            <div class="col-md-6" style="overflow-wrap: break-word;">
                                {{ message.body }}
                            </div>
                        </div>
                        <div class="col-md-3">
                          <small class="small">
                              <i class="fa fa-clock-o"></i> {{ message.created_at | moment "from" }}
                          </small>
                        </div>

                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    props: ['messages'],
    data () {
        return {
            AuthUser: [],
        }
    },
    ready: function () {
        this.getAuthUser();
    },
    methods: {
        getAuthUser: function () {
            this.$http.get('/getAuthUser').then(function (res) {
                this.AuthUser = res.body;
            }, function (res) {
                alertify.error('error in Server Try Again Later');
            });

        },
        isRight: function (id) {
            if (this.AuthUser.id == id) {
                return true;
            } else {
                return false;
            }
        }
    }
}
</script>
