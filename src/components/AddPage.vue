
<script>

export default {
	props:['someProps'],
	render(h) {
		var p = h('p',{
						domProps:{
							innerHTML: this.someProps.title
						},
					    attrs: {
						    class : 'no-tag-title'
						}
					});
		var a = h('a',{
					domProps:{
						innerHTML: this.someProps.innerText
					},
				    attrs: {
				    	href : 'javascript:;',
					    class : 'add-tags-btn'
					}
				})

		return h('div',{},[p, a])
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