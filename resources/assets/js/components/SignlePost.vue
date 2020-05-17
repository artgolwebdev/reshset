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
                <div class="btn-group" role="group">
                    <span >
                        <i class="glyphicon glyphicon-comment art-btn-sm"  @click="expanded = !expanded"></i>
                        <div class="badge" v-if="comments.length>0">
                        {{ comments.length }}
                        </div>
                    </span>
                    <like v-bind:id="post_id"></like>
                </div>
                <div v-if="expanded">
                <ul class="list-group">
                    <li class="list-group-item" v-for="comment in commentsdata">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                <img class="media-object" :src="comment.user.avatar">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ comment.user.name }}</h4>
                                <p>{{ comment.comment }}</p>
                            </div>
                            <div class="media-footer">
                                <span class="pull-right">
                                    <timeago :datetime="comment.created_at" :auto-update="60"></timeago>
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
                </div>
                <div v-if="!expanded">
                <p class="text-center" v-if="comments.length > 3">
                    <b @click="expanded=true" class="show-more">Show {{ comments.length - 3 }} more comments</b>
                </p>

                </p>
                <ul class="list-group">
                    <li class="list-group-item" v-for="(comment,index) in commentsdata"  v-if="index >= commentsdata.length-3">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                <img class="media-object" :src="comment.user.avatar">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ comment.user.name }}</h4>
                                <p>{{ comment.comment }}</p>
                            </div>
                            <div class="media-footer">
                                <span class="pull-right">
                                    <timeago :datetime="comment.created_at" :auto-update="60"></timeago>
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
                </div>

            </div>
                <div class="panel-footer">
                 <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                      <i class="glyphicon glyphicon-comment"></i>
                    </span>
                    <input class="form-control input-lg" type="text" placeholder="Leave a comment..." v-model="comment"  v-on:keyup.enter="addComment">
                    <span class="input-group-addon" id="basic-addon1">
                        <button class="btn btn-sm btn-info"  @click="addComment" :disabled="isDisabled">add</button>
                    </span>
                </div>

                </div>
        </div>
</template>

<script>
import Like  from './Like.vue'

export default {
    props : ['avatar','user_name','created_at','content','post_id','comments'],
      data() {
            return { 
                comment : '' ,
                expanded : false , 
                isDisabled : true    
            }
    },
    components:{ 
        Like
    },
    computed : {
        commentsdata(){
           return this.comments.sort((a,b)=>{
               return new Date(a.created_at) - new Date(b.created_at);
           })
        }
    },
    methods : {
        addComment(){
            console.log("post id : " + this.post_id);
            console.log("comment : " + this.comment);
            
            if(this.comment.length == 0){
                new Noty({
                    type : 'error' , 
                    text : "Cant add empty comment", 
                }).show();
                return;
            }

            this.$http.post('/add-comment',{
                post_id : this.post_id , 
                comment : this.comment
            })
            .then((response)=>{
                console.log(response);
                this.expanded = true;
                this.comment = '';
                 this.$store.commit('update_post_comments',{
                    id : this.post_id , 
                    comment : response.body 
                })
                new Noty({
                    type : 'success' , 
                    text : "Comment added successfully!", 
                }).show();
            })
        }
    },
    watch : {
        comment(){
            console.log(this.comment);
            if(this.comment.length>0){
                this.isDisabled = false;
            }else{
                this.isDisabled = true;
            }
        }
    }
}
</script>

<style>
    .avatart-feed{
        border-radius:40px;
        width:auto;
        max-width:40px;
    }

    .show-more{
        cursor:pointer;
    }

    ul.list-group{
        margin-top:10px;
    }
</style>