<template lang="html">
    <ul class="messages">
        <li class="message right appeared" v-for="message in messages" track-by="$index">
            <div class="avatar"></div>
            <div class="text_wrapper">
                <div class="text">
                    {{ message.body }}
                    {{ message.created_at }}
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
