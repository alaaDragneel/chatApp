<template lang="html">
        <li role="presentation" v-bind:class="{'li-active': checkRoute('/addRoom')}">
            <a v-link="{path: '/addRoom'}">
                <i class="fa fa-plus"></i> Add Room
            </a>
        </li>

        <li role="presentation" v-bind:class="{'li-active': checkRoute('/allRooms')}">
            <a v-link="{path: '/allRooms'}">
                <i class="fa fa-inbox"></i> All Rooms
            </a>
        </li>

        <li role="presentation" v-bind:class="{'li-active': checkRoute('/myRooms')}">
            <a v-link="{path: '/myRooms'}">
                <i class="fa fa-comments"></i> My Rooms
            </a>
        </li>
</template>

<script>
export default {
    methods: {
        checkRoute: function (value) {
            return this.$route.path == value;
        }
    }
}
</script>
