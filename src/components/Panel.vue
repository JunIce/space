<template>
  <div class="panelsUser cl">
        <div class="user">
          <div class="panels-user-head">
            <img src="http://img.reretu.com/2017/07/14/f4f77911b0dd157c_150x150.jpg" alt="">
          </div>
          <div class="panels-user-info">
            <h1>王者</h1><i class="user-sex male"></i>
            <span>110100</span>
            <span class="user-psign">人啊</span>
          </div>
        </div>

         <div class="userPageBtn">
                            <a href="/e/member/EditInfo/" class="userInChg">修改资料</a>
                            <div class="userHots">
                <div class="fr"><span>关注</span><i>8</i></div>
                <div class="fr"><span>粉丝</span><i>1</i></div>
              </div>
            </div>
      </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
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
.userPageBtn a {
    background-color: #f66;
    color: #fff;
    display: inline-block;
    font-size: 14px;
    border-radius: 4px;
    vertical-align: middle;
    position: relative;
}
.userAddFol, .userCanFol, .userHsFol, .userInChg {
    height: 32px;
    line-height: 32px;
    width: 120px;
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
</style>
