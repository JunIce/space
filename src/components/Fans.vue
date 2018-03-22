<template>
 <div>
	<template v-if="fans.length > 0">
		<ul class="user-fans">
			<li v-for="(fan,index) in renderData">
				<div class="rank-info">
					<a :href="'/user/'+ fan.userid ">
					<img :src="fan.userpic">
					</a>
					<div class="fans-detail">
						<p class="fans-username">{{fan.username}}
						<i class="user-sex" :class="fan.sex"></i>
						</p>
						<span class="fans-say">{{fan.sign}}</span>
					</div>
				</div>

				<a href="javascript:;" class="guanzhuBtn list-btn-margin"
				:class="{'has-done':filter(fan.relationship)}" :data-uid="fan.userid" @click="userFollow($event)">{{filter(fan.relationship) ? '已关注' : '关注'}}</a>
			</li>
		</ul>
        <template v-if="hasPage >= 1">
            <page
            :total="fans.length"
            :display = "pageLine"
            :current-page='currentPage'
            @pagechange="pagechange"></page>
        </template>
	</template>

	<template v-else>
			<AddPage :nomessage="nofans"></AddPage>
	</template>
</div>
</template>
<script>
import AddPage from '@/components/AddPage'
import bus from '@/components/bus'
import Page from '@/components/Page'

export default {
		name:'Follow',
		props:['data'],
		data(){
			return{
				fans: this.data || [],
                pageLine: 8,
                currentPage: 1,
				nofans:{
					type: 'fans',
			    	title:'分享高质量图片可以获得更多粉丝哦~~',
			    	titleurl:'',
			    	btnName:''
				}
			}
		},
		computed:{
            renderData(){
    			var end = this.pageLine * this.currentPage;
    			var start = this.pageLine * (this.currentPage - 1)
    			return this.fans.slice(start, end)
    		},
            hasPage(){
				return parseInt(this.fans.length/this.pageLine)
			},
		},
		components:{
			AddPage,
            Page
		},
		methods:{
			filter(val){
				return val == 0 ? false : true;
			},
            pagechange(data){
    			this.currentPage = data;
    		},
			userFollow(e){
				var uid = e.target.getAttribute('data-uid');
				var self = this
				if(uid){

					this.fans.map(function(i,index) {
						if(i.userid == uid) {
							i.relationship == 1 ? self.unfollow(uid, index) : self.follow(uid, index)
						}
					})
				}
			},
			follow(uid,index){
				this.$http.post('/api/follow/',{
		            fusr: uid
		           })
		           .then(res => {
		              var data = res.body
		              if(data.status == 1) {

		                 this.fans[index].relationship = 1
		              }
		           })
		    },
		    unfollow(uid,index){
		    	this.$http.post('/api/cancelFollow/',{
	            s_user:  uid
	           })
	           .then(res => {
	              var data = res.body
	              if(data.status == 1) {
	                 this.fans[index].relationship = 0
	                 bus.$emit('cancelFollow',index)
	              }
	           })
		    }
		}
	}
</script>

<style scoped>
.user-fans {min-height:400px;}
.user-fans li{display: flex;justify-content:space-between}
.user-fans li {padding:22px 25px;background:#fff;}
.rank-info {float:left;}
.rank-info img {width:66px;height:66px;border-radius:50%;overflow:hidden;display:inline-block;vertical-align:bottom;}
.fans-detail {display:inline-block;margin-left:16px;}
.fans-username {font-size:14px;color:#666;text-align:left;}
.fans-say {font-size:12px;color:#ccc;padding:8px 0;margin-bottom:8px;display:block;}
.guanzhuBtn {width:80px;height:32px;font-size:12px;text-align:center;line-height:32px;background:#ff6666;color:#fff;display:block;border-radius:16px;}
.has-done {background-color:#eeeeee;color:#999;}
.list-btn-margin {margin-top:12px;}

.user-sex{width: 16px;height: 16px;background-repeat: no-repeat;display: inline-block;vertical-align: middle;background-size: contain;background-position: center;}
.male{background-image: url(../assets/male.png);}
.female{background-image: url(../assets/female.png);}
</style>
