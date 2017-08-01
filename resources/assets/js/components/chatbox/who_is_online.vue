<template lang="html">
  <div class="row well" style="max-height: 200px; overflow-y: auto;" v-sticky-scroll:animate=500>
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item" v-for="online in who_is_online_props" track-by="$index">
                <span v-if="online.user.avatar != '' ">
                    <img v-bind:src="online.user.avatar" v-bind:alt="online.user.name" class="img-circle" width="30">
                </span>
                <span v-else>
                    <img v-bind:src="'/images/default.png'" v-bind:alt="online.user.name" class="img-circle" width="30">
                </span>
                {{ online.user.name }}
                <i class="fa fa-circle" style="color: green; font-size: 12px;"></i>
            </li>
        </ul>
    </div>
  </div>
</template>

<script>
export default {
    props: ['who_is_online_props']}
</script>
