<template>
	<div class="tagBox">
		<div class="boxPad">
			<div class="tag-title">全部标签</div>

			<div >
				<ul class="tagsList">
					<li 
					v-for="tag in publicTags">

					<span :id="'tag'+ tag.tagid" class="tag" :class="{'active':tag.check}" @click="userSelectTag($event)" >{{tag.tagname}}</span>

					</li>
				</ul>

			</div>
			<i class="box-close" @click="closeBox()"></i>
		</div>
	</div>
</template>

<script>

import bus from '@/components/bus'

export default{
	props:['data'],
	data(){
		return{
			userTags:[],
			tagsList:this.data
		}
	},
	mounted(){
		var self = this
		bus.$on('userTags',(data)=>{
			self.userTags = data
		})
		
		this.defaultCss()
	},
	methods:{
		userSelectTag(e){
			var id = e.target.id.match(/\d+/g)[0];
			var self = this
			this.$http.post('/api/subscribe/',{tagid:id})
			  .then(res => {
			  	var data = res.body
			  		if(data.status == 1) {
			  			e.target.classList.add('active');
			  			bus.$emit('addTag' ,{
			  				tagname : e.target.innerText,
			  				tagid : id
			  			})
			  		}
			  })
		},
		defaultCss(){
			var box = document.getElementsByClassName('tagBox')[0];
			var boxCWidth = box.clientWidth;
			var boxCHeight = box.clientHeight;
			var boxtop = box.offsetTop;
			var boxleft = box.offsetLeft;

			var userListTop = document.getElementsByClassName('user-list')[0].offsetTop;

			box.style.left = (960 - boxCWidth)/2 + 'px';
			box.style.top = (this.winSize.height - boxCHeight)/2 - userListTop + this.scrollTop + 'px';
		},
		preventScroll(){
			document.body.classList.add('noscroll')
			document.body.style.top = -this.scrollTop + 'px';
		},
		closeBox(){
			bus.$emit('closeBox',false)
		}
	},
	computed:{
		winSize(){
			return {
				width : document.documentElement.clientWidth,
				height : document.documentElement.clientHeight
			}
		},
		scrollTop(){
			return document.body.scrollTop;
		},
		publicTags(){
			var tag = this.tagsList || [];
			var pubTags = app.publicTags;
			pubTags.map(function(i){
					i.check = false;
			});
			pubTags.map(function(i){
				tag.map(function(j){
					if(i.tagname == j.tagname) {
						i.check = true
						return;
					}
				})
			});
			return pubTags;
		}
	},
	watch :{
		
	}
}

</script>

<style scoped>

.tagBox{
    position: absolute;
    background-color: #fff;
    border-radius: 4px;
    z-index: 100;
    width: 610px;
}
.boxPad{
	padding: 0 24px 46px 24px;
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
.tag{
width: 118px;
line-height: 42px;
display: block;
background-color: #f4f4f4;
font-size: 14px;
color:#333;
border-radius: 5px;
margin:10px;
cursor: pointer;
}
.tagsList{
	display: flex;
	flex-wrap:wrap;
}
.tagsList li{
	width: 25%;
	box-sizing: border-box;
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
.tagsList span.active{background-color:#ff6666;color:#fff;}
</style>