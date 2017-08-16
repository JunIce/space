<template>
	<div class="tagBox">
		<div class="boxPad">
			<div class="tag-title">全部标签</div>

			<div >
				<ul class="tagsList">
					<li><span class="tag">头像</span></li>
					<li><span class="tag">头像</span></li>
					<li><span class="tag">头像</span></li>
					<li><span class="tag">头像</span></li>
					<li><span class="tag">头像</span></li>
					<li><span class="tag">头像</span></li>
					<li><span class="tag">头像</span></li>
				</ul>

			</div>
		</div>
	</div>
</template>

<script>
export default{
	mounted(){
		this.preventScroll()
		this.defaultCss()
	},
	methods:{
		defaultCss(){
			var box = document.getElementsByClassName('tagBox')[0];
			var boxCWidth = box.clientWidth;
			var boxCHeight = box.clientHeight;
			var boxtop = box.offsetTop;
			var boxleft = box.offsetLeft;
			console.log(boxtop,boxleft)

		},
		preventScroll(){
			var scrollTop = document.body.scrollTop;
			//ddocument.body.classList.add('noscroll')
			//document.body.style.top = -scrollTop + 'px';
		}
	},
	computed:{
		winSize(){
			return {
				width : document.documentElement.clientWidth,
				height : document.documentElement.clientHeight
			}
		}
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
</style>