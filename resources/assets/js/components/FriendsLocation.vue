<template>

<!-- Make a div wrapped slider,set height and width -->
<div class="wrapper">
   <!-- Using the slider component -->
   <slider ref="slider" :options="options">
       <!-- slideritem wrapped package with the components you need -->
       <slideritem v-for="(item,index) in results" :key="index" class="item">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <p class="text-dark">{{item.name}}</p>
            </div>
            <div class="panel-body">
                <img :src="item.avatar" class="img img-responsive">
            </div>
            <div class="panel-footer">
                <friend :profile_user_id="item.id"></friend>
            </div>
        </div>
        </slideritem>
       <!-- Customizable loading -->
       <div slot="loading">loading...</div>
   </slider>
</div>

</template>

<script>
import { slider, slideritem } from 'vue-concise-slider';

    export default {
          data() {
            return { 
                results : [] ,     
                //Slider configuration [obj]
                options: {
                    currentPage: 0,
              
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getFriends();
        }
        ,methods : {
            getFriends(){
                this.$http.get('/friendsbylocation/')
                .then((response)=>{
                    console.log(response);
                    this.results = response.body;
                });
       }
    },
    components: {
      slider,
      slideritem
    }
}


</script>

<style>

    p.text-dark {
        font-size:12px;
        font-weight:300;
    }
    .panel-body-avatar{
        border:1px solid darkblue;
        height:auto;
        min-height:100px;
    }

    .item{
        padding:30px;
    }

    .item .panel {
        margin:0px;
    }

    .wrapper {
        height:auto;
    }
    .wrapper .item{
        padding:0px;
        display:inline-block;
        font-size:unset;
        width:auto;
        min-width:220px;
        margin-right:2%;
        min-height:200px;
        
    }
</style>

