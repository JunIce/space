<template>
  <div>
    <ul class="pagination">
      <li class="pre" :class="{'disabled': current == 1}" @click="setCurrent(current - 1)"></li>

      <li v-for="p in grouplist" :class="{'active': current == p.val}" @click="setCurrent(p.val)">
      {{ p.text }}
      </li>

      <li class="aft" :class="{'disabled': current == page}" @click="setCurrent(current + 1)"></li>
    </ul>
  </div>
</template>

<script>
  export default{
    data(){
      return {
        current: this.currentPage
      }
    },
    mounted(){
    },
    props: {
      total: {// 数据总条数
        type: Number,
        default: 0
      },
      display: {// 每页显示条数
        type: Number,
        default: 10
      },
      currentPage: {// 当前页码
        type: Number,
        default: 1
      },
      pagegroup: {// 分页条数
        type: Number,
        default: 5,
        coerce: function (v) {
          v = v > 0 ? v : 5;
          return v % 2 === 1 ? v : v + 1;
        }
      }
    },
    computed: {
      page: function () { // 总页数
        return Math.ceil(this.total / this.display);
      },
      grouplist: function () { // 获取分页页码
        var len = this.page, temp = [], list = [], count = Math.floor(this.pagegroup / 2), center = this.current;
        if (len <= this.pagegroup) {
          while (len--) {
            temp.push({text: this.page - len, val: this.page - len});
          }
          ;
          return temp;
        }
        while (len--) {
          temp.push(this.page - len);
        }
        ;
        var idx = temp.indexOf(center);
        (idx < count) && ( center = center + count - idx);
        (this.current > this.page - count) && ( center = this.page - count);
        temp = temp.splice(center - count - 1, this.pagegroup);
        do {
          var t = temp.shift();
          list.push({
            text: t,
            val: t
          });
        } while (temp.length);
        if (this.page > this.pagegroup) {
          (this.current > count + 1) && list.unshift({text: '...', val: list[0].val - 1});
          (this.current < this.page - count) && list.push({text: '...', val: list[list.length - 1].val + 1});
        }
        return list;
      }
    },
    methods: {
      setCurrent: function (idx) {
        if (this.current != idx && idx > 0 && idx < this.page + 1) {
          this.current = idx;
          this.$emit('pagechange', this.current);
        }
      }
    },
    watch:{
    	total(){
    		this.current = 1
    	}
    }
  }
</script>

<style scoped>
div{
	position: absolute;
    bottom: 0;
    width: 100%;

}
.pagination li{
	display: inline-block;
    width: 24px;
    height: 24px;
    line-height: 24px;
    margin-right: 16px;
	border-radius: 50%;
	cursor: pointer;
	-moz-user-select: none; /*mozilar*/
	-webkit-user-select: none; /*webkit*/
	-ms-user-select: none; /*IE*/
	user-select: none;
}
li a{display: block;color: #646363;}
li:hover{    background: #aaa;color: #fff;}
li.active{color: #fff;    background: #ff6666;}
.pre,.aft{width: 16px;height: 16px;background-image: url(../assets/left.png);background-size: contain;vertical-align: middle;background-repeat: no-repeat;background-position: center;background-size: 20px;margin-top: -1px;}
.aft{transform: rotate(180deg);}
.pre:hover,.aft:hover{background-image: url(../assets/lef.png);background-repeat: no-repeat;background-size: contain;background-position: center;background-size: 20px;}
.aft:hover{transform: rotate(180deg);}
</style>
