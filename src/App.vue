<template>
  <div id="app">
    <panel></panel>
    <panelnav></panelnav>
  </div>
</template>

<script>

import Panel from '@/components/Panel'
import PanelNav from '@/components/PanelNav'

export default {
  name: 'app',
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
a{text-decoration: none;}
ul,li,p,a{padding: 0;margin:0;}
li{list-style: none}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50; 
}
</style>
