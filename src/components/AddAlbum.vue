<template>
	<div class="albumbox">
		<div class="boxPad">
			<div class="tag-title">添加专辑</div>
			<div class="album-list">
				<ul class="alist">
					<li v-for=" i in userAlList "><span>{{i.album_name}}</span></li>
				</ul>

				<div class="album-create-text">
					<div class="album-text">
					<input 
						type="text" 
						v-model="albumname"
						@keyup.enter="cAlbum"
					/></div>
					<div class="album-btn">
						<button @click="cAlbum">创建</button>
					</div>
				</div>
			</div>
		</div>
		<i class="box-close" @click="closeBox()"></i>
	</div>
</template>

<script>
import bus from '@/components/bus'
	export default{
		name : 'addalbum',
		props:['data'],
		data(){
			return{
				userdetail : {},
				albumList : [],
				albumname :''
			}
		},
		created(){
			
		},
		mounted(){
			var self = this
			this.defaultCss()
		},
		methods:{
			cAlbum(){
				var self = this;
				var data = this.xssFilter(this.albumname);
				if(data){
					this.$http.post('/api/album/',{album_name:data})
					.then(res=>{
						var data = res.body;
						if(data.status == 1){
							bus.$emit('createAlbum',{album_name:data.album_name,aid:data.aid})
						}
					})
				}
			},
			defaultCss(){
				var box = document.getElementsByClassName('albumbox')[0];
				var boxCWidth = box.clientWidth;
				var boxCHeight = box.clientHeight;
				var boxtop = box.offsetTop;
				var boxleft = box.offsetLeft;

				var userListTop = document.getElementsByClassName('user-list')[0].offsetTop;

				box.style.left = (960 - boxCWidth)/2 + 'px';
				box.style.top = (this.winSize.height - boxCHeight)/2 - userListTop  + 'px';
			},
			closeBox(){
				bus.$emit('closeAlbum',false)
			},
			xssFilter(s){
				var pattern = new RegExp("[0-9`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）%——|{}【】‘；：”“'。，、？《》]") 
				var rs = ""; 
				for (var i = 0; i < s.length; i++) {
					rs = rs+s.substr(i, 1).replace(pattern,""); 
				} 
				return rs; 
			}
		},
		computed:{
			winSize(){
				return {
					width : document.documentElement.clientWidth,
					height : document.documentElement.clientHeight
				}
			},
			userAlList(){
				return this.data || [];
			}
		},

	}
</script>

<style scoped>
.album-btn{
	width: 14%;
}
.album-btn button{
	width: 100%;
	background-color: #ff6666;
	color:#fff;
	line-height: 30px;
	outline: none;
	border: none;
	font-size: 3px;
	border-radius: 4px;
	cursor: pointer;
	font-size: 12px;	
}
.album-text{
	width: 80%;
	box-sizing:border-box;
	background-color: #fff;
	border:1px solid #999;
	border-radius: 3px;
	overflow: hidden;
}
.album-text input{
	line-height: 24px;
	width: 100%;
	border:none;
	outline:none;
	padding: 4px 8px;
	box-sizing:border-box;
}
.album-create-text{
	background-color:#eee; 
	padding:10px 0;
	position: absolute;
	bottom: 0;
	width: 100%;
	display: flex;
	justify-content:space-around;
}
.albumbox{
    position: absolute;
	background-color: #fff;
    border-radius: 4px;
    z-index: 100;
    width: 540px;
}
.boxPad{
	padding: 0 40px 46px 40px;
}
.tag-title{
	font-size: 16px;
	color:#333;
	position: relative;
	line-height: 54px
}
.tag-title:before,.tag-title:after{
	content: '';
	display: inline-block;
	vertical-align: middle;
	width: 40px;
	height: 1px;
	background-color: #333;
}
.tag-title:after{
	margin-left:16px;
}
.tag-title:before{
	margin-right:16px;
}
.album-list{
	border:1px solid #333;
	border-radius: 5px;
	height: 180px;
	overflow: hidden;
	position: relative;
}
.alist{
	overflow-y: scroll;
    height: 126px;
    color: #666;
    font-size: 14px;
}
.alist li{
    line-height: 32px;
    display: block;
    text-indent: 8px;
    cursor: pointer;
    text-align: left;
}
.alist li:hover{
	background-color: #eee
}
.box-close{
	width: 16px;
	height: 16px;
	background-image: url(../assets/close_16.png);
	display: inline-block;
	position: absolute;
	top:12px;
	right: 12px;
	cursor:pointer;
}
</style>