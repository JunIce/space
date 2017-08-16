<template>
	<div>
		<div class="userCol-nav">
		<template v-for="(btn,index) in btnList">
	        <a href="javascript:;" class="userCol" :class="{userSect:index===number}" @click="selectBtn($event,index)">{{btn}}</a>
	    </template>    
  		</div>

  		<div >
  			<ul class="user-photo-list">
  				<li class="photo" v-for="photo in photoData">  
	                 <a :href="photo.titleurl" :alt="photo.title">
	                  <img :src="photo.titlepic" :alt="photo.title">
	                 </a>
	            </li>
  			</ul>
  		</div>
	</div>
</template>
<script>

export default {
	name:'Photo',
	props:['data'],
	data(){
		return{ 
			 number: 0, // 默认开始
			 btnList:['我收藏的','我发布的'],
		 	 photoData:[]
		}
	},
	mounted(){
		this.number = 0
		this.photoData = this.photoFava
	},
	methods:{
		selectBtn(e, index){
			this.number= index;  
			if(index == 0) {
				this.photoData = this.photoFava
			}else{
				this.photoData = this.photoPub
			}
		}
	},
	computed:{
		photoFava(){
			return this.data.fava
		},
		photoPub(){
			return this.data.public
		},
	}
}
</script>
<style scoped>
.userCol-nav {display: flex;}
.userCol {font-size:12px;color:#333;display: inline-block;    padding: 8px 30px;    background-color: #fff;    text-align: center;   }
.userCol:first-child {border-radius:5px 0 0 5px}
.userCol:last-child {border-radius:0 5px 5px 0}
.userSect {background-color: #ff6666;color: #fff;}

.user-photo-list{width: 966px;margin-left: -3px;display: flex;flex-wrap:wrap;margin-top:20px;}
.photo{width: 25%;box-sizing: border-box;padding: 3px;}
.photo img{width: 100%;display: block;}
</style>
