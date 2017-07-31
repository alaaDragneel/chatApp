<template lang="html">
    <ul class="inbox-nav inbox-divider">
        <li v-bind:class="{'active': checkRoute('/addRoom')}">
            <a v-link="{path: '/addRoom'}">
                <i class="fa fa-plus"></i> Add Room
            </a>
        </li>

        <li v-bind:class="{'active': checkRoute('/allRooms')}">
            <a v-link="{path: '/allRooms'}">
                <i class="fa fa-inbox"></i> All Rooms
            </a>
        </li>

        <li v-bind:class="{'active': checkRoute('/myRooms')}">
            <a v-link="{path: '/myRooms'}">
                <i class="fa fa-comments"></i> My Rooms
            </a>
        </li>

    </ul>
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
