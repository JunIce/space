<template>
	<div id="showTips">
		<div class="bg-color"></div>
	</div>
</template>

<style scoped>
	#showTips {
	    width: 100%;
	    height: 100%;
	}
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