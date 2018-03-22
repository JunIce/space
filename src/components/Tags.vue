<template>
    <div>

    <template v-if="tagsList.length > 0">
		<ul class="tagsBox">
			<template v-if="isSelf">
				<li 
				class="tag addBtn"
				@click="showMarsk"
				></li>
			</template>
			<li 
			v-for="(tag,index) in tagsList" 
			class="tag"
			@mouseenter="isSelf && showClose($event,index)"
			@mouseleave="isSelf && hideClose($event,index)"
			>
				<a :href="'/label/'+ tag.tagid ">{{tag.tagname}}</a>
				<i class="rmTag"
				   :id="'rm_'+ tag.tagid" 
					@click="isSelf && rmTag($event,index)"
				></i>
			</li>
		</ul>
		
	</template>
	<template v-else>
		<AddPage :nomessage="notags"></AddPage>
	</template>

	<template v-if="marsk">
		<smark :component="addTag" :propsdata="tagsList"></smark>
	</template>
</div>
</template>
<script>
import AddPage from '@/components/AddPage'
import Smark from '@/components/Smark'
import bus from '@/components/bus'

export default {
	name:'Tags',
	props:['data'],
	data(){
		return{   
			addTag: 'pubRecTag', 
		    marsk : false ,
		    notags : {
		    	type: 'tag',
		    	title:'暂时没有关注的标签~~',
		    	titleurl:'javascript:;',
		    	btnName:'添加标签'
		    },
		    tagsList : this.data
		}
	},
	mounted(){
		var self = this
		bus.$on('closeBox',function(data) {
			self.marsk = false
		})
		bus.$on('nomessage_tag',function(data) {
			self.showMarsk();
		})
	},
	components:{
		Smark,
		AddPage
	},
	methods:{
		showMarsk(){
			this.marsk = true
			bus.$emit('userTags',this.data);
		},
		showClose(e){
			e.target.childNodes[2].style.display = 'block'
		},
		hideClose(e){
			e.target.childNodes[2].style.display = 'none'
		},
		rmTag(e,index){
			
			var id = e.target.id.match(/\d+/)[0];
			this.$http.post('/api/cancelSub/',{tagid:id})
				.then(res => {
					var data = res.body;
					if(data.status == 1) {
						bus.$emit('rmTag',index)
					}
				})
		},
		closeBox(data){
			
		}
	},
	computed:{
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