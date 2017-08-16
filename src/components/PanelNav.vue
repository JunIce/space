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


import Smark from '@/components/Smark'

export default {
	props:['detail'],
	data(){
		return{
			navLists:[
			{
				navname : '标签',
				component : 'tags'
			},{
				navname : '关注',
				component : 'follow',
			},{
				navname : '粉丝',
				component : 'fans'
			},{
				navname: '专辑',
				component : 'album'
			},{
				navname : '图片',
				component : 'photo'
			},{
				navname: '留言',
				component : 'asset'
			}],
			defaultdata : {}
		}
	},
	components:{
		ViewPage,
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
			this.defaultdata = this.navLists[index];
			this.defaultdata['data'] = app['detail'][this.navLists[index]['component']]
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
.user-list {     margin: 0 auto;    margin-top: 20px;    position: relative;   min-height: 300px;    margin-bottom: 80px;}
</style>