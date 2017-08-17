<template>
  <div id="app">
    <panel :userprofile="userprofile"></panel>
    <panelnav :detail="userdetail"></panelnav>
  </div>
</template>

<script>
import bus from '@/components/bus'
import Panel from '@/components/Panel'
import PanelNav from '@/components/PanelNav'

export default {
  name: 'app',
  data(){
    return{
    }
  },
  mounted(){
      var self = this;

      bus.$on('addTag',(data) => {
        var tags = self.userdetail.tags ? self.userdetail.tags :[];
          
          tags.unshift(data)
          console.log(self.userdetail)
      })

      bus.$on('rmTag',(data) => {
          self.userdetail.tags.splice(data,1);
      })

  },
  computed:{
      appdata(){
          return app;
      },
      userprofile(){
         return this.appdata.userprofile;
      },
      userdetail(){
         return this.appdata.detail;
      }
  },
  components:{
     'panel' : Panel,
     'panelnav' : PanelNav
  }
}
</script>

<style>
body{
  background-color: #f6f6f6;
}
body.noscroll{position:fixed;width:100%}
a{text-decoration: none;}
ul,li,p,a{padding: 0;margin:0;}
li{list-style: none}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50; 
  width: 960px;
  margin:auto;
}
</style>
