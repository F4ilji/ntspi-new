<script>
export default {
	name: "ClientScrollTimeline"
}
</script>

<template>
	<div id="progress"></div>
</template>

<style scoped>

@keyframes grow-progress {
	from { transform: scaleX(0); }
	to { transform: scaleX(1); }
}

#progress {
	top: 0;
	height: 2px;
	background: #26ACB8;
	z-index: 99;
	width: 100%;
	position: fixed;

	transform-origin: 0 50%;
	animation: grow-progress auto linear;
	animation-timeline: scroll();
}

</style>