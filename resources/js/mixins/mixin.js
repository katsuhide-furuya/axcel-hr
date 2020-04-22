export default {
    methods: {
        toastSuccess: function(msg) {
            this.$toasted.success(msg, { 
                theme: 'bubble',
                position: 'bottom-right',
                action: {
                    text : 'CLOSE',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0)
                    }
                },
                duration : 5000
            })
        },
        toastInfo: function(msg) {
            this.$toasted.info(msg, { 
                theme: 'bubble',
                position: 'bottom-right',
                action: {
                    text : 'CLOSE',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0)
                    }
                },
                duration : 5000
            })
        },toastError: function(msg) {
            this.$toasted.error(msg, { 
                theme: 'bubble',
                position: 'bottom-right',
                action: {
                    text : 'CLOSE',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0)
                    }
                },
                duration : 5000
            })
        },
    }
}