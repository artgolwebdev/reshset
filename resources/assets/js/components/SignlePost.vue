<template>
       <div class="panel panel-default">
            <div class="panel-heading">
                <img :src="avatar" class="avatart-feed">
                {{ user_name }}

                <span class="pull-right">
                    <timeago :datetime="created_at" :auto-update="60"></timeago>
                </span>
            </div>
            <div class="panel-body">
                <p>{{ content }}</p>
                <hr>
                <like v-bind:id="post_id"></like>
            </div>
                <div class="panel-footer">
                </div>
        </div>
</template>

<script>
import Like  from './Like.vue'

export default {
    props : ['avatar','user_name','created_at','content','post_id'],
    components:{ 
        Like
    },
}
</script>

<style>
    .avatart-feed{
        border-radius:40px;
        width:auto;
        max-width:40px;
    }
</style>