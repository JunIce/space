<template>
  <div id="app">
    <panel :userprofile="userprofile" :userdetail="userdetail"></panel>
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
      })

      bus.$on('rmTag',(data) => {
          self.userdetail.tags.splice(data,1);
      })
      
      bus.$on('createAlbum',(data) => {
          self.userdetail.album.create.unshift(data);
      })

      bus.$on('cancelFollow',(data) => {
          self.userdetail.follow.splice(data,1);
      })

      app['login'] = this.isLogin;
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
      },
      isLogin(){
         return $user.userid ? true : false;
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
