    var globData = [];
    new Vue({
        el: '#app',
        data: {
            albumCart: [],
            albums: [],
            show: false,
			isActive: false
        },
        computed: {
            total() {
                return this.albumCart.reduce((total, el) => {
                    return total + el.price;
                }, 0);
            },
            count() {
                return this.albumCart.length
            }
        },
        methods: {
            addAlbumCart(i) {
                this.albumCart.push({
                    artwork: this.albums[i].artwork,
                    name: this.albums[i].name,
                    price: this.albums[i].price,
                });
                this.saveCart();
            },
            removeAlbum(i) {
                this.albumCart.splice(i, 1);
                this.saveCart();
            },
            saveCart() {
                const parsed = JSON.stringify(this.albumCart);
                localStorage.setItem('cart', parsed);
            },

            fetchData: function() {
                let self = this
                const myRequest = new Request('https://itunes.apple.com/lookup?amgArtistId=5723&entity=album&limit=10')

                fetch(myRequest)
                    .then((response) => { return response.json() })
                    .then((data) => {
                        let temp = [];
                        for (let i = 0; i < data.results.length; i++) {
                            if (data.results[i].wrapperType != 'artist') {
                                temp[i - 1] = {
                                    artwork: data.results[i].artworkUrl60,
                                    name: data.results[i].collectionName,
                                    price: data.results[i].collectionPrice
                                };
                            }
                        }
                        self.albums = temp;
                    }).catch(error => { console.log(error); });

            },
			launch: function() {
			  this.isActive = true;
			},
			close: function() {
			  this.isActive = false;
			}
        },
        mounted() {
            this.fetchData();

            if (localStorage.getItem('cart')) {
                try {
                    this.albumCart = JSON.parse(localStorage.getItem('cart'));
                } catch (e) {
                    localStorage.removeItem('cart');
                }
            }
        },
    })