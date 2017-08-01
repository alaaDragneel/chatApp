<template lang="html">
  <div class="row well">
    <div class="col-md-12">
        <ul class="list-group activity"  v-sticky-scroll:animate=500>
            <li class="list-group-item" v-for="activity in activity_props" track-by="$index">
                {{ activity }}
            </li>
        </ul>
    </div>
  </div>
</template>

<script>
export default {
    props: ['activity_props']}
</script>
