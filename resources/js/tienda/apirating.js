const apirating = new Vue({
    el: "#apirating",
    data: {
        rating: 0,
        review_rating: '',
        user_id: $('#user_id_rating').val(),
        product_id: $('#product_id_rating').val(),

        totalrate: 0,
        totaluser: 0,

        bar1: 0,
        bar2: 0,
        bar3: 0,
        bar4: 0,
        bar5: 0,

        pregunta_prod: '',
        comments: []
    },
    created() {
        this.getRating()
    },
    methods: {
        setRating() {
            if (this.user_id != '') {
                if (this.rating > 0) {
                    Swal.fire({
                        title: "Estas seguro de proceder con la valoración?",
                        //text: "¡No podrás revertir esto!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí!",
                        cancelButtonText: "Cancelar"
                    }).then(result => {
                        if (result.value) {
                            axios
                            .get("http://tiendademo1.test/api/rating/new", {
                                params: { product_id: this.product_id, user_id: this.user_id, rating:this.rating, review_rating:this.review_rating }
                            })
                            .then(response => {
                                if (response.data == 'positivo') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Gracias por tu Valoración!',
                                        showConfirmButton: false,
                                        timer: 1200
                                    })
                                    this.getRating()
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Fallo al Valorar!',
                                        showConfirmButton: false,
                                        timer: 1200
                                    })
                                }
                            }).catch(err => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Fallo al Valorar!',
                                    showConfirmButton: false,
                                    timer: 1200
                                })
                            })
                        } else {
                            Swal.fire(
                                "Cancelado!",
                                "Cancelado!",
                                "error"
                            );
                        }
                    })
                    
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fallo al Valorar!',
                        showConfirmButton: false,
                        timer: 1200
                    })
                }
            }
        },
        getRating() {
            fetch(`http://tiendademo1.test/api/rating/${this.product_id}`)
            .then(res => res.json())
            .then(res => {
                var mydata = res.data
                this.totaluser = mydata.length
                var sum = 0
                for (var i = 0; i < mydata.length; i++) {
                    sum += parseFloat(mydata[i]['rating'])
                }
                var avg = sum/mydata.length
                this.totalrate = parseFloat(avg.toFixed(1))

                if (isNaN(this.totalrate)) {
                    this.totalrate = 0
                }

                var barT = 0
                var bar1 = 0
                var bar2 = 0
                var bar3 = 0
                var bar4 = 0
                var bar5 = 0
                for (var j = 0; j < mydata.length; j++) {
                    if (parseInt(mydata[j]['rating']) == '1') {
                        bar1 += 1
                    }
                    if (parseInt(mydata[j]['rating']) == '2') {
                        bar2 += 1
                    }
                    if (parseInt(mydata[j]['rating']) == '3') {
                        bar3 += 1
                    }
                    if (parseInt(mydata[j]['rating']) == '4') {
                        bar4 += 1
                    }
                    if (parseInt(mydata[j]['rating']) == '5') {
                        bar5 += 1
                    }
                }
                barT = bar1 + bar2 + bar3 + bar4 + bar5
                bar1 = (bar1 * 100) / barT
                bar2 = (bar2 * 100) / barT
                bar3 = (bar3 * 100) / barT
                bar4 = (bar4 * 100) / barT
                bar5 = (bar5 * 100) / barT
                $('.bar-1').css('width', bar1+'%')
                $('.bar-2').css('width', bar2+'%')
                $('.bar-3').css('width', bar3+'%')
                $('.bar-4').css('width', bar4+'%')
                $('.bar-5').css('width', bar5+'%')

                this.bar1 = bar1 + '%'
                this.bar2 = bar2 + '%'
                this.bar3 = bar3 + '%'
                this.bar4 = bar4 + '%'
                this.bar5 = bar5 + '%'
            }).catch(err => {
                console.log(err)
            })
        },
        setComment() {
            if (this.user_id != '') {
                axios
                .get("http://tiendademo1.test/comment/new", {
                    params: { product_id: this.product_id, user_id: this.user_id, pregunta_prod:this.pregunta_prod }
                })
                .then(response => {
                    if (response.data == 'positivo') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pregunta Enviada!',
                            showConfirmButton: false,
                            timer: 1200
                        })
                        window.setTimeout(function(){
                            location.reload();
                        }, 1200)
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fallo al Preguntar!',
                            showConfirmButton: false,
                            timer: 1200
                        })
                    }
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fallo al Preguntar!',
                        showConfirmButton: false,
                        timer: 1200
                    })
                })
            }
        },
    },
    mounted() {
        
    }
});