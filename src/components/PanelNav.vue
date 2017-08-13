<template>
	<div>
		<ul class="panelNav">
			<li v-for="(item,index) in navLists"><a href="javascript:;" @click="tabnav($event.target , index)">{{item.navname}}</a></li>
		</ul>
		
		<div class="user-list">
	        <view-page :defaultdata="defaultdata"></view-page>
		</div>
	</div>
</template>

<script>
import ViewPage from '@/components/ViewPage'
// import Follow from '@/components/Follow'
// import Fans from '@/components/Fans'
// import Album from '@/components/Album'
// import Photo from '@/components/Photo'
// import Asset from '@/components/Asset'

import Smark from '@/components/Smark'

export default {
	data(){
		return{
			defaultIndex: 0,
			navLists:[
			{
				navname : '标签',
				component : 'view-page',
				title:'暂时没有关注的标签~~',
				innerText : '添加标签'
			},{
				navname : '关注',
				component : 'follow',
				title:'暂时没有关注的标签~~',
				innerText : '添加关注'
			},{
				navname : '粉丝',
				component : 'fans',
				title:'暂时没有关注的标签~~',
				innerText : '添加粉丝'
			},{
				navname: '专辑',
				component : 'album',
				title:'暂时没有关注的标签~~',
				innerText : '添加关注'
			},{
				navname : '图片',
				component : 'photo',
				title:'暂时没有关注的标签~~',
				innerText : '添加图片'
			},{
				navname: '留言',
				component : 'asset',
				title:'暂时没有关注的标签~~',
				innerText : '添加留言'
			}],
			defaultdata : {}
		}
	},
	components:{
		ViewPage,
		// Follow,
		// Fans,
		// Album,
		// Photo,
		// Asset,
		Smark
	},
	mounted(){
		var navParent = document.getElementsByClassName('panelNav')[0];
		var child = navParent.childNodes[0].childNodes[0];
		this.tabnav(child,0)
	},
	methods:{
		tabnav(el, index){
			this.clearClass();
			el.classList.add('active')
			//this.currentView = this.navLists[index].component;
			this.defaultdata = this.navLists[index]
			//console.log(this.nodata)
		},
		clearClass() {
			var navParent = document.getElementsByClassName('panelNav')[0];
			var children = navParent.childNodes;

			for(var i = 0; i < children.length; i ++) {
				children[i].childNodes[0].classList.remove('active')
			}
		}
	}
}
</script>

<style>
.panelNav{	background-color: #fff;}
.panelNav li{width:114px;display: inline-block;text-align: center;}
.panelNav a{margin:0 auto;line-height: 40px;width: 48px;display: block;color:#333;font-size: 16px;border-bottom: 4px solid transparent}
.panelNav a.active{border-bottom: 4px solid #ff6666;}
.user-list {    max-width: 960px;   margin: 0 auto;    margin-top: 20px;    position: relative;   min-height: 300px;    margin-bottom: 80px;}
</style>