<script>
import PubRecTag from '@/components/PubRecTag'

    export default{
        name : 'Smark',
        data(){
            return{

            }
        },
        components:{
            PubRecTag
        },
        mounted(){
            
        },
        render(h) {
            var bg = h('div',{
                    attrs: {
                        class:'bg-color'
                    }
                });
            return h('div',{
                        attrs: {
                            id : 'showTips'
                        }
                },[bg,h(PubRecTag)])
        }
    }
</script>
<style scoped>
	.bg-color {
    position: fixed;
    background-color: #000;
    filter: alpha(opacity=50);
    -moz-opacity: .5;
    -khtml-opacity: .5;
    opacity: .5;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 100;
}
</style>