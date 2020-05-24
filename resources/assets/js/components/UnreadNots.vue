<template>
    <li id="nots-li">
        <a href="/notifications" title="Notifications">
            <i class="glyphicon glyphicon-globe"></i>
            <span class="badge" v-if="all_notes_count!=0">{{ all_notes_count }}</span>
        </a>
    </li>
</template>

<script>
export default {
    mounted(){
        this.get_unread();
    },
    methods : {
        get_unread(){
            this.$http.get('/get_unread')
            .then((nots)=>{
                nots.body.forEach((not)=>{
                    this.$store.commit('add_not',not);
                })
            })
        }
    },
    computed : {
        all_notes_count(){
            return this.$store.getters.all_nots_count;
        }
    }
}
</script>