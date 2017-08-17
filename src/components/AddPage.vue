
<script>
import bus from '@/components/bus'
export default {
	props:['nomessage'],
	render(h) {
		var isSelf = this.isSelf();
		var p = h('p',{
						domProps:{
							innerHTML: this.nomessage.title
						},
					    attrs: {
						    class : 'no-tag-title'
						}
					});
		if(isSelf){
			var a = h('a',{
					domProps:{
						innerHTML: this.nomessage.btnName
					},
				    attrs: {
				    	href : this.nomessage.titleurl,
					    class : 'add-tags-btn'
					},
					on:{
						click:this.clickHandler
					}
				})
		}
		
		return h('div',{},[p, a])
	},
	methods:{
		isSelf(){
			return app.userprofile.userid == $user.userid ? true : false;
		},
		clickHandler(){
			bus.$emit('nomessage_'+ this.nomessage.type, true)
		}
	}
}
</script>

<style scoped>
.no-tag-title{
	margin-top: 160px;
	padding: 24px 0;
	color:#ccc;
	font-size: 16px;
	font-weight: bold;
}
.add-tags-btn{
	width: 160px;
	line-height: 36px;
	border-radius: 40px;
	background-color: #ff6666;
	color:#fff;
	display: block;
	margin: auto;
}
</style>