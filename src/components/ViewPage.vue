
<script>
import AddPage from '@/components/AddPage'
export default {
	props: ['defaultdata'],
	components:{
		AddPage
	},
	render(h) {		
		return h(AddPage ,{
			props: {
				someProps: this.defaultdata
			}
		})
	}
}
</script>
