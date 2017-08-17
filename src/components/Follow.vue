<template>
	
	<div>
		
		<template v-if="followData.length > 0">
			<ul class="user-fans">
				<li v-for="(follower,index) in followData">
					<div class="rank-info">
						<a :href="'/user/'+ follower.userid ">
						<img :src="follower.userpic">
						</a>
						<div class="fans-detail">
							<p class="fans-username">{{follower.username}}
							<i class="user-sex" :class="follower.sex"></i>
							</p>
							<span class="fans-say">{{follower.sign}}</span>
						</div>
					</div>

					<a href="javascript:;" class="guanzhuBtn list-btn-margin" 
					:class="{'has-done':follower.relationship}" 
					:data-uid="follower.userid"
					@click="userFollow($event)"
					>{{follower.relationship? '已关注' : '关注'}}</a>				
				</li>
			</ul>
		</template>

		<template v-else>
				<AddPage :nomessage="nofollewer"></AddPage>
		</template>
	</div>
</template>

<script>

import AddPage from '@/components/AddPage'
	export default {
		name:'Follow',
		props:['data'],
		data(){
			return{
				nofollewer:{
					type: 'follow',
			    	title:'去用户排行关注你感兴趣的人吧',
			    	titleurl:'/rank',
			    	btnName:'用户排行'
				}
			}
		},
		computed:{
			followData(){
				this.data.map(function(i){
					//
					if(i.relationship == '0'){
						i.relationship = false
					}else{
						i.relationship = true
					}

					//
					if(!i.sign){
						i.sign = '很懒呢！暂未填写个人介绍！';
					}

					
				})

				return this.data
			}
		},
		components:{
			AddPage,
		}
	}
</script>

<style scoped>
.user-fans {min-height:400px;}
.user-fans li{display: flex;justify-content:space-between}
.user-fans li {padding:22px 25px;background:#fff;}
.rank-info {float:left;}
.rank-info img {width:66px;height:66px;border-radius:50%;overflow:hidden;display:inline-block;vertical-align:bottom;}
.user-sex{width: 16px;height: 16px;background-repeat: no-repeat;display: inline-block;vertical-align: middle;background-size: contain;background-position: center;}
.male{background-image: url(../assets/male.png);}
.female{background-image: url(../assets/female.png);}

.fans-detail {display:inline-block;margin-left:16px;}
.fans-username {font-size:14px;color:#666;text-align:left;}
.fans-say {font-size:12px;color:#ccc;padding:8px 0;margin-bottom:8px;display:block;}
.guanzhuBtn {width:80px;height:32px;font-size:12px;text-align:center;line-height:32px;background:#ff6666;color:#fff;display:block;border-radius:16px;}
.has-done {background-color:#eeeeee;color:#999;}
.list-btn-margin {margin-top:12px;}
</style>