<template>
    <li id="nots-li" :class="{active:isShown }">
        <a title="Notifications" @click="toggleDrop">
            <i class="glyphicon glyphicon-globe"></i>
            <span class="badge" v-if="all_notes_count!=0">{{ all_notes_count }}</span>
        </a>

        <div class="panel panel-default panel-results" v-if="isShown">
            <div class="panel-footer">
                <div class="close">
                    <i class="glyphicon glyphicon-remove icon-to-close" @click="toggleDrop"></i>
                </div>
            </div>
            <div class="panel-body panel-body-wrapper">
                <b v-if="isLoading">Loading...</b>
                <ul class="list-group" v-if="!isLoading">
                    <li class="list-group-item" v-for="not in all_nots">
                        <a :href="OriginalLink + '/profile/' + not.slug">{{ not.name }}</a>&nbsp; <span v-html="not.message"></span>
                    </li>
                </ul>
                <p v-if="all_nots.length==0&&!isLoading" class="text-center"><i>No unread notifications.</i></p>
            </div>
            <div class="panel-footer text-center">
                <a href="/notifications" >Show all</a>
            </div>
        </div>
    </li>
</template>

<script>
export default {
    data() {
        return {
            isLoading : true , 
            isShown : false,
            nots : [] , 
            OriginalLink : window.OriginalLink
        }
    },
    mounted(){
        this.get_unread();
    },
    methods : {
        toggleDrop(){
            if(window.innerWidth < 420){
                document.location.href=window.OriginalLink+"/notifications";
                return;
            }
            this.isShown = !this.isShown;
            if(this.isShown)this.markasreadall();
        },
        markasreadall(){
            this.$http.get('/markasreadall')
            .then((response)=>{
                this.nots = response.body;
                this.isLoading = false;
            })
        },
        get_unread(){
            this.$http.get('/get_unread')
            .then((nots)=>{
                this.isLoading = false;
                nots.body.forEach((not)=>{
                    this.$store.commit('add_not',not);
                })
            })
        }
    },
    computed : {
        all_notes_count(){
            return this.$store.getters.all_nots_count;
        },

        all_nots(){
            return this.$store.getters.all_nots;
        }
    }
}
</script>

<style scoped>
.panel-results{
    right: 0;
    top:60px;
}
.panel-results:after{
    content: '';
    width: 0px;
    height: 0px;
    border-right: 14px solid transparent;
    border-left: 14px solid transparent;
    border-top: 14px solid transparent;
    border-bottom: 14px solid #f5f5f5;
    position: absolute;
    top: -28px;
    right: 2%;
}


#nots-li{
    cursor: pointer;
}
</style>