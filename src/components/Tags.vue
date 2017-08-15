<template>
	
		<ul class="tagsBox">
			<li v-for="tag in tagsList" class="tag">{{tag.tagname}}</li>
			<li class="tag addBtn"></li>
		</ul>

</template>
<script>

export default {
	props:['data'],
	data(){
		return{ 
		    tagsList : this.data             
		}
	},
	mounted(){
		console.log(this.data)
	},
	componnets:{
	},
	methods:{
	}
	
}
</script>

<style scoped>
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
}
.addBtn{
	background-image: url(../assets/plus.png);
	background-size: 40px ;
	background-position: center;
	background-repeat: no-repeat;
	cursor: pointer;
}
</style>