<template>
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Friends ({{ friends.length }})
    </div>
    <div class="panel-body">
        <ul class="list-group" v-if="friends.length">
            <li class="list-group-item" v-for="friend in friends">
                <img :src="friend.avatar" width="20px">
                {{ friend.name }}
            </li>
        </ul>
        <p v-else>No friends found...</p>
    </div>
    <div class="panel-footer">

    </div>
</div>
</template>

<script>
export default {
    props : ['user_id'],
    data() {
        return {
            friends : [] 
        }
    },
    mounted(){
        this.getFriends();
    },
    methods : {
        getFriends()
        {
            this.$http.get('/user/friends/'+this.user_id)
            .then((response)=>{
                this.friends = response.body;
            })
        }
    }
}
</script>