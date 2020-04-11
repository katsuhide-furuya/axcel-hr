<template>    
    <transition name='modal'>
        <div class='modal-mask'>
            <div class='modal-wrapper'>
                <div class='modal-container'>
                    <div class='modal-header'>
                        <slot class='' name='header'>default header</slot>
                        <v-icon v-on:click='$emit("close")' class='modal-close-button' name='times'></v-icon>
                    </div>

                    <div class='modal-body'>
                        <slot name='body'>default body</slot>
                    </div>

                    <div class='modal-footer'>
                        <slot name='footer'>default footer</slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.modal-mask {
	position: fixed;
	z-index: 9998;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	display: table;
	transition: opacity 0.3s ease;
}

.modal-wrapper {
	display: table-cell;
	vertical-align: middle;
}

.modal-container {
	width: 70%;
	min-width: 0;
	margin: 5vh auto;
	background-color: #fff;
	background-clip: border-box;
	border: 1px solid rgba(0, 0, 0, 0.125);
	border-radius: 0.25rem;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	transition: all 0.3s ease;
}

.modal-header {
	height: 10vh;
}

.modal-footer {
	height: 10vh;
	justify-content: flex-start !important;
}

.modal-header h3 {
	margin-top: 0;
	color: #42b983;
}

.modal-body {
	max-height: 70vh;
	overflow-y: scroll;
}

.modal-close-button {
	float: right;
	cursor: pointer;
}

.modal-enter, .modal-leave-active {
	opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
}
</style>

<script>
</script>
