<template lang="html">
    <ul class="messages">
        <li class="message right appeared" v-for="message in messages" track-by="$index">
            <div class="avatar"></div>
            <div class="text_wrapper">
                <div class="text">
                    <div class="row">
                        <div class="col-md-9">
                            {{ message.body }}
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

        }
    },
    ready: function () {

    },
}
</script>
