<template>
    <div>
		<ul class="tagsBox">
			<li 
			v-for="(tag,index) in tagsList" 
			class="tag"
			@mouseenter="isSelf && showClose($event,index)"
			@mouseleave="isSelf && hideClose($event,index)"
			>
				<a :href="tag.titleurl">{{tag.tagname}}</a>
				<i class="rmTag"
					@click="isSelf && rmTag($event,index)"
				></i>
			</li>
			<template v-if="isSelf">
				<li 
				class="tag addBtn"
				@click="showMarsk"
				></li>
			</template>
			
		</ul>
			<template v-if="marsk">
				<smark></smark>
			</template>
		</div>
</template>
<script>
import Smark from '@/components/Smark'
import bus from '@/components/bus'

export default {
	name:'Tags',
	props:['data'],
	data(){
		return{    
		    marsk : false        
		}
	},
	mounted(){
		console.log(bus)
		bus.$on('closeBox',function(data) {
			console.log(data)
		})
	},
	components:{
		Smark
	},
	methods:{
		showMarsk(){
			this.marsk = true
		},
		showClose(e){
			e.target.childNodes[2].style.display = 'block'
		},
		hideClose(e){
			e.target.childNodes[2].style.display = 'none'
		},
		rmTag(e,index){

		},
		closeBox(data){
			console.log(data)
		}
	},
	computed:{
		tagsList(){
			this.data.map(function(i){
				i['titleurl'] = '/label/'+ i.tagid;
			})

			return this.data
		},
		isSelf(){
			return app.userprofile.userid == $user.userid ? true : false;
		}
	}
}
</script>

<style scoped>
a{color:#666;}
.tagsBox{
	display: flex;
	flex-wrap:wrap;
}
.tag{
	width:140px;
	background-color: #fff;
	line-height: 68px;
	text-align: center;
	border-radius: 5px;
	margin:10px;
	position: relative;
}
.addBtn{
	background-image: url(../assets/plus.png);
	background-size: 40px ;
	background-position: center;
	background-repeat: no-repeat;
	cursor: pointer;
}
.rmTag{
	width: 12px;height: 12px;
	display: inline-block;
	position: absolute;
	top: 6px;
	right: 6px;
	background-image: url(../assets/close_16.png);
	background-size: contain;
	display: none;
	cursor: pointer;
}
</style>