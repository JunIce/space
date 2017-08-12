
<script>
import AddPage from '@/components/AddPage'
export default {
	props: ['nodata'],
	components:{
		AddPage
	},
	render(h) {		
		return h(AddPage ,{
			props: {
				someProps: this.nodata
			}
		})
	}
}
</script>
