
<script>
import AddPage from '@/components/AddPage'
import Follow from '@/components/Follow'
import Tags from '@/components/Tags'

import Fans from '@/components/Fans'
import Album from '@/components/Album'
import Photo from '@/components/Photo'
import Asset from '@/components/Asset'

export default {
	props: ['defaultdata'],
	components:{
		AddPage,
		Tags,
		Follow,
		Fans,
		Album,
		Photo,
		Asset,
	},
	render(h) {		
		var component = this.defaultdata['component'];
		var data = this.defaultdata['data'];
		console.log(typeof data)
		if(typeof data == 'object') {
			console.log(this.firstUpperCase(component))
			return h(this.firstUpperCase(component) ,{
				props: {
					someProps: data
				}
			})
		}else{
			return h(AddPage ,{
				props: {
					someProps: this.defaultdata
				}
			})
		}		
	},
	methods:{
	  firstUpperCase(str) {
		  return str.toLowerCase().replace(/( |^)[a-z]/g, (L) => L.toUpperCase());
		}
	}
}
</script>
