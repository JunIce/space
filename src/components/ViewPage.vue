
<script>

import Follow from '@/components/Follow'
import Tags from '@/components/Tags'

import Fans from '@/components/Fans'
import Album from '@/components/Album'
import Photo from '@/components/Photo'
import Asset from '@/components/Asset'

export default {
	props: ['defaultdata'],
	components:{
		
		Tags,
		Follow,
		Fans,
		Album,
		Photo,
		Asset,
	},
	render(h) {		
		var component = this.firstUpperCase(this.defaultdata['component']);
		var data = this.defaultdata['data'];
		
			return h(component ,{
				props: {
					data: data
				}
			})
		
	},
	methods:{
	  firstUpperCase(str) {
	  	var str = str || '';
		  return str.toLowerCase().replace(/( |^)[a-z]/g, (L) => L.toUpperCase());
		}
	}
}
</script>
