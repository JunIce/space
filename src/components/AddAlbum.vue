<template>
	<div class="albumbox">
		<div class="boxPad">
			<div class="tag-title">添加专辑</div>
			<div class="album-list">
				<ul class="alist">
					<li><span>123</span></li>
					<li><span>123</span></li>
					<li><span>123</span></li>
					<li><span>123</span></li>

				</ul>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		name : 'addalbum'
	}
</script>

<style scoped>
.albumbox{
    position: absolute;
	background-color: #f8f8f8;
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
}
.alist{
	overflow-y: scroll;
    height: 126px;
    color: #666;
}
.alist li{
    line-height: 32px;
    display: block;
    text-indent: 8px;
    cursor: pointer;
}
</style>