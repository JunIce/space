<template>
	<div>
		<template v-if="marsk">
			<smark :component="addAlbum" :propsdata="albumCreate"></smark>
		</template>
		<div class="userCol-nav">
			<template v-for="(btn,index) in btnList">
		        <a href="javascript:;" class="userCol" :class="{userSect:index===number}" @click="selectBtn($event,index)">{{btn}}</a>
		    </template>    
  		</div>
	
		<div>

		<template v-if="albumData.length > 0">
			<ul class="user-album-list">
			<template v-if=" isSelf && number == 0">
				<li class="album">
					<div class="album-bg">
						<div class="c-albumBtn" @click="showMarsk()">
							<i class="add-Album"></i>
							<p class="createAlbum">创建专辑</p>
		                </div>
					</div>
				</li>
			</template>
				<li class="album" v-for="album in renderData">
					<div class="album-bg">
						<a :href="'/collection/'+ album.aid " target="_blank">
							<img :src="album.album_titlepic == null ? noPic : album.album_titlepic" :alt="album.album_name" class="album-titlepic">
		                    <p class="album-title">{{album.album_name}}</p>
		                    <div class="album-detail">
		                     	<i class="albumLikeIco"></i><span>{{album.album_fava_num}}</span> 
		                     	<i class="albumViewIco"></i><span>{{album.album_photo_num}}</span>
		                  	</div>
		                </a>
					</div>
				</li>
			
			</ul>
			</template>

			<template v-else>
				<AddPage :nomessage="number == 0 ? noalbum : nofava "></AddPage>
			</template>	
			<template v-if="hasPage >= 1">
				<page 
				:total="albumData.length" 
				:display = "pageLine" 
				:current-page='currentPage' 
				@pagechange="pagechange"></page>
			</template>		
		</div>
	</div>
</template>
<script>
import noPic from '@/assets/nopic.png'
import AddPage from '@/components/AddPage'
import Smark from '@/components/Smark'
import bus from '@/components/bus'
import Page from '@/components/Page'


export default {
	name:'Album',
	props:['data'],
	data(){
		return{  
			currentPage: 1,
		 	pageLine :7, // 每页显示条数
			addAlbum: 'addAlbum',
			marsk : false ,
			noPic : noPic,
			number: 0, // 默认开始
			btnList : ['我创建的','我收藏的'],  
			albumData : [], 
			noalbum:{
				title:'来创建你的第一个专辑吧',
				type: 'album',
		    	titleurl:'javascript:;',
		    	btnName:'创建专辑'
			},
			nofava:{
				title:'两手空空~~',
				type: 'album',
		    	titleurl:'',
		    	btnName:''
			}            
		}
	},
	mounted(){
		var self = this;
		this.number = 0
		this.albumData = this.albumCreate
		
		bus.$on('closeAlbum',function(data) {
			self.marsk = data
		})
	},
	methods:{
		selectBtn(e, index){
			this.number= index;  
			if(index == 0) {
				this.albumData = this.albumCreate
			}else{
				this.albumData = this.albumFava
			}
		},
		pagechange(data){
			this.currentPage = data;
		},
		showMarsk(){
			this.marsk = true
		},
	},
	computed:{
		albumFava(){
			return this.data.favorite || []
		},
		albumCreate(){
			return this.data.create || []
		},
		isSelf(){
			return app.userprofile.userid == $user.userid ? true : false;
		},
		renderData(){
			var end = this.pageLine * this.currentPage;
			var start = this.pageLine * (this.currentPage - 1)
			return this.albumData.slice(start, end)
		},
		hasPage(){
			return parseInt(this.albumData.length/this.pageLine)
		}
	},
	components:{
		AddPage,
		Smark,
		Page
	}
}
</script>

<style scoped>
.userCol-nav {display: flex;}
.userCol {font-size:12px;color:#333;display: inline-block;    padding: 8px 30px;    background-color: #fff;    text-align: center;   }
.userCol:first-child {border-radius:5px 0 0 5px}
.userCol:last-child {border-radius:0 5px 5px 0}
.userSect {background-color: #ff6666;color: #fff;}

.user-album-list{display: flex;flex-wrap:wrap;width: 980px;margin-left: -10px;margin-top: 10px;}
.album{width:25%;padding:10px;box-sizing: border-box;}
.album-bg{background-color:#fff;border-radius: 5px;overflow: hidden;padding:10px;height: 100%;box-sizing: border-box;}
.album-titlepic{width: 100%;display: block;}
.album-title{padding: 14px 0;font-size:14px;color:#333;font-weight: bold;text-align: left;}

.album-detail{text-align: left;}
.album-detail i{background-repeat: no-repeat;width:16px;height: 16px;display: inline-block;background-position: center;vertical-align: middle;}
.albumLikeIco{background: url(../assets/like.png);background-size: 16px 16px;}
.albumViewIco{background: url(../assets/view.png);background-size: 22px;}
.album-detail span{font-size:14px;color:#ccc;margin:0 10px 0 4px;}

.add-Album{background:url(../assets/plus.png) no-repeat; width: 64px;height: 64px;}
.createAlbum{font-size:14px;color:#ccc;font-weight:400;padding:14px;}

.c-albumBtn{display: flex;align-items:center;height: 100%;text-align: center;justify-content:center;flex-direction: column;cursor: pointer;}
.c-albumBtn a{display: block;}
</style>