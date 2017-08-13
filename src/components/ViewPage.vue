
<script>
import AddPage from '@/components/AddPage'
export default {
	props: ['defaultdata'],
	components:{
		AddPage
	},
	render(h) {		
		console.log(this.defaultdata)
		return h(AddPage ,{
			props: {
				someProps: this.defaultdata
			}
		})
	}
}
</script>
