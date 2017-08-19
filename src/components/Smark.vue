<script>
import PubRecTag from '@/components/PubRecTag'
import AddAlbum from '@/components/AddAlbum'


    export default{
        name : 'Smark',
        props:['component','propsdata'],
        data(){
            return{

            }
        },
        components:{
            PubRecTag,
            AddAlbum
        },
        mounted(){
            
        },
        render(h) {
            var com = this.component
            var bg = h('div',{
                    attrs: {
                        class:'bg-color'
                    }
                });
            var close = h('i',{
                on:{
                    click:this.closeBox
                },
                attrs:{
                    class:"box-close"
                }
            });
            return h('div',{
                        attrs: {
                            id : 'showTips'
                        }
                },[bg,h(com,{
                    props:{
                        data:this.propsdata
                    }
                })])
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