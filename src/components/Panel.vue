<template>
  <div class="panelsUser cl">
        <div class="user">
          <div class="panels-user-head">
            <img :src="this.userprofile.userpic" alt="">
          </div>
          <div class="panels-user-info">
            <h1>{{this.userprofile.username}}</h1><i class="user-sex male"></i>
            <span>{{this.userprofile.email}}</span>
            <span class="user-psign">{{this.userprofile.sign}}</span>
          </div>
        </div>

         <div class="userPageBtn">
            <template v-if="isSelf">
              <a href="/e/member/EditInfo/" class="userInChg">修改资料</a>
            </template>
            <template v-else>
              <a href="javascript:;" class="sendMsg"></a>
              <a href="javascript:;" 
              class="Follow"
              :class="{'userHsFol':hasFollow}"
              @click="addFol"
              ></a>
            </template>
              <div class="userHots">
                <div class="fr"><span>关注</span><i>{{this.followers}}</i></div>
                <div class="fr"><span>粉丝</span><i>{{this.fans}}</i></div>
              </div>
            </div>

          <div class="user-fen">
              <p>积分 : <span>{{this.userfen}}</span></p>
              <p>金币 : <span>{{this.usermoney}}</span></p>
          </div>
      </div>
</template>

<script>
export default {
  name: 'Panel',
  props:['userprofile', 'userdetail'],
  data () {
    return {
        hasFollow: false
    }
  },
  mounted(){
    this.hasFollow = app.hasfollow ? true : false
  },
  computed:{
    followers(){
        var data = this.userdetail.follow || [];
        return data.length || 0
    },
    fans(){
      var data = this.userdetail.fans || [];
        return data.length || 0
    },
    isSelf(){
      return app.userprofile.userid == $user.userid ? true : false;
    },
    userfen(){
      return parseInt(app.userprofile.userfen);
    },
    usermoney(){
      return parseInt(app.userprofile.money);
    },
  },
  methods:{
    clFollow(e){
      e.target.classList.add('clFol')
    },
    addFol(){
      var self = this
        if(!app['login']) {
          alert('请先登录'); return;
        }
        if(!this.hasFollow) {
           this.$http.post('/api/follow/',{
            fusr: self.userprofile.userid
           })
           .then(res => {
              var data = res.body
              if(data.status == 1) {
                 this.hasFollow = 1
              }
           })
        }else{
            this.$http.post('/api/cancelFollow/',{
            s_user:  self.userprofile.userid
           })
           .then(res => {
              var data = res.body
              if(data.status == 1) {
                  this.hasFollow = 0
              }
           })
        }
    }
  }
}
</script>

<style scoped>
.panelsUser {
    padding: 60px 0 50px 0;
    background: #fff;
    text-align: center;
    position: relative;
    margin-top: 60px;
}
.panels-user-head img {
    width: 125px;
    height: 125px;
    outline: 0;
    border-radius: 100px;
}
.panels-user-info {
    padding: 8px 0 0 0;
}
.panels-user-info h1 {
    font-size: 16px;
    color: #333;
    display: inline-block;
}
.panels-user-head img{width:125px;height:125px;outline:0;border-radius:100px}
.panels-user-info{padding:8px 0 0 0}
.panels-user-info h1{font-size:16px;color:#333;display:inline-block}
.user-sex{width:15px;height:15px;background-image:url(../assets/pub.png);background-size:48px 112px;display:inline-block;vertical-align:middle;margin-left:12px}
.male{background-position:-33px -49px}
.female{background-position:-33px -65px}
.panels-user-info span{font-size:12px;color:#666;display:block;margin-top:10px}
.panels-user-info .user-psign{color:#ccc}

.userPageBtn {
    position: absolute;
    top: 45px;
    right: 45px;
}


.userHots div {
    display: inline-block;
    margin-top: 24px;
    padding: 0 11px;
}
.userHots i, .userHots span {
    display: block;
    text-align: center;
    font-style: normal;
    font-size: 14px;
    color: #999;
}
.userHots i {
    font-size: 16px;
    color: #333;
    margin-top: 8px;
    font-weight: 700;
}
.userInChg{
  background-color: #f66;
    color: #fff;
  display: inline-block;
  font-size: 14px;
  border-radius: 4px;
  vertical-align: middle;
  position: relative;
  height: 32px;
  line-height: 32px;
  width: 120px;
}
.Follow{
  background-image: url(../assets/guan.png);
  background-color: #f66;
  color: #fff;
  display: inline-block;
  font-size: 14px;
  border-radius: 4px;
  vertical-align: middle;
  position: relative;
  height: 32px;
  line-height: 32px;
  width: 120px;
}
.clFol{
    background-position: 0 -30px;
}
.userHsFol{
  background-color:#34cd99;
  background-position: 0 -63px;
}
.userHsFol:hover{
  background-position: 0 -30px;
  background-color:#ff6666;
}
.user-fen{
  position: absolute;
  top: 45px;
  left: 45px;
  font-size: 14px;
  color:#999;
  line-height: 24px;
  text-align: left;
}
.user-fen span{color:#666;}
</style>
