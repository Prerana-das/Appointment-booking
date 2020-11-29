export default {
	data() {
		return {

			
			// siteUri: 'https://backoffice.forehand.se/',
			// siteUri: 'http://backoffice.localhost/',

			siteUri: 'http://127.0.0.1:8000/',


			
			
			
		}
	},
	methods: {
		async callApi(method, url, dataObj) {
			try {

				let data = await axios({
					headers: {
						'Accept': 'application/json',
						'Content-Type': 'application/json',
					},
					method: method,
					url: url,
					data: dataObj
				})
				return data

			} catch (e) {

				return e.response
			}
		},
		s(msg, i = 'Great!') {
            this.$Notice.success({
                title: i,
                desc: msg
            });
        },
        w(msg, i = 'Hi!') {
            this.$Notice.warning({
                title: i,
                desc: msg
            });
        },
        e(msg, i = 'Oops!') {
            this.$Notice.error({
                title: i,
                desc: msg
            });
        },
        swr() {
            this.$Notice.error({
                title: 'Oops',
                desc: 'Something went wrong, please try again later'
            });
        },



	}
}