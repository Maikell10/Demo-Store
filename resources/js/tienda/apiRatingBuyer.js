const apiratingBuyer = new Vue({
    el: "#apiratingBuyer",
    data: {
        statusC: '',

        calification: '',
        opinion: '',
        
        selectOption: '',

        user_id: '',
        store_user_id: '',
        created_sale: '',
        type_rating: 'STORE'
    },
    created() {
        
    },
    methods: {
        RateBuyer() {
            //this.part = 4
            this.opinion = $('#opinion').val()
            if (this.opinion.length < 11) {
                Swal.fire({
                    icon: 'error',
                    title: 'Alerta!',
                    text: 'Su opinión debe contener más de 10 carácteres!',
                })
            } else {
                this.calification = $('input:radio[name=radioSecond]:checked').val()
                this.statusC = $('#statusC').val()
            
                Swal.fire({
                    title: "Estas seguro de proceder con la calificación?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí!",
                    cancelButtonText: "Cancelar"
                }).then(result => {
                    if (result.value) {
                        axios
                        .get("http://tiendademo1.test/store/rating_seller", {
                            params: { option: this.option, user_id: this.user_id, store_user_id: this.store_user_id, selectOption:this.selectOption, calification:this.calification, opinion:this.opinion, type_rating:this.type_rating, created_sale:this.created_sale, statusC:this.statusC }
                        })
                        .then(response => {
                            if (response.data == 'positivo') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Calificación Enviada!',
                                    showConfirmButton: false,
                                    timer: 1200
                                })
                                window.setTimeout(function(){
                                    location.assign('http://tiendademo1.test/admin/order');
                                }, 1200)
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Fallo al Enviar!',
                                    showConfirmButton: false,
                                    timer: 1200
                                })
                            }
                        }).catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Fallo al Enviar!',
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
            }
            
        },
    },
    mounted() {
        this.user_id = $('#user_id_modal').val()
        this.store_user_id = $('#store_id_modal').val()
        this.created_sale = $('#created_sale_modal').val()
    }
});